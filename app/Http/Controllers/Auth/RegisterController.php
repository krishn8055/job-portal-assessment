<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Jobs\UserRegistrationEmailJob;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Notifications\UserRegistration;
use Session;

class RegisterController extends Controller
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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],            
            'username' => ['required', 'string', 'unique:users'],
            'company_name' => ['required', 'string'],
            'password' => ['required','string','min:8'],
        ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        $confirmation_code = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,20);
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'role_id' => 1,
            'email' => $data['email'],
            'username' => $data['username'],
            'company_name' => $data['company_name'],
            'confirmation_code'=>$confirmation_code,
            'password' => Hash::make($data['password']),
        ]);
        $user->notify(new UserRegistration($user));
        // dispatch/(new UserRegistrationEmailJob($user));
        Session::flash('message', 'We have sent you an verification email!');
        Session::flash('alert-class', 'success');

        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return redirect($this->redirectTo)->with('message', 'We have sent you an verification email!');
    }

    public function userRegister()
    {
        return view('auth.user_register');
    }

    public function userRegisterStore(Request $request)
    {
        // dd($request->all());

        // dd($request->all());
            $rules = array(
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],            
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required','string','min:8'],
            );
            $messages = [];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            } else {
                $confirmation_code = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,20);
                $register = new User();
                $register->role_id = 2;
                $register->first_name = $request['first_name'];
                $register->last_name = $request['last_name'];
                $register->email = $request['email'];
                $register->username = $request['username'];
                $register->confirmation_code = $confirmation_code;
                $register->password = Hash::make($request['password']);

                if ($register->save()) {
                    $register->notify(new UserRegistration($register));
                    Session::flash('message', 'We have sent you an verification email!');
                    Session::flash('alert-class', 'success');
                    return redirect('/login');
                } else {
                    Session::flash('message', 'Oops !! Something went wrong please try again after some times');
                    Session::flash('alert-class', 'error');
                    return redirect()->back();
                }
            }
    }
}
