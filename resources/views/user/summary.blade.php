@extends('user-layouts.master')
<link href="{{asset('datetimepicker/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="{{asset('datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>

 
@section('heading')
 <!-- Calendar -->
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> -->
    
@endsection
<style>
@import url('http://fonts.googleapis.com/css?family=Lobster');
@import url('http://fonts.googleapis.com/css?family=Anton');
@import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
@import url('https://fonts.googleapis.com/css?family=Archivo+Black');
@import url('https://fonts.googleapis.com/css?family=Lato');

    #map {
        height:250px;
        width:250px;
     
       /* width:450px;
       */
        
    }
    
    .help{
        color:#4caf50;
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
 box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 20px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3) !important;

}

.cardhover:hover{
 box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 20px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3) !important;

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

hr{
  border-top: 3px double #8c8b8b;
}

.lnk:hover{
  border-top: 1px solid #30BB6D;
  border-bottom: 1px solid #30BB6D;
}
div#calendar .fc-center h2 {
  color: black;
}
input[type="text"], input[type="number"], #mode {
  border:1px solid #F2E6E4;

}
/*Resize the wrap to see the search bar change!*/



</style>

@section('content')

<div class="wrapper">
  <div class="header header-filter" style="background-image: url('{{asset('img/bgindex.jpg')}}')">
    <div class="container">
      <div class="row">
        <center>
        <div class="col-md-6">
           <br>
            <h1 class="title text-left" style="font-size: 80px; font-family: 'Lobster', cursive;">Planned Meals</h1>
              <a href="./home">
                <button id="ordermode" style="background-color:transparent;  border:2px solid white; font-size: 40px; margin-top:-20px; margin-left:10px; font-family: 'Lobster', cursive; color:white; width: 300px">Express Meal</button>
              </a>
        </div>
      </div>
    </div>
  </div>
  <div class="main main-raised">
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="content"> 
            <center>
         <!--    <input type="text" id="location" name="location" class="form-control">
                                                                      <input type="hidden" id="city" name="city" />
                                                                      <input type="hidden" id="cityLat" name="cityLat" />
                                                                      <input type="hidden" id="cityLng" name="cityLng" /> -->
                                                                      <!-- <div id="map"></div> -->
              <h1 style="color:#30bb6d">SUMMARY OF DISHES</h1>
              <label>Please select a dish to change the order details.</label>
              <br>
               <div class="card" style="width:92rem; margin-right:-10px; margin-left:10px; padding:10px">
              <div id='calendar'></div>
              </div>
           <div class="footer">
          <button type="button" onclick="window.location.href='{{route('user.plan.index')}}'" class="btn btn-flat btn-danger">Go Back</button>
           <button type="button" class="btn btn-flat btn-success add-dish" value="./payment" onclick="window.location.href='{{route('user.payment')}}'">Payment Method</button>
          </div>

          </div><!--content!-->
        </div><!--row!-->
        </div><!--container!-->
      </div><!--section!-->
    </div><!--main raised!-->
    <br>
  </div><!--wrapper!-->
