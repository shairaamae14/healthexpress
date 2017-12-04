@extends('user-layouts.master')
<link href="{{asset('datetimepicker/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
<link href="{{asset('datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
@section('heading')
 <!-- Calendar -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> -->
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.css'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
@endsection
<style>
@import url('http://fonts.googleapis.com/css?family=Lobster');
@import url('http://fonts.googleapis.com/css?family=Anton');
@import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
@import url('https://fonts.googleapis.com/css?family=Archivo+Black');
@import url('https://fonts.googleapis.com/css?family=Lato');


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
            <!--start card!-->
  
  <!-- <h5>{{$cal}}</h5> -->
 
            <div class="card" style="width:30rem; margin-left:-50px; padding:10px">
              <!--   <img class="card-img-top" src="..." alt="Card image cap"> -->
              <div class="card-block">
                <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                <h4 class="card-title text-center" style="color:#4caf50;">Suggested Dishes</h4>
                <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                <p class="card-text text-center">Suggested dishes based your health information</p>
              </div>
              <center>
              <form method="post" action="#">
              {{csrf_field()}}
              <input type="hidden" name="type" value="{{$type}}">
              <!--BFAST-->
              
                <!-- <div class="card-block">
                  <input type="checkbox" style="float:left; margin-top:15px; margin-right: 8px; margin-left: 8px">
                  <img src="{{asset('img/tunapatties.jpg')}}" style="width:50px; height:50px; float:left; margin: 5px"/>
                  <label style="color:black" name="dish_id" value="1">Tuna patties</label><br>
                  <label class="control-label">SMALL DESCRIPTION</label>
                </div> --><!--cardblock!-->
                <div id='wrap'>

        <div id='external-events'>
          <div id='external-events-listing'>
            <!-- <h4>Draggable Events</h4> -->
            <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
            <label class="card-title text-center" style="color:#4caf50;">Breakfast</label>
            <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
            <div class="card" style="margin-bottom: 10px">
              <div class='fc-event'>Mixed Bowl Salad</div>
            </div>
            <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
            <label class="card-title text-center" style="color:#4caf50;">Lunch</label>
            <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
            <div class="card" style="margin-bottom: 10px">
              <div class='fc-event'>Tuna Patties</div>
            </div>
            <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
            <label class="card-title text-center" style="color:#4caf50;">Dinner</label>
            <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
            <div class="card" style="margin-bottom: 10px">
              <div class='fc-event'>Braised Beef</div>
            </div>
          </div>
          <!-- <p>
            <input type='checkbox' id='drop-remove' unchecked />
            <label for='drop-remove'>remove after drop</label>
          </p> -->
        </div>

        

        <div style='clear:both'></div>

    </div>



                

                <!-- <div class="form-group">
                  <div class="input-group date form_datetime col-md-5" data-date="2017-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input class="form-control" size="16" type="text" value="" placeholder="choose schedule" style="width:180px; font-size:12px" readonly>
                    <span class="input-group-addon"><span class="fa fa-times" aria-hidden="true"></span></span>
                    <span class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></span>
                  </div>
                  <input type="hidden" id="dtp_input1" value="" /><br/>
                </div> -->
                <!--CALENDAR!-->
              <!-- </div> --><!--CARD!-->
              <!--endoflunch!-->
              <!--DINNER-->
              
              <!--ENDOF!-->
              <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
              <div class="card-block">
                <button type="submit" class="btn btn-success btn-flat">Save Schedule</button>
              </div>
              </form>
              </div>

         
          <div class="card" style="width:92rem; float:right; margin-right:-10px; margin-left:10px; padding:10px">
            <div id='calendar'></div>
          </div>
        </div><br><br><!--content!-->
      </div><!--row!-->
    </div><!--section!-->
  </div><!--main raised!-->
</div><!--wrapper!-->
<script src='https://code.jquery.com/jquery-1.11.2.min.js'></script>
<script src='https://code.jquery.com/ui/1.11.2/jquery-ui.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.js'></script>


<script>
    $(document).ready(function() {


        /* initialize the external events
        -----------------------------------------------------------------*/

        $('#external-events .fc-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });


        /* initialize the calendar
        -----------------------------------------------------------------*/

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            dragRevertDuration: 0,
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            eventDragStop: function( event, jsEvent, ui, view ) {
                
                if(isEventOverDiv(jsEvent.clientX, jsEvent.clientY)) {
                    $('#calendar').fullCalendar('removeEvents', event._id);
                    var el = $( "<div class='fc-event'>" ).appendTo( '#external-events-listing' ).text( event.title );
                    el.draggable({
                      zIndex: 999,
                      revert: true, 
                      revertDuration: 0 
                    });
                    el.data('event', { title: event.title, id :event.id, stick: true });
                }
            }
        });


        var isEventOverDiv = function(x, y) {

            var external_events = $( '#external-events' );
            var offset = external_events.offset();
            offset.right = external_events.width() + offset.left;
            offset.bottom = external_events.height() + offset.top;

            // Compare
            if (x >= offset.left
                && y >= offset.top
                && x <= offset.right
                && y <= offset .bottom) { return true; }
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
<script type="text/javascript" src="{{asset('datetimepicker/js/locales/bootstrap-datetimepicker.fr.js')}}" charset="UTF-8">
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


<script>
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


$(".form_datetime").datetimepicker({
        format: "dd MM yyyy - hh:ii"
    }); 
  
</script>





                    
