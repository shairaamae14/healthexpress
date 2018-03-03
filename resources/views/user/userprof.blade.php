@extends('user-layouts.master')
@section('heading')
   <script src="{{asset('customer/assets/js/jquery.min.js')}}" type="text/javascript"></script>
   <script src="{{asset('js/jquery-2.0.0.min.js')}}" type="text/javascript"></script>
 <script src="{{asset('js/userform-validation.js')}}" type="text/javascript"></script>
 <script src="{{asset('js/jquery.validate.min.js')}}" type="text/javascript"></script>
 @endsection
<style>
@import url('https://fonts.googleapis.com/css?family=Lobster');
@import url('https://fonts.googleapis.com/css?family=Anton');
@import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
@import url('https://fonts.googleapis.com/css?family=Archivo+Black');

.map{
  height:20%;
}

.validations{
  font-size: 12px;
   color:#30BB6D;
}
#addaller_form label.error {
color:#D83131;
font-size:10px;

}
#addaller_form input.error {
border:1px solid #D83131;
}
#gen_form label.error {
color:#D83131;
font-size:10px;

}
#gen_form input.error {
border:1px solid #D83131;
}

#health_form label.error {
color:#D83131;
font-size:10px;

}
#health_form input.error {
border:1px solid #D83131;
}

#ordermode{
  padding:20px;
}
#ordermode:hover{
  background-color: white !important;
  color:#30BB6D !important;
}
#rate{
  color:orange;
}
ul,li{
text-decoration: none;
display: inline-block;

}

#cat:hover{
  color:black !important;
  text-decoration: none !important;
}

#cat{
  font-family: 'Ubuntu Condensed', sans-serif; color:#30BB6D;
  text-decoration: none;
}

#tb{
  color:white !important;
}



/*Resize the wrap to see the search bar change!*/


    #map {
        height: 40%;
        margin-bottom: 10px;
      }
</style>


