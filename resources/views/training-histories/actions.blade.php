@if(auth()->user()->hasRole('trainer') || auth()->user()->hasRole('admin'))
@if(($training_history->status_id == 5 && auth()->user()->hasRole('trainer')) || auth()->user()->hasRole('admin'))
@if($training_history->status_id == 5)
<a href="{{route('training-histories.edit',['id'=>$training_history->id])}}" class="btn btn-success edit-button">
    <i class="fa fa-edit"></i>
</a>
@endif
{{-- <a href="{{ route('training-histories.delete', ['id' => $training_history->id]) }}" class="btn btn-danger action-button delete-button">
    <i class="fa fa-times"></i>
</a> --}}
@endif
@endrole

