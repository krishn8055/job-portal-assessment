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
                        <h2 class="content-header-title float-left mb-0">Profile</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item "><a href="{{url('employer/dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Profile
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- users edit start -->
            <section class="app-user-edit">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span class="d-none d-sm-block">Account</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                <form class="form-horizontal" id="profileForm" method="post" action="{{url('employer/updateProfile')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="first_name" class=" control-label">First Name<span style="color:red;"> *</span></label></label>
                                                <div class=" jointbox">
                                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{$user->first_name}}" placeholder="Enter First Name">
                                                @if ($errors->has('first_name'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="last_name" class=" control-label">Last Name<span style="color:red;"> *</span></label></label>
                                                <div class=" jointbox">
                                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{$user->last_name}}" placeholder="Enter Last Name">
                                                @if ($errors->has('last_name'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email" class=" control-label">Email<span style="color:red;"> *</span></label></label>
                                                <div class="">
                                                <input type="email" class="form-control"  name="email" id="email" value="{{$user->email}}" placeholder="Enter Email ID">
                                                @if ($errors->has('email'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="username" class=" control-label">Username<span style="color:red;"> *</span></label></label>
                                                <div class="">
                                                <input type="username" class="form-control"  name="username" id="username" value="{{$user->username}}" placeholder="Enter Username">
                                                @if ($errors->has('username'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('username') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="company_name" class=" control-label">Company Name<span style="color:red;"> *</span></label></label>
                                                <div class="">
                                                <input type="text" class="form-control"  name="company_name" id="company_name" value="{{$user->company_name}}" placeholder="Enter Company Name" required>
                                                @if ($errors->has('company_name'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('company_name') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="" style="border-top:0">
                                                <div class="box-footer">
                                                    <button type="submit" id="createBtn" class="btn btn-primary pull-right" style="margin-left: 20px;float:right;">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
@if(Session::has('status'))

@endif
<!-- <script type="text/javascript" src="{{URL::asset('resources/assets/webcam/webcamjs/webcam.min.js')}}"></script> -->
<script>
    $(document).ajaxStart(function() {
        Pace.restart();
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var SITE_URL = "<?php echo URL::to('/'); ?>";
</script>

<script src="{{asset('assets/custom/jquery.validate.js')}}"></script>
<script src="{{asset('assets/custom/additional-methods.js')}}"></script>
<script>
  $(document.body).on('click', "#createBtn", function(){
    var id = "{{$user->id}}";
      if ($("#profileForm").length){
          $("#profileForm").validate({
                  errorElement: 'span',
                  errorClass: 'text-red text-danger',
                  ignore: [],
                  rules: {
                      "first_name":{
                          required:true,
                      },
                      "last_name":{
                          required:true,
                      },
                        "email":{
                            required:true,
                            email:true,
                        },

                        "username":{
                            required:true,
                            lettersonlys:true,
                            remote: {
                                data:{id:id,type:'1'},
                                url: SITE_URL + '/check-username-exsist',
                                type: "get"
                            }
                        },
                        "company_name":{
                            required:true,
                        }
                  },
                  messages: {
                      "first_name":{
                          required:"Please enter first name."
                      },

                      "last_name":{
                          required:"Please enter last name."
                      },
                      "email":{
                          required:"Please enter email."
                      },

                        "username":{
                            required:'Please enter username.',
                            lettersonlys:"Please enter only alphabetic characters.",
                            remote:"Provided username already used by some one.",
                        },

                      "company_name":{
                          required:"Please enter company name."
                      },
                  },
                  errorPlacement: function(error, element) {
                  error.insertAfter(element.closest(".form-control"));
                  },
          });
      }
  });

</script>
@endsection
