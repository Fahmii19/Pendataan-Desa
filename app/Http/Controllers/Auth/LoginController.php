<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // Time out after 30 minutes
    protected $decayMinutes = 5;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated()
    {
        // Check if user is allowed to login
        if (Auth::user()->allowed == 0) {
            Auth::logout();
            return redirect()->to('/login');
        }

        //Loging User Login
        log_authenticated(Auth::user()->id);

        $agent = new  \Jenssegers\Agent\Agent;
        if ($agent->isMobile()) {
            return redirect()->to('/konsultasi');
        } else {
            return redirect()->to('/');
        }
    }
}
