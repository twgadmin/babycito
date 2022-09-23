<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\CustomService;
use App\Models\Gift;
use App\Models\RegistriesPayment;

use Cart;

class CheckoutController extends Controller
{
    
   protected $stripe; 

   public function __construct(){

    $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET','sk_test_51LGQZ0AzJPkCOpA5mUPaJHeMq6wkOEPZ3YRC3hkTGMwfdH7WiaJkouckDWBtxv5qnuQAgPFK55hDXAXhhJVKmGbN00ow6j5Ww9'));
   }

   public function checkoutMessageSave(Request $request){

        $request->validate([
            'cart.message_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'cart.message_email' => 'required|string|max:128|email:rfc,dns',
            'cart.message_phone' => 'required|numeric',
            'cart.message_text' => 'required|max:1000',
        ]);

        $stripe_product = [];
        $stripe_product_price = [];
        $items = Cart::getContent();
        $total = 0;

        foreach($items as $item){
            $total = $total + $item->price; 
            $stripe_product[] = $this->createStripeProduct($item);
        }
      

        foreach($stripe_product as $sp){
            $stripe_product_price[] = $this->createStripeProductPrice($sp);
        }

        $percentage = env('percentage_deduction',9);
        $t_fee =  ($percentage / 100) * $total;

        $pf_id = $this->createStripeFeeProduct($t_fee);
        $feePrice = $this->createStripePriceFee($t_fee,$pf_id);
        $stripe_product_price[] = $feePrice;


        $checkoutStripeSession = $this->checkoutStripeSession($stripe_product_price, $request, $stripe_product);

        session(['stripe_checkout_id' => $checkoutStripeSession->id]);

        return redirect($checkoutStripeSession->url);

    }

    public function createStripeProduct($product){

        return $this->stripe->products->create([
          'name' => $product->name,
          'metadata' => array_merge($product->attributes->toArray(),['price' => $product->price])
        ]);

    }


     public function createStripeProductPrice($product){

        return $this->stripe->prices->create([
          'unit_amount' =>  (int) ($product->metadata->price * 100),
          'currency' => 'usd',
          'product' => $product->id,
        ]);

    }

    public function createStripeFeeProduct($fee){
        return $this->stripe->products->create([
          'name' =>'Fee',
          'metadata' => ['price' => $fee]
        ]);
    }


     public function createStripePriceFee($fee, $product){

        return $this->stripe->prices->create([
          'unit_amount' =>  (int) ($fee * 100),
          'currency' => 'usd',
          'product' => $product->id,
        ]);

    }

    public function checkoutStripeSession($pricesData, $request, $stripe_product){
        $prices = [];
        $receiver_id = 0;
        foreach($pricesData as $p){
            $prices[] =  ["price" => $p->id, 'quantity' => 1];
        }

        $stripe_product_meta = [];
        foreach($stripe_product as $sp){
            $stripe_product_meta[$sp->id] = json_encode($sp->metadata->toArray());
            $receiver_id =  $sp->metadata->user_id;
        }


        $meta =  array_merge(['gift_message' => json_encode(array_merge($request->cart,['receiver_id' => $receiver_id]))],$stripe_product_meta);

        return $this->stripe->checkout->sessions->create([
          'success_url' => route('checkout-success'),
          'cancel_url' => route('checkout-cancel'),
          'line_items' => $prices,
          'mode' => 'payment',
          'metadata' => $meta
        ]);

       
    }

    public function checkoutSuccess(Request $request){

        if ($request->session()->has('stripe_checkout_id')) {
            //
            $stripe_checkout_id = $request->session()->get('stripe_checkout_id');
            $intenet_response = $this->stripe->checkout->sessions->retrieve($stripe_checkout_id,[]);
            echo "<pre>";
            print_r($intenet_response);
            exit();    
            $meta = $intenet_response->metadata;
            $gift_data = json_decode($intenet_response->metadata->gift_message);

            if($intenet_response->payment_status == "paid"){

                $receiver = json_decode($meta);
                $gift = new Gift;
                $gift->receiver_id = $gift_data->receiver_id;
                $gift->giver = $gift_data->message_name;
                $gift->email = $gift_data->message_email;
                $gift->phone = $gift_data->message_phone;
                $gift->message = $gift_data->message_text;
                $gift->meta = $meta;
                $gift->save();

                unset($meta['gift_message']);

                foreach($gift->meta as $key => $m){
                    if($key == "gift_message"){
                        continue;
                    } 

                    $dm = json_decode($m);
                    //RegistriesPayment
                    RegistriesPayment::create([
                        'gift_id' => $gift->id,
                        'user_id' => $gift->receiver_id,
                        'price' =>  $dm->price,
                        'registry_service_id' =>  $dm->registry_service_id,
                    ]);
                }                
            }


            $request->session()->forget('stripe_checkout_id');
            Cart::clear();

            return redirect('/')->with('success','Gift sent succesfully');
        }
    }

    public function checkoutCancel(){
            return redirect('/checkout/message')->with('error','Gift not send payment issue');
    }
    
}
