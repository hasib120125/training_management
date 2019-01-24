@extends('layouts.dashboard')
@section('page-title', 'Training Status')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="content-header clearfix">
  <h2 class="pull-left  darkblue-color">
    Training Assignments
  </h2>
  
</div>
<div class="content">
  <div class="alert alert-success" id="success-msg" style="display:none"></div>
  <div class="alert alert-error" id="error-msg" style="display:none"></div>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="bg-gray color-palette" style="padding: 10px; margin-bottom: 10px">
        <div class="form-inline">
          <div class="form-group">
            <label for="daterange">Date Range </label>
            <div id="reportrange" class="form-control">
              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
              <span></span> <b class="caret"></b>
            </div>
          </div>
          <div class="form-group" style="margin-left: 20px" id="filter-box">
            <label for="username">Training Title </label>
          </div>
        </div>
      </div>
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
    var startDate = moment().subtract(29, 'days');
    var endDate = moment();

    var table = $('#data-table').DataTable({
      initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                if(column[0] == 1){
                  var select = $('<select class="form-control"><option value=""></option></select>')
                  .appendTo($("#filter-box"))
                  .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                      $(this).val()
                    );
                    column
                    .search( val ? val : '', false, false )
                    .draw();
                  } );

                  column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                  } );
                }
            } );
        },
        dom: 'lBfrtip',
        buttons: [
            { extend: "excel", text: "Export Training Status", title: 'Training Status' }
          ],
        serverSide: true,
        processing: true,
        ordering: true,
        searching: true,
        select: true,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        ajax: {
          url: "{{route('training-users.data')}}",
          data: function(d){
            d.start_date = startDate ? startDate.format('YYYY-MM-DD HH:mm:ss'): '',
            d.end_date = endDate ? endDate.format('YYYY-MM-DD HH:mm:ss') : ''
          }
        },
        columns: [
            { title: 'Name', data: 'name', name: 'user.name'},
            { title: 'Training Title', data: 'training_title', name: 'training.title'},
            {title: 'Start Date', data: 'started_at', name: 'started_at' },
            {title: 'End Date', data: 'ended_at', name: 'ended_at' },
            {title: 'Assign Date', data: 'updated_at', name: 'training_user.updated_at' },      
            { title: 'Status', data: 'status', name: 'status.name', 
              render : function(val)
              {
                if(val == 'open')
                    {
                    return "<small class='label pull-right bg-green'>Open</small>";
                    }
                    else if(val == 'close')
                    {
                    return "<small class='label pull-right bg-red'>Close</small>";
                    }
              }
            },

            {title: 'Actions', data: 'action', orderable: false, searchable: false, 
            className: 'action-column'}

        ],
    });

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: { cancelLabel: 'Clear' }
    }, cb);

    cb(start, end);
    $("#reportrange").on('apply.daterangepicker', function(e, picker){
      startDate = picker.startDate;
      endDate = picker.endDate;
      table.draw(false);
    })
    $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
      //do something, like clearing an input
      startDate = undefined;
      endDate = undefined;
      $('#reportrange span').html('');
      table.draw(false);
    });
});
</script>
@endpush
