@extends('layouts.dashboard')
@section('page-title', 'Users')

@section('content')

<div class="content-header clearfix">
  <h2 class="pull-left darkblue-color">
    List of Users
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
    serverSide: true,
    processing: true,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: "{{route('users.data')}}",
    columns: [
      // {title: 'Login ID', data: 'username'},
      {title: 'Name', data: 'name'},
      {title: 'Email', data: 'email'},
      {title: 'Group', data: 'role', name: "roles.display_name"},
      {title: 'Registered At', data: 'registered_at', name:'users.created_at'},
      {title: 'Mobile', data: 'mobile'},
      {title: 'ID/S-ID', data: 'id_number'},
      {title: 'Secondary Contact', data: 'secondary_contact'},
      {title: 'Address', data:'address'},
      {title: 'Status', data: 'is_active', 
        render: function (val) 
                {
                    if(val == 1)
                    {
                      return "<small class='label pull-right bg-green'>Active</small>";
                    }
                    else
                    {
                      return "<small class='label pull-right bg-yellow'>Inactive</small>";
                    }
                    
                }
      },
      {title: 'Actions', data: 'action', orderable: false, searchable: false,className:'action-column'}
    ]
  })
})
</script>
@endpush
