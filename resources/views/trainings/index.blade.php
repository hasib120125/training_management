@extends('layouts.dashboard')
@section('page-title', 'Trainings')

@section('content')

<div class="content-header clearfix">
  <h2 class="pull-left darkblue-color">
    List of Trainings
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
<div class="modal fade" id="modal-form">
  <div class="modal-dialog">
    <div class="modal-content"></div>
  </div>
</div>
@endsection

@push('scripts')
<script>
@role('admin')
$(function () {
    var table = $('#data-table').DataTable({
        serverSide: true,
        processing: true,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        ajax: "{{route('trainings.data')}}",
        order: [[ 3, 'desc']],
        columns: [
            {data: 'id', visible: false},
            {title: 'Title', data: 'title'},
            {title: 'Description', data: 'description'},
            {title: 'Type', data: 'type',name:'type.name'},
            {title: 'Mode', data: 'mode',name:'mode.name'},
            {title: 'Started At', data: 'started_at'},
            {title: 'Ended At', data: 'ended_at'},           
            {
                title: 'Status', data: 'status',name:'status.name',
                render: function (val) 
                {
                    if(val == 'Open')
                    {
                    return "<small class='label label-info'>Open</small>";
                    }
                    else if(val == 'Close')
                    {
                    return "<small class='label label-warning'>Close</small>";
                    }
                }
              },

            {title: 'Actions', data: 'action', orderable: false, searchable: false, className: 'action-column'}
        ]
    })
})
@endrole
@role('trainer')
$(function () {
    var table = $('#data-table').DataTable({
        serverSide: true,
        processing: true,
        ajax: "{{route('trainings.data')}}",
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
@endrole
</script>
@endpush
