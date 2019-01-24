<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">User</label>
      {!! Form::select('user_id', $users, null, ['class'=>'form-control select2', 'id' =>  'user-id', 'placeholder' => 'Please Select']) !!}
      <span class="help-block"></span>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">From</label>
      <div class="form-line">
        {!! Form::text('started_at', null, array('id' => 'started_at', 'placeholder' => 'From Date','class' => 'form-control datetimepicker','autocomplete'=>'off')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">To</label>
      <div class="form-line">
        {!! Form::text('ended_at', null, array('id' => 'ended_at', 'placeholder' => 'End Date','class' => 'form-control datetimepicker','autocomplete'=>'off')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Target Hour</label>
      <div class="form-line">
        {!! Form::number('target_hour', null, array('id'=> 'target-hour', 'placeholder' => 'Target Hour','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>
