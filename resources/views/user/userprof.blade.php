@extends('user-layouts.master')
<style>
@import url('https://fonts.googleapis.com/css?family=Lobster');
@import url('https://fonts.googleapis.com/css?family=Anton');
@import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
@import url('https://fonts.googleapis.com/css?family=Archivo+Black');

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
        <br>
     <!--<center><h1 class="title text-center" style="font-family: 'Lobster', cursive; font-size: 60px;">Let us all be healthy!</h1> -->
    <!-- <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class=" btn btn-danger btn-raised btn-lg" ="background-color:transparent;border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px " id="ordermode"><center> Express Meal</center> </a><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class=" btn btn-danger btn-raised btn-lg" id="ordermode" style="background-color:transparent;  border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px "><center>Planned Meal</center></a> -->
        </div>
      </div>
    </div>
  </div>

 <div class="main main-raised" style="height:800px">
   <div class="profile-content">
       <div class="container">
          <div class="row"> 
            <div class="profile" >
                <div class="avatar">
                     <center>
                   <div style="width:200px; height:200px; margin-top: -100px; background-color:#30BB6D; border-radius: 100px; border:2px white solid;">
                     <label style="font-size: 150px; color:white; float:center">{{$user->fname[0]}}</label>
                   </div>
                </div>
                <br>
                <center> <input type="file" id="img" class="btn btn-flat btn-success" name="img">
                                
                <div class="name">
                     <center><h3 class="title" style="color:#30BB6D">{{Auth::user()->fname." ".Auth::user()->lname}}</h3>
                </div>
           </div>
          </div>
               
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
    </div>

  <div class="content">
    <div class="tab-content text-center" id="who">
       <div class="tab-pane active" id="profile">
           <button type="button" class="btn btn-flat btn-primary edit" style="background-color:#30BB6D; border:none; margin-top: 1px; float:right" data-toggle="modal" data-target="#myModal{{$user->id}}">
            <i class="fa fa-edit"></i>
            </button>
            <br><br>
            <h2 style="color:black; float:left; margin-left: 12px; font-size:20px"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;General Information</b> 
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
               <a href="{{ route('user.changepass') }}" style="text-decoration:underline;" data-toggle="modal"><label style="float:left; font-size:15px; color:black"> &nbsp;Change Password</label></a>
            </li>
      </div>
    </div>
  </div>
   <div class="tab-pane" id="settings">
        <h2 style="color:black; float:left; margin-left: 12px; font-size:20px"><b>Health Information</b></h2>
        <button type="button" class="btn btn-flat btn-primary edit" style="background-color:#30BB6D; border:none; float:right" data-toggle="modal" data-target="#myModal3{{$user->id}}">
        <i class="fa fa-edit"></i>
        </button>

    <div class="col-md-8 col-md-8" style="width: 100%">
        <ul class="list-group" style="width: 100%">
           <li class="list-group-item" style="height: 50px">
               <label style="float:left; font-size:15px; color:black"><b>Birthdate:</b>{{$user->birthday}}</label>
               <label style="float:left; font-size:15px; color:black"><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Age:</b>&nbsp;{{$user->age}}</label>
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

    </div>




<!-- Modal Core -->
 

<div class="modal fade" id="myModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Change</b></h4>
      </div>&nbsp;&nbsp;
        <div class="modal-body">
             <form method="post" action="{{route('profile.update', ['id'=> Auth::id()])}}" enctype="multipart/form-data">
                {{csrf_field()}} 
                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;<b>General Information</b></h4>
          <div class="col-sm-6">
            <div class="form-group label-floating has-success">
                <label class="control-label">Last Name</label>
                <input type="text" class="form-control" name="lname" value="{{$user->lname}}" />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group label-floating has-success">
                <label class="control-label">First Name</label>
                <input type="text" class="form-control" name="fname" value="{{$user->fname}}" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
              <label class="control-label">Location</label>
              <input type="text" class="form-control" name="location" value="{{$user->location}}" />
           </div>
         </div>
          <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;<b>Contact Information</b></h4>
         <div class="col-sm-6">
           <div class="form-group label-floating has-success">
              <label class="control-label">Contact Number</label>
              <input type="text" class="form-control" name="contact_no" value="{{$user->contact_no}}" />
           </div>
         </div>
        <div class="col-sm-6">
          <div class="form-group label-floating has-success">
              <label class="control-label">Email</label>
              <input type="text" class="form-control" name="email" value="{{$user->email}}" />
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
<!--END!-->





