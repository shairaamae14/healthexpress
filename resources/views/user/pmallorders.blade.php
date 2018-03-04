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

    /*#map {
        height:250px;
        width:250px;
     
       //width:450px;
       
        
    }*/

    #map{
  width:500px;
  height:300px;
  padding-bottom:5px}
    
    .help{
        color:#4caf50;
    }
 .modal{
      padding-right: 600px !important;
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
              <a href="{{route('user.index')}}">
                <button id="ordermode" style="background-color:transparent;  border:2px solid white; font-size: 40px; margin-top:-20px; margin-left:10px; font-family: 'Lobster', cursive; color:white; width: 300px">Express Meal</button>
              </a>
        </div>
        </center>
      </div>
    </div>
  </div>
  <div class="main main-raised">
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="content"> 
            <center>
               <h1 class="text-center" style="color:white; background-color: #4caf50">Planned Meal Orders</h1>
                <label style="font-size: 20px;"><b style="font-size: 20px; color:#4caf50">Total Meal Cost</b>: Php {{$allMealCost}}</label>
              <label style="font-size: 20px;"><b style="font-size: 20px; color:#4caf50">Total Delivery Fee</b>: Php {{$totalDelFee}}</label>
              <br>
              <label style="font-size: 20px;"><b style="font-size: 20px; color:#4caf50">All Cost</b>: Php {{$allcost}}</label>
              <br>
                <div class="card" style="width:92rem; margin-right:-10px; margin-left:10px; padding:10px">
              <div id='calendar'></div>   
       
              <div class="footer">
            <button type="button" class="btn btn-flat btn-success add-dish" value="./payment" onclick="window.location.href='{{route('pmorder.orderhistory')}}'">Proceed to Orders status</button>
            </div>
                 </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@foreach($data as $order)

{{-- @foreach($timediff as $time) --}}
<div id="fullCalModal{{$order->uo_id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    {{$order->a}}
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="text-center" style="color:white; background-color: #4caf50">{{$order->title}}</h4>
      </div>
      <div class="modal-body">
           <div class="col-md-12"><center>
                <img src="{{url('./dish_imgs/'.$order->dishes['dish_img'])}}" style="width:150px; height:150px; border:2px solid #F0F0F0; border-radius: 10px"><br>
              </div><br><center>
              <div class="col-md-12">
                <label style="float:center; font-size:15px; color:black">
                  <b style="color: #4caf50">&nbsp; Meal For:</b>
                    &nbsp;{{$order->dishes->besteaten[0]['name']}}
                </label><br>
                <label style="float:center; font-size:15px; color:black">
                  <b style="color: #4caf50">&nbsp; Date:</b>
                    &nbsp;{{ Carbon\Carbon::parse($order->start)->format('Y-M-d H:m:s') }}
                </label><br>
                <label style="float:center; font-size:15px; color:black">
                  <b style="color: #4caf50">&nbsp; Status:</b>
                    &nbsp;{{$order->order_status}}
                </label><br>
                  <label style="float:center; font-size:15px; color:black">
                    <b style="color: #4caf50">&nbsp; Price:</b>
                @if($order->dishes['sellingPrice'])
                  &nbsp;{{$order->dishes['sellingPrice']}}
                @else
                  &nbsp;None
                @endif    
                </label><br>
                   <label style="float:center; font-size:15px; color:black">
                  <b style="color: #4caf50">&nbsp; Cook:</b>
                    &nbsp;{{$order->dishes->cook['first_name']}}&nbsp;{{$order->dishes->cook['last_name']}}
                </label><br>
                <label style="float:center; font-size:15px; color:black">
                  <b style="color: #4caf50">&nbsp; Mode of Delivery:</b>
                  @if($order->mode_delivery)
                    &nbsp;{{$order->mode_delivery}}
                  @else
                     &nbsp;To be set
                  @endif
                </label><br>
                <label style="float:center; font-size:15px; color:black;">
                @if($order->mode_delivery=="Delivery")
                  <b style="color: #4caf50">&nbsp;Delivery Address:</b>
                @else
                 <b style="color: #4caf50">&nbsp;Pickup Address:</b>
                @endif
                  @if($order->address)
                    &nbsp;{{$order->address}}
                  @else
                    &nbsp;To be set
                  @endif
                </label><br>
                @if($order->mode_delivery=="Delivery")
                 <label style="float:center; font-size:15px; color:black;">
                  <b style="color: #4caf50">&nbsp; Delivery Charge:</b>
                    Php&nbsp;{{$order->delivery_fee}}</label><br>
                    <label style="float:center; font-size:15px; color:black">
                    <b style="color: #4caf50">&nbsp;Sidenote:</b>
                @if($order->sidenote)
                    &nbsp;{{$order->sidenote}}
                @else
                    &nbsp;None
                @endif    
                </label><br>

                 @else
                 <label style="float:center; font-size:15px; color:black">
                    <b style="color: #4caf50">&nbsp;Sidenote:</b>
                @if($order->sidenote)
                    &nbsp;{{$order->sidenote}}
                @else
                    &nbsp;None
                @endif    
                </label><br>
                  @endif
             <!--    </label><br>
                <label style="float:center; font-size:15px; color:black">
                    <b style="color: #4caf50">&nbsp;Sidenote:</b>
                @if($order->sidenote)
                    &nbsp;{{$order->sidenote}}
                @else
                    &nbsp;None
                @endif    
                </label><br> -->
                <form method="post" action="{{route('user.pmchangetime')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="uo_id" value="{{$order->uo_id}}">
                  
                @if($order->newAttribute == 1)
                <b>&nbsp;Change time:</b>
                  <input id="appt-time" type="time" name="appt-time" step="2" value="{{ Carbon\Carbon::parse($order->start)->format('H:m:s') }}">
                @endif
             </div>

      </div>
      <div class="modal-footer">
        
          @if($order->newAttribute == 1)
            {{-- <button type="button" class="btn btn-warning" onclick="cancel({{$order->uo_id}})">Cancel Order</button> --}}
            <button type="button" class="btn btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#confirm{{$order->uo_id}}">Cancel Order</button>
            <button type="submit" class="btn btn-success"><a id="eventUrl" style="color:white" target="_blank">Save Changes</a></button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          @else
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          @endif
      </div>
    </div>

  </form>

  </div>
</div>
{{-- @endforeach --}}



<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm{{$order->uo_id}}">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure you want to cancel order?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="cancel({{$order->uo_id}})" id="modal-btn-yes">Yes</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-btn-no">No</button>
      </div>
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
<script>
$(document).ready(function() {
    $.ajax({
      url: '{{ route("user.pmordersfetch") }}',
      method: 'get', 
      data: {'type':'fetch'},
      success: function(s){
        json_events = s;
        $('#calendar').fullCalendar({
            events: JSON.parse(s),
          utc: true,
          header: {
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },  
          editable: false,
          droppable: false, // this allows things to be dropped onto the calendar
          dragRevertDuration: 0,
          
          eventClick:  function(event, jsEvent, view) {
            var id= event.uo_id;
            $('#modalTitle').html(event.title);
            $('#modalBody').html(event.description);
            $('#eventUrl').attr('href',event.url);
            $('#fullCalModal'+id).modal();
            initMap(id);
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
<script>
function cancel(id){
      $.ajax({
        url: "{{route('user.cancelorder')}}",
        type: 'get', // Send post data
        data: {'id':id},
        async: false,
        success: function(){
          location.reload();
          // alert('hi');
        }
      });
     }
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




                    
