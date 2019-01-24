{!! Form::model($training, ['id'=>'model-form','method' => 'PATCH','route' => ['trainings.update', $training->id], 'files' => true, 'data-val' => true]) !!}
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <h4 class="modal-title darkblue-color">Edit Training</h4>
</div>
<div class="modal-body">
  @include('trainings.fields')
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Update</button>
</div>
{!! Form::close() !!}
