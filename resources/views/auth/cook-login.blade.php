@extends('wiz-layouts.master')

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=369940186757354";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style>
/*#box{
    
    box-shadow: rgba(0, 0, 0, 0.1) 10px 5px 10px 10px;
 background-color:transparent;
    border-radius: 4px;
    top:50px;
}

h2{
    text-align:center;
    color:white;
    font-family: verdana;
}
.form-control{
  background-color: white;
}
*/
</style>
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
               <form class="form-horizontal" method="POST" action="{{ route('cook.login.submit') }}" style="margin-top: 10px">
                        
                        {{ csrf_field() }}
                <div class="header header-success text-center">
                  <h2 style="color:white">Sign in</h4>
                   <center>
                  <div class="social-line"><center>
                          <a href="{{ route('login') }}">
                                    <label style="color:white; font-size: 10px">Sign in as User &nbsp; | </label> 
                                </a> 

                      <a href="{{ route('register') }}">
                                    <label style="color:white; font-size: 10px"> Sign up as User</label> 
                                </a> 
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
                                    <span class="help-block" style="background-color: #30bb6d; color:white; font-size:12px">
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
                                     <span class="help-block" style="background-color: red; font-size:15px">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                  </div>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} checked>
                      Remember me
                      </input>
                    </label>
                  </div>


                     </div>    <!--lastdiv!--> 
                     <div class="footer text-center">
                  <button type="submit" class="btn btn-simple btn-success btn-lg"><b style="font-size: 15px">Sign in</b></a>
                </div>

                <br>
                  
                        <a style="font-size:12px; float:right; margin-right:10px; font-family: arial"  href="{{ route('cook.password.request') }}">
                                    <label style="color:black">Forgot Your Password? </label> 
                                </a> 
                      

             
               


                  </div>
               

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    </div>
@endsection