@section('content')
<div class="wrapper">
  <div class="header header-filter" style="background-image: url('{{asset('img/bgindex.jpg')}}')">
    <div class="container">
      <div class="row">
           <center>
          <div class="col-md-6">
        </div>
      </div>
      <br><br><br>
    </div>
  </div>

 <div class="main main-raised">
   <div class="profile-content">
       <div class="container">
          <div class="row"> 
            <div class="profile" >
              @if($user->profpic)
                <div class="avatar">
                     <center>
                   <div style="width:200px; height:200px; margin-top: -100px; background-color:#30BB6D; border-radius: 100px; border:2px white solid;">
                      <img src="{{url('./user_imgs/'.$user->profpic)}}" class="img-circle" id="img-tag" width="200px"/>
                   </div>
                </div>
              @else
              <div class="avatar">
                     <center>
                   <div style="width:200px; height:200px; margin-top: -100px; background-color:#30BB6D; border-radius: 100px; border:2px white solid;">
                     <label style="font-size: 150px; color:white; float:center">{{Auth::user()->fname[0]}}</label>
                   </div>
                </div>
              @endif
                   <br>
                    <center><button class="btn btn-success" data-toggle="modal" data-target="#myModal9{{$user->id}}" style="background-color:#30BB6D">Upload image</button>
                   </center>
                <div class="name">
                  <center><h3 class="title" style="color:#30BB6D">{{Auth::user()->fname." ".Auth::user()->lname}}</h3></center>
                </div>
           </div><!--profile!-->
          </div><!--row!-->
          @if(session('success'))
          <div class="alert alert-success">
            <div class="container">
                <div class="alert-icon">
                    <i class="material-icons">check</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <b>Success!</b> {{session('success')}}
            </div>
        </div>
        @endif
  @if($errors->any())
  <div class="alert alert-danger">
     <div class="container-fluid">
         <div class="alert-icon">
         <i class="material-icons">error_outline</i>
         </div>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
       <b>Error Alert:</b>&nbsp; {{$errors->first()}}
    </div>
  </div>
  @endif
  <div class="card card-nav-tabs">
    <div class="header" style="background-color:#30BB6D">
       <div class="nav-tabs-navigation" style="background-color:#30BB6D">
          <div class="nav-tabs-wrapper" style="background-color:#30BB6D">
              <center>
               <ul class="nav nav-tabs" data-tabs="tabs" style="background-color:#30BB6D">
                  <li class="active">
                      <a href="#profile" data-toggle="tab" style="color:black">
                        <i class="material-icons" id="tb">face</i>
                          Personal
                       </a>
                  </li>
                   <li>
                       <a href="#settings" data-toggle="tab" style="color:gray">
                         <i class="material-icons" id="tb">favorite</i>
                          Health
                       </a>
                   </li>
                </ul>
           </div>
        </div>
    </div><!--header!-->

  <div class="content">

    <div class="tab-content text-center" id="who">
       <div class="tab-pane active" id="profile">
           <button type="button" class="btn btn-flat btn-primary edit" style="background-color:#30BB6D; border:none; margin-top: 1px; float:right" data-toggle="modal" data-target="#myModal{{$user->id}}">
            <i class="fa fa-edit"></i>
            </button>
            <br><br>
            <h2 style="color:black; float:left; margin-left: 12px; font-size:20px">
            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;General Information</b> 
            </h2>
            <br><br>
   <div class="col-md-8 col-md-8" style="width: 100%;">

      <div class="col-md-8 col-md-8" style="width: 50%; margin-left:10px; margin-top: 8px;">
          <ul class="list-group" style="width: 100%; float:left; margin-right: 10px">
              <li class="list-group-item" style="height: 50px">
                   <i class="material-icons" style="float:left">supervisor_account</i>
                   <label style="float:left; font-size:15px; color:black">
                   <b>&nbsp; Last Name:</b>
                    &nbsp;{{$user->lname}}
                   </label>
                   <label style="float:left; font-size:15px; color:black">
                   <b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; First Name:</b>
                   &nbsp;{{$user->fname}}
                   </label>
              </li>
              <li class="list-group-item" style="height: 50px">
                   <i class="material-icons" style="float:left">home</i>
                   <label style="float:left; font-size:12px; color:black">
                    <b style="font-size: 15px">&nbsp;Address:</b>
                    &nbsp;{{$user->location}}
                   </label>
              </li> 
          </ul>
      </div>

   <div class="col-md-8 col-md-8" style="width: 50%; float:right; margin-top: -180px;">
      <h2 style="color:black; float:left; margin-left: 12px; font-size:20px;">
      <b>Contact Information</b>
      </h2>
      <br><br>
        <ul class="list-group" style="width: 100%; float:right">
            <li class="list-group-item" style="height: 50px">
                 <i class="material-icons" style="float:left">phone</i>
                 <label style="float:left; font-size:15px; color:black"><b>&nbsp; Contact Number:</b>&nbsp;{{$user->contact_no}}</label>
             </li>
             <li class="list-group-item" style="height: 50px">
                 <i class="material-icons" style="float:left">email</i>
                 <label style="float:left; font-size:15px; color:black"><b>&nbsp; Email:</b>&nbsp;{{$user->email}}</label>
            </li>
        </ul>
   </div>
   <br><br><br>

   <div class="col-md-8 col-md-8" style="width: 100%; float:right; margin-top: -15px">
      <h2 style="color:black; float:left; margin-left: 12px; font-size:20px"><b>Account Details</b></h2>
        <ul class="list-group" style="width: 99%">
           <li class="list-group-item" style="height: 50px">
               <i class="material-icons" style="float:left">security</i>
               <a href="{{ route('user.changepass') }}" style="text-decoration:underline;" data-toggle="modal"><label style="float:left; font-size:15px; color:black"> &nbsp;Change Password&nbsp;<i class="fa fa-edit"></i></label></a>
            </li>
      </div>

    </div>
  </div> <!--tab pane active!-->

   <div class="tab-pane" id="settings">
        <h2 style="color:black; float:left; margin-left: 12px; font-size:20px"><b>Health Information</b></h2>
        <button type="button" class="btn btn-flat btn-primary edit" style="background-color:#30BB6D; border:none; float:right" data-toggle="modal" data-target="#myModal3{{$user->id}}">
        <i class="fa fa-edit"></i>
        </button>

    <div class="col-md-8 col-md-8" style="width: 100%">
        <ul class="list-group" style="width: 100%">
           <li class="list-group-item" style="height: 50px">
               <label style="float:left; font-size:15px; color:black"><b>Birthdate:</b>{{$user->birthday}}</label>
               <label style="float:left; font-size:15px; color:black"><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Age:</b>&nbsp;{{$user->age()}}</label>
           </li>
           <li class="list-group-item" style="height: 50px">
                <label style="float:left; font-size:15px; color:black">
                <b>Gender:</b>
                {{$user->gender}}</label>
                <label style="float:left; font-size:15px; color:black">
                <b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Weight:</b>
                {{$user->weight}}
                </label>
                <label style="float:left; font-size:15px; color:black">
                <b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Height:</b>
                 &nbsp;{{$user->height}}
                 </label>
            </li>
            <li class="list-group-item" style="height: 50px">
                 <label style="float:left; font-size:15px; color:black">
                  <b>Health Goal:</b>&nbsp;
                  @foreach($userhealthgoals as $goal)
                  {{$goal->hgoal_name}}
                  @endforeach
                 </label>
             </li>
             <li class="list-group-item" style="height: 50px">
                   <label style="float:left; font-size:15px; color:black">
                   <b>Lifestyle:</b>&nbsp;
                   @foreach($userlifestyle as $lifestyle)
                        {{$lifestyle->lifestyle_name}}
                   @endforeach
                   </label> 
             </li>
             <li class="list-group-item" style="height: 50px">
                    <label style="float:left; font-size:15px; color:black">
                    <b>Allergens:</b>&nbsp;
                    @if(count($userallergens))
                    @foreach($userallergens as $allergens)
                      <ul style="display: inline-block; margin-left:-30px">
                        <li style="text-decoration: none;">
                         {{$allergens->allergen_name}} <b>({{$allergens->tolerance_level}})</b>
                        </li>
                      </ul>
                    @endforeach 
                    @else
                    <ul style="display: inline-block; margin-left:-30px">
                        <li style="text-decoration: none;">
                        <b>None</b>
                        </li>
                      </ul>
                        @endif
                    </label>  
                 <!--    <label style="float:left; font-size:15px; color:black">
                    <b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tolerance Level:</b> &nbsp;
                    @foreach($userallergens as $allergens)
                      <ul style="display: inline-block; margin-left:-30px">
                        <li style="text-decoration: none">
                          {{$allergens->tolerance_level}}
                        </li>
                      </ul>
                    @endforeach
                    </label>  -->
                    <button type="button"  style="background-color:white; color:#30BB6D; border:none; float:right; height:30px; font-size: 25px" data-toggle="modal" data-target="#myModal4{{$user->id}}">
                    <i class="fa fa-plus"></i>
                    </button>
                     <button type="button"  style="background-color:white; color:#30BB6D; border:none; float:right; height:30px; font-size: 25px" data-toggle="modal" data-target="#myModal6{{$user->id}}">
                   <i class="fa fa-edit"></i>
                    </button>
                    <button type="button"  style="background-color:white; color:#30BB6D; border:none; float:right; height:30px; font-size: 25px" data-toggle="modal" data-target="#myModal7{{$user->id}}">
                     <i class="fa fa-times"></i>
                    </button>
             </li>
             <li class="list-group-item" style="height: 50px">
                 <label style="float:left; font-size:15px; color:black">
                 <b>Medical Condition:</b>&nbsp;
                 @if(count($usermedcons))
                 @foreach($usermedcons as $medcon)
                   <label style="color:black">
                    {{$medcon->medcon_name}}&nbsp;
                   </label>
                 @endforeach
                 @else
                 <label style="color:black">
                 <b>None</b>
                   </label>
                   @endif

                 </label> 
                 <button type="button"  style="background-color:white; color:#30BB6D; border:none; float:right; height:30px; font-size: 25px" data-toggle="modal" data-target="#myModal5{{$user->id}}">
                 <i class="fa fa-plus"></i>
                  </button>
                   <button type="button"  style="background-color:white; color:#30BB6D; border:none; float:right; height:30px; font-size: 25px" data-toggle="modal" data-target="#myModal8{{$user->id}}">
                 <i class="fa fa-times"></i>
                  </button>
             </li>
        </ul>
   </div>
   </div> <!--TAB PANE!-->

   </div><!--WHO ID!-->
   </div><!--after who!-->
       

                  </div>
              </div>
          </div>
    </div>