<!--start!-->
<div class="modal fade" id="myModal3{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Change</b></h4>
      </div>
        <div class="modal-body">   
          <form method="post" action="{{route('profile.update', ['id'=> Auth::id()])}}" enctype="multipart/form-data">
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
                       <option value="{{ $goal->hg_id }}" {{ $selectedGoal == $goal->hg_id ? 'selected="selected"' : '' }}>{{ $goal->hgoal_name}}</option>    
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
                <div class="col-sm-1">
                   <div class="form-group label-floating has-success">
                      @foreach($userhealthgoals as $goal)         
                          <input type="hidden" class="form-control" name="hgoal" value=" {{$goal->hgoal_name}}" />
                       @endforeach
                   </div>
                </div>
                <div class="col-sm-2">
                   <div class="form-group label-floating has-success">
                        @foreach($userallergens as $allergen)         
                          <input type="hidden" class="form-control" name="allergen" value=" {{$allergen->allergen_name}}" />
                         @endforeach
                   </div>
                </div>
                <div class="col-sm-1">
                  <div class="form-group label-floating has-success">
                         @foreach($userlifestyle as $lifestyle)
                           <input type="hidden" class="form-control" name="lifestyle" value="{{$lifestyle->lifestyle_name}}" />     
                         @endforeach
                  </div>
                </div>
                <div class="col-sm-2">
                   <div class="form-group label-floating has-success">
                        @foreach($usermedcons as $medcon)
                          <input type="hidden" class="form-control" name="medcon" value="{{$medcon->medcon_name}}" />     
                        @endforeach
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

<!--START!-->
<div class="modal fade" id="myModal4{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Add</b></h4>
      </div>
          <form method="post" action="{{route('allergen.add', ['id'=>Auth::user()->id])}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-body">   
               <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;
               <b>Add Allergens</b>
               </h4>
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
                <label class="control-label">Tolerance Level | Allergens</label>
                   @if ($allergies)
                   @foreach($allergies as $aller)
                   <select name="tolerance[]" class="tol" id="tol">
                          <option value="Low">Low</option>
                          <option value="Medium">Medium</option>
                          <option value="High">High</option>
                    </select>
                       <input type="checkbox" class="allergies" name="allergen[]" value="{{$aller->allergen_id}}">
                       {{ $aller->allergen_name}}<br> 
                       
                  @endforeach
                  @endif    
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

<div class="modal fade" id="myModal5{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Add</b></h4>
      </div>
      <form method="post" action="{{route('medcon.add', ['id'=>Auth::user()->id])}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-body">   
                   <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;
                     <b>Add Medical Condition</b>
                    </h4>
                     <div class="col-sm-12">
                      <div class="form-group label-floating has-success">
                          <label class="control-label">Medical Condition</label>
                         
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



<!-- Modal Core -->
 

<div class="modal fade" id="myModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Change</b></h4>
      </div>&nbsp;&nbsp;
        <div class="modal-body">
             <form method="post" action="{{route('profile.update', ['id'=> Auth::id()])}}" enctype="multipart/form-data">
                {{csrf_field()}} 
                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;<b>General Information</b></h4>
          <div class="col-sm-6">
            <div class="form-group label-floating has-success">
                <label class="control-label">Last Name</label>
                <input type="text" class="form-control" name="lname" value="{{$user->lname}}" />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group label-floating has-success">
                <label class="control-label">First Name</label>
                <input type="text" class="form-control" name="fname" value="{{$user->fname}}" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
              <label class="control-label">Location</label>
              <input type="text" class="form-control" name="location" value="{{$user->location}}" />
           </div>
         </div>
          <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;<b>Contact Information</b></h4>
         <div class="col-sm-6">
           <div class="form-group label-floating has-success">
              <label class="control-label">Contact Number</label>
              <input type="text" class="form-control" name="contact_no" value="{{$user->contact_no}}" />
           </div>
         </div>
        <div class="col-sm-6">
          <div class="form-group label-floating has-success">
              <label class="control-label">Email</label>
              <input type="text" class="form-control" name="email" value="{{$user->email}}" />
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
<!--END!-->





