@extends('layouts.dashboard')
@section('page-title', 'Pending Trainings')
@section('content')
<div class="content-header clearfix">
  <h2 class="pull-left">
    List of Trainings
  </h2>
  <div class="pull-right">
    <a href="{{ route('trainings.create')}}" class="btn bg-blue create-button" id="create-button">
      <i class="fa fa-plus-square"></i> Add new
    </a>
  </div>
</div>
<div class="content">
  <div class="alert alert-success" id="success-msg" style="display:none"></div>
  <div class="alert alert-error" id="error-msg" style="display:none"></div>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="table-responsive">
        <table id="data-table" class="table table-bordered"></table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-form">
  <div class="modal-dialog">
    <div class="modal-content"></div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    var table = $('#data-table').DataTable({
        serverSide: true,
        processing: true,
        ajax: "{{route('trainings.pendingData')}}",
        order: [[ 3, 'desc']],
        columns: [
            {data: 'id', visible: false},
            {title: 'Title', data: 'title'},
            {title: 'Description', data: 'description'},
            {title: 'Started At', data: 'started_at'},
            {title: 'Ended At', data: 'ended_at'},
            {title: 'Actions', data: 'action', orderable: false, searchable: false, className: 'action-column'}
        ]
    });

  });
</script>
@endpush
