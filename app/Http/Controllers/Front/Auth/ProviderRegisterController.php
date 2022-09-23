<?php
namespace App\Http\Controllers\Front\Auth;
// use App\User;
// use App\Models\Country;
use App\Models\User;
use App\Http\Controllers\Front\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Mail;
class ProviderRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/providerregister';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('front.auth.providerregister');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'first_name'            => ['required','max:50'],
            'last_name'             => ['required', 'max:50'],
            'phone'                 => ['required', 'numeric'],
            //'user_type'             => ['required', 'numeric'],
            //'email'                 => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'email' => 'required|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {

        $data = [
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'phone'      => $data['phone'],
            'email'      => $data['email'],
            'user_type'  => '2',  //$data['user_type'],
            'password'   => bcrypt($data['password'])
        ];
        if(isset($data['user_type'])){
            if($data['user_type'] == 1){
                $data = array_merge($data,[
                    'services_title' => $data['first_name'] ."' registry",
                    'meta_description'  => "We're excited to welcome our baby into our family. Your gifts will help us pay for the support we need. We are so grateful for anything you can contribute. Thank you so much! Xoxo",                
                    'approved'      => 1,
                    'approved_at'      => date("Y-m-d H:i:s")
                    ]);

                        Mail::send(
                            'emails.front.registerEmail', 
                            [
                                'first_name' => $data['first_name'],
                                'last_name'  => $data['last_name'],
                                'phone'      => $data['phone'],
                                'email'      => $data['email'],
                                'user_type'  => 'Registry User'                                
                            ],
                            function ($message){
                                    $message->to(env('MAIL_FROM_ADDRESS'));
                                    $message->cc(['ehtisham.khantwg@gmail.com','faizan.ahmedtwg@gmail.com','babycito@mailinator.com']);
                                    $message->subject('Registered User Email');               
                            }
                        );
            }
            else{
                $data = array_merge($data,[
                    'services_title' => $data['first_name'] ."' provider",
                    'approved'      => 1,
                    'approved_at'      => date("Y-m-d H:i:s")
                    ]);


                        Mail::send(
                            'emails.front.registerEmail', 
                            [
                                'first_name' => $data['first_name'],
                                'last_name'  => $data['last_name'],
                                'phone'      => $data['phone'],
                                'email'      => $data['email'],
                                'user_type'  => 'Provider'                                
                            ],
                            function ($message){
                                    $message->to(env('MAIL_FROM_ADDRESS'));
                                    $message->cc(['ehtisham.khantwg@gmail.com','faizan.ahmedtwg@gmail.com','babycito@mailinator.com']);
                                    $message->subject('Registered User Email');               
                            }
                        );
            }
           
        }

        return User::create($data);

        
    }

    public function register(Request $request)
    {
        
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if($request->user_type == 1){
             \Auth::login($user);
             return $this->registered($request, $user)
                        ?: redirect('view-registry');
        }else{

            \Auth::login($user);
            return $this->registered($request, $user)
                       ?: redirect('editUser/'.$user->id);
        }

        
    }
}
