@extends('wiz-layouts.master')
<style>
    #map {
        height: 40%;
        margin-bottom: 10px;
      }
</style>

@section('content')
 <div class="top-content" style="margin-top:50px;">
            <div class="container">
    
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
                        <form role="form" method="POST" action="{{ route('cook.register.submit') }}" class="f1">
                                  {{ csrf_field() }}

                            <h3>Register</h3>
                            <p>Be one of our cooks!</p>
                            <br>
                           <h1 style="border:2px solid #30BB6D"></h1>
                            <br>
                            <fieldset>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label class="sr-only" for="f1-first-name">First name</label>
                                    <input type="text" name="fname" value="{{ old('name') }}"" placeholder="First name..." class="f1-first-name form-control" id="f1-first-name" value="{{ old('name') }}">

                                            @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                                </div>
                                     </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  
                                    <input type="text" name="lname" placeholder="Last name..." class="f1-last-name form-control" id="f1-last-name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                </div>
                                   </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <input type="text" name="email" placeholder="Email" class="f1-last-name form-control" id="f1-last-name"  value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                                </div>


                              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="form-group">
                                   
                                    <input type="password" name="password" placeholder="Password" class="f1-last-name form-control" id="f1-last-name">

                             @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                                </div>


                                <div class="form-group">
                                    <label class="sr-only" for="lname">Email Address</label>
                                    <input type="password" type="password" name="password_confirmation" class="f1-last-name form-control" id="f1-last-name" placeholder="Confirm password">

                                </div>

                                 <div class="form-group">
                                    <label class="sr-only" for="loc">Contact no</label>
                                    <input type="text" id="contact" name="contact_no" placeholder="Contact Number" class="f1-last-name form-control">
                                  
                                </div>
                               
                                <div class="form-group">
                                    <label class="sr-only" for="loc">Location</label>
                                    <input type="text" id="location" name="location" placeholder="Location" class="f1-last-name form-control" id="f1-last-name">
                                    <input type="hidden" id="city" name="city" />
                                    <input type="hidden" id="cityLat" name="cityLat" />
                                    <input type="hidden" id="cityLng" name="cityLng" />  
                                </div>

                                <div id="map"></div>
                                
                            

                                <div class="f1-buttons">
                                    <button type="submit" class="btn btn-next" style="background-color:#30BB6D">Register</button>
                                </div>
                          

                           
                                    
                                </div>
                            </fieldset>
                        
                        </form>
                    </div>
                </div>
                    
            </div>
        </div>


@endsection


@section('addtl_scripts')
<script src="{{asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{asset('wizard/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('wizard/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('wizard/js/jquery.backstretch.min.js')}}"></script>
<script src="{{asset('wizard/js/retina-1.1.0.min.js')}}"></script>
<script src="{{asset('wizard/js/scripts.js')}}"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
         $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>

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