@extends('employer.layouts.app')
@section('title') Profile | @endsection
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Posted Jobs</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item "><a href="{{url('employer/dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Posted Jobs
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Posted jobs</h4>
                            </div>
                            <div class="col-sm-12 pull-right  " style="padding-bottom: 10px;">
                      <a href="{{url('employer/posted-jobs/create')}}" class="float-right">
                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light">Post a New Job</button>
                      </a>
                  </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Job Title</th>
                                            <th>Description</th>
                                            <th>Skills</th>
                                            <th>Experience</th>
                                            <th>Applications</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($data) >0)
                                        @foreach($data as $key=>$value)
                                        @php
                                        $skills = json_decode($value->skill);
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->job_title}}</td>
                                            <td>{{$value->job_description}}</td>
                                            <td>{{implode(',',$skills)}}</td>
                                            <td>{{$value->experience_year}} year {{$value->experience_month}} months</td>
                                            @if(empty($value['jobApplication']))
                                            <td>{{0}}</td>
                                            @else
                                            <td>{{$value['jobApplication']->count()}}</td>
                                            @endif
                                            <td><a href="{{url('employer/posted-jobs/edit/'.$value->id)}}" class="badge badge-pill badge-light-primary mr-1">Update</a></td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td>No data found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->

            </div>
        </div>
    </div>
        </div>
    </div>
    </div>
</div>

@endsection
@section('script')
@if(Session::has('message'))
    <script>
        $(function() {
            toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
        });
    </script>
@endif
@endsection