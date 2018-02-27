@extends('user-layouts.master')
<link href="{{asset('css/smart_wizard_vertical.css')}}" rel="stylesheet" type="text/css">


<style>
  @import url('https://fonts.googleapis.com/css?family=Lobster');
  @import url('https://fonts.googleapis.com/css?family=Anton');
  @import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
  @import url('https://fonts.googleapis.com/css?family=Archivo+Black');
  @import url('https://fonts.googleapis.com/css?family=Lato');

  #map {
        height: 40%;
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

  .box-solid:hover{
   box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3) !important;

 }

 .box-solid img:hover{
   box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3) !important;
   border-radius: 10px !important;
   border:2px solid #30BB6D !important;
 }

 #tots:hover{
  font-size: 20px !important;
}

#rev:hover{
  text-decoration: none !important;
  color:black !important;
}

 .name{
 overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}


/*Resize the wrap to see the search bar change!*/

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
                    <h1 class="title text-left" style="font-size: 80px; font-family: 'Lobster', cursive;">Express Order</h1>

                     <a href="./plannedmeals"><button id="ordermode" style="background-color:transparent;  border:2px solid white; font-size: 40px; margin-top:-20px; margin-left:10px; font-family: 'Lobster', cursive; color:white; width: 300px">Planned Meal
                     </button>
                     </a>


                </div>
        </div>


    </div>
  </div>
</div>

<div class="main main-raised"  style="width: 65%; float: left">
  <div class="section">
    <div class="container" style="width: 100%;">
      <div class="row">
       <a href="{{route('user.index')}}" class="btn-simple btn btn-succes">
          <i class="material-icons">arrow_back</i>Go back to home</a>
        <div class="col-md-12" style="margin-top:5px">
          <h1 class="text-center" style="color:white; background-color: #4caf50; margin-top: -10px"><b>Order details</b></h1>
          <label><b>NOTE:</b>&nbsp;Every cook has different delivery charge. </label>
           <form method="POST" action="{{route('order.checkout', ['mode' => $mode])}}">
          <input type="radio" name="address" value="default" checked><b>Use default address & contact number</b>
          <div class="col-md-12" style="border:1px solid #4caf50;  margin-bottom: 20px">
          @foreach($customer as $c)
          <label style="color:black"><b>Address:</b>
          <label name="userlocation" value="{{$c->location}}">{{$c->location}}</label>
          <input type="hidden" name="userlocation" value="{{$c->location}}">
          <input type="hidden" name="cLat" value="{{$c->latitude}}">
          <input type="hidden" name="cLng" value="{{$c->longitude}}"><br>
          <label style="color:black"><b>Contact Number</b></label>
          <input type="text" name="contact_no" class="form-control" value="{{$c->contact_no}}">
          <p class="small" style="color:gray">You may fill in a new contact number</p>

          @endforeach
          </div><br><br><br>
           <input type="radio" name="address" value="new"><b>New address and contact number</b>
          <div class="col-md-12" style="border:1px solid #4caf50;">
          <label style="color:black"><b>New delivery address:</b></label>
              <input type="text" id="location" name="location" class="form-control" placeholder="Enter a new location">
              <input type="hidden" id="city" name="city" />
              <input type="hidden" id="cityLat" name="cityLat" />
              <input type="hidden" id="cityLng" name="cityLng" />
              <div id="map"></div><br>
          <label style="color:black"><b>Enter your new contact number:</b></label>
          <input type="text" name="contact_num" class="form-control"  style="width:250px">
          </div>
         </div>
                      {{csrf_field()}}
                      @if(count(Cart::content()))
                      
                      @foreach(Cart::content() as $item)
                      <input type="hidden" name="dish[]" value="{{$item->id}}">
                      <input type="hidden" name="name[]" value="{{$item->name}}">
                      <input type="hidden" name="cook_id[]" value="{{$item->cook_id}}">
                      <input type="hidden" name="cookname[]" value="{{$item->cookname}}">
                      <input type="hidden" name="total[]" value="{{$item->subtotal}}">
                      <input type="hidden" name="qty[]" value="{{$item->qty}}">
                      <input type="hidden" name="sidenote[]" value="{{$item->sidenote}}">
                      <input type="hidden" name="order_date" value="{{\Carbon\Carbon::now('Asia/Manila')}}">
                      <input type="hidden" name="payment_mode" value="COD">
                      <input type="hidden" name="delivery_fee" id="del_fee" value="">
                      @endforeach

                      @foreach($dishes as $d)
                      <input type="hidden" name="cooklat[]" value="{{$d[0]->cook['latitude']}}">
                      <input type="hidden" name="cooklng[]" value="{{$d[0]->cook['longitude']}}">
                       @endforeach
                      @endif
                    
         <button type="submit" class="btn btn-flat btn-success pull-right" style="margin:10px 10px">Submit</button> 
         </form>
      </div>
    </div>
  </div>
 </div>
      <!-- End Profile Tabs -->
     </div>     
    </div>
   </div>
  </div><!--container!-->
 </div><!--section!-->
