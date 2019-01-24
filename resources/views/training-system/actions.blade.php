<a href="{{route('training-system.edit',['id'=>$training_system->id])}}" class="btn btn-success action-button edit-button">
    <i class="fa fa-edit"></i>
</a>
<a href="{{ route('training-system.delete', ['id' => $training_system->id]) }}" class="btn btn-danger action-button delete-button">
    <i class="fa fa-times"></i>
</a>
