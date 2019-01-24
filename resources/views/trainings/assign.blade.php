{!! Form::open(['id'=>'model-form','method' => 'POST','route' => ['trainings.assign', $training->id]]) !!}
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <h4 class="modal-title">Assign Training</h4>
</div>
<div class="modal-body">
    <div class="row clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label">Start Date</label>
                <div class="form-line">
                    {!! Form::text('started_at', null, array('id' => 'started_at', 'placeholder' => 'Start Date','class' => 'form-control datetimepicker')) !!}
                </div>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label">End Date</label>
                <div class="form-line">
                    {!! Form::text('ended_at', null, array('id' => 'ended_at', 'placeholder' => 'End Date','class' => 'form-control datetimepicker')) !!}
                </div>
                <span class="help-block"></span>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="">Users</label>
                {!! Form::select('user_ids[]', $users, null, array('id' => 'user_ids', 'class' => 'form-control select2', 'multiple' => true)) !!}
                <span class="help-block"></span>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Assign</button>
</div>
{!! Form::close() !!}
