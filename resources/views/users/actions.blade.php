<a href="{{route('users.edit',['id'=>$user->id])}}" class="btn btn-success action-button edit-button">
    <i class="fa fa-edit"></i>
</a>
@if($user->is_locked)

@elseif($user->is_active)
<a href="{{ route('users.delete', ['id' => $user->id]) }}"class="btn btn-danger action-button delete-button">
    <i class="fa fa-times"></i>
</a>
@endif
