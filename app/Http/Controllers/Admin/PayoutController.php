<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Gift;

class PayoutController extends Controller
{
    
    protected $stripe; 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
          $this->middleware('auth:admin');

         $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET','sk_test_51LGQZ0AzJPkCOpA5mUPaJHeMq6wkOEPZ3YRC3hkTGMwfdH7WiaJkouckDWBtxv5qnuQAgPFK55hDXAXhhJVKmGbN00ow6j5Ww9'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifts  = Gift::with('payment.user','payment.service')->latest()->paginate(1000);
        $stripe_balance = $this->stripe->balance->retrieve();

        return view('admin.payout.index', compact('gifts','stripe_balance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }


    public function payout($id){

        $gift  = Gift::with('payment.user','payment.service')->findOrFail($id);
        $amount = 0;
        $user_account = 0;
        if($gift->status <> 'paid'){

            foreach($gift->payment as $k => $pay){
                $amount = ($amount + $gift->payment[$k]->price);
                $user_account = $pay->user->stripe_code;
            }

            // check user stripe account is connected
            try{
                $this->stripe->accounts->retrieve(
                    $user_account,
                    []
                );
            }catch (\Stripe\Exception\ApiErrorException $e) {
                 return redirect()
                ->route('admin.payout.index')
                ->with('error', 'User stripe account not connected');
            }

            // check available balance
            $stripe_balance = $this->stripe->balance->retrieve();
            $available_balace = $stripe_balance->available[0]->amount/100;

            if($available_balace < $amount){
                 return redirect()
                ->route('admin.payout.index')
                ->with('error', 'You available balance is insufficient');
            }

            // make payment 

            $st_resp = $this->stripe->transfers->create([
              'amount' => $amount*100,
              'currency' => 'usd',
              'destination' => $user_account,
            ]);

            $gift->items = $st_resp;
            $gift->amount = $amount;
            $gift->status = "paid";
            $gift->save();

             return redirect()
                ->route('admin.payout.index')
                ->with('success', 'Amount has been transfered successfully');

        }else{

             return redirect()
                ->route('admin.payout.index')
                ->with('error', 'Gift already been paid');

        }
    }
}
