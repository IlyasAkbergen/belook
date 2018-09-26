<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
   // protected $redirectTo = 'myProfile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function authenticated(Request $request, $user)
    {
        if ( $user->token != NULL) {
            return redirect()->route('activateAccount');
        }else{
            if($user->role == 'buyer'){
                return redirect('/');
            }else if($user->role == 'seller'){
                return redirect()->route('myProfile');
            }else{
                return redirect()->route('office');
            }
        }

    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