</div><!--main raised!-->
 <div class="main main-raised"  style="width: 25%; float: right;">
    <div class="section" style="padding-bottom: 2px">
        <div class="container" style="width: 100%">
                <p style="color: black; float:left; margin-top: -60px;font-size: 21px; font-family: 'Lobster', cursive;">
                <i class="material-icons" style="font-size:21px">shopping_cart</i> &nbsp;Your Cart &nbsp; 
                <span class="badge" style="font-family: verdana; background-color:#30BB6D" id="totalqty">
              {{Cart::count()}}
              </span>
              </p>
               <div class="row" style="padding-right:8px; padding-left: 8px;">
                 @if(count(Cart::content()))
                   @foreach(Cart::content() as $item) 
                   <div class="col-md-12">
                       <label style="font-size: 12px"><b>Cook:{{$item->cookname}}</b></label>
                   </div>
                   <div class="col-sm-6">
                    <label class="name" style="float: left; font-size: 15px; color:black"><b class="name">{{$item->name}}</b><br></label>
                   </div>
                   <div class="col-md-6">
                   <label  name="quantity" style="color:black; margin-right:20px"><b> x {{$item->qty}} </b></label>
                   </div>
                   <div class="col-md-12">
                   @if($item->sidenote)
                    <label style="font-size: 12px"><b>Side note:{{$item->sidenote}}</b></label>
                  @else
                    <label></label>
                  @endif
                  </div>
                   <div class="col-md-12" style="border-bottom: 1px solid #e5e5e5">
                       <label style="font-size: 12px; color: gray; float:left"> Price: <b id="price">{{$item->price}}.00</b></label>
                       <label style="font-size: 12px; color: gray; float:right">Total Amount:<b id="itemamount">Php {{$item->subtotal}}.00</b></label>
                   </div>
                   @endforeach
                     @else
                      <center>
                        <label style="font-size: 30px">Your cart is empty</label>
                      </center>
                   @endif
                 </div><br>
                  <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
                         <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lato', sans-serif" id="tots">
                         <b>Subtotal:</b>&nbsp;Php
                         <label style="color:black" id="subtotal">{{Cart::subtotal()}}</label>
                         </p>
                         <br>
                   </div>
                 @if(count(Cart::content()))
                 <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
                       <form method="post" action="{{route('express.summary')}}">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          @foreach(Cart::content() as $item)
                                          <input name="amount" value="{{Cart::subtotal()}}" type="hidden">
                                          @endforeach
                                          @if(count(Cart::content()))
                                          @foreach(Cart::content() as $item)
                                          <input type="hidden" name="dish[]" value="{{$item->id}}">
                                          <input type="hidden" name="cook_id[]" value="{{$item->cook_id}}">
                                          <input type="hidden" name="total[]" value="{{$item->subtotal}}">
                                          <input type="hidden" name="qty[]" value="{{$item->qty}}">
                                          <input type="hidden" name="order_date" value="{{\Carbon\Carbon::now('Asia/Manila')}}">
                                          <input type="hidden" name="payment_mode" value="COD">
                                          <input type="hidden" name="delivery_fee" id="del_fee1" value="">
                                          @endforeach
                                          @endif
                        
                   </div>
                @endif
            </div>
        </div>
    </div>
  </div>
       



@endsection

@section('addtl_scripts')

<script src="https://js.braintreegateway.com/web/dropin/1.8.0/js/dropin.min.js"></script>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://js.braintreegateway.com/web/dropin/1.8.0/js/dropin.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.28.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.28.0/js/paypal-checkout.min.js"></script>
<script type="text/javascript" src="{{asset('js/jquery-2.0.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('js/pace.min.js')}}"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOkRKO79rw8RrYgfrMgqIz2du240Uyz6U&libraries=places&callback=initMap"
    async defer></script>
    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {

        var latLng = new google.maps.LatLng(10.3157007,123.88544300000001 );
        var mapOptions = {
            zoom:13,
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
 $(document).ready(function(e){
   $('.service').on('change','input', function() {
   var option = $('input[name=option]:checked').val(); 
   if(option == 'pick-up') {
       $('#finish').show();
       $('#next').hide();
   }
   else {
       $('#next').show();
       $('#finish').hide();
   }
});

   $('#next').on('click', function() {
       $('#service').hide("blind");
       $('#tabpayment').show("blind");
   });
 
   $('#wizard').smartWizard({transitionEffect:'slide'});
 });

</script>
<script>
$(document).ready(function(){
 var subtotal = document.getElementById('subtotal').textContent;
 var total=parseInt(subtotal) + 40;
 var fee = 40;
 var delivery = fee.toFixed(2);
 document.getElementById('subtotal').textContent=total.toFixed(2);
 $('#del_fee').val(fee);
 $('#del_fee1').val(fee);
});
</script>
@endsection