</div><!--wrapper!-->

<!-- Modal Core -->
<!--general information!-->
<div class="modal fade mdl" id="myModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Change</b></h4>
      </div>&nbsp;&nbsp;
        <div class="modal-body">
             <form method="post" action="{{route('profile.update', ['id'=> Auth::id()])}}" enctype="multipart/form-data" id="gen_form">
                {{csrf_field()}} 
                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;<b>General Information</b></h4>

          <div class="col-sm-6">
            <div class="form-group label-floating has-success">
                <label class="control-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" value="{{$user->lname}}" />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group label-floating has-success">
                <label class="control-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="{{$user->fname}}" />
            </div>
          </div>
          <div class="col-sm-12">
           <h4 class="modal-title" id="myModalLabel"><b>Contact Information</b></h4>
            <div class="form-group label-floating has-success">
              <label class="control-label">Location</label>
               <input type="text" class="form-control" name="location" id="location" value="{{$user->location}}" />
               <input type="hidden" id="city" name="city" />
               <input type="hidden" id="cityLat" name="cityLat" value="{[$user->latitude}}" />
               <input type="hidden" id="cityLng" name="cityLng" value="{{$user->longitude}}" />
               <div class="map" id="map"></div>
           </div>
         </div><br>
         <div class="col-sm-6">
           <div class="form-group label-floating has-success">
              <label class="control-label">Contact Number</label>
              <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{$user->contact_no}}" />
           
           </div>
         </div>
        <div class="col-sm-6">
          <div class="form-group label-floating has-success">
              <label class="control-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" />
            
          </div>
        </div>
         <!--HIDDEN!-->
         <div class="col-sm-1">
            <div class="form-group label-floating has-success">
                <input type="hidden" class="form-control" name="long" value="{{$user->longitude}}" />
            </div>
          </div>
          <div class="col-sm-1">
             <div class="form-group label-floating has-success">
              <input type="hidden" class="form-control" name="lat" value="{{$user->latitude}}" />
             </div>
          </div>
          <div class="col-sm-1">
             <div class="form-group label-floating has-success">
                <input type="hidden" class="form-control" name="weight" value="{{$user->weight}}" />
              </div>
           </div>
          <div class="col-sm-1">
             <div class="form-group label-floating has-success">
               <input type="hidden" class="form-control" name="height" value="{{$user->height}}" />
             </div>
          </div>
          <div class="col-sm-1">
             <div class="form-group label-floating has-success">
              <input type="hidden" class="form-control" name="birthday" value="{{$user->birthday}}" />
             </div>
          </div>
          <div class="col-sm-1">
             <div class="form-group label-floating has-success">
              <input type="hidden" class="form-control" name="gender" value="{{$user->gender}}" />
            </div>
          </div>
          <div class="col-sm-1">
             <div class="form-group label-floating has-success">
                @foreach($userhealthgoals as $goal)         
                   <input type="hidden" class="form-control" name="hgoal" value=" {{$goal->hg_id}}" />
                @endforeach
              </div>
           </div>
           <div class="col-sm-1">
              <div class="form-group label-floating has-success">
                    @foreach($userlifestyle as $lifestyle)
                  <input type="hidden" class="form-control" name="lifestyle" value="{{$lifestyle->lifestyle_id}}" />     
                          @endforeach
              </div>
          </div>
          <br>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info btn-simple" style="color:#30BB6D">Change</button>
          </div>
        </form>
      </div><!--MODAL BODY!-->
    </div>
  </div>
