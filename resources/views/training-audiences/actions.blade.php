<a href="{{route('training-audiences.edit',['id'=>$training_audience->id])}}" class="btn btn-success action-button edit-button">
    <i class="fa fa-edit"></i>
</a>
<a href="{{ route('training-audiences.delete', ['id' => $training_audience->id]) }}"class="btn btn-danger action-button delete-button">
    <i class="fa fa-times"></i>
</a>
