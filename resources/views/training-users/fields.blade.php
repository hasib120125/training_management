    <div class="row clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">Training</label>
                {!! Form::select('training_id', $trainings, empty($training) ? null: $training->id, array('id' => 'training_id', 'class' => 'form-control select2', 'placeholder' => 'Please Select')) !!}
                <span class="help-block"></span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label">Start Date</label>
                <div class="form-line">
                    {!! Form::text('started_at', null, array('id' => 'started_at', 'placeholder' => 'Start Date','class' => 'form-control datetimepicker','autocomplete'=>'off')) !!}                  
                </div>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label">End Date</label>
                <div class="form-line">
                    {!! Form::text('ended_at', null, array('id' => 'ended_at', 'placeholder' => 'End Date','class' => 'form-control datetimepicker','autocomplete'=>'off')) !!}
                </div>
                <span class="help-block"></span>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">Users</label>
                {!! Form::select('user_ids[]', $users, null, array('id' => 'user_ids', 'class' => 'form-control select2', 'multiple' => "multiple")) !!}
                <span class="help-block"></span>
            </div>
        </div>
    </div>

    