<?php

namespace App\Http\Controllers\Employer;

use Auth;
use Hash;
use Session;
use App\Models\User;
use Validator;
use Zxing\QrReader;
use ZipStream\Option\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('employer.profile')->with(compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
            $rules = array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'username' => 'required|unique:users,username,'.$id.',id',
                'company_name'=>'required'
            );
            $messages = [];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            } else {
                $editUser = User::find($id);
                $editUser->first_name = $request['first_name'];
                $editUser->last_name = $request['last_name'];
                $editUser->email = $request['email'];
                $editUser->username = $request['username'];
                $editUser->company_name = $request['company_name'];
                $editUser->updated_at = date("Y-m-d H:i:s");

                if ($editUser->save()) {
                    Session::flash('message', 'Profile information updated !!');
                    Session::flash('alert-class', 'success');
                    return redirect('employer/profile');
                } else {
                    Session::flash('message', 'Oops !! Something went wrong please try again after some times');
                    Session::flash('alert-class', 'error');
                    return redirect('employer/profile');
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