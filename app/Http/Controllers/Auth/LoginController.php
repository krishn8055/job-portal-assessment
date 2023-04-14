<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function postLogin(Request $request)
    {
        $validatedData = $request->validate([
    'username' => 'required',
    'password' => 'required',
]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            Session::flash('message', 'loggedin!');
                    Session::flash('alert-class', 'success');
            return redirect()->intended('home')
                        ->withSuccess('You have Successfully loggedin');
        }
        Session::flash('message', 'Oops !! Something went wrong please try again after some times');
        Session::flash('alert-class', 'error');
        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }
}
