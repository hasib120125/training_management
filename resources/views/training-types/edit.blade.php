{!! Form::model($training_type,['id'=>'model-form','method' => 'PATCH','route' => ['training-types.update', $training_type->id]]) !!}
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <h4 class="modal-title darkblue-color">Edit Training Type</h4>
</div>
<div class="modal-body">
  @include('training-types.fields')

  <div class="row clearfix">
      <div class="col-sm-6">
          <div class="form-group required">
            <label class="control-label">Status</label>
            {!! Form::select('active_status',['1' => 'Active','0' => 'Inactive'], null, ['class'=>'form-control select2', 'id' =>  'training-type-id', 'placeholder' => 'Please Select']) !!}
            <span class="help-block"></span>
          </div>
      </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Update</button>
</div>
{!! Form::close() !!}
