@extends('layouts.auth')
@section('page-title', 'Register - Anontech')
@section('content')
    <div class="top-content">

        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><a href="{{ url('/') }}"><i class="fa fa-arrow-left" style="font-size:0.8em"></i><strong> AnonTech</strong></a></h1>
                        <div class="description">
                            <p>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 social-login">
                        <h3>Register with:</h3>


                        <div class="social-login-buttons">

                            <a class="btn btn-link-1 btn-link-1-facebook" href="{{ url('/auth/facebook') }}">
                                <i class="fa fa-facebook"></i> Facebook
                            </a>
                            <a class="btn btn-link-1 btn-link-1-twitter" href="{{ url('/auth/twitter') }}">
                                <i class="fa fa-twitter"></i> Twitter
                            </a>
                            <a class="btn btn-link-1 btn-link-1-google-plus" href="{{ url('/auth/google') }}">
                                <i class="fa fa-google-plus"></i> Google Plus
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <h3>Or</h3>
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Register for a new account</h3>
                                <p>Fill in the form below:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-key"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form class="login-form" role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="sr-only">Name</label>

                                    <input id="name" type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="sr-only">E-Mail Address</label>

                                    <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone" class="sr-only">Phone Number</label>

                                    <input id="phone" type="text" class="form-control" placeholder="Phone number" name="phone" value="{{ old('phone') }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="sr-only">Password</label>

                                    <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="sr-only">Confirm Password</label>

                                    <input id="password-confirm" type="password" class="form-control" placeholder="Retype password" name="password_confirmation" required>
                                </div>

                                <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                                    <label for="remarks" class="sr-only">Comments</label>

                                    <textarea id="remarks" class="form-control" placeholder="Write something.." name="remarks">{{ old('remarks') }}</textarea>

                                    @if ($errors->has('remarks'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('remarks') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <input type="hidden" name="user_type" value="client">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                                <div class="form-link text-left">
                                    <a href="{{ route('login') }}">I already have an account</a><br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                </div>
            </div>
        </div>

    </div>
@endsection