<!--start!-->
<div class="modal fade" id="myModal3{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Change</b></h4>
      </div>
        <div class="modal-body">   
          <form method="post" action="{{route('profile.update', ['id'=> Auth::id()])}}" enctype="multipart/form-data">
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
                <div class="col-sm-1">
                   <div class="form-group label-floating has-success">
                      @foreach($userhealthgoals as $goal)         
                          <input type="hidden" class="form-control" name="hgoal" value=" {{$goal->hgoal_name}}" />
                       @endforeach
                   </div>
                </div>
                <div class="col-sm-2">
                   <div class="form-group label-floating has-success">
                        @foreach($userallergens as $allergen)         
                          <input type="hidden" class="form-control" name="allergen" value=" {{$allergen->allergen_name}}" />
                         @endforeach
                   </div>
                </div>
                <div class="col-sm-1">
                  <div class="form-group label-floating has-success">
                         @foreach($userlifestyle as $lifestyle)
                           <input type="hidden" class="form-control" name="lifestyle" value="{{$lifestyle->lifestyle_name}}" />     
                         @endforeach
                  </div>
                </div>
                <div class="col-sm-2">
                   <div class="form-group label-floating has-success">
                        @foreach($usermedcons as $medcon)
                          <input type="hidden" class="form-control" name="medcon" value="{{$medcon->medcon_name}}" />     
                        @endforeach
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
        <form method="post" action="{{ route('user.changepass') }}" enctype="multipart/form-data">
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




<!--START!-->
<div class="modal fade" id="myModal4{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i><b>Add Allergens</b></h4>
      </div>
          <form method="post" action="{{route('allergen.add', ['id'=>Auth::user()->id])}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-body">   
          <div class="col-sm-12">
            <div class="form-group label-floating has-success">
                <label class="control-label">Tolerance Level | Allergens</label>
                 
                   @foreach($allergies as $aller)
                
                   <select multiple name="tolerance[]" class="tol" id="tol" style="width:20%" disabled>
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
                <label class="control-label">Tolerance Level | Allergens</label>
                  
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
<script>
$(document).ready(function(){
    // $('.tol').attr('disabled', 'disabled');

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

      // function checkoldpass(){
      //   var pass = $("#oldpass").val();
      //     $.ajax({
      //               method: 'POST',
      //               url: "{{ url('/user/changepass') }}" ,
      //               dataType: 'json',
      //               headers: {'X_CSRF_TOKEN': '{{csrf_token()}}'},
      //               data: {'pass':pass},
      //               success: function(json) {
      //                   console.log('success');
      //               },
      //               error: function(xhr,error){
      //                   console.log(xhr);
      //               }
      //     });
      // }

      function checkpass(password){
        var oldpass = document.getElementById('oldpass').value;
        if(password!=oldpass){
                $('#checkpass').html('Password incorrect!').css('color', 'red');
              }
              else{
                $('#checkpass').html('Password correct!').css('color', 'green');
              }
      }


      // function checkpass(password){
      //   var oldpass = $('#oldpass').val();
      //   $.ajax({
      //       url: "{{ url('/user/password') }}",
      //       dataType: "json",
      //       method: 'get',
      //       data: {'password':oldpass},
      //       success:function(json){
      //         if(password!=oldpass){
      //           $('#checkpass').html('Password incorrect!').css('color', 'red');
      //         }
      //       },
      //       error:function(){
      //         console.log(xhr);
      //       }
      //   });
        
      // }





      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 10.3157007, lng: 123.88544300000001},
          zoom: 13
        });
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
          anchorPoint: new google.maps.Point(0, -29)
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOkRKO79rw8RrYgfrMgqIz2du240Uyz6U&libraries=places&callback=initMap"
        async defer></script>


@endsection

