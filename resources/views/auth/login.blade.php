@extends('partials.htmlhead')

@section('content')

<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Help</b>Desk</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login') }}" method="POST">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input type="email" class="form-control" name="email" value="{{ old('email') }}"  placeholder="E-Mail Address" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input id="password" type="password" class="form-control" name="password"  placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-round">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="{{ route('social.auth', 'facebook') }}" class="btn btn-block btn-social btn-facebook btn-flat "><i class="fa fa-facebook"></i> Sign in using
      Facebook</a>
      <P></P>
      <a href="{{ route('social.auth', 'google') }}" class="btn btn-block btn-social btn-google"><i class="fa fa-google-plus"></i> Sign in using
      Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="{{ route('password.request') }}" class="btn btn-link">I forgot my password</a><br>
    <a href="{{ route('register') }}" class="btn btn-link">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>


@endsection
