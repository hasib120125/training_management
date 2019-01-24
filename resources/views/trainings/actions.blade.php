@role('admin')
<a href="{{ route('training-users.create', ['training_id' => $training->id]) }}" class="btn btn-primary assign-button">
    <i class="fa fa-angle-double-right"></i>
</a>
<a href="{{route('trainings.edit',['id'=>$training->id])}}" class="btn btn-success action-button edit-button">
    <i class="fa fa-edit"></i>
</a>
@if($training->id == '1' || $training->id == '2')

@else
<a href="{{ route('trainings.delete', ['id' => $training->id]) }}"class="btn btn-danger action-button  delete-button">
    <i class="fa fa-times"></i>
</a>
@endif
@if($training->files()->count())
<a href="{{route('trainings.DownloadFile', ['id'=> $training->id])}}" class="btn btn-success">
    <i class="fa fa-download"></i>
</a>
@endif
@endrole
