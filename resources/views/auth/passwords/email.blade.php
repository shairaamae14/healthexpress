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
    <div class="header header-filter" style="background-image: url('{{asset('img/bgsignin.jpg')}}');min-height:100%;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    -moz-background-size: cover;">
<div class="container">
    <div class="row">
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
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

                                    <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif

                                    </div>

                                    <div class ="row">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-simple btn-primary btn-lg">Send Password Reset Link</button>
                                        </div>
                                    </div>
                    
                                </div>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    HealthExpress
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                 About Us
                             </a>
                         </li>
                        </ul>
                    </nav>
            <!--                    <div class="copyright pull-right">
                        &copy; 2016, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com" target="_blank">Creative Tim</a>
                    </div>-->
                </div>
            </footer>
        </div>

    </div>

</div>
</div>
@endsection
