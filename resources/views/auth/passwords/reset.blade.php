@extends('wiz-layouts.master')
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=369940186757354";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@section('content')
<div class="wrapper">
    <div class="header header-filter" style="background-image: url('{{asset('img/bgsignin.jpg')}}');min-height:100%;">
        <div class="container">
            <div class="row">
                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                   <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                        <div class="card card-signup">
                            <div class="header header-success text-center">
                                <h4>Reset Password</h4>
                            </div>

                        <p class="text-divider"></p>
                            <div class="content">

                                    @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                    @endif


                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <span class="input-group-addon">
                                        <i class="material-icons">email</i>
                                    </span>

                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email" required>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock_outline</i>
                                    </span>

                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="input-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                 <span class="input-group-addon">
                                    <i class="material-icons">lock_outline</i>
                                </span>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>

                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class ="row">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-simple btn-primary btn-lg">Reset Password</button>
                                </div>
                            </div>
                            </div>
                        </div>
                     </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
