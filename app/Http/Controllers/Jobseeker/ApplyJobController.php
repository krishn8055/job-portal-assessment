<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostJob;
use App\Models\ApplyJob;
use Validator;
use Session;

class ApplyJobController extends Controller
{
    public function index($id)
    {
        $data = PostJob::find($id);
        return view('jobseeker.apply_job',compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
            $rules = array(
                'cover_letter' => 'nullable',
                'headline' => 'required',
            );
            $messages = [];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            } else {
                $jobData = PostJob::where('id',$request['id'])->first();
                $newJob = new ApplyJob();
                $newJob->job_id = $request['id'];
                $newJob->seeker_id = auth()->user()->id;
                $newJob->emp_id = $jobData->emp_id;
                $newJob->headline = $request['headline'];
                if($request->file('cover_letter')){//check if file are exists on request
                         $cover_letter = $request->file('cover_letter');
                         $tujuan_upload = 'uploads/coverLetter';
                         $cover_letter->move($tujuan_upload, $cover_letter->getClientOriginalName());
                         $newJob->cover_letter = $cover_letter->getClientOriginalName();
                    }

                if ($newJob->save()) {
                    Session::flash('message', 'Job Applied successfully');
                    Session::flash('alert-class', 'success');
                    return redirect('jobseeker/dashboard');
                } else {
                    Session::flash('message', 'Oops !! Something went wrong please try again after some times');
                    Session::flash('alert-class', 'error');
                    return redirect('jobseeker/dashboard');
                }
            }
    }

    public function appliedJob()
    {
        $data = ApplyJob::where('seeker_id',auth()->user()->id)->with('jobDetail')->get();
        // dd($data);
        return view('jobseeker.apply_list',compact('data'));
    }
}
