<!DOCTYPE html>
<html lang="en">

<head>
	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="linkvisionsoftwaresolution">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/normalize.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/grid.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/auth.css')}}">
	<title>@yield('page-title', 'Login - Info360')</title>
</head>

<body class="login-page">
	<div class="login-page-container">
		<div class="section-upper">
			<div class="logo-container">
				<img src="{{ asset('img/logo.png') }}" alt="Info 360 Logo">
			</div>
		</div>
		@yield('content')
	</div>
	@stack('scripts')
	<script>
	var timeout
	function refresh(){
		clearTimeout(timeout)
		timeout = setTimeout(() => {
			location.reload()
		}, {{ (config('session.lifetime')-10) * 60 * 1000 }})
	}
	refresh()
	document.addEventListener('click', refresh)
	</script>
</body>

</html>