</div>
<!--end!-->
<!--health information!-->
<div class="modal fade" id="myModal3{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Change</b></h4>
      </div>
        <div class="modal-body">   
          <form method="post" action="{{route('profile.update', ['id'=> Auth::id()])}}" enctype="multipart/form-data" id="health_form">
          {{csrf_field()}} 
          <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;<b>Health Information</b></h4>      
            <div class="col-sm-6">
               <div class="form-group label-floating has-success">
                   <label class="control-label">Birthday</label>
                    <input type="date" class="form-control" name="birthday" value="{{$user->birthday}}" />
                 </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group label-floating has-success">
                    <label class="control-label">Weight(kg)</label>
                    <input type="text" class="form-control" name="weight" value="{{$user->weight}}" />
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group label-floating has-success">
                      <label class="control-label">Height(cm)</label>
                      <input type="text" class="form-control" name="height" value="{{$user->height}}" />
                </div>
             </div>
             <div class="col-sm-6">
                <div class="form-group label-floating has-success">
                      <label class="control-label">Health Goal</label>            
                      <select name="hgoal" class="form-control" style="margin-top:2px">   
                      @if($healthgoals->count())
                      @foreach($healthgoals as $goal)
                       <option value="{{$goal->hg_id }}" {{ $selectedGoal == $goal->hg_id ? 'selected="selected"' : '' }}>{{ $goal->hgoal_name}}</option>    
                      @endforeach
                      @endif          
                        </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group label-floating has-success">
                      <label class="control-label">Lifestyle</label>
                      <select name="lifestyle" class="form-control" style="margin-top:2px">
                       @if($lifestyles->count())
                       @foreach($lifestyles as $lstyle)
                                <option value="{{ $lstyle->lifestyle_id }}" {{ $selectedLifestyle == $lstyle->lifestyle_id ? 'selected="selected"' : '' }}>{{ $lstyle->lifestyle_name}}</option>    
                       @endforeach
                       @endif          
                       </select>      
                </div>
              </div>
              <!--HIDDEN!-->
              <div class="col-sm-1">
                <div class="form-group label-floating has-success">
                      <input type="hidden" class="form-control" name="lname" value="{{$user->lname}}" />
                </div>
              </div>
              <div class="col-sm-1">
                <div class="form-group label-floating has-success">
                        <input type="hidden" class="form-control" name="fname" value="{{$user->fname}}" />
                </div>
              </div>
              <div class="col-sm-1">
                <div class="form-group label-floating has-success">
                        <input type="hidden" class="form-control" name="location" value="{{$user->location}}" />
                </div>
              </div>
              <div class="col-sm-1">
                <div class="form-group label-floating has-success">
                          <input type="hidden" class="form-control" name="contact_no" value="{{$user->contact_no}}" />
                </div>
              </div>
              <div class="col-sm-1">
                <div class="form-group label-floating has-success">
                            <input type="hidden" class="form-control" name="long" value="{{$user->longitude}}" />
                </div>
              </div>
              <div class="col-sm-1">
                 <div class="form-group label-floating has-success">
                            <input type="hidden" class="form-control" name="lat" value="{{$user->latitude}}" />
                  </div>
               </div>
               <div class="col-sm-1">
                  <div class="form-group label-floating has-success">
                              <input type="hidden" class="form-control" name="gender" value="{{$user->gender}}" />
                  </div>
               </div>
               <div class="col-sm-1">
                  <div class="form-group label-floating has-success">
                          <input type="hidden" class="form-control" name="email" value="{{$user->email}}" />
                   </div>
                </div>
               
                </div>
            <!--HIDDEN!-->
               <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-info btn-simple" style="color:#30BB6D">Change</button>
              </div>
          </form>
        </div><!--MODAL BODY!-->
    </div>   
  </div>
