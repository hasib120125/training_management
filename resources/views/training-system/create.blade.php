@extends('layouts.dashboard')
@section('page-title', 'Create Training')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="content-header clearfix">
  <h2 class="pull-left darkblue-color">
    Create Training System/Device
  </h2> 
</div>
{!! Form::open(['id'=>'model-form','route' => 'training-system.store','method'=>'POST']) !!}
<div class="content">
  <div class="alert alert-success" id="success-msg" style="display:none"></div>
  <div class="alert alert-error" id="error-msg" style="display:none"></div>  
  <div class="panel panel-default">
    <div class="box box-info">
     	<div class="box-body">                                  
  			 @include('training-system.fields')
	 	</div>
		<div class="box-footer">
      <button type="reset" class="btn btn-default pull-left">Reset</button>
		 	<button type="submit" class="btn btn-primary pull-right">Create</button>
		</div>
	</div>
  </div>   
</div>
{{ Form::close() }}
@endsection
