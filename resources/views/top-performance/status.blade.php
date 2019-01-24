@extends('layouts.dashboard')
@section('page-title', 'Training Targets')

@section('content')

<div class="content-header clearfix">
  <h2 class="pull-left darkblue-color">
    List of Training Targets Status
  </h2>
  
</div>
<div class="content">
  <div class="alert alert-success" id="success-msg" style="display:none"></div>
  <div class="alert alert-error" id="error-msg" style="display:none"></div>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="table-responsive">
        <!-- <table id="data-table" class="table table-bordered"></table> -->
         <table class="table table-bordered">
            <thead>
              <tr>
                @role('admin')
                <th>User Name</th>
                @endrole
                <th>Date</th>
                <th>Target Hours</th>
                <th>Achived Hours</th>
                <th>Remaining Hours</th>
              </tr>
            </thead>
            <tbody>
              @foreach($targets as $target)
              <tr>
                @role('admin')
                <td>{{$target->user->name}}</td>
                @endrole
                <td> {{$target->started_at->format('Y-m-d') .' - '.$target->ended_at->format('Y-m-d') }}</td>
                <td>{{$target->target_hour}}</td>
                <td>{{$target->achieved_hour}}</td>
                <td>{{$target->target_hour - $target->achieved_hour}}</td>
              </tr>
             @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="modal-form">
  <div class="modal-dialog">
    <div class="modal-content"></div>
  </div>
</div>
@endsection
