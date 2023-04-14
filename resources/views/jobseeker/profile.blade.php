@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
                                <form class="form-horizontal" id="profileForm" method="post" action="{{url('jobseeker/updateProfile')}}" enctype="multipart/form-data">
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
                                                <label for="experience" class=" control-label">Experience<span style="color:red;"> *</span></label></label>
                                                <div class="">
                                                <input type="text" class="form-control"  name="experience" id="experience" value="{{$user->experiance}}" placeholder="Enter Experience">
                                                @if ($errors->has('experience'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('experience') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="title" class=" control-label">Title<span style="color:red;"> *</span></label></label>
                                                <div class="">
                                                <input type="title" class="form-control"  name="title" id="title" value="{{$user->title}}" placeholder="Enter Title">
                                                @if ($errors->has('title'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <div class="form-group {{ $errors->has('skill') ? ' has-error' : '' }}">
                                            <label  class="control-label" for="skill">Skill<span style="color:red;"> *</span></label>
                                            @if(!empty(auth()->user()->skill))
                                            <select class="form-control" id="skill" multiple name="skill[]">
                                              @php
                                              $selected = json_decode(auth()->user()->skill);
                                              @endphp
                                                    <option value="PHP" @if(in_array('PHP',$selected)) selected @endif>PHP</option>
                                                    <option value="CI" @if(in_array('CI',$selected)) selected @endif>CI</option>
                                                    <option value="Laravel" @if(in_array('Laravel',$selected)) selected @endif>Laravel</option>
                                                    <option value="NodeJs" {@if(in_array('NodeJs',$selected)) selected @endif>NodeJs</option>
                                                    <option value="ReactJs" @if(in_array('ReactJs',$selected)) selected @endif>ReactJs</option>
                                                    <option value="Angular" @if(in_array('Angular',$selected)) selected @endif>Angular</option>
                                                    <option value="Java" @if(in_array('Java',$selected)) selected @endif>Java</option>
                                            </select>
                                            @else
                                            <select class="form-control" id="skill" multiple name="skill[]">
                                                    <option value="PHP">PHP</option>
                                                    <option value="CI">CI</option>
                                                    <option value="Laravel">Laravel</option>
                                                    <option value="NodeJs">NodeJs</option>
                                                    <option value="ReactJs">ReactJs</option>
                                                    <option value="Angular">Angular</option>
                                                    <option value="Java">Java</option>
                                            </select>
                                      @endif
                                        </div>
                                      </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="resume" class=" control-label">Resume<span style="color:red;"> *</span></label></label>
                                                <div class="">
                                                <input type="file" class="form-control"  name="resume" id="resume" value="{{$user->resume}}" placeholder="Resume">
                                                </div>
                                                <a href="{{asset('uploads/resume/'.$user->resume)}}" target="_blank">View Uploaded Resume</a>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="" style="border-top:0">
                                                <div class="box-footer">
                                                    <button type="submit" id="createBtn" class="btn btn-primary pull-right mt-2" style="margin-left: 20px;float:right;">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
      $(document).ready(function() {
  $("#skill").select2({
    placeholder: "Select a skill",
    allowClear: true,
  });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
@if(Session::has('message'))
    <script>
        $(function() {
            toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
        });
    </script>
@endif
<script>
$(document.body).on('click', "#createBtn", function(){
      if ($("#profileForm").length > 0) {
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
            "experience":{
              required:true,
            },
            "title":{
              required:true,
            },
            "skill[]":{
              required:true,
            },
          },
          messages: {
            "first_name":{
              required:"Please enter first name.",
            },
            "last_name":{
              required:"Please enter last name.",
            },
            "experience":{
              required:"Please enter experience.",
            },
            "title":{
              required:"Please enter title.",
            },
            "skill[]":{
              required:"Please select skill.",
            },
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
</script>

@endsection