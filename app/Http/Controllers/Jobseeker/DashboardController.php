<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostJob;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $jobs = PostJob::with('applyJobDetail')->get();
        return view('jobseeker.dashboard',compact('jobs'));
    }
}
