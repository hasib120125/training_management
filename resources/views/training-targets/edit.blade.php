{!! Form::model($training_target,['id'=>'model-form','method' => 'PATCH','route' => ['training-targets.update', $training_target->id]]) !!}
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <h4 class="modal-title darkblue-color">Edit Training Type</h4>
</div>
<div class="modal-body">
  @include('training-targets.fields')
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Update</button>
</div>
{!! Form::close() !!}
