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
#box{
    
    box-shadow: rgba(0, 0, 0, 0.1) 0px 5px 10px 10px;
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

</style>
@section('content')
 
     <div class="container-fluid" style="margin-top: 100px">
                    <div class="row-fluid" >
                       
                                <h2 style="color:white; font-family: arial; font-size: 50px; margin-top: 10px; margin-bottom: 10px"><strong>SIGN IN</strong></h2>
                           <div class="col-md-offset-4 col-md-4" id="box">
                      
                           
                           <!--      <hr style="border:1px solid #30BB6D"> -->
                               

                                  <form class="form-horizontal" method="POST" action="{{ route('cook.login.submit') }}" style="margin-top: 10px">
                        {{ csrf_field() }}
                                        <fieldset>
                                            <!-- Form Name -->


                                            <!-- Text input-->

                                           <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" style="color:#30BB6D"></i></span>
                                                        <input name="email" value="{{ old('email') }}" placeholder="Email" class="form-control" type="text" style="background-color: white; color:black;">


                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                                    </div>
                                                </div>
                                            </div>


                                      
                                            <!-- Text input-->
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"">

                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock" style="color:#30BB6D"></i></span>
                                                        <input name="password" placeholder="Password.."class="form-control" type="password" style="background-color: white; color:black;">

                                                          @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                                    </div>
                                                </div>
                                            </div>


                                          <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <strong><label style="color:white; font-family: arial; float:left"><strong>
                                        <input type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}>REMEMBER ME
                                    </strong></label></strong>
                                </div>
                            </div>
                        </div>
                                        
                                    
                               
                            
                                            <div class="form-group">

                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-md btn-danger pull-right" style="background-color: #30BB6D">Login </button><a class="btn btn-link" style="font-size:12px; float:right; font-family: arial; color:white"  href="{{ route('cook.password.request') }}">
                                    Forgot Your Password?      
                                </a>
                                
                                                </div>
                                            </div>

                                              <div class="form-group">
                                             <a href="{{route('login')}}" style="float:left; font-family: verdana; font-size:12px; margin-left: 5px; color:white; float:left">    Login as Customer</a>
                                             <a href="{{route('register')}}" style="float:left; font-family: verdana; font-size:12px; margin-left: 5px; color:white; float:right">Register as Customer</a>

                                             </div>

                                              
                                                                                        
                                        </fieldset>
                                    </form>
                        </div> 
    </div>
@endsection