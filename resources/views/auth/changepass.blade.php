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
                     <label style="font-size: 150px; color:white; float:center">{{Auth::user()->fname[0]}}</label>
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
    <form class="form-horizontal" method="POST" action="{{ url('/change/password') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('passwordold') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label" style="color:#30bb6d">Old Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="passwordold" style="background-image: linear-gradient(#30bb6d, #30bb6d), linear-gradient(#D2D2D2, #D2D2D2);" required>

                                @if ($errors->has('passwordold'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passwordold') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label" style="color:#30bb6d">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="passwordnew" style="background-image: linear-gradient(#30bb6d, #30bb6d), linear-gradient(#D2D2D2, #D2D2D2);" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label" style="color:#30bb6d">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" style="background-image: linear-gradient(#30bb6d, #30bb6d), linear-gradient(#D2D2D2, #D2D2D2);" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"  style="background-color:#30bb6d">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>

  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/alertifyjs/1.9.0/alertify.min.js"></script>

<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/alertify.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/default.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/semantic.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/bootstrap.min.css"/>

@if(session('success'))
<script type="text/javascript">
    $(document).ready(function(){
        alertify.success("{{session('success')}}");
    });
</script>
@endif

@if(session('error'))
<script type="text/javascript">
    $(document).ready(function(){
        alertify.error("{{session('error')}}");
    });
</script>
@endif



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










