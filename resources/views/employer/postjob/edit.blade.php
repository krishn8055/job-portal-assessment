@extends('employer.layouts.app')
@section('title') Update Post | @endsection
@section('content')
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Update Post</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="{{url('employer/dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Update Post
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section class="bs-validation">
        <div class="row">
          <div class="col-md-12 col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Update Post</h4>
              </div>
              <div class="card-body">
                <form class="form-horizontal" id="userForm" role="form" action="{{url('employer/posted-jobs/update',$data->id)}}" method="post" enctype="multipart/form-data" >
                  @csrf
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group {{ $errors->has('job_title') ? ' has-error' : '' }}">
                            <label  class="control-label" for="job_title">Job Title<span class="colorRed"> *</span></label>
                            <div class=" jointbox">
                              <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter Job Title" value="{{$data->job_title}}"/>
                              @if ($errors->has('job_title'))
                              <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('job_title') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 mb-1">
                          <div class="form-group {{ $errors->has('skill') ? ' has-error' : '' }}">
                                            <label  class="control-label" for="skill">Skill<span class="colorRed"> *</span></label>
                                            <select class="form-control" id="skill" multiple name="skill[]">
                                              @php
                                              $selected = json_decode($data->skill);
                                              @endphp
                                                    <option value="PHP" @if(in_array('PHP',$selected)) selected @endif>PHP</option>
                                                    <option value="CI" @if(in_array('CI',$selected)) selected @endif>CI</option>
                                                    <option value="Laravel" @if(in_array('Laravel',$selected)) selected @endif>Laravel</option>
                                                    <option value="NodeJs" {@if(in_array('NodeJs',$selected)) selected @endif>NodeJs</option>
                                                    <option value="ReactJs" @if(in_array('ReactJs',$selected)) selected @endif>ReactJs</option>
                                                    <option value="Angular" @if(in_array('Angular',$selected)) selected @endif>Angular</option>
                                                    <option value="Java" @if(in_array('Java',$selected)) selected @endif>Java</option>
                                            </select>
                                        </div>
                                      </div>
                        <div class="col-sm-12">
                          <div class="form-group {{ $errors->has('job_description') ? ' has-error' : '' }}">
                            <label  class="control-label" for="job_description">Job Description <span class="colorRed"> *</span></label>
                            <div class=" jointbox">
                              <textarea class="form-control" name="job_description" id="job_description" rows="3" placeholder="Textarea">{{$data->job_description}}</textarea>
                              @if ($errors->has('job_description'))
                              <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('job_description') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group {{ $errors->has('experience_year') ? ' has-error' : '' }}">
                            <label  class=" control-label" for="experience_year">Experience(in year) <span class="colorRed"> *</span></label>
                            <div class="">
                              <input type="number" class="form-control" id="experience_year" name="experience_year" placeholder="Experience in year"  value="{{$data->experience_year}}"/>
                              @if ($errors->has('experience_year'))
                              <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('experience_year') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group {{ $errors->has('experience_month') ? ' has-error' : '' }}">
                            <label  class=" control-label" for="experience_month">Experience(in months) <span class="colorRed"> *</span></label>
                            <div class="">
                              <input type="number" class="form-control" id="experience_month" name="experience_month" placeholder="Experience in months"  value="{{$data->experience_month}}"/>
                              @if ($errors->has('experience_month'))
                              <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('experience_month') }}</strong>
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
                              <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                              <button type="submit" id="createBtn" class="btn btn-primary pull-right" style="margin-left: 20px;float:right;">Update</button>
                              <!-- <button type="button" class="btn btn-info pull-right"  id="cancelBtn" style="float:right;">Close</button> -->
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
    <script>
      $(document).ready(function() {
  $("#skill").select2({
    placeholder: "Select a skill",
    allowClear: true,
  });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
$(document.body).on('click', "#createBtn", function(){
      if ($("#userForm").length > 0) {
        $("#userForm").validate({
errorElement: 'span',
          errorClass: 'text-red text-danger',
          ignore: [],
          rules: {
            "job_title":{
              required:true,
              minlength: 2,
              maxlength: 20
            },
            "job_description":{
              required:true,
              minlength: 2,
              maxlength: 20
            },
            "skill[]":{
              required:true,
            },
            "experience_year":{
              required:true,
            },
            "experience_month":{
              required:true,
            }
          },
          messages: {
            "skill[]":{
              required:"Please enter skills.",

            },
            "job_title":{
              required:"Please enter job title.",
            },
            "job_description":{
              required:"Please enter job description.",
            },
            "experience_year":{
              required:"Please enter experience in year.",
            },
            "experience_month":{
              required:"Please enter experience in months.",
            }
          },errorPlacement: function(error, element) {
            if(element.is('select')){
              error.appendTo(element.closest("div"));
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