<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Sub Title</label>
        <div class="form-line">
          {!! Form::text('sub_title', null, array('autocomplete'=> 'off','placeholder' => 'sub title','class' => 'form-control')) !!}
        </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>  
<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">From</label>
      <div class="form-line">
        {!! Form::text('started_at', null, array('id' => 'started_at', 'placeholder' => 'From Date','class' => 'form-control assignTrainingDatetimepicker','autocomplete'=>'off')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">To</label>
      <div class="form-line">
        {!! Form::text('ended_at', null, array('id' => 'ended_at', 'placeholder' => 'End Date','class' => 'form-control assignTrainingDatetimepicker','autocomplete'=>'off')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Duration</label>
      <div class="form-line">
        {!! Form::text('user_duration', null, array('id'=> 'user-duration','format' => "HH:mm:ss" ,'placeholder' => 'Duration in hour','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">No of Trainees</label>
      <div class="form-line">
        {!! Form::number('no_of_trainees', null, array('id'=> 'no-of-trainees', 'placeholder' => 'Number of trainees', 'class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-sm-12">
    <div class="form-group required">
      <label class="control-label">Location</label>
      <div class="form-line">
        {!! Form::text('location', null, array('id'=> 'location', 'placeholder' => 'Location','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>
<div class="row clearfix"> 
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Training Type</label>
      <div class="form-line">
        {!! Form::select('training_type_id', $training_types, $training_user->training->training_type_id, array('id'=> 'training-type-id','class' => 'form-control select2', 'placeholder' => 'Please Select')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Training Mode</label>
      {!! Form::select('training_mode_id', $training_modes, $training_user->training->training_mode_id, array('id' => 'training-mode-id', 'class'=>'form-control select2', 'placeholder' => 'Please Select')) !!}
      <span class="help-block"></span>
    </div>
  </div>
</div>

<div class="row clearfix"> 
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Training System</label>
      <div class="form-line">
        {!! Form::select('training_system_id', $training_system, $training_user->training->training_system, array('id'=> 'training-system-id','class' => 'form-control select2', 'placeholder' => 'Please Select')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Training Brand</label>
      {!! Form::select('training_brand_id', $training_brands, $training_user->training->training_brand, array('id' => 'training-brand-id', 'class'=>'form-control select2','placeholder' => 'Please Select')) !!}
      <span class="help-block"></span>
    </div>
  </div>
</div>

<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Audience</label>
      <div class="form-line">
        {!! Form::select('training_audience_id', $audiences, null, array('id'=> 'training-audience-id', 'placeholder' => 'Audience','class' => 'form-control select2')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>  

@role('admin')
<div class="row clearfix">  
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Status</label>
      {!! Form::select('status_id', $statuses, null, ['class'=>'form-control select2', 'id' =>  'status_id', 'placeholder' => 'Please Select']) !!}
      <span class="help-block"></span>
    </div>
  </div>
</div>
@endrole


<div class="row clearfix">
  <div class="col-sm-12">
    <div class="form-group">
      <label call="control-label">Description</label>
      <div class="form-line">
        {!! Form::textarea('description', null, array('id'=> 'description', 'placeholder' => 'Here goes the Description of the training...','class' => 'form-control', 'rows' => 4)) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>
