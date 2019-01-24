<a href="{{route('training-types.edit',['id'=>$training_type->id])}}" class="btn btn-success action-button edit-button">
    <i class="fa fa-edit"></i>
</a>
@if($training_type->id != 1)
<a href="{{ route('training-types.delete', ['id' => $training_type->id]) }}"class="btn btn-danger action-button delete-button">
    <i class="fa fa-times"></i>
</a>
@else

@endif
