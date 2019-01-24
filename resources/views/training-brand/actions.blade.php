<a href="{{route('training-brand.edit',['id'=>$training_brand->id])}}" class="btn btn-success action-button edit-button">
    <i class="fa fa-edit"></i>
</a>
<a href="{{ route('training-brand.delete', ['id' => $training_brand->id]) }}" class="btn btn-danger action-button delete-button">
    <i class="fa fa-times"></i>
</a>
