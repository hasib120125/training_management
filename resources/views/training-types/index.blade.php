@extends('layouts.dashboard')
@section('page-title', 'Training Types')

@section('content')

<div class="content-header clearfix">
  <h2 class="pull-left darkblue-color">
    List of Training Types
  </h2>
  {{-- <div class="pull-right">
    <a href="{{ route('training-types.create')}}" class="btn bg-blue create-button" id="create-button">
      <i class="fa fa-plus-square"></i> Add new
    </a>
  </div> --}}
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
    serverSide: true,
    processing: true,    
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: "{{route('training-types.data')}}",
    columns: [
      {title: 'Name', data: 'name'},
      { title: 'Status', data: 'active_status', 
        render : function(val)
          {
            if(val == '1')
              {
                return "<small class='label pull-right bg-green'>Active</small>";
              }
              else if(val == '0')
              {
                return "<small class='label pull-right bg-red'>Inactive</small>";
              }
          }
      },
      {title: 'Actions', data: 'action', orderable: false, searchable: false}
    ]
  })
})
</script>
@endpush
