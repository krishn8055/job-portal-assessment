@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    	<div class="col-10">
        	<form action="{{url('jobseeker/apply-job/store')}}" id="userForm" method="POST" enctype="multipart/form-data">
        		@csrf
        		<input type="hidden" name="id" value="{{$data->id}}">
				<div class="form-group">
				<label for="headline">Headline<span style="color:red;"> *</span></label></label>
				<input type="headline" class="form-control" id="headline" name="headline" placeholder="Write Headline here">
				</div>
				@if ($errors->has('headline'))
				<span class="help-block alert alert-danger">
				<strong>{{ $errors->first('headline') }}</strong>
				</span>
				@endif
				<div class="form-group">
				<label for="pwd">Cover Letter<span style="color:red;"> *</span></label></label>
				<input type="file" class="form-control" name="cover_letter" id="cover_letter">
				</div>
				@if ($errors->has('cover_letter'))
				<span class="help-block alert alert-danger">
				<strong>{{ $errors->first('cover_letter') }}</strong>
				</span>
				@endif
				<button type="submit" class="btn btn-primary mt-2" id="createBtn">Submit</button>
			</form>
		</div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
      if ($("#userForm").length > 0) {
        $("#userForm").validate({
errorElement: 'span',
          errorClass: 'text-red text-danger',
          ignore: [],
          rules: {
            "headline":{
              required:true,
            },
            "cover_letter":{
              required:true,
            },
          },
          messages: {
            "headline":{
              required:"Please enter headline.",
            },
            "cover_letter":{
              required:"Please select file.",
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
@endsection
