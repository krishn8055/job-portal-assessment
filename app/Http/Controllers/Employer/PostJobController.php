<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\Models\PostJob;
use Session;

class PostJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PostJob::where('emp_id',auth()->user()->id)->with('jobApplication')->get();
        // dd($data);
        return view('employer.postjob.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employer.postjob.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
            $rules = array(
                'job_title' => 'required',
                'job_description' => 'required',
                'skill' => 'required|array|min:1',
                'experience_year' => 'required',
                'experience_month'=>'required',
            );
            $messages = [];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            } else {
                $newJob = new PostJob();
                $newJob->emp_id = auth()->user()->id;
                $newJob->job_title = $request['job_title'];
                $newJob->job_description = $request['job_description'];
                $newJob->skill = json_encode($request['skill']);
                $newJob->experience_year = $request['experience_year'];
                $newJob->experience_month = $request['experience_month'];

                if ($newJob->save()) {
                    Session::flash('message', 'New Job Post Created Successfully1');
                    Session::flash('alert-class', 'success');
                    return redirect('employer/posted-jobs');
                } else {
                    Session::flash('message', 'Oops !! Something went wrong please try again after some times');
                    Session::flash('alert-class', 'error');
                    return redirect('employer/posted-jobs');
                }
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PostJob::find($id);
        if (!empty($data)) {
            return view('employer.postjob.edit',compact('data'));
        }else{
            Session::flash('message', 'No Record found!');
                    Session::flash('alert-class', 'error');
                    return redirect('employer/posted-jobs');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = $request->id;
            $rules = array(
                'job_title' => 'required',
                'job_description' => 'required',
                'skill' => 'required|array|min:1',
                'experience_year' => 'required',
                'experience_month'=>'required',
            );
            $messages = [];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            } else {
                $editJob = PostJob::find($id);
                $editJob->emp_id = auth()->user()->id;
                $editJob->job_title = $request['job_title'];
                $editJob->job_description = $request['job_description'];
                $editJob->skill = json_encode($request['skill']);
                $editJob->experience_year = $request['experience_year'];
                $editJob->experience_month = $request['experience_month'];
                $editJob->updated_at = date('Y-m-d h:i:s');

                if ($editJob->save()) {
                    Session::flash('message', 'Post Job details udated !!');
                    Session::flash('alert-class', 'success');
                    return redirect('employer/posted-jobs');
                } else {
                    Session::flash('message', 'Oops !! Something went wrong please try again after some times');
                    Session::flash('alert-class', 'error');
                    return redirect('employer/posted-jobs');
                }
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
