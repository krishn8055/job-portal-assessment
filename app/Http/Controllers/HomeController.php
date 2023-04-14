<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $role_type = \Auth::user()->role_id;
            if ($role_type == 1) {
                return redirect('employer/dashboard');
            }else if ($role_type == 2) {
                return redirect('jobseeker/dashboard');
            }else {
                return redirect('login');
            }
        }else {
            return redirect('login');
        }
    }
}
