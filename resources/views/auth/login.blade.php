@extends('layouts.auth')
@section('page-title', 'Login - TRM')
@section('content')
<div class="section-lower">
	<div class="row">
		<div class="wrapper">
			<div class="sign-in-form">
				<form action="{{ route('login')}}" method="post">
					{{ csrf_field() }}
					<label>Username</label>
					<input type="text" name="username" placeholder="Username" required="">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password" required="">
					<!-- <a href="#" class="pass">Forgot Password?</a> -->
					<input type="submit" value="Log In">
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	var errors = {!! $errors !!};
	var output = '';
	if(errors){
		if(errors.username && errors.username.length){
			output += errors.username[0];
		}
		if(errors.password && errors.password.length){
			if(output){
				output += '\n';
			}
			output += errors.password[0];
		}
		if(output){
			alert(output);
		}
	}
</script>
@endpush