</div>
 <!--end!-->
<!-- password modal -->
<div class="modal fade" id="modalpass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="{{url('/change/password')}}" enctype="multipart/form-data">
        {{csrf_field()}} 
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
              <label class="control-label">Current Password</label>
              <input type="password" class="form-control" name="oldpass" id="oldpass" required/>
            </div>
            <p type="hidden" id="checkpass"></p>
            <p type="hidden" id="pass" value="{{Auth::user()->password}}"></p>
          </div>
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
              <label class="control-label">New Password</label>
              <input type="password" class="form-control" name="newpass" id="newpass" required/>
            </div>
            <p type="hidden" id="minpass"></p>
          </div>
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
              <label class="control-label">Confirm Password</label>
              <input type="password" class="form-control" name="confirmpass" id="confirmpass" required />
            </div>
            <p type="hidden" id="checkmatch"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info btn-simple" style="color:#30BB6D">Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--Add allergen!-->
<div class="modal fade" id="myModal4{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i><b>Add Allergens</b></h4>
      </div>
          <form method="post" action="{{route('allergen.add', ['id'=>Auth::user()->id])}}" id="addaller_form">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-body">   
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
                <label class="control-label">Tolerance Level | Allergens</label>
                 
                   @foreach($allergies as $aller)
                
                   <select name="tolerance[]" class="tol" id="tol" style="width:20%" disabled>
                          <option value="Low">Low</option>
                          <option value="Medium">Medium</option>
                          <option value="High">High</option>
                    </select>
           
                          <input type="checkbox" class="allergies" id="allergies" name="allergen[]" value="{{$aller->allergen_id}}">
                          {{ $aller->allergen_name}}<br>
                        
                  @endforeach
                
                    
             </div>
          </div> 
          </div> <!--MODAL BODY!-->
          <div class="modal-footer">
              <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-info btn-simple" style="color:#30BB6D">Add</button>
         </div>
     </form>
    </div>   
  </div>
