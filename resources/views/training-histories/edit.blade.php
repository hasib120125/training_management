@extends('layouts.dashboard')
@section('page-title', 'Create Training History')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="content-header clearfix">
  <h2 class="pull-left darkblue-color">
    Edit Training History
  </h2> 
</div>


{!! Form::model($training_history, ['id'=>'model-form','method' => 'PATCH','route' => ['training-histories.update', $training_history->id]]) !!}

<input type="hidden" name="user_id" value="{{$training_history->user_id}}">

<div class="content">
  <div class="alert alert-success" id="success-msg" style="display:none"></div>
  <div class="alert alert-error" id="error-msg" style="display:none"></div>  
  <div class="panel panel-default">
    <div class="box box-info">
     	<div class="box-body">                                  
  			@include('training-histories.edit-form-fields')
	 	</div>
		<div class="box-footer">
      
      <button type="submit" class="btn btn-primary pull-right">Update</button>
		</div>
	</div>
  </div>
  <div class="alert alert-success" id="success-msg-bottom" style="display:none"></div>   
</div>
{!! Form::close() !!}
@endsection