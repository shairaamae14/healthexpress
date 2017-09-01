@extends('wiz-layouts.master')
<style>
    #map {
        height: 40%;
      }
</style>

@section('content')
 <div class="top-content" style="margin-top:50px;">
            <div class="container">
    
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
                        <form role="form" method="POST" action="{{route('register')}}" class="f1">
                            {{csrf_field()}}
                            <h3>Register</h3>
                            <p>Fill in the form to get instant access</p>
                            <div class="f1-steps">
                                <div class="f1-progress">
                                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%; background-color:#30BB6D"></div>
                                </div>
                                <div class="f1-step active">
                                    <div class="f1-step-icon" style="background-color: #30BB6D;"><i class="fa fa-user"></i></div>
                                    <p style="color:#30BB6D">About</p>
                                </div>
                                <div class="f1-step">
                                    <div class="f1-step-icon" style="background-color: #30BB6D;"><i class="fa fa-key"></i></div>
                                    <p style="color:#30BB6D">Personal Information</p>
                                </div>
                                <div class="f1-step">
                                    <div class="f1-step-icon" style="background-color: #30BB6D;"><i class="fa fa-stethoscope"></i></div>
                                    <p style="color:#30BB6D">Health Information</p>
                                </div>
                            </div>
                            
                            <fieldset>
                                <h4>Tell us who you are:</h4>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="f1-first-name">First name</label>
                                    <input type="text" name="fname" placeholder="First name..." class="form-control" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="lname">Last name</label>
                                    <input type="text" name="lname" placeholder="Last name..." class="form-control" id="f1-last-name">
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="contact">Contact no:</label>
                                    <input type="text" name="contact_no" placeholder="Contact number" class=" form-control" id="f1-last-name">
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
                                    <button type="button" class="btn btn-next" style="background-color:#30BB6D">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>
                                <h4>Set up your account:</h4>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="f1-email">Email</label>
                                    <input type="text" name="email" placeholder="Email..." class="form-control" value="{{ old('email') }}">
                                     @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="f1-password">Password</label>
                                    <input type="password" name="password" placeholder="Password..." class="f1-password form-control" id="f1-password">

                                      @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-repeat-password">Confirm password</label>
                                    <input type="password" name="password_confirmation" placeholder="Repeat password..." class="f1-repeat-password form-control" id="f1-repeat-password">
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>
                                <h4>Tell us about your health:</h4>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-md-4">
                                    <label for="f1-facebook">Birthday</label>
                                    <input id="age" type="date" class="form-control" name="bday" min="1" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="f1-facebook">Weight</label>
                                    <input id="weight" type="number" class="form-control" name="weight" min="1" required><label class="col-md-4 control-label" style="color:black">kg</label>
                                </div>
                                <div class="col-md-4">
                                    <label for="f1-facebook">Height</label>
                                    <input id="height" type="number" class="form-control" name="height" min="1" required><label class="col-md-4 control-label" style="color:black">cm</label>
                                </div>
                                <div class="col-md-4">
                                    <label for="f1-facebook">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="Male">M</option>
                                        <option value="Female">F</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-md-12">
                                    <label for="f1-twitter">Health Goal</label>
                                    
                                     <select class="col-md-4 form-control" name="goal" style="color:black">
                                         @foreach($goals as $goal)
                                         <option value="{{$goal->hg_id}}">{{$goal->hgoal_name}}</option>
                                         @endforeach
                                    </select>
                                    <input type="hidden" value="{{ \Carbon\Carbon::now() }}" name="dateStarted">
                                     <a data-toggle="tooltip" data-placement="right" title="What is your aim with your body"><i class="fa fa-question-circle"></i></a>     
                                </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                <div class="col-md-12">
                                    <label for="f1-twitter">Lifestyle/Activeness</label>
                                    
                                     <select class="col-md-4 form-control" name="lifestyle" style="color:black">
                                         @foreach($lifestyles as $lstyles)
                                         <option value="{{$lstyles->lifestyle_id}}">{{$lstyles->lifestyle_name}}</option>
                                        @endforeach
                                    </select>
                                   
                                      <a data-toggle="tooltip" data-placement="right" title="Sedentary:gets little to no exercise;
                                      Lightly Active:daily exercise for 30 mins;
                                      Active:daily exercise for 1hr and 45mins;
                                      Extremly Active:daily exercise for 4 hrs and 15mins"><i class="fa fa-question-circle"></i></a>
                                </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                    <label>Allergens</label>
                                <div class="form-group">
                               
                                    <select multiple name="allergen[]" class="form-control">
                                        @foreach($allergens as $allgen)
                                        <option value="{{$allgen->allergen_id}}">{{$allgen->allergen_name}}</option>
                                        @endforeach
                                    </select>
                                
                                </div>
                                    <label>Tolerance Level (Allergens)</label>
                                <div class="form-group">
                               
                                    <select name="tolerance" class="form-control">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                
                                </div>
                            </div>

                               <div class="row">
                                    <label>Medical Conditions</label>
                                <div class="form-group">
                                
                                    <select multiple name="med_condition[]" class="form-control">
                                        @foreach($mconditions as $conditions)
                                        <option value="{{$conditions->medcon_id}}">{{$conditions->medcon_name}}</option>
                                        @endforeach
                                    </select>
                                
                                </div>
                            </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="submit" class="btn btn-submit">Submit</button>
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