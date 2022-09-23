<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Front\Controller;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\RegistryEvent;
use App\Models\User;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Category;
use App\Models\FeaturedImage;
use App\Models\RegistryEventUser;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\UserMediaFile;
use App\Models\ServiceSection;
use App\Models\CustomService;
use App\Models\Banner;
use App\Models\Gift;
use App\Models\Registry;
use App\Models\BlogCategory;
use App\Models\CategoryCustomService;
use App\Models\OneTimeGift;
use Illuminate\Http\Request;
use App\Http\Requests\Front\StoreContactRequest;
use Mail;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Cart;
use Newsletter;


class HomeController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/view-registry';
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $blogs = Blog::getAllBlogsWithUser();
        $featured_image = FeaturedImage::getActiveFeaturedImage();    
        $testimonials = Testimonial::getAllTestimonials();
        $services = Service::all();
        $service_sections = ServiceSection::all();

        $anticipation = Page::find(9);
        $birth = Page::find(10);    
        $continuedcare = Page::find(11);
        $learnaboutservices = Page::find(12);
        $connectwithproviders = Page::find(13);
        $getthesupport = Page::find(14);

        return view('front.pages.home', compact('blogs', 'featured_image', 'testimonials','services','service_sections','anticipation','birth','continuedcare','learnaboutservices','connectwithproviders','getthesupport'));
    }
    public function about()
    {
        $pages = Page::with('mediaFiles')->where('slug','LIKE','%about%')->where('slug','LIKE','%about-us%')->first();
        return view('front.pages.about-us',compact('pages'));
    }
    public function providers(Request $request)
    {
        $banner = Banner::find(1);
        $categories = Category::whereNull('deleted_at')->orderBy('name')->get();
        $category = Null;
        if($request->category){
            $category = Category::where('slug',$request->category)->whereNull('deleted_at')->pluck('id');
        }
        $custom_services = CustomService::when($request->category,function($query) use ($category){
            return $query->whereHas('categoryCustomService',function($query) use ($category){
                return $query->whereIn('category_id',$category);
            });
        })->where('status',1)
        ->whereHas('user',function($q){
            return $q->where('user_type',2)->where('approved',1);
        })->with('user')
        ->groupBy('vendor_id')->whereNull('deleted_at')->paginate(10);
        return view('front.pages.providers',compact('categories','custom_services','banner'));
    }
    public function providerdetail($id, Request $request)
    {

        $category = Null;
        if($request->category){
            $category = Category::where('slug',$request->category)->whereNull('deleted_at')->pluck('id');
        }
        $user = User::findOrFail($id);
        $custom_services = CustomService::when($request->category,function($query) use ($category){
        return $query->whereHas('categoryCustomService',function($query) use ($category){
            return $query->whereIn('category_id',$category);
        });
        })->where('status',1)->where('vendor_id',$id)->get();
            $userMediaFiles = UserMediaFile::where('user_id',$id)->whereNull('deleted_at')->get();
            
        return view('front.pages.provider-detail',compact('user','userMediaFiles','custom_services'));
    }
    public function registry()
    {
        return view('front.pages.registry');
    }
    public function blog(Request $request)
    {
        $data = Blog::getAllBlogsList($request);    
        return view('front.pages.blog', compact('data'));
    }

    public function blogCategory(Request $request)
    {
        $data = Blog::getAllBlogsWithUserWithCategory($request->search_keyword); 
        $data_category = "yes";   
        return view('front.pages.blog', compact('data','data_category'));
    }

    public function blogPost($id)
    {
        $blog_categories = BlogCategory::all();
        $data = Blog::getAllBlogsWithUser(['blogs.id' => $id])->first();
        $recent_blogs = Blog::where('id','!=',$id)->latest()->take(3)->get();
        return view('front.pages.blog-post', compact('data','blog_categories','recent_blogs'));
    }
    public function contact()
    {
        $pages = Page::with('mediaFiles')->where('slug','LIKE','%contact%')->where('slug','LIKE','%contact-us%')->first();
        return view('front.pages.contact-us', compact('pages'));
    }

    public function contactSave(StoreContactRequest $request)
    {
         $data = $request->except([
            '_token',
            '_method'
        ]);

        Contact::create($data);

         Mail::send(
            'emails.admin.contactEmail', 
            [
                'name' => $data['name'],
                'phone'  => $data['phone'],
                'email'      => $data['email'],
                'message_d'  => $data['message']
            ],
            function ($message){

                $message->to(env('MAIL_FROM_ADDRESS'));
                $message->cc(['faizan.ahmedtwg@gmail.com','babycito@mailinator.com']);
                $message->subject('Contact Us');
            }
        );

        return redirect()
            ->back()
            ->with('status', 'Thanks for contacting us.');

        // code...
    }
    public function termsnconditions()
    {
        $pages = Page::with('mediaFiles')->where('slug','LIKE','%terms%')->where('slug','LIKE','%condition%')->first();
        return view('front.pages.terms-and-conditions',compact('pages'));
    }
    public function privacypolicy()
    {
        $pages = Page::with('mediaFiles')->where('slug','LIKE','%privacy%')->where('slug','LIKE','%privacy-policy%')->first();
        return view('front.pages.privacy-policy',compact('pages'));
    }
    public function cookiepolicy()
    {
        $pages = Page::with('mediaFiles')->where('slug','LIKE','%cookie%')->where('slug','LIKE','%cookie-policy%')->first();
        return view('front.pages.cookie-policy',compact('pages'));
    }
    public function helpcenter()
    {
      $pages = Page::with('mediaFiles')->where('slug','LIKE','%help%')->where('slug','LIKE','%help-center%')->first();
      $aboutbabycitos = Faq::whereNull('deleted_at')->where('is_active',1)->where('user_type',3)->orderByRaw('CAST(ordering AS INTEGER)')->get();
      $providers = Faq::whereNull('deleted_at')->where('is_active',1)->where('user_type',2)->orderByRaw('CAST(ordering AS INTEGER)')->get();
      $registries = Faq::whereNull('deleted_at')->where('is_active',1)->where('user_type',1)->orderByRaw('CAST(ordering AS INTEGER)')->get();
      return view('front.pages.help-center',compact('pages','providers','registries','aboutbabycitos'));
    }
    public function findregistry()
    {
        return view('front.pages.find-registry');
    }
    public function createregistry()
    {
        return view('front.pages.create-registry');
    }

    public function deleteRegistryEvent($id, Request $request){

        $ev =  RegistryEventUser::findOrFail($id);
        $ev->delete();

        session()->flash('status', 'Your registry was updated successfully.');
        return redirect()->back();

    }
    public function saveRegistryEvent(Request $request){

        if($register_event = RegistryEventUser::where('user_id',$request->user()->id)->where('registry_event_id', $request->registry_event)->first()){
            $register_event->event_date = $request->event_date;
            $register_event->save();
        }else{
             RegistryEventUser::create([
            'registry_event_id' => $request->registry_event,
            'event_date' => $request->event_date,
            'user_id' => $request->user()->id,
        ]);
        }

         session()->flash('status', 'Your registry was updated successfully.');
         return redirect()->back();
    }

    public function saveRegistryUser(Request $request)
    {
         $this->validator($request->all())->validate();

        event(new Registered($user = $this->createregistryUser($request->all())));

        Auth::login($user);
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'first_name'            => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:50'],
            'last_name'             => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:50'],
            'phone'                 => ['required', 'numeric'],
            'user_type'             => ['required', 'numeric'],
            'email'                 => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password'              => [
            'required','min:8',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*#?&]/',
            'confirmed'
            ],
            'password_confirmation' => [
                'required','min:8', // must be at least 8 characters in length
                'regex:/[a-z]/', // must contain at least one lowercase letter
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'regex:/[0-9]/', // must contain at least one digit
                'regex:/[@$!%*#?&]/' // must contain a special character   
            ],

            ],
            [
            'password.required' => 'The password field is required.',
            'password.min'      => 'The password must be at least 8 characters in length.',
            'password.regex' => 'The password must contain at least one uppercase letter or lowercase letter or at least one digit or a special character.',
            'user_type.required' => 'Please select a valid user type.',
            'user_type.numeric'  => 'Please select a valid user type.',
            'user_type.max'      => 'Please select a valid user type.',
            
            ] 

        );
    }

    protected function createregistryUser(array $data)
    {
        return User::create([
            'services_title' => $data['first_name'] ."' registry",
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'phone'      => $data['phone'],
            'email'      => $data['email'],
            'approved'      => 1,
            'approved_at'      => date("Y-m-d H:i:s"),
            'user_type'  => $data['user_type'],
            'meta_description'  => "We're excited to welcome our baby into our family. Your gifts will help us pay for the support we need. We are so grateful for anything you can contribute. Thank you so much! Xoxo",
            'password'   => bcrypt($data['password']),
        ]);
    }

    public function registrycheckout()
    {
        return view('front.pages.registry-checkout');
    }
    public function viewregistry(Request $request)
    {
        $serviceExistInRegistry = [];
        $registry_event = RegistryEvent::all();
        $user = User::where('user_type',1)->findOrFail(Auth::id());
        $registryDetails = Registry::where('user_id',Auth::id())->get();

        foreach($registryDetails as $registryDetailValue):
            if(isset($registryDetailValue->qty)&&$registryDetailValue->qty>0):
                $serviceExistInRegistry[$registryDetailValue->services_id]=$registryDetailValue->qty;
            endif;                
        endforeach;
        return view('front.pages.view-registry', compact('user','registry_event','serviceExistInRegistry'));
    }

    public function connectStripe(Request $request){
     
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET','sk_test_51LGQZ0AzJPkCOpA5mUPaJHeMq6wkOEPZ3YRC3hkTGMwfdH7WiaJkouckDWBtxv5qnuQAgPFK55hDXAXhhJVKmGbN00ow6j5Ww9'));

        $account = $stripe->accounts->create(
          [
            'country' => 'US',
            'type' => 'express',
            'capabilities' => [
              'card_payments' => ['requested' => true],
              'transfers' => ['requested' => true],
            ],
            'business_type' => 'individual',
            'business_profile' => ['url' => env('APP_ENV') == 'local' ? 'https://example1.com' : route("share-registry",[base64_encode($request->email)])],
          ]
        );

        if($account->id){

         $user = User::findOrFail($request->user()->id);
         $user->stripe_code = $account->id;
         $user->save();

        $onBoard =   $stripe->accountLinks->create(
              [
                'account' => $account->id,
                'refresh_url' =>  route("view-registry"),
                'return_url' =>  route("view-registry"),
                'type' => 'account_onboarding',
              ]
        );

         return redirect($onBoard->url);

        }else{
            redirect()->back()->with('error',"Cannot connect stripe. Check back later");
        }

    }

    public function addservice($id = NULL)
    {
        $user = User::findOrFail(Auth::id());
        $custom_services_selected_categories = [];
        //Request $request
        /*if($request->user()->user_type == 1 && !$request->user()->stripe_code){
             return redirect('view-registry')
            ->with('error', 'Please connect the stripe account first');
        }*/        
        $custom_services = CustomService::where('status',1)->where('id',$id)->first();
        $custom_services_category = CategoryCustomService::where('custom_service_id',$id)->get();
        if(count($custom_services_category)>0){
            foreach ($custom_services_category as $custom_services_category_key => $custom_services_category_value) {
                $custom_services_selected_categories[$custom_services_category_value['category_id']]=$custom_services_category_value['category_id'];
            }            
        }
        $categories = Category::whereNull('deleted_at')->get();
        return view('front.pages.custom_services.add-new-service',compact('categories','custom_services','custom_services_selected_categories','user'));
    }

    public function editUser($id)
    {
        $user = User::with('mediaImages')->findOrFail($id);
        return view('front.pages.custom_services.edit-user',compact('user'));
    }
    
    public function updateUser(Request $request,$id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'previous_image',
            'previous_media_image',
            'previous_profile_image'
        ]);
        $user = User::with('mediaImages')->findOrFail($id);
        $user->services_title = isset($request->title) ? $request->title : $user->services_title;
        $user->services_body = isset($request->services_body) ? $request->services_body : $user->services_body;
        $user->first_name = isset($request->first_name) ? $request->first_name : $user->first_name;
        $user->last_name = isset($request->last_name) ? $request->last_name : $user->last_name;
        $user->phone = isset($request->phone) ? $request->phone : $user->phone;
        if ($request->hasFile('services_image')) {
            if (!empty($request->previous_image)) {
                if (!empty($request->previous_image) && file_exists(uploadsDir('front/user_services_images') . $request->previous_image)) {
                    unlink(uploadsDir('front/user_services_images') . $request->previous_image);
                }
            }

            @mkdir(uploadsDir('front/user_services_images'), 0755, true);

            // move/upload file on server
            $photo              = $request->file('services_image');
            $extension          = $photo->getClientOriginalExtension();
            // getting file extension
            $filename           = 'services-' . time() . '.' . $extension;
            $photo->move(uploadsDir('front/user_services_images'), $filename);
            $data['services_image'] = $filename;
        }
        $user->services_image = isset($filename) ? $filename : $user->services_image;

        if ($request->hasFile('profile_image')) {
            if (!empty($request->previous_profile_image)) {
                if (!empty($request->previous_profile_image) && file_exists(uploadsDir('front/users_profile') . $request->previous_profile_image)) {
                    unlink(uploadsDir('front/users_profile') . $request->previous_profile_image);
                }
            }

            @mkdir(uploadsDir('front/users_profile'), 0755, true);

            // move/upload file on server
            $photo              = $request->file('profile_image');
            $extension          = $photo->getClientOriginalExtension();
            // getting file extension
            $filename           = 'profile-' . time() . '.' . $extension;
            $photo->move(uploadsDir('front/users_profile'), $filename);
        }
        $user->profile_image = isset($filename) ? $filename : $user->profile_image;
        //media images save work down below
        if($request->hasFile('media_images')){
           
            $total = count($_FILES['media_images']['name']);

                // Loop through each file
                /*$user_media = UserMediaFile::where('user_id',Auth::id())->get();
                foreach($user_media as $usrmedia){    
                    
                    @unlink('./uploads/front/user_media_images/'.$usrmedia->filename); 
                    $usrmedia->delete();
                }*/
                @mkdir(uploadsDir('front/user_media_images'), 0755, true);
                for( $i=0 ; $i < $total ; $i++ ) {
                    //Get the temp file path
                    $tmpFilePath = $_FILES['media_images']['tmp_name'][$i];
                    //Make sure we have a file path
                    if ($tmpFilePath != ""){
                        //Setup our new file path
                        $userfilename           = 'media_user-' . time() . '.' . $_FILES['media_images']['name'][$i];
                        $newFilePath = "./uploads/front/user_media_images/" .$userfilename;
                        //Upload the file into the temp dir
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {                            
                            //Handle other code here
                            $userMediaFile = new UserMediaFile;
                            $userMediaFile->user_id = Auth::id();
                            $userMediaFile->filename = $userfilename;
                            $userMediaFile->save();
                        }
                    }
                }
        }
        $user->meta_description = isset($request->meta_description) ? $request->meta_description : $user->meta_description;
       // contact form data set down below for provider only

        if(isset($request->contact_email)){
            $user->contact_email = $request->contact_email;
        }

        if(isset($request->website)){
            $user->website = $request->website;
        }
        if(isset($request->location)){
            $user->location = $request->location;
        }
        $user->save();

        return redirect()
            ->back()
            ->with('status', 'Your Data has been updated.');
    }


    //search registry user function down below
    public function searchRegistryUser(Request $request){
        $search = $request->name;
        $users = User::where('user_type',1)
                    ->where('approved',1)
                    ->when($search,function($query) use ($search){
                        return $query->where(\DB::raw("concat(first_name, ' ', last_name)"), 'LIKE', "%".$search."%")->where('user_type',1)
                        ->whereNull('deleted_at');;
                    })
                    ->get();
        return view('front.pages.registry.search_registry',compact('users'));
    }

    public function shareRegistryLink(Request $request,$hash_code){
        $serviceExistInRegistry=[];
        $registry_event = RegistryEvent::all();
        $users = User::where('user_type',1)->where('approved',1)->whereNull('deleted_at')->pluck('email');
        foreach($users as $key=>$email){
            $generate_hash_code[] = base64_encode($email);
            
        }
       
        if(in_array($hash_code,$generate_hash_code)){           
            $email = base64_decode($hash_code);
            $user = User::where('email',$email)->first();
        }
        
        $user = User::findOrFail($user->id);
        

        $registryDetails = Registry::where('user_id',$user->id)->get();

        foreach($registryDetails as $registryDetailValue):
            if(isset($registryDetailValue->qty)&&$registryDetailValue->qty>0):
                $serviceExistInRegistry[$registryDetailValue->services_id]=$registryDetailValue->qty;
            endif;                
        endforeach;

        return view('front.pages.share_link_registry', compact('user','registry_event','serviceExistInRegistry'));
    }

    public function saveshareRegistryLink(Request $request,$hash_code){
        $data = $request->except([
            '_token',
            '_method',
            'email'
        ]);
        $user = User::where('email',$request->email)->first();
        $user->share_link_code = $hash_code;
        $user->save();

        return redirect()
            ->back()
            ->with('popup', 'open');
    }


    public function viewDetailRegistryService($hash_code, $service_id, Request $request)
    {
        if($hash_code){           
            $serviceExistInRegistry=[];
            $email = base64_decode($hash_code);

            $user = User::where('email',$email)->first();

            if($user){

            $registryDetails = Registry::where('user_id',$user->id)->get();

                foreach($registryDetails as $registryDetailValue):
                    if(isset($registryDetailValue->qty)&&$registryDetailValue->qty>0):
                        $serviceExistInRegistry[$registryDetailValue->services_id]=$registryDetailValue->qty;
                    endif;                
                endforeach;

                $service = $user->registry()->where('id',$service_id)->with('custom_service.categoryCustomService')->get();

             $service =  $service[0];
             return view('front.pages.registry-checkout',compact('user','service','serviceExistInRegistry'));
            }

        }
        abort(404);

    }

    public function registryServiceCart($hash_code, $service_id, Request $request)
    {

            $request->validate([
            'amount' => 'required|numeric',
            ]);

            if($hash_code){           
                $email = base64_decode($hash_code);

                $user = User::where('email',$email)->first();
                if($user){
                $service = $user->registry()->where('id',$service_id)->with('custom_service.category')->get();

                $service =  $service[0];

                // you can not cart your own registry services
                if($request->user() && $request->user()->id == $service->user_id){

                      return redirect()->back()->with('error', 'You can not cart your registry services');
                }

                 if($service){
                       $c_alldata = Cart::getContent();
                       $f_user_id = [];
                       foreach($c_alldata as $d)
                            $f_user_id[]= $d->attributes->user_id;


                        if(Cart::get($service_id)){
                            Cart::update($service_id,[
                                'quantity' => 1,
                                'price' => $request->amount
                            ]);
                            if(!$request->buy_now)
                                return redirect()->back()->with('status', 'Cart updated sucessfully.');
                            else
                                return redirect('/checkout');
                        }
                        else if(in_array($user->id,$f_user_id) || Cart::isEmpty()){

                            Cart::add(array(
                                'id' =>  $service_id,
                                'user_id' => $user->id,
                                'name' => $service->custom_service->services_title,
                                'price' => $request->amount,
                                'quantity' => 1,
                                'attributes' => array(
                                    'registry_name' => $user->first_name . "'s Registry",
                                    'user_to' => $user->first_name .' '. $user->last_name,
                                    'registry_service_id' => $service_id,
                                    'services_id' => $service->services_id,
                                    'user_id' => $user->id,
                                )
                            ));
                             if(!$request->buy_now)
                                return redirect()->back()->with('status', 'Successfully added to cart.');
                            else{
                               return  redirect('/checkout');
                            }
                        } else{
                            return redirect()->back()->with('error', 'You can pay for one registry user at a time or empty your cart first');
                        }  
                        

                       
                }

            }

        }
            

       
    }


    public function checkout(){
       
       $items = Cart::getContent();
       return view('front.pages.checkout',compact('items'));
    }

    public function emptyCart(){
       
        Cart::clear();
        return redirect()->back()->with('success', 'Cart empty sucessfully');

    }
    public function deleteCart(Request $request){
       
       if($request->row_id){
         Cart::remove($request->row_id);
         return redirect()->back()->with('success', 'Cart updated sucessfully');
       }
       abort(404);
    }

    public function checkoutMessage(Request $request){
       
       $items = Cart::getContent();
       return view('front.pages.checkout-message',compact('items'));
    }

    public function viewGifts(Request $request){
        if($request->user()->user_type == 1){
            $records = Gift::where('receiver_id',$request->user()->id)->paginate(10);
            return view('front.pages.gift',compact('records'));
        }
        abort(404);
        
    }

    public function newsletter(Request $request){       
        if(!Newsletter::isSubscribed($request->user_email) ) {
            Newsletter::subscribe($request->user_email);
            //return redirect('https://mailchi.mp/susanssleepsolutions/5-tips-to-getting-your-baby-to-sleep-through-the-night');
            return redirect()->back()->with('success', 'You have been subscribe sucessfully');
        }else{
             return redirect()->back()->with('error', 'You email is already subscribed');
            
        }        
    }

    public function requestForPricing(Request $request){
        $user = User::findOrFail(Auth::id());
    
        $data = $request->except([
            '_token',
            '_method',
        ]);

        $custom_service = CustomService::where('id',$request->services_id)->first();
        $vendorDetails = User::findOrFail($custom_service->vendor_id);
        
        Mail::send(
            'emails.front.requestpricingEmail', 
            [
                'vendorname' => $vendorDetails->first_name.' '.$vendorDetails->last_name,
                'username'  => $user->first_name.' '.$user->last_name,
                'serviceName'      => $custom_service->services_title
            ],
            function ($message) use ($vendorDetails) {
                    $message->to($vendorDetails->email);
                    $message->cc(['ehtisham.khantwg@gmail.com','faizan.ahmedtwg@gmail.com','babycito@mailinator.com',env('MAIL_FROM_ADDRESS')]);
                    $message->subject('Request Pricing');               
            }
        );

        return redirect()->back()->with('success', 'Service price request has been send successfully.');        
        exit();
    }

    public function viewPages($page_identifire=NULL)
    {
        $pages ="";
        $pages = Page::with('mediaFiles')->where('slug','LIKE','%'.$page_identifire.'%')->where('slug','LIKE','%'.$page_identifire.'%')->first();
        return view('front.pages.pages', compact('pages'));
    }

    public function deleteMediaImages(Request $request){
        $usrmedia = UserMediaFile::where('id',$request->id)->first();
        @unlink('./uploads/front/user_media_images/'.$usrmedia->filename); 
        $usrmedia->delete();
    }            

    public function editUserPassword($id)
    {
        $user = User::with('mediaImages')->findOrFail($id);
        return view('front.pages.custom_services.edit-user-password',compact('user'));
    }

    protected function CheckUpdatePasswordValidator(array $data)
    {
        return Validator::make($data, [
            
            'current_password'              => [
                'required','min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
            'password' => [
                'required','min:8', // must be at least 8 characters in length
                'regex:/[a-z]/', // must contain at least one lowercase letter
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'regex:/[0-9]/', // must contain at least one digit
                'regex:/[@$!%*#?&]/' // must contain a special character   
            ],

            ],
            [
            'password.required' => 'The password field is required.',
            'password.min'      => 'The password must be at least 8 characters in length.',
            'password.regex' => 'The password must contain at least one uppercase letter or lowercase letter or at least one digit or a special character.'            
            ] 

        );
    }

    public function updateUserPassword(Request $request,$id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'current_password',
            'password',
            'password_confirmation'
        ]);
        $user = User::with('mediaImages')->findOrFail($id);
        $this->CheckUpdatePasswordValidator($request->all())->validate();
        if (Hash::check($request->current_password, $user->password)==1){

            if ($request->password==$request->password_confirmation) {                    
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('status', 'Your password has been updated.');
            }else{
                return redirect()
                ->back()
                ->with('error',"Password and confirmation password not Matched.");
            }   

        }else{
            return redirect()
            ->back()
            ->with('error',"Current password not matched.");
        }
        
    }

    public function downloadFreeServiceGuide(Request $request){

        $request->validate([
            'fullname'=> 'required|max:65|regex:/^[\pL\s\-]+$/u',
            'email'=> 'required|string|max:128|email:rfc,dns'
        ]);

        if(!Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribe($request->email);
            $files = public_path('uploads/front/babycito-service-guide.pdf');
            Mail::send(
                'emails.front.downloadfreeserviceguide', 
            [
                'fullname' => $request->fullname
            ],
            function ($message) use ($request, $files) {
                    $message->to($request->email);
                    $message->cc(['ehtisham.khantwg@gmail.com','ehtisham.khantwg@gmail.com','faizan.ahmedtwg@gmail.com','babycito@mailinator.com',env('MAIL_FROM_ADDRESS')]);
                    $message->subject('Download Free Service Guide');
                    $message->attach($files);               
            }
        );

        return redirect()->back()->with('success', 'Great things are headed your way! An email has been sent with a link to the download the Service Guide.');
        }else{
             return redirect()->back()->with('error', 'You email is already subscribed');
            
        }        
    }

    public function downloadFreeServiceGuidePdf(){      
        $filepath = public_path('uploads/front/babycito-service-guide.pdf');       
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);
            exit;
        }
    }    


    public function deleteCustomService($id=NULL){      
        $registries = Registry::where('status',1)->whereNull('deleted_at')->where('user_id',Auth::id())->where('id',$id)->first();
        if(isset($registries->id)){
            Registry::where('id',$registries->id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
            return redirect()->back()->with('status', 'Your registry services has been deleted successfully.');       
            exit();
        }else{
            return redirect()->back()->with('error', 'You can not delete registry services!');
            exit();
        }
    }    


    public function oneTimeGift(){      
        $providers = User::where('user_type',2)->where('approved',1)->get();
        return view('front.pages.onetimegift',compact('providers'));        
    }

    public function sendOneTimeGift(Request $request){
        $request->validate([
            'sendername'=> 'required',     //|regex:/^[\pL\s\-]+$/u
            'senderemail'=> 'required|string|max:128|email:rfc,dns',
            'amount'=> 'required|numeric',            
            'provider'=> 'required',
            'message'=> 'required',
            'gift_deliver_at'=> 'required',            
            'receivername'=> 'required',    //|regex:/^[\pL\s\-]+$/u
            'receiveremail'=> 'required|string|max:128|email:rfc,dns',
        ]);


        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET','sk_test_51LGQZ0AzJPkCOpA5mUPaJHeMq6wkOEPZ3YRC3hkTGMwfdH7WiaJkouckDWBtxv5qnuQAgPFK55hDXAXhhJVKmGbN00ow6j5Ww9'));


        $products_obj= $stripe->products->create([
          // 'id'=> $uniqueProductId,
          'name' => 'One Time Gift For '.$request->receivername."(".$request->receiveremail.")",
          'active'=> 'true',
          'description'=>'One Time Gift For '.$request->receivername."(".$request->receiveremail.")",
          'images'=>[
            'https://files.stripe.com/links/MDB8YWNjdF8xS2Vld2tLY2lOUHR6b1RpfGZsX3Rlc3RfYkZzRkM5UkxYMTFRUHFTQ21mNWM2ZFQx00GF3YS6op'
          ],
        ]);


        $price_obj=$stripe->prices->create([
            // \Stripe\price::create([
            // 'id'=>$uniquePriceId, 
          'unit_amount' => $request->amount*100,
          'currency' => 'usd',
          'product' => $products_obj['id'],
          'tax_behavior' => 'exclusive',
        ]);



        try{
                         
                $checkoutStripeSession = $stripe->checkout->sessions->create([
                  'customer_email' => $request->receiveremail,
                  'success_url' => route('one-time-gift-success'),
                  'cancel_url' => route('one-time-gift-cancel'),
                  'payment_method_types' => ['card'],
                  'metadata' => ['gift_message' => json_encode(["sendername"=>$request->sendername,"senderemail"=>$request->senderemail,"amount"=>$request->amount,"message"=>$request->message,"gift_deliver_at"=>$request->gift_deliver_at,"receivername"=>$request->receivername,"receiveremail"=>$request->receiveremail,"provider"=>$request->provider])],
                  'line_items' => [["name"=>'One Time Gift For '.$request->receivername."(".$request->receiveremail.")", "description"=>'One Time Gift For '.$request->receivername."(".$request->receiveremail.") Provided By ".$request->provider, "amount"=>$request->amount*100, "currency"=>"usd", "quantity"=>"1" ]],
                  'mode' => 'payment'
                ]);
            
            /*$checkoutStripeSession = $stripe->checkout->sessions->create([
              'success_url' => route('checkout-success'),
              'cancel_url' => route('checkout-cancel'),
              'payment_method_types' => ['card'],
              'line_items' => [["price" => $price_obj->id, 'quantity' => 1]],
              'mode' => 'payment'
            ]);
            */
            session(['stripe_checkout_id' => $checkoutStripeSession->id]);
            return redirect($checkoutStripeSession->url);         


        }  catch (\Stripe\Exception\InvalidRequestException $e) {
            return back()
            ->with('error',$e->getError()->message);// 'Invoice Not send!');
        } 
        exit();

    }

    public function sendOneTimeGiftSuccess(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET','sk_test_51LGQZ0AzJPkCOpA5mUPaJHeMq6wkOEPZ3YRC3hkTGMwfdH7WiaJkouckDWBtxv5qnuQAgPFK55hDXAXhhJVKmGbN00ow6j5Ww9'));

        if ($request->session()->has('stripe_checkout_id')) {
            $stripe_checkout_id = $request->session()->get('stripe_checkout_id');
            $intenet_response = $stripe->checkout->sessions->retrieve($stripe_checkout_id,[]);
            $meta = $intenet_response->metadata;
            $gift_data = json_decode($intenet_response->metadata->gift_message);

            /*$capability = $stripe->accounts->updateCapability(
              'acct_1Lh90XB67lOJ4uVc',
              'transfers',
              ['requested' => true]
            );
            echo "<pre>";
            print_r($capability);
            exit();
            /*
            $stripe->accounts->update(
              'acct_1Lh8RAPm6VlRB8du',
              [
                  'tos_acceptance' => 
                  [
                      'date' => strtotime(date('Y-m-d H:i:s')),
                      'ip' =>$request->server('REMOTE_ADDR'),
                      'user_agent'=>$request->server('HTTP_USER_AGENT')
                  ]
              ]
            );


            $stripe->accounts->updateCapability(
              'acct_1Lh90XB67lOJ4uVc',
              'transfers',
              ['requested' => true]
            );

            $accounts = $stripe->accounts->retrieve(
              'acct_1Lh8RAPm6VlRB8du'
              //'acct_1LLLtmPfGzQca9CQ',
            );
            echo "<pre>";
            print_r($accounts);
            exit();/**/
            //acct_1Lh7dcPekIgXEMjo

                /*
                 $stripe->paymentIntents->create([

                      amount: PaymentAmount,
                      currency: "USD",
                      description: "We did it boss",
                      payment_method_data: {
                        type: "card",
                        card: {
                          token: TokenID,
                        },
                      },
                      receipt_email: "abdullahabid427@gmail.com",
                      customer: CustomerID,
                      //application_fee_amount,
                      transfer_data: {
                        destination: AccountID,
                      },
                      confirm: true,    
                 ]);
                
                
                $bankaccount = $stripe->tokens->create([
                  'bank_account' => [
                    'country' => 'US',
                    'currency' => 'usd',
                    'account_holder_name' => 'Westren Union Account',
                    'account_holder_type' => 'individual',
                    'routing_number' => '110000000',
                    'account_number' => '000123456789',
                  ]
                ]);

                /*    
                echo "<pre>";
                print_r($bankaccount);
                echo "</pre><br><br><br><br>";
                */
                //exit();
                
                
                /*
                $account = $stripe->accounts->create(
                    "country": "US",
                    "currency": "usd",
                    "account_holder_name": "Stripe Test Account",
                    "account_holder_type": "individual",
                    "routing_number": "110000000",
                    "account_number": "000123456789",
                
                    $account = $stripe->accounts->create(
                      [
                        'country' => 'US',
                        'type' => 'express',
                        'email' => $gift_data->receiveremail,
                        'capabilities' => [
                           'transfers' => ['requested' => true]
                        ],
                        'business_type' => 'individual',
                        'business_profile' => ['url' => env('APP_ENV') == 'local' ? 'https://example1.com' : route("share-registry",[base64_encode($gift_data->receiveremail)])],
                        //'tos_acceptance' => ['service_agreement' => 'recipient'],
                      ]
                    );


                    $accounts = $stripe->accounts->createExternalAccount(
                          $account->id,
                          [
                            'external_account' => $bankaccount->id,
                          ]
                    );

              
                   $stripe->accounts->updateCapability(
                      $account->id,
                      'transfers',
                      ['requested' => true]
                    );
                    /*
                    $stripe->accounts->update(
                      $account->id,
                      [
                          'tos_acceptance' => 
                          [
                              'date' => strtotime(date('Y-m-d H:i:s')),
                              'ip' =>$request->server('REMOTE_ADDR'),
                              'user_agent'=>$request->server('HTTP_USER_AGENT'),
                              //'service_agreement' => 'recipient'
                          ]
                      ]
                    );
                    $onBoard =   $stripe->accountLinks->create(
                          [
                            'account' => $account->id,
                            'refresh_url' =>  route("view-registry"),
                            'return_url' =>  route("view-registry"),
                            'type' => 'account_onboarding',
                          ]
                    );
                /*
                    $accounting = $stripe->accounts->retrieve(
                        $account->id,
                    );

                    echo "<pre>";
                    print_r($accounting);
                    echo "</pre><br><br><br><br>";
                    exit();    
                   */

                    //if($account->id){

                     /*
                        $user = User::findOrFail($request->user()->id);
                        $user->stripe_code = $account->id;
                        $user->save();
                     */
                    /*        
                    echo "<pre>";
                    print_r($onBoard);
                    echo "</pre><br><br><br><br>";
                    exit();    

                         // make payment 
                        $st_resp = $stripe->transfers->create([
                          'amount' => $gift_data->amount*100,
                          'currency' => 'usd',
                          'destination' => $account->id,
                          "source_type"=>"card"
                        ]);
                        echo "<pre>";
                        print_r($st_resp);
                        echo "</pre><br><br><br><br>";            
                        exit();

                     //return redirect($onBoard->url);

                    /*
                    }else{
                        redirect()->back()->with('error',"Cannot connect stripe. Check back later");
                    }*/

            /*    
                $topups = $stripe->topups->create(
                  [
                    'amount' => $gift_data->amount*100,
                    'currency' => 'usd',
                    'description' => 'One Time Gift For '.$gift_data->receivername."(".$gift_data->receiveremail.")\n ".$gift_data->message,
                    'statement_descriptor' => 'One Time Gift',
                  ]
                );
            
                $balance = $stripe->balance->retrieve();
                echo "<pre>";
                print_r($balance);            
                exit();
            */
            /*
            $topups = $stripe->transfers->create(
                [
                  "amount" => 100,
                  "currency" => "usd",
                  "description" => 'One Time Gift For '.$gift_data->receivername."(".$gift_data->receiveremail.")\n ".$gift_data->message,
                  "destination" => "acct_1LLLtmPfGzQca9CQ",
                  "source_type"=>"card"
                ]
            );
            */


            if($intenet_response->payment_status == "paid"){
                $receiver = json_decode($meta);
                /******************************************************************************/
                /******************************************************************************/
                /******************************************************************************/
                /******************************************************************************/

                $account = $stripe->accounts->create(
                  [
                    'country' => 'US',
                    'type' => 'express',
                    'email' => $gift_data->receiveremail,
                    'capabilities' => [
                      //'card_payments' => ['requested' => true],
                        'transfers' => ['requested' => true],
                    ],
                    //"representative"=>true,
                    //'relationship'=>["title"=>"CEO","representative"=>true],
                    'business_type' => 'individual',
                    'business_profile' => ["mcc" => "7372",'url' => env('APP_ENV') == 'local' ? 'https://example1.com' : route("share-registry",[base64_encode($gift_data->receiveremail)])],
                    //'tos_acceptance' => ['service_agreement' => 'recipient'],
                  ]
                );
                  
                if($account->id){

                    $bankaccount = $stripe->tokens->create([
                      'bank_account' => [
                        'country' => 'US',
                        'currency' => 'usd',
                        'account_holder_name' => 'Stripe Test Account',
                        'account_holder_type' => 'individual',
                        'routing_number' => '110000000',
                        'account_number' => '000123456789',
                      ]
                    ]);

                    $stripe->accounts->createExternalAccount(
                      $account->id,
                      ['external_account' => $bankaccount->id]
                    );
                  
                    $stripe->accounts->updateCapability(
                      $account->id,
                      'transfers',
                      ['requested' => true]
                    );

                  /*
                    $stripe->accounts->createPerson(
                      $account->id,
                       [
                        'first_name' => $gift_data->receivername,
                        'dob' => ["day"=>"28","month"=>"02","year"=>"1985"],
                        'address' => [
                            "city"=>"San Francisco",
                            "country"=>"US",
                            "line1"=>"510 Townsend Street, San Francisco, CA, USA",
                            "line2"=>"",
                            "postal_code"=>"94103",
                            "state"=>"California"
                        ],
                        'phone' => "+18004444444",
                        'first_name' => $gift_data->receivername,
                        'ssn_last_4' => '8888'
                       ]
                    );
                   */ 

                    $onBoard =   $stripe->accountLinks->create(
                          [
                            'account' => $account->id,
                            'refresh_url' =>  url("view-payment-details/".$account->id),
                            'return_url' =>  url("view-payment-details/".$account->id),
                            'type' => 'account_onboarding',
                          ]
                    );

                    $gift = new OneTimeGift;
                    $gift->sendername = $gift_data->sendername;
                    $gift->senderemail = $gift_data->senderemail;
                    $gift->amount = $gift_data->amount;
                    $gift->message = $gift_data->message;
                    $gift->vendor = $gift_data->provider;
                    $gift->gift_deliver_at = $gift_data->gift_deliver_at;
                    $gift->receivername = $gift_data->receivername;
                    $gift->receiveremail = $gift_data->receiveremail;
                    $gift->stripe_code = $account->id;
                    $gift->url = $onBoard->url;
                    $gift->paid = false;
                    $gift->save();


                    if($gift_data->gift_deliver_at==date('Y-m-d')){
                          Mail::send(
                            'emails.front.sendOneTimeGiftEmail', 
                            [
                                'sendername' => $gift_data->sendername,
                                'receivername'  => $gift_data->receivername,
                                'amount'      => $gift_data->amount,
                                'messages'  => $gift_data->message,
                                'urldata'=>$onBoard->url
                            ],
                            function ($message) use ($gift_data) {
                            $message->to($gift_data->receiveremail);
                            $message->cc(['ehtisham.khantwg@gmail.com','faizan.ahmedtwg@gmail.com','babycito@mailinator.com',env('MAIL_FROM_ADDRESS'),$gift_data->senderemail]);
                            $message->subject($gift_data->sendername.' sent you $'.$gift_data->amount.'.00 Babycito.');
                            }
                        );
                    }    


                        unset($meta['gift_message']);                
                }else{
                    redirect()->back()->with('error',"Cannot connect stripe. Check back later");
                }
                /******************************************************************************/
                /******************************************************************************/
                /******************************************************************************/
                /******************************************************************************/

            }
            $request->session()->forget('stripe_checkout_id');
            return redirect('/')->with('success','One Time Gift sent succesfully');
        }
    }


    public function sendOneTimeGiftCancel(){
            return redirect('/checkout/message')->with('error','Gift not send payment issue');
    }

    public function viewPaymentDetails($accountid=NULL)
    {
        $oneTimeGift = OneTimeGift::where('stripe_code',$accountid)->first();
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET','sk_test_51LGQZ0AzJPkCOpA5mUPaJHeMq6wkOEPZ3YRC3hkTGMwfdH7WiaJkouckDWBtxv5qnuQAgPFK55hDXAXhhJVKmGbN00ow6j5Ww9'));
        $stripe->transfers->create(
            [
              "amount" => ($oneTimeGift->amount*100),
              "currency" => "usd",
              "description" => 'One Time Gift For '.$oneTimeGift->receivername."(".$oneTimeGift->receiveremail.")\n ".$oneTimeGift->message,
              "destination" => $oneTimeGift->stripe_code
            ]
        );
        return redirect('/')->with('success','One Time Gift Payment transfer succesfully');
    }
}