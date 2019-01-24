<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Title</label>
      <div class="form-line">
        {!! Form::text('title', null, array('id'=> 'title', 'placeholder' => 'Training Title','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Start Date</label>
      <div class="form-line">
        {!! Form::text('started_at', null, array('id' => 'started_at', 'placeholder' => 'Launch Date','autocomplete' => 'off','class' => 'form-control datetimepicker')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">End Date</label>
      <div class="form-line">
        {!! Form::text('ended_at', null, array('id' => 'ended_at', 'placeholder' => 'End Date','autocomplete' => 'off','class' => 'form-control datetimepicker')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Training Type</label>
      {!! Form::select('training_type_id', $training_types, null, ['class'=>'form-control select2', 'id' =>  'training-type-id', 'placeholder' => 'Please Select']) !!}
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Training Mode</label>
      {!! Form::select('training_mode_id', $training_modes, null, ['class'=>'form-control select2', 'id' => 'training-mode-id', 'placeholder' => 'Please Select' ]) !!}
      <span class="help-block"></span>
    </div>
  </div>
</div>

<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Training System</label>
      {!! Form::select('training_system', $training_system, null, ['class'=>'form-control select2', 'id' =>  'training-system-id', 'placeholder' => 'Please Select']) !!}
      
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Training Brand</label>
      {!! Form::select('training_brand', $training_brand, null, ['class'=>'form-control select2', 'id' => 'training-brand-id', 'placeholder' => 'Please Select' ]) !!}
      
    </div>
  </div>
</div>

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

@if(!empty($training) && $training->files()->count())
<div class="row clear-fix">
  <div class="col-md-12">
    <label>Current File(s)</label>
    <div class="box box-default">
      <div class="box-body">
        @foreach($training->files as $file)
        <div class="row">
          <div class="col-md-8 file-container">
            <input name="existing_files[{{$file->id}}]" class="file first-file file-id" type="hidden" value="1"/>
            <span class="file-name">{{ $file->raw_name }}</span>
            <button class="file-revert-button" style="display:none"><i class="fa fa-undo"></i></button>
            <button class="file-remove-button">&times;</button>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endif
<div class="row clear-fix">
  <div class="col-md-12">
    <label>File(s)</label>
    <div class="box box-default">
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-12 file-container">
            <input name="files[]" class="file-one first-file" type="file" />
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
