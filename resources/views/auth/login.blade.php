@extends('wiz-layouts.master')

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=369940186757354";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

@section('content')
    <div class="wrapper">
    <div class="header header-filter" style="background-image: url('{{asset('img/bgsignin.jpg')}}');   min-height:100%;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    -moz-background-size: cover;">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <div class="card card-signup">
              <form class="form-horizontal" method="POST" action="{{ route('login') }}"  style="margin-top: 10px" id="loginform">
                        {{ csrf_field() }}
                <div class="header header-success text-center">
                  <h2 style="color:white"><b>SIGN</b> IN</h2>
                  <div class="social-line"><center>
                    <a href="{{ route('cook.login') }}">
                      <label style="color:white; font-size: 10px">Sign in as Cook &nbsp; | </label> 
                    </a> 
                    <a href="{{ route('cook.register') }}">
                      <label style="color:white; font-size: 10px"> Sign up as Cook</label> 
                     </a>
                     </center> 
                  </div>
                </div>
             
                <div class="content">
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">email</i>
                      </span>
                      <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email...">
                         @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong> 
                          </span>
                          @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">lock_outline</i>
                      </span>
                      <input type="password" name="password" placeholder="Password..." class="form-control" />
                        @if ($errors->has('password'))
                           <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                        @endif
                    </div>
                  </div>
                </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me</input>
                    </label>
                  </div>


                
                    <div class="footer text-center">
                      <div class ="row">
                        <div class="text-center col-md-3">
                            <button type="submit" class="btn btn-simple btn-primary btn-lg">Sign in</button>
                        </div>
                        <div class ="text-center col-md-3">
                            <a class="btn btn-simple btn-primary btn-lg" href="{{ route('password.request') }}">
                            Forgot Your Password?
                            </a>
                      </div>
                    </div>
                  </div>
              </form>
              <div class="text-center">
                  Don't have an account yet? <a href="{{ route('register' )}}" class="btn btn-simple btn-primary">Register</a>
              </div>
            </div>

            </div>
          </div>
    </div>
  </div>
</div>
@endsection
@section('addtl_scripts')
<!--   Core JS Files   -->
  <script src="{{asset('customer/assets/js/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('customer/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('customer/assets/js/material.min.js')}}"></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('customer/assets/js/nouislider.min.js')}}" type="text/javascript"></script>

  <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
  <script src="{{asset('customer/assets/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>

  <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
  <script src="{{asset('customer/assets/js/material-kit.js')}}" type="text/javascript"></script>
  <!-- JQuery Validate-->
  <script src="{{asset('js/jquery.validate.min.js')}}" type="text/javascript"></script>
  <!-- Form Validation -->
  <script src="{{asset('js/form-validation.js')}}" type="text/javascript"></script>
@endsection