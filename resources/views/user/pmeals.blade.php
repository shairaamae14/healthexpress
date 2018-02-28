@extends('user-layouts.master')
<link href="{{asset('datetimepicker/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="{{asset('datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>


@section('heading')

    

    
@endsection
<style>
@import url('http://fonts.googleapis.com/css?family=Lobster');
@import url('http://fonts.googleapis.com/css?family=Anton');
@import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
@import url('https://fonts.googleapis.com/css?family=Archivo+Black');
@import url('https://fonts.googleapis.com/css?family=Lato');

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
td.fc-day.fc-past {
    background-color: #EEEEEE;
}
/*.ui-draggable-handle{
  padding:5px;
  margin:3px;
  background-color:#4cae4cc4;
  border:0;
}
.fc-event.fc-draggable{
  padding:5px;
  margin:1px;
  background-color:#4cae4cc4;
  border:0;
}*/
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
            <div class="card" style="width:30rem; margin-left:-50px; padding:10px">
              <button type="button" class="btn btn-flat" onclick="changedish({{$cookid}})" style="width:280px;background-color:#f74141b3">Change Set of Dishes</button>
              <div class="card-block">
                <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                <h4 class="card-title text-center" style="color:#4caf50;">Suggested Dishes</h4>
                <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                <p class="card-text text-center">Suggested dishes based your health information</p>
              </div>
              <center>
                {{-- <input type="hidden" name="daterange" value="{{$daterange}}"> --}}

                
              <form method="post" action="#">
              {{csrf_field()}}
              <input type="hidden" name="cookid" id="cookid" value="{{$cookid}}">
              {{-- <input type="hidden" name="duration" id="duration" value="{{$duration}}"> --}}
                <div id='wrap'>
                  <div id='external-events'>
                      <input type="hidden" name="start" value="{{$start}}">
                      <input type="hidden" name="end" value="{{$end}}">
                      <!-- Breakfast -->
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <label class="card-title text-center" style="color:#4caf50;">Breakfast</label>
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <div class="card" style="margin-bottom: 10px">
                        @foreach($breakfast as $bfast)
                          <div class='fc-event'  data-event='{"did": {{$bfast->did}}, "title": "{{$bfast->dish_name}}", "be":1, "cook":{{$cookid}} }'>{{$bfast->dish_name}}</div>
                        @endforeach
                      </div>
                      <!-- Lunch -->
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <label class="card-title text-center" style="color:#4caf50;">Lunch</label>
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <div class="card" style="margin-bottom: 10px">
                        @foreach($lunch as $lnch)
                          <div class='fc-event' data-toggle="modal" data-event='{"did": {{$lnch->did}}, "title": "{{$lnch->dish_name}}", "be":2, "cook":{{$cookid}} }'>{{$lnch->dish_name}}</div>
                        @endforeach
                      </div>
                      <!-- Dinner -->
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <label class="card-title text-center" style="color:#4caf50;">Dinner</label>
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <div class="card" style="margin-bottom: 10px">
                        @foreach($dinner as $dnr)
                          <div class='fc-event' data-event='{"did": {{$dnr->did}}, "be":3, "title": "{{$dnr->dish_name}}", "cook":{{$cookid}} }'>{{$dnr->dish_name}}</div>
                        @endforeach
                      </div>

                      <label><i>Select and drag a dish to the calendar</i></label><br>


                      <i class="fa fa-trash-o fa-2x" aria-hidden="true" id="trash"></i>
                      
                  </div>
                  <div style='clear:both'></div>
                </div>
                <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
              </form>
            </center>


              <div class="card-block text-center">
                <button type="button" onclick="window.location.href='{{route('user.plan.clear')}}'" class="btn btn-flat btn-danger">Go Back</button>
                  <button type="button" class="btn btn-flat btn-success add-dish" value="./summary" onclick="window.location.href='{{route('user.pmsummary')}}'">Proceed</button>
                </div>

            </div>
            <div class="card" style="width:92rem; float:right; margin-right:-10px; margin-left:10px; padding:10px">
              <div id='calendar'></div>
              <label>Click on a meal to see more details</label>
            </div>

          </div><br><br><!--content!-->
        </div><!--row!-->
      </div>
      </div><!--section!-->
    </div><!--main raised!-->
</div>


@foreach($betype as $best)
<div id="dishDetails{{$best->dish_id}}{{$best->uo_id}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title" style="color:#30bb6d">Dish Details</h4>
            </div>
            <form action="{{route('user.pmdetails')}}" method="post">
            {{csrf_field()}}
              <div id="modalBody" class="modal-body">
                <div class="col-md-12">
                  <input type="hidden" name="uo_id" value="{{$best->uo_id}}">
                  @foreach($dishes as $dish)
                    @if($best->dish_id == $dish->ding_id && $best->uo_id == $dish->uo_id)
                      <div class="col-md-6">
                        <img src="{{url('./dish_imgs/'.$dish->dish_img)}}" style="width:150px; height:150px; border:2px solid #F0F0F0; border-radius: 10px"><br><br>
                        <label style="float:center; font-size:15px; color:black">
                          <b>Dish Name:</b>
                            &nbsp;{{$dish->dish_name}}
                        </label><br>
                        <label style="float:center; font-size:15px; color:black">
                          <b>Cook:</b>
                            &nbsp;{{$dish->first_name}} {{$dish->last_name}}
                        </label><br>
                        <label style="float:center; font-size:15px; color:black">
                          <b>Meal For:</b>
                            &nbsp;{{$dish->name}}
                        </label><br>
                        <label style="float:center; font-size:15px; color:black">
                          <b>Price:</b>
                            &nbsp;{{$dish->sellingPrice}}
                        </label><br>
                        <label style="float:center; font-size:15px; color:black">
                          <b>No of Servings:</b>
                            &nbsp;{{$dish->no_of_servings}}
                        </label><br>
                      </div>
                      <div class="col-md-6">
                        <h4><b>Nutritional Facts</b></h4>
                          <b>Amount Per Serving</b>
                          <table>
                              <tr style="border-bottom:2px solid black">
                                <td><b style="margin-right: 50px">Calories</b></td>
                                <td>{{ $dish->calories }}g</td>
                              </tr>
                              <tr>
                                <td><b style="margin-right: 50px">Total Fat</b></td>
                                <td>{{ $dish->total_fat }}g</td>
                              </tr>
                              <tr>
                                <td><b style="margin-right: 50px">Cholesterol</b></td>
                                <td>{{ $dish->cholesterol }}g</td>
                              </tr>
                              <tr>
                                <td><b style="margin-right: 50px">Sodium</b></td>
                                <td>{{ $dish->sodium }}g</td>
                              </tr>
                              <tr style="border-bottom:2px solid black">
                                <td><b style="margin-right: 50px">Total Carbohydrate</b></td>
                                <td>{{ $dish->carbohydrate }}g</td>
                              </tr>
                              <tr>
                                <td><b style="margin-right: 50px">Protein</b></td>
                                <td>{{ $dish->protein }}g</td>
                              </tr>
                          </table><br>
                          <b>&nbsp;Change time:</b>
                          <input id="appt-time" type="time" name="appt-time" step="2" value="{{ Carbon\Carbon::parse($dish->start)->format('H:m:s') }}">
                      </div>
                    @endif
                  @endforeach
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" style="margin:10px" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success"><a id="eventUrl" style="color:white" target="_blank">Save Changes</a></button>
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

<script src="{{asset('js/pace.js')}}"></script>


<script>
$(document).ready(function() {

    $('#external-events .fc-event').each(function() {

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true, // will cause the event to go back to its
        revertDuration: 0 //  original position after the drag
      });

    });

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
          showNonCurrentDates:false,
          editable: true,
          droppable: true, // this allows things to be dropped onto the calendar
          dragRevertDuration: 0,
          eventLimit: 3,
          
          validRange: {
            start: '{{$start}}',
            end:'{{$end}}'
          },
          
          drop: function() {
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove();
            }
          },
          eventDragStop: function (event, jsEvent, ui, view) {
            if (isElemOverDiv()) {
              var con = confirm('Are you sure to delete this permanently?');
              if(con == true) {
              var id = event.uo_id;
              $.ajax({
                  url: '{{ route("user.delete") }}',
                  data: {'id':id},
                  method: 'GET',
                  dataType: 'json',
                  success: function(response){
                    console.log(response);
                    if(response.status == 'success'){
                      $('#calendar').fullCalendar('removeEvents');
                          getFreshEvents();
                        }
                  },
                  error: function(e){ 
                    alert('Error processing your request: '+e.responseText);
                  }
                });
              }   
            }
          },
          eventReceive: function(event){
            var title = event.title;
            var cook = event.cook;
            console.log(event.cook);
            var dish = event.did;
            var be = event.be;
            var om = 2;
            if(be == 1){
              var start = event.start.format("YYYY-MM-DD[T]06:00:00");
              var end = (event.end == null) ? start : event.end.format();
            }
            else if(be ==2){
              var start = event.start.format("YYYY-MM-DD[T]11:00:00");
              var end = (event.end == null) ? start : event.end.format(); 
            }
            else{
              var start = event.start.format("YYYY-MM-DD[T]17:00:00");
              var end = (event.end == null) ? start : event.end.format();
            }

            $.ajax({
              url: "{{ route('user.storeplans') }}",
              data: {'title':title,'start':start,'end':end,'dish_id':dish,'be_id':be,'om_id':om, 'cook':cook},
              method: "GET",
              dataType: 'json',
              success: function(){
                $('#calendar').fullCalendar('updateEvent',event);
                
                location.reload();
                Pace.restart();
              },
              error: function(e){
                console.log('error');
              }
            });
            $('#calendar').fullCalendar('updateEvent',event);
          },
          eventDrop: function(event, delta, revertFunc) {
            var id = event.uo_id;
            var title = event.title;
            var start = event.start.format("YYYY-MM-DD[T]HH:MM:SS");
            var end = (event.end == null) ? start : event.end.format();
            $.ajax({
              url: "{{ route('user.resetdate') }}",
              data: {'title':title,'start':start,'end':end,'id':id},
              method: "GET",
              dataType: 'json',
              success: function(response){
                if(response.status != 'success')                            
                  revertFunc();
              },
              error: function(e){                     
                revertFunc();
                alert('Error processing your request: '+e.responseText);
              }
            });
          },
          eventClick:  function(event, jsEvent, view) {
            var id = event.dish_id;
            var pid = event.uo_id;
            console.log(id);
            $('#eventUrl').attr('href',event.url);
            $('#dishDetails'+id+pid).modal();
          },
          eventResize: function(event, delta, revertFunc) {
            var id = event.uo_id;
            var title = event.title;
            var end = event.end.format();
            var start = event.start.format();
            $.ajax({
              url: "{{ route('user.resetdate') }}",
              data: {'title':title,'start':start,'end':end,'id':id},
              method: 'GET',
              dataType: 'json',
              success: function(response){
                if(response.status != 'success')                            
                  revertFunc();
              },
              error: function(e){                     
                revertFunc();
                  alert('error');
              }
            });
          },
          eventConstraint: {
            businessHours: {
              start: moment().format('HH:mm'),
              end: '24:00'
            }
          }


        });
      }
    });
    var currentMousePos = {
      x: -1,
      y: -1
    };
    jQuery(document).on("mousemove", function (event) {
    currentMousePos.x = event.pageX;
    currentMousePos.y = event.pageY;
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
  {{-- <script src="{{asset('customer/assets/js/jquery.min.js')}}" type="text/javascript"></script> --}}
       <script src="{{asset('customer/assets/js/bootstrap.min.js')}}" type="text/javascript"></script> 
       <script src="{{asset('customer/assets/js/material.min.js')}}"></script> 

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  {{-- <script src="{{asset('customer/assets/js/nouislider.min.js')}}" type="text/javascript"></script> --}}

  <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
  {{-- <script src="{{asset('customer/assets/js/bootstrap-datepicker.js')}}" type="text/javascript"></script> --}}

  <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
  {{-- <script src="{{asset('customer/assets/js/material-kit.js')}}" type="text/javascript"></script> --}}
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> --}}
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}


 {{--  <script type="text/javascript" src="{{asset('js/jquery-2.0.0.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.smartWizard.js')}}"></script>
 --}}
 {{--  <script type="text/javascript" src="{{asset('datetimepicker/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('datetimepicker/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('datetimepicker/js/locales/bootstrap-datetimepicker.fr.js')}}" charset="UTF-8">
</script> --}}

  <script type='text/javascript'>
  $(document).ready(function(){

    $('.set').click(function(){
      $('.askq').removeAttr('hidden');
      $(this).attr('disabled', 'disabled');
    });
     
      // $('.timepicker').timepicker();
   });
  function changedish(id){
    $.ajax({
      url: "{{route('user.changedish')}}",
      method: "get",
      data: {'id':id},
      success: function(){
        location.reload();
      }
    });
  }
</script>
  <script>
    $(document).ready(function(e){
      $('.addCart').click(function(e){
        e.preventDefault();
         var dish_id=$(this).attr("id");
         var be_id=$('#be_id').val();
         console.log(dish_id, be_id);
         $.ajax({
          type:"GET",
          url:"/pcart/"+dish_id+"/"+be_id,
            success:function(data){
             $("#modal.close").click();
             // $(".cntnt").append(data);                     
            },
            error:function(data)
            {
              alert("Error");
            }
        });
      });
    });
  </script>


@endsection




                    
