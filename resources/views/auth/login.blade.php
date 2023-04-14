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
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{asset('app-assets/images/pages/login-v2.svg')}}" alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title font-weight-bold mb-1">Welcome to {{config('app.name')}}!</h2>
                                <form class="mt-2" action="{{url('postLogin')}}" method="POST" id="userForm">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="username">Username<span style="color:red;"> *</span></label></label>
                                        <input class="form-control" id="username" type="text" name="username" placeholder="Enter Username" aria-describedby="username" autofocus="" tabindex="1" />

                                    @if ($errors->has('username'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                @endif
                                        
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="password">Password<span style="color:red;"> *</span></label></label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="2" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                                @endif
                                    </div>

                                        
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="remember-me" type="checkbox" tabindex="3" />
                                            <label class="custom-control-label" for="remember-me"> Remember Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" id="empBtn" tabindex="8">Sign up</button>
                                </form>
                                <p class="text-center mt-2"><span>New on our platform?</span><a href="{{route('register')}}"><span>&nbsp;Create an account</span></a></p>
                            </div>
                        </div>
                        <!-- /Login-->
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
$(document.body).on('click', "#empBtn", function(){
      if ($("#userForm").length > 0) {
        $("#userForm").validate({
errorElement: 'span',
          errorClass: 'text-red text-danger',
          ignore: [],
          rules: {
            "username":{
              required:true,
              minlength: 2,
              maxlength: 20
            },
            "password":{
              required:true,
              minlength: 2,
              maxlength: 20
            },
          },
          messages: {
            "username":{
              required:"Please enter username.",
            },
            "password":{
              required:"Please enter password.",
            },
          },errorPlacement: function(error, element) {
            if(element.is('password')){
              error.appendTo(element.after(".input-group"));
            }else if(element.is('textarea')){
              error.appendTo(element.closest("div"));
            }else{
              error.insertAfter(element.closest(".form-control"));
            }
          },
})
}
}); 
    </script>
@endsection