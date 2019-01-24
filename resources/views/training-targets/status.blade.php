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
        <table id="data-table" class="table table-bordered"></table>
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

@push('scripts')
<script>
$(function () {
  $('#data-table').DataTable({

    dom: 'lBfrtip',
      buttons: [
        { 
          extend: "excel", text: "Download Excel", title: 'Target Status Reports'
        },
      ], 

    serverSide: true,
    processing: true,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: "{{ route('training-targets.statusdata') }}",
    columns: [
      @role('admin')
      {title: 'Name', data: 'user_name', name: 'user.name' },
      @endrole
      {title: 'From', data: 'started_at', name: 'started_at' },
      {title: 'To', data: 'ended_at', name: 'ended_at' },
      {title: 'Target', data: 'target_hour', name: 'target_hour' },
      {title: 'Achieved', data: 'achived_hours'},
      {title: 'Remaining Hours', data: 'remain_hours'}  
      
    ]
  })
})
</script>
@endpush
