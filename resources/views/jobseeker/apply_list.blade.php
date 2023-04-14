@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        	@foreach($data as $key=>$value)
        	@php
        	$skill = json_decode($value['jobDetail']->skill);
        	@endphp
        <div class="col-md-4 ml-2">
           <div class="card" style="width: 18rem;height:100%;">
			  <div class="card-body">
			    <h5 class="card-title">{{$value['jobDetail']->job_title}}</h5>
			    <p class="card-text"><b>Description :</b> {{$value['jobDetail']->job_description}}</p>
			    <p class="card-text"><b>Skill Required :</b> {{implode(',',$skill)}}</p>
			    <p class="card-text"><b>Experience Required : </b>{{$value['jobDetail']->experience_year}} years {{$value['jobDetail']->experience_month}} months</p>
			    <p class="card-text"><b>Applied On : </b>{{date('Y-m-d',strtotime($value->created_at))}}</p>
			  </div>
			</div>
        </div>
			@endforeach
    </div>
</div>
@endsection
