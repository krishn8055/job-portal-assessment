@extends('layouts.authApp')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo--><a class="brand-logo" href="javascript:void(0);">
                        
                            <h2 class="brand-text text-primary ml-1">{{config('app.name')}}</h2>
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="../../../app-assets/images/pages/register-v2.svg" alt="Register V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Register-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title font-weight-bold mb-1">Register as Employer</h2>
                                <form class="auth-register-form mt-2" id="empForm" action="{{route('register')}}" method="POST">
                                    @csrf
                                    @if (session('message'))
                              <div class="help-block alert alert-{{session('alert-class')}} text-left">
                                  <span>{{session('message')}}</span>
                              </div>
                            @endif
                                    <div class="form-group">
                                        <label class="form-label" for="first_name">First Name</label>
                                        <input class="form-control" id="first_name" type="text" name="first_name" placeholder="Enter First Name" aria-describedby="first_name" autofocus="" tabindex="1" />
                                        @if ($errors->has('first_name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('first_name') }}</strong>
                                  </span>
                                @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="last_name">Last Name</label>
                                        <input class="form-control" id="last_name" type="text" name="last_name" placeholder="Enter Last Name" aria-describedby="last_name" autofocus="" tabindex="2" />
                                        @if ($errors->has('last_name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('last_name') }}</strong>
                                  </span>
                                @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" id="email" type="text" name="email" placeholder="Enter Email ID" aria-describedby="email" tabindex="3" />
                                        @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                                @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="username">Username</label>
                                        <input class="form-control" id="username" type="text" name="username" placeholder="Enter Username" aria-describedby="username" autofocus="" tabindex="4" />
                                        @if ($errors->has('username'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="company_name">Company Name</label>
                                        <input class="form-control" id="company_name" type="text" name="company_name" placeholder="Enter Company Name" aria-describedby="company_name" autofocus="" tabindex="5" />
                                        @if ($errors->has('company_name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('company_name') }}</strong>
                                  </span>
                                @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="6" />
                                            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="confirm_password">Confirm Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="confirm_password" type="confirm_password" name="confirm_password" placeholder="············" aria-describedby="confirm_password" tabindex="7" />
                                            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="empbtn" tabindex="8">Sign up</button>
                                </form>
                                <p class="text-center mt-2"><span>Already have an account?</span><a href="page-auth-login-v2.html"><span>&nbsp;Sign in instead</span></a></p>
                            </div>
                        </div>
                        <!-- /Register-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @endsection
    @section('script')
  @if(Session::has('message'))
    <script>
      $(function() {
          toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
      });
    </script>
  @endif

<script>
    $(document).ajaxStart(function() { Pace.restart(); });
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
        var SITE_URL = "<?php echo URL::to('/'); ?>";

        $.validator.addMethod("email", function(value, element) {
              return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
        }, "Please enter valid email.");

        $.validator.addMethod("lettersonlys", function(value, element) {
            return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
        }, "Letters only please");

        $.validator.addMethod("password_length", function(value, element) {
            return /^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@$!%?&#^.()_-])[A-Za-z\d@$!%?&#^.()_-]{8,18}$/.test(value);
        }, "Enter combination of at least 8 number, letters ,special character and atleast one capital letter.");

        $(document.body).on('click',"#empbtn",function(){
            if($("#empForm").length){
                $("#empForm").validate({
                // onfocusout: false,
                errorElement: 'div',
                errorClass: 'text-danger',
                ignore: [],
                    rules: {
                        "first_name":{
                            required:true,
                            lettersonlys:true,
                            minlength: 2,
                            maxlength: 50,
                        },
                        "last_name":{
                            required:true,
                            lettersonlys:true,
                            minlength: 2,
                            maxlength: 50,
                        },
                        "email":{
                            required:true,
                            email:true,
                        },
                        "username":{
                            required:true,
                            lettersonlys:true,
                            remote: {
                                url: SITE_URL + '/check-username-exsist',
                                type: "get"
                            }
                        },
                        "password":{
                            required:true,
                        },
                        "confirm_password":{
                            required:true,
                            equalTo:'#password',
                        },
                        "company_name":{
                            required:true,
                        }
                    },
                    messages: {
                        "first_name":{
                            required:"Please enter first name.",
                            lettersonlys:"Please enter only alphabetic characters.",
                            maxlength:"Please enter not more than 30 characters.",
                        },
                        "last_name":{
                            required:"Please enter last name.",
                            lettersonlys:"Please enter only alphabetic characters.",
                            maxlength:"Please enter not more than 30 characters.",
                        },
                        "email":{
                            required:'Please enter email address.',
                            remote:"Provided email already used by some one.",
                        },
                        "username":{
                            required:'Please enter username.',
                            lettersonlys:"Please enter only alphabetic characters.",
                            remote:"Provided username already used by some one.",
                        },
                        "confirm_password":{
                            required:"Please enter confirm password.",
                            equalTo: "Please enter same as password.",
                        },
                        "password":{
                            required:"Please enter password.",
                        },
                        "company_name":{
                            required:"Please enter company name.",
                        }
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element.closest(".form-group"));
                    },
                    submitHandler: function(form,e) {
                        e.preventDefault();
                        // $("#submitForm").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                        form.submit();
                    },
                });
            }
        });

    </script>
@endsection