</div>
<!--end!-->
<!--Add medical condition!-->
<div class="modal fade" id="myModal5{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Add Medical Condition</b></h4>
      </div>
      <form method="post" action="{{route('medcon.add', ['id'=>Auth::user()->id])}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-body">   
                     <div class="col-sm-12">
                      <div class="form-group label-floating has-success">
                         
                                @if ($medcons->count())

                                @foreach($medcons as $med)
                                <input type="checkbox" name="medcon[]" value="{{$med->medcon_id}}">
                                {{ $med->medcon_name}}<br> 
                             @endforeach
                                  @endif
                                     
                                     </div>
                    </div> 
               </div>

 <!--end!-->
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-info btn-simple" style="color:#30BB6D">Add</button>
      </div>
     </form>
    </div>   
  </div>
</div>
<!--Edit allergen!-->
 @foreach($userallergens as $aller)
<div class="modal fade" id="myModal6{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>Edit Allergen</b></h4>
      </div>

     <form method="post" action="{{route('allergies.update', ['id'=>Auth::user()->id])}}" enctype="multipart/form-data">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-body">   
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
                <label class="control-label">Tolerance Level | Allergens</label>
                  
                   @foreach($userallergens as $aller)
                   <br>
                    <input type="hidden" name="ua_id[]" value="{{$aller->ua_id}}">
                     
                    <select name="tolerance[]" class="tol2" id="tol_{{$aller->allergen_id}}" style="width:20%">
                      @if($aller->tolerance_level == 'Low')
                          <option value="Low" selected>Low</option>
                          <option value="Medium">Medium</option>
                          <option value="High">High</option>
                      @elseif($aller->tolerance_level == 'Medium')
                          <option value="Low">Low</option>
                          <option value="Medium" selected>Medium</option>
                          <option value="High">High</option>
                      @else
                          <option value="Low">Low</option>
                          <option value="Medium">Medium</option>
                          <option value="High" selected>High</option>
                      @endif
                    </select>&nbsp; 
                   <input type="checkbox" class="allergies" id="allergies" name="allergen[]" value="{{$aller->allergen_id}}">
                   {{ $aller->allergen_name}}
              @endforeach
                <div id="list">

                </div>
                    
             </div>
          </div> 
          </div> <!--MODAL BODY!-->
          <div class="modal-footer">
              <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-info btn-simple" style="color:#30BB6D">Update</button>
         </div>
     </form>
    </div>   
  </div>
</div>
<!--end!-->
@endforeach
<!--Delete allergen!-->
<div class="modal fade" id="myModal7{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>Delete Allergens</b></h4>
      </div>
          <form method="post" action="{{route('aller.destroy')}}">    
             {{csrf_field()}}
          <div class="modal-body">   
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
                <label class="control-label">Tolerance Level | Allergens</label>
                  
                   @foreach($userallergens as $aller)
                         <input type="hidden" name="ua_id" value="{{$aller->ua_id}}">
                         <input type="checkbox" class="allergies" name="allergen[]" value="{{$aller->ua_id}}">
                          {{ $aller->allergen_name}}</label>
                           <label>Tolerance Level:<b>{{$aller->tolerance_level}}</b></label><br>
                       
                  @endforeach
                
                    
             </div>
          </div> 
          </div> <!--MODAL BODY!-->
          <div class="modal-footer">
              <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-info btn-simple" style="color:#30BB6D">Delete</button>
         </div>
     </form>
    </div>   
  </div>
</div>
<!--end!-->
<!--Delete Medical Condition!-->
<div class="modal fade" id="myModal8{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>Delete Medical Condition</b></h4>
      </div>
          <form method="post" action="{{route('aller.destroyM')}}">    
             {{csrf_field()}}
          <div class="modal-body">   
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
                <label class="control-label">Medical Condition</label>
                  
                   @foreach($usermedcons as $m)
                         <input type="hidden" name="m_id" value="{{$m->medcon_id}}">
                         <br><input type="checkbox" class="allergies" name="medcon[]" value="{{$m->umedconID}}">
                          {{ $m->medcon_name}}</label>
                         
                  @endforeach
                
                    
             </div>
          </div> 
          </div> <!--MODAL BODY!-->
          <div class="modal-footer">
              <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-info btn-simple" style="color:#30BB6D">Delete</button>
         </div>
     </form>
    </div>   
  </div>
</div>
<!--end!-->
<!--Upload Image!-->
<!--Upload Image!-->
<div class="modal fade" id="myModal9{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><b>Upload Image</b></h4>
      </div>
        <form method="post" action="{{route('user.img', ['id'=>Auth::user()->id])}}" enctype="multipart/form-data">    
           {{csrf_field()}}
        <div class="modal-body">  
        <center>
        @if(!$user->profpic)
          <input type="file" class="dropify" data-height="160" data-allowed-file-extensions="jpg jpeg png svg"/ name="img" id="img">
       @else
       <input type="file" class="dropify" data-height="160" data-default-file="{{asset('user_imgs/'.$user->profpic)}}" data-allowed-file-extensions="jpg jpeg png svg" name="img">
       @endif
        </div> <!--MODAL BODY!-->
        <div class="modal-footer">
              <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-info btn-simple" style="color:#30BB6D">Save</button>
         </div>
         </form>
    </div>   
  </div>
</div>
<!--end!-->
<!--end!-->

@endsection
@section('addtl_scripts')

<!--   Core JS Files   -->
  
  <!-- <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js" type="text/javascript"></script> -->
  <script src="{{asset('customer/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('customer/assets/js/material.min.js')}}"></script>

<!--jquery validation!-->
 <script src="{{asset('js/form-validation.js')}}" type="text/javascript"></script>
 <script src="{{asset('js/jquery.validate.min.js')}}" type="text/javascript"></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('customer/assets/js/nouislider.min.js')}}" type="text/javascript"></script>

  <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
  <script src="{{asset('customer/assets/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>

  <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
  <script src="{{asset('customer/assets/js/material-kit.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/dropify.min.js')}}"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOkRKO79rw8RrYgfrMgqIz2du240Uyz6U&libraries=places&callback=initMap"
    async defer></script>
    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        // lat=document.getElementById('cityLat').value;
        // lng=document.getElementById('cityLng').value;
        // alert(lng);
        var latLng = new google.maps.LatLng(10.3157007,123.88544300000001);
        var mapOptions = {
            zoom:12,
            center: latLng
        }
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var card = document.getElementById('pac-card');
        var input = document.getElementById('location');    
        var options = {
                        componentRestrictions: {country: 'ph'}
                      };
        // var types = document.getElementById('type-selector');
        // var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input, options);
        
        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: latLng,
          anchorPoint: new google.maps.Point(0, -29)
        });
       
         geocoder = new google.maps.Geocoder();
         
         google.maps.event.addListener(marker, 'dragend', function() {
              geocoder.geocode({latLng: marker.getPosition()}, function(responses) {
            if (responses && responses.length > 0) {
                infowindow.setContent(
                "<div class='place'>" + responses[0].formatted_address 
                + "<br /> <small>" 
                + "Latitude: " + marker.getPosition().lat() + "<br>" 
                + "Longitude: " + marker.getPosition().lng() + "</small></div>"
                );
                infowindow.open(map, marker);
            } else {
                alert('Error: Google Maps could not determine the address of this location.');
            }
            });
                map.panTo(marker.getPosition());
          });
          google.maps.event.addListener(marker, 'dragstart', function() {
            infowindow.close(map, marker);
        });
          
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          document.getElementById('city').value = place.name;
          document.getElementById('cityLat').value = place.geometry.location.lat();
          document.getElementById('cityLng').value = place.geometry.location.lng();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
          
         

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // document.getElementById('use-strict-bounds')
        //     .addEventListener('click', function() {
        //       console.log('Checkbox clicked! New state=' + this.checked);
        //       autocomplete.setOptions({strictBounds: this.checked});
        //     });
      }
    </script>
     <script>
    $('.mdl').on('shown.bs.modal', function () {
        // lat=document.getElementById('cityLat').value;
        // lng=document.getElementById('cityLng').value;
    google.maps.event.trigger(map, "resize");
    // map.setCenter(lat, lng);
     });
    </script>

    
    <script>
        $(document).ready(function() {
              var dropify = $('.dropify').dropify({
        messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happened.'
    }
       });
  
            $('.datepicker').datepicker({
                weekStart:1
            });
            
            $('.allergens').on('click',':checkbox', function() {
                $(this).each(function() {
                    if($("input:checked").length > 0) {
                        $('#tolerance').show();
                    }
                    else if($(this).prop("checked") == false) {
                        $('#tolerance').hide();
                    } 

                });
            });
//            $('#medcon').on('click',':checkbox', function() {
//                $(this).each(function() {
//                    if($("input:checked").length <= 0) {
//                        var empty ="<input type='hidden' value='' name='med_condition'>";
//                        $('.medcon').append(empty);
//                    }
//                    else if($(this).prop("checked") == false) {
//                        var empty ="<input type='hidden' value='' name='med_condition'>";
//                        $('.medcon').append(empty);
//                    } 
//                  
//                });    
//                
//                    
//
//            });
           
    });
    </script>
 <!--  <script type="text/javascript">
  $(document).ready(function(){
    //Change image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#img").change(function(){
        readURL(this);
    });
  });

</script> -->
<script>
$(document).ready(function(){
    $('.tol').attr('disabled', 'disabled');

    var $checkBox = $('.allergies');

    $checkBox.on('change',function(e){
        if ($(this).is(':checked')){
            $("#tol_" + $(this).attr("value")).removeAttr('disabled');
           
        }else{
           $("#tol_" + $(this).attr("value")).attr('disabled','disabled');
        }
    });
});
</script>

<script>
$(document).ready(function(){
$('.tol').attr('disabled', 'disabled');
});

function check(){
  var checkboxes = document.getElementsByName("allergies");
  var checkboxesChecked = [];
  // loop over them all
  for (var i=0; i<checkboxes.length; i++) {
     // And stick the checked ones onto an array...
     if (checkboxes[i].checked) {
       var div = document.getElementById('list');
       div.innerHTML+=
                    ''; 
     }
  }
}

$(document).ready(function(){

  var $checkBox = $('.allergies');
     

$checkBox.on('change',function(e){
    var $select = $(this).prev();
    if ($(this).is(':checked')){
        $select.removeAttr('disabled');
    }else{
       $select.attr('disabled','disabled');
    }
});

});

</script>

<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      $(document).ready(function(){

          $('#confirmpass').on('keyup', function(){
            var newpass = $("#newpass").val();
            var confirm = $("#confirmpass").val();
              if (newpass != confirm)
                $("#checkmatch").html("Passwords do not match!").css('color', 'red');
              else
                $("#checkmatch").html("Passwords match!").css('color', 'green');
          });

          $('#oldpass').on('keyup', function(){
            var oldpass = $('#oldpass').val();
            var pass = $('#pass').val();
              if(pass==oldpass){
                $('#checkpass').html('Password correct!').css('color', 'green');
              }
              else if(pass!=oldpass){
                $('#checkpass').html('Password incorrect!').css('color', 'red');
              }
          });

          

      });

      function checkpass(password){
        var oldpass = document.getElementById('oldpass').value;
        if(password!=oldpass){
                $('#checkpass').html('Password incorrect!').css('color', 'red');
              }
              else{
                $('#checkpass').html('Password correct!').css('color', 'green');
              }
      }

</script>

@endsection

