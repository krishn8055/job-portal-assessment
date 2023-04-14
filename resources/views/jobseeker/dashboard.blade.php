@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        	@foreach($jobs as $key=>$value)
        	@php
        	$skill = json_decode($value->skill);
        	@endphp
        <div class="col-md-4 ml-2">
           <div class="card" style="width: 18rem;height:100%;">
			  <div class="card-body">
			    <h5 class="card-title">{{$value->job_title}}</h5>
			    <p class="card-text"><b>Created on :</b> {{date('Y-m-d',strtotime($value->created_at))}}</p>
			    <p class="card-text"><b>Description :</b> {{$value->job_description}}</p>
			    <p class="card-text"><b>Skill Required :</b> {{implode(',',$skill)}}</p>
			    <p class="card-text"><b>Experience Required : </b>{{$value->experience_year}} years {{$value->experience_month}} months</p>
			    @if(empty($value['applyJobDetail']))
			    <a href="{{url('jobseeker/apply-job',$value->id)}}" class="btn btn-primary">Apply Now</a>
			    @else
			    <span class="btn btn-success">Already Applied</span>
			    @endif
			  </div>
			</div>
        </div>
			@endforeach
    </div>
</div>
@endsection