</div>
<br>
@foreach($data as $order)
<div id="fullCalModal{{$order->dish_id}}" class="modal fade pull-left mdl" style="align-content: center">
    <div class="modal-dialog" style="float:center; margin-right: 1500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title" style="color: #4caf50"><b>{{$order->title}}</b></h4>
            </div>
             <form action="{{route('user.setDetails')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="pm_id" id="pm_id" value="{{$order->pm_id}}">
            <div id="modalBody" class="modal-body col-md-12 modall"> 
              <div class="col-md-12 details">
             <div class="col-md-6">
                 <img src="{{url('./dish_imgs/'.$order->dish_img)}}" style="width:150px; height:150px; border:2px solid #F0F0F0; border-radius: 10px"><br>
                 </div>
             <div class="col-md-6">
                <label style="float:center; font-size:15px; color:black">
                  <b>&nbsp; Meal For:</b>
                    &nbsp;{{$order->name}}
                </label><br>
                <label style="float:center; font-size:15px; color:black">
                  <b>&nbsp; Date:</b>
                    &nbsp;{{ Carbon\Carbon::parse($order->start)->format('Y-M-d H:m:s') }}
                </label><br>
                <label style="float:center; font-size:15px; color:black">
                  <b>&nbsp; Status:</b>
                    &nbsp;{{$order->p_status}}
                </label><br>
                <label style="float:center; font-size:15px; color:black">
                  <b>&nbsp; Mode of Delivery:</b>
                  @if($order->mode_delivery)
                    &nbsp;{{$order->mode_delivery}}
                  @else
                     &nbsp;To be set
                  @endif
                </label><br>
                <label style="float:center; font-size:15px; color:black;">
                  <b>&nbsp; Address:</b>
                  @if($order->address)
                    &nbsp;{{$order->address}}
                  @else
                    &nbsp;To be set
                  @endif
                </label><br>
                <label style="float:center; font-size:15px; color:black">
                  <b>&nbsp; Sidenote:</b>
                @if($order->sidenote)
                    &nbsp;{{$order->sidenote}}
                @else
                    &nbsp;None
                @endif    
                </label><br>
             </div>
              </div>
              <div class="col-md-12">
              <center><button type="button" class="btn btn-flat btn-success btn-md set" id="setdetails" style="margin-bottom:50px;">SET DETAILS</button></center>
              <div class="askq" hidden>
                <label style="float:center; font-size:15px; color:black">
                  <b>&nbsp;Mode of Delivery:</b></label>
                  <select name="mode" class="mode form-control" id="mode" style="width:450px">
                    <option value="Delivery">Delivery</option>
                    <option value="Pickup">Pick up</option>
                  </select>
                  <div class="address" id="address">  
                    <div id="del" class="del" hidden>
                      <label style="float:center; font-size:15px; color:black">
                      <b>&nbsp;Delivery Address:</b></label>
                      <br>
                      <input type="checkbox" class="defaultadd" id="defaultadd" checked>&nbsp;Use default address
                      <input type="text" name="d_address" class="form-control has-success loc" id="location{{$order->dish_id}}" style="width:450px">
                      <input type="hidden" id="city" name="city" />
                      <input type="hidden" id="cityLat" name="cityLat" value="{{$order->latitude}}" />
                      <input type="hidden" id="cityLng" name="cityLng" value="{{$order->longitude}}"/>
                      <input type="hidden" id="dish_id" value="{{$order->dish_id}}">
                      <center><div id="map{{$order->dish_id}}" class="map" style="height:200px"></div>
                    </div>
                    <div id="pick" class="pick" hidden>
                      <label style="float:center; font-size:15px; color:black">
                      <b>&nbsp;Pick-Up Address:</b></label>&nbsp;
                      <label>{{$order->c_location}}</label>
                      <input type="hidden" id="city" name="city" />
                      <input type="hidden" id="cityLat" name="cityLatp"/>
                      <input type="hidden" id="cityLng" name="cityLngp" />
                      <input type="hidden" name="p_address" value="{{$order->c_location}}">
                    </div>
                  </div>
                   <label style="float:center; font-size:15px; color:black">
                  <b>&nbsp;Number of persons:</b>
                  <input type='number' name="num" class='form-control has-success' min="1" value="1" style='width:50px;'>
                  </label><br>
                
                  <label style="float:center; font-size:15px; color:black">
                  <b>&nbsp;Do you have any specifications?</b></label>
                  <input type='text' name="spec" class='form-control has-success' style='width:250px;'>
              </div>
            </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btnsave" disabled>Save Changes</button>
            </div>
            </form>
            </div>
        </div>
    </div>
@endforeach
<script src='https://code.jquery.com/jquery-1.11.2.min.js'></script>
<script src='https://code.jquery.com/ui/1.11.2/jquery-ui.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js'></script>
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOkRKO79rw8RrYgfrMgqIz2du240Uyz6U&libraries=places&callback=initMap" async defer></script>

<script>
// $(document).ready(function() {
// $(".modall").on("shown.bs.modal", function(e) {
//       google.maps.event.trigger(map, "resize");
//        return map.setCenter(latLng);
// });     });

  function initMap(id) {


        var latLng = new google.maps.LatLng(10.3157007,123.88544300000001 );
        var mapOptions = {
            zoom:13,
            center: latLng
        }
      

        var map = new google.maps.Map(document.getElementById('map'+id), mapOptions);
        var card = document.getElementById('pac-card');
        var input = document.getElementById('location'+id);
        var options = {
                        componentRestrictions: {country: 'ph'}
                      }; 

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
        // map2.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        

    // $('#fullCalModal'+id).on('shown.bs.modal', function () {
    //     google.maps.event.trigger(map, 'resize');
    //     // map.setCenter(center);
    //   });
        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);
         // autocomplete.bindTo('bounds', map2);

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
  
         // google.maps.event.trigger(map, 'resize');
                
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
                  // infowindow.open(map2, marker);
            } else {
                alert('Error: Google Maps could not determine the address of this location.');
            }
            });
                map.panTo(marker.getPosition());
          });
          google.maps.event.addListener(marker, 'dragstart', function() {
            infowindow.close(map, marker);
              // infowindow.close(map2, marker);
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
          


          // infowindowContent.children['place-icon'].src = place.icon;
          // infowindowContent.children['place-name'].textContent = place.name;
          // infowindowContent.children['place-address'].textContent = address;
          // infowindow.open(map, marker);
        });

 $('#fullCalModal'+id).on('shown.bs.modal', (e) => {
    this.resizeMap();
     });
     function resizeMap() {
    var map = new google.maps.Map(document.getElementById('map'+id), this.options);
    google.maps.event.trigger(map, "resize");
     }

       
      }

 



