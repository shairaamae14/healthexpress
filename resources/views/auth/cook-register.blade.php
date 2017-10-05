@extends('wiz-layouts.reg-master')
<style>
    #map {
        height: 40%;
        margin-bottom: 10px;
      }
</style>

@section('content')
  <div class="image-container set-full-height" style="background-image: url('{{asset('img/bgsignin.jpg')}}')">
	    <!--   Big container   -->
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="card wizard-card" data-color="green" id="wizardProfile">
                            <form role="form" method="POST" action="{{ route('cook.register.submit') }}">
                                {{csrf_field()}}
                                <div class="wizard-header">
                                        <h3 class="wizard-title">
                                           Register
                                        </h3>
                                        <h5>Be one of our cooks!</h5>
                                </div>
                                <div class="wizard-navigation">
                                    <ul>
                                        <li><a href="#about" data-toggle="tab">About</a></li>
                                        <li><a href="#contact" data-toggle="tab">Contact</a></li>
                                    </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="about">
                                                <div class="row">
                                                    <h4 class="info-text"> Tell us who you are:</h4>
		                                	<div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                        <i class="material-icons">face</i>
                                                                </span>
                                                                <div class="form-group has-success">
                                                                    <label class="control-label">First Name <small>(required)</small></label>
                                                                    <input name="fname" type="text" class="form-control" value="{{ old('name') }}">
                                                                    
                                                                    @if ($errors->has('name'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('name') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                            <i class="material-icons">record_voice_over</i>
                                                                    </span>
                                                                    <div class="form-group has-success">
                                                                      <label class="control-label">Last Name <small>(required)</small></label>
                                                                      <input name="lname" type="text" class="form-control">
                                                                    </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                        <i class="material-icons">email</i>
                                                                </span>
                                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  has-success">
                                                                    <label class="control-label">Email <small>(required)</small></label>
                                                                    <input name="email" type="email" class="form-control" value="{{ old('email') }}">
                                                                        @if ($errors->has('email'))
                                                                           <span class="help-block">
                                                                               <strong>{{ $errors->first('email') }}</strong>
                                                                           </span>
                                                                       @endif
                                                                </div>
                                                            </div>
                                                             <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                            <i class="material-icons">lock</i>
                                                                    </span>
                                                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}  has-success">
                                                                      <label class="control-label">Password <small>(required)</small></label>
                                                                      <input type="password" name="password"  class="form-control">
                                                                    </div>
                                                            </div>
                                                            <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                            <i class="material-icons">lock_outline</i>
                                                                    </span>
                                                                    <div class="form-group has-success">
                                                                      <label class="control-label">Confirm Password</label>
                                                                      <input type="password" name="password_confirmation" class="form-control">
                                                                    </div>
                                                            </div>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                            <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                            <i class="material-icons">place</i>
                                                                    </span>
                                                                    <div class="form-group has-success">
                                                                      <input type="text" id="location" name="location" class="form-control">
                                                                      <input type="hidden" id="city" name="city" />
                                                                      <input type="hidden" id="cityLat" name="cityLat" />
                                                                      <input type="hidden" id="cityLng" name="cityLng" />
                                                                    </div>
                                                            </div>
                                                            <div id="map"></div>
                                                            </div>
		                                	
		                            	</div>
		                            </div>
		                            <div class="tab-pane" id="contact">
		                                <h4 class="info-text">Contact Numbers</h4>
		                                <div class="row">
		                                   <div class="col-sm-10 col-sm-offset-1">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                    <i class="material-icons">phone</i>
                                                            </span>
                                                            <div class="form-group has-success">
                                                              <label class="control-label">Primary Number</label>
                                                              <input type="text" name="cnumber" class="form-control">
                                                            </div>
                                                        </div>
                                                       <div class="input-group">
                                                            <span class="input-group-addon">
                                                                    <i class="material-icons">dialpad</i>
                                                            </span>
                                                            <div class="form-group label-floating has-success">
                                                              <label class="control-label">Service Provider</label>
                                                              <select class="form-control" name="detail">
                                                                  <option value="Sun">Sun</option>
                                                                  <option value="Smart">Smart</option>
                                                                  <option value="Globe">Globe</option>
                                                                  <option value="TnT">Talk n Text</option>
                                                              </select>
                                                            </div>
                                                        </div>

                                                           
                                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next' />
		                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Register' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	        </div><!-- end row -->
	    </div> <!--  big container -->

	    <div class="footer">
	        <div class="container text-center">
	             Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>.
	        </div>
	    </div>
	</div>

@endsection


@section('addtl_scripts')

    <script src="{{asset('mbootstrap-wizard/assets/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('mbootstrap-wizard/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('mbootstrap-wizard/assets/js/jquery.bootstrap.js')}}" type="text/javascript"></script>
    <!--  Plugin for the Wizard -->
    <script src="{{asset('mbootstrap-wizard/assets/js/material-bootstrap-wizard.js')}}"></script>
    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
    <script src="{{asset('mbootstrap-wizard/assets/js/jquery.validate.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
         $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOkRKO79rw8RrYgfrMgqIz2du240Uyz6U&libraries=places&callback=initMap"
        async defer></script>
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


@endsection