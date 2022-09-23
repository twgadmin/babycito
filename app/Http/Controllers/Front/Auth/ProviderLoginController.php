<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Front\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProviderLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/providerlogin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
         * Logged in user should not be able to visit login page, unless logged out
         *
         * It's redirection is managed from App > Http > Middleware > RedirectIfAuthenticated
         */
        $this->middleware('guest')->except('logout');
        //parent::__construct();
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('front.auth.providerlogin');
    }

    public function login(\Illuminate\Http\Request $request) {
    $this->validateLogin($request);


    // This section is the only change
    if ($this->guard()->validate($this->credentials($request))) {
        $user = $this->guard()->getLastAttempted();
        // Make sure the user is active
        if ($user->approved && $this->attemptLogin($request)) {

            if($user->user_type == 2){
                $this->redirectTo = '/services';
            }else{
                $this->redirectTo = '/view-registry';
            }
            // Send the normal successful login response
            return $this->sendLoginResponse($request);
        } else {
            // Increment the failed login attempts and redirect back to the
            // login form with an error message.
            session()->flash('error', 'This account is not approved by admin.');
                 return redirect()->back();
        }
    }

    return $this->sendFailedLoginResponse($request);
}






    /**
     * @param Request $request
     * @param $user
     */
    public function authenticated(Request $request, $user)
    {
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        /*
         * Here, admin guard is being called by $this->guard()
         */
        $this->guard()->logout();

        // $request->session()->invalidate();

        return redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        // return $request->only($this->username(), 'password');
        return [
            'email'    => $request->{$this->username()}, 
            'password' => $request->password,
            'user_type' => '2'
        ];
    }
}