$(document).ready(function() {
    $.ajax({
      url: '{{ route("user.fetch") }}',
      method: 'get', 
      data: {'type':'fetch'},
      success: function(s){
        json_events = s;
        $('#calendar').fullCalendar({
            events: JSON.parse(s),
          utc: true,
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },  
          editable: false,
          droppable: false, // this allows things to be dropped onto the calendar
          dragRevertDuration: 0,
          
          eventClick:  function(event, jsEvent, view) {
             var id= event.dish_id;
              // alert(id);
            $('#modalTitle').html(event.title);
            $('#modalBody').html(event.description);
            $('#eventUrl').attr('href',event.url);
            $('#fullCalModal'+id).modal();
            initMap(id);
            // resize(id);
          },
         

        });
      }
    });
  


  function getFreshEvents(){
    $.ajax({
      url: "{{route('user.fetch')}}",
      type: 'get', // Send post data
      data: 'type=fetch',
      async: false,
      success: function(s){
        freshevents = s;
        // alert('hi');
      }
    });
    $('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
  }
  function isElemOverDiv() {
        var trashEl = jQuery('#trash');

        var ofs = trashEl.offset();

        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);

        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
            currentMousePos.y >= y1 && currentMousePos.y <= y2) {
            return true;
        }
        return false;
  }
});   
    
</script> 


            

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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 


  <script type="text/javascript" src="{{asset('js/jquery-2.0.0.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.smartWizard.js')}}"></script>

 <script type="text/javascript" src="{{asset('datetimepicker/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('datetimepicker/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('datetimepicker/js/locales/bootstrap-datetimepicker.fr.js')}}" charset="UTF-8"></script>





<script>
$(document).ready(function(){

   $('.set').click(function(){
      $('.details').attr('hidden', 'hidden');
      $('.askq').removeAttr('hidden');
      $(this).attr('disabled', 'disabled');
        $('.btnsave').removeAttr('disabled');
         // $('.btnsave').removeAttr('hidden');
        $('.lblset').removeAttr('hidden');
        // $('.showdet').
      
    });
   // $('.fc-event').each(function(){
   //  console.log('hi');
   // });
  $('.mode').change(function(e){
      ChangeDrop(this);
      var id=$('.dish_id').val();
      alert(id);
       $('#fullCalModal'+id).modal({
        backdrop: 'static',
        keyboard: false
    }).on('shown.bs.modal', function () {
        google.maps.event.trigger(map, 'resize');
        map.setCenter(center);
    });

 
        });

 $(".mode").each(function(){
          ChangeDrop(this);
    
        });
  });

      
function ChangeDrop(mode){
              var val = $(mode).val();
              var id  = $('#dish_id').val();
              var div = $(mode).parent().find('.address')[0];
              
              if(val=="Delivery"){
                $('.del').removeAttr('hidden');
                $('.pick').attr('hidden', 'hidden');
                 
  
              }
              else if (val=="Pickup"){
                $('.pick').removeAttr('hidden');
                $('.del').attr('hidden', 'hidden');
              }
               
    $(div).find(".defaultadd").change(function(){
            if ($(this).is(":checked")){
                 $(div).find('.loc').val('{{$order->location}}');
            }else{
                $(div).find('.loc').val('');
                $(div).find('.loc').attr('placeholder', 'Please choose delivery location')
            }
            });              
}
</script>

<script type='text/javascript'>
  $(document).ready(function(){
     $('.form_datetime').datetimepicker({
          //language:  'fr',
          weekStart: 1,
          todayBtn:  1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      forceParse: 0,
          showMeridian: 1
      });
   });
</script> 



<!-- <script>
  $(document).ready(function (){
    $('#btnplan').on('click', function(){
      $('#content').hide();
      $('#content2').show();
    });
    $('#back').on('click', function() {
      $('#content2').hide();
      $('#content').show();x
    });
    $('#next').on('click', function() {
      $('#content2').hide();
      $('#content3').show();
    });
    $('#wizard1').smartWizard({
              transitionEffect:'fade',
              onFinish:onFinishCallback,
              onLeaveStep  : leaveAStepCallback,
          });
       function leaveAStepCallback(obj, context){
              // To check and enable finish button if needed
              if (context.fromStep >= 2) {
                  $('#wizard1').smartWizard('enableFinish', true);
              }
              return true;
          }
    
        function onFinishCallback(){
          alert('Finish Called');
          window.location.href= './plannedmeal/calendar';

        }

          
  });
  </script> -->
   


</script>






                    
