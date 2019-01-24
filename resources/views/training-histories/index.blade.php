@extends('layouts.dashboard')
@section('page-title', 'Training Histories')

@section('content')

<div class="content-header clearfix">
  <h2 class="pull-left darkblue-color">
    List of Training Histories
  </h2>  
</div>
<div class="content">
  <div class="alert alert-success" id="success-msg" style="display:none"></div>
  <div class="alert alert-error" id="error-msg" style="display:none"></div>
  <div class="panel panel-default">

    <div class="bg-gray color-palette" style="padding: 10px; margin-bottom: 10px">
        <div class="form-inline">
          <div class="form-group">
            <label for="daterange">Date Range </label>
            <div id="reportrange" class="form-control">
              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
              <span></span> <b class="caret"></b>
            </div>
          </div>
          
        </div>
      </div>

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

    var startDate = moment().subtract(29, 'days');
    var endDate = moment();

    var table = $('#data-table').DataTable({

    @role('trainer')  
    dom: 'lBfrtip',
      buttons: [
        { 
          extend: "excel", text: "Download Excel", title: 'List Of Training History'
        },
      ],  
    @endrole

    serverSide: true,
    processing: true,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    ajax: "{{ route('training-histories.data') }}",
    
    columns: [
      @role('admin')
      {title: 'User', data: 'user',name: 'user.name'},
      @endrole
      {title: 'Training Title', data: 'training', name: 'training.title'},
      {title: 'Training Sub title', data: 'sub_title'},
      {title: 'From', data: 'started_at', name: 'started_at' },
      {title: 'To', data: 'ended_at', name: 'ended_at' },      
      {title: 'No of Trainees', data: 'no_of_trainees', name: 'no_of_trainees' },
      {title: 'Duration', data: 'approved_duration', name: 'approved_duration' },
      {title: 'Location', data: 'location', name: 'location' },
      {title: 'Audience', data: 'audience', name: 'audience.name' },
      {title: 'Training Type', data:'training_type', name:'training_type.name'},
      {title: 'Training Mode', data: 'training_mode', name:'training_mode.name'},
      {title: 'Training System', data: 'training_system', name:'training_system.name'},  
      {title: 'Training Brand', data: 'training_brand', name:'training_brand.name'},
      {title: 'Description', data: 'description'},
      
      {title: 'Status', data: 'status', name: 'status.name', 
        render: function (full_val) 
                {
                  // alert(full_val);
                    // if(val == 'approved')
                    // {
                    //   return "<small class='label pull-right bg-green'>Approved</small>";
                    // }
                    // else if(val == 'pending')
                    // {
                    //   return "<small class='label pull-right bg-yellow'>Pending</small>";
                    // }
                    // else if(val == 'rejected')
                    // {
                    //   return "<small class='label pull-right bg-red'>Rejected</small>";
                    // }
                    var return_string = "";
                    var splitted_val = full_val.split(':');
                    var val = splitted_val[0];
                    if(val == 'approved')
                    {
                      return_string = "<small class='label pull-right bg-green'>Approved</small>";
                    }
                    else if(val == 'pending')
                    {
                      return_string = "<small class='label pull-right bg-yellow'>Pending</small>";
                    }
                    else if(val == 'rejected')
                    {
                      return_string = "<small class='label pull-right bg-red'>Rejected</small>";
                    }

                    
                    if(splitted_val.length > 1){
                      return_string += "<small class='label pull-right bg-purple'>"+splitted_val[1]+"</small>";
                    }

                    
                    return return_string;
                }
      },
      
      {title: 'Actions', data: 'action', orderable: false, searchable: false, className: 'action-column'}
       
    ]
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
      console.log('clicked')
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

})
</script>
@endpush
