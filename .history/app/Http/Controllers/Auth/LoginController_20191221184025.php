<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

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
    // protected $redirectTo = '/administrator';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function authenticated($request, $user)
    // {
    //   if($user->email_verified_at=="")
    //   {
    //         \Auth::logout();
    //         Session::flash('message', 'Please verify your email!');
    //         Session::flash('alert-class', 'alert-danger');
    //   }

    //   return redirect('/login');
    // }

    public function login(Request $request)
    {
        dd($request);
        if (Auth::check()) {
            if( Auth::user()->role==1 || Auth::user()->role==2){
             return redirect('/administrator');
            }
         }
    }

    public function logout(Request $request)
    {
      if (Auth::check()) {
        
        Auth::logout();
        return redirect('/');
      }
      else{
//        $user = Auth::user();
//        $user->logged_or_not = 0;
//        $user->save();
        return redirect('/');
      }
        
    }
}
