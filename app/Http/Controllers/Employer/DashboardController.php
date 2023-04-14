<?php

namespace App\Http\Controllers\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use App\Models\PostJob;
use App\Models\ApplyJob;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalJob = PostJob::where('emp_id',auth()->user()->id)->count();
        $totalApplyCount = ApplyJob::where('emp_id',auth()->user()->id)->count();
        return view('employer.dashboard',compact('totalJob','totalApplyCount'));
    }
}
