<a href="{{route('training-targets.edit',['id'=>$training_target->id])}}" class="btn btn-success action-button edit-button">
    <i class="fa fa-edit"></i>
</a>
<a href="{{ route('training-targets.delete', ['id' => $training_target->id]) }}"class="btn btn-danger action-button delete-button">
    <i class="fa fa-times"></i>
</a>
