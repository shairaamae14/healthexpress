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
     <!--      <center><h1 class="title text-center" style="font-family: 'Lobster', cursive; font-size: 60px;">Let us all be healthy!</h1> -->

    <!-- <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class=" btn btn-danger btn-raised btn-lg" ="background-color:transparent;border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px " id="ordermode">
            <center> Express Meal</center>
            </a>
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class=" btn btn-danger btn-raised btn-lg" id="ordermode" style="background-color:transparent;  border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px ">
             <center>Planned Meal</center>
            </a> -->

        </div>

      
      </div>
    </div>
  </div>

        <div class="main main-raised"  style="width: 65%; float: left">
        <div class="section">
            <div class="container" style="width: 90%;">
      <div class="profile-content">
             <div class="card card-nav-tabs">
              <div class="content">
                <div class="tab-content text-center">
                  <div class="box-body">
             @foreach($det as $dets)
              
                 <img src="{{url('./dish_imgs/'.$dets->dish_img)}}" style="width:200px; height:200px; border:2px solid #F0F0F0; border-radius: 10px; float: left"></img></center>
                
              
        
              
                <div class="form-group col-md-8">   
                <h2 style="color:#30BB6D; float:left; margin-left:10px; margin-top:-5px;"><b> {{$dets->dish_name}} </b></h2><br>
                <h3 style="color:#30BB6D; float:left; margin-left:-240px;">{{$dets->dish_desc}}</h3>
                </div>

                <div class="form-group col-md-8" style="margin-top: 0px;">   
                         <h3 style="float:left; margin-left:10px; color:#DED6D4"><b>Php {{$dets->basePrice}}</b></h3>
                         </div>
                         <center><button type="button" class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; margin-top: 2px; border:none; font-size: 20px">Add to cart</button></center>

              </div>
              @endforeach
            </div>

                  </div>

                </div>
              </div>

            </div>
       

                </div>
              </div>
              <!-- End Profile Tabs -->              
            </div>

 </div>



 <div class="main main-raised"  style="width: 25%; float: right;">
        <div class="section" style="padding-bottom: 2px">
            <div class="container" style="width: 100%">

            <p style="color: black; float:left; margin-top: -60px;font-size: 20px; font-family: 'Lobster', cursive;"><i class="material-icons" style="font-size:20px">shopping_cart</i> &nbsp;Your Cart</p>

                <div class="row" style="padding-right:8px; padding-left: 8px">
                   <dl class="dl-horizontal">
                             <div id="cartdiv">
                       
                        
                            
                           </div>

                         
                        </dl>




        <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
         <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lobster', cursive;" id="tots"><b>Subtotal:</b> Php 56.00</p><br>
         </div>
          <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
         <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lobster', cursive;" id="tots"><b>Delivery Fee:</b> Php 40 .00</p><br></div>
          <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
       <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lobster', cursive;" id="tots"><b>Total:</b> Php 150.00</p>
     
          <button type="button" class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:left; margin-top: 2px; border:none" id="chkt">Checkout</button>
        </div>

                </div>
                </div>
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


<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

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

