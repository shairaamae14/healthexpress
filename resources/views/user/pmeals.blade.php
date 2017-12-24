@extends('user-layouts.master')
<link href="{{asset('datetimepicker/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
<link href="{{asset('datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
@section('heading')
 <!-- Calendar -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> -->
    
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
              <div class="card-block">
                <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                <h4 class="card-title text-center" style="color:#4caf50;">Suggested Dishes</h4>
                <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                <p class="card-text text-center">Suggested dishes based your health information</p>
              </div>
              <center>
              <form method="post" action="#">
              {{csrf_field()}}
                <div id='wrap'>
                  <div id='external-events'>
                      <!-- Breakfast -->
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <label class="card-title text-center" style="color:#4caf50;">Breakfast</label>
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <div class="card" style="margin-bottom: 10px">
                        @foreach($breakfast as $bfast)
                          <div class='fc-event' data-event='{"did": {{$bfast->did}}, "title": "{{$bfast->dish_name}}", "be":{{$bfast->be_id}} }'>{{$bfast->dish_name}}</div>
                        @endforeach
                      </div>
                      <!-- Lunch -->
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <label class="card-title text-center" style="color:#4caf50;">Lunch</label>
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <div class="card" style="margin-bottom: 10px">
                        @foreach($lunch as $lnch)
                          <div class='fc-event' data-event='{"did": {{$lnch->did}}, "title": "{{$lnch->dish_name}}", "be":{{$lnch->be_id}} }'>{{$lnch->dish_name}}</div>
                        @endforeach
                      </div>
                      <!-- Dinner -->
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <label class="card-title text-center" style="color:#4caf50;">Dinner</label>
                      <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
                      <div class="card" style="margin-bottom: 10px">
                        @foreach($dinner as $dnr)
                          <div class='fc-event' data-event='{"did": {{$dnr->did}}, "be":{{$dnr->be_id}}, "title": "{{$dnr->dish_name}}" }'>{{$dnr->dish_name}}</div>
                        @endforeach
                      </div>
                      <i class="fa fa-trash-o fa-2x" aria-hidden="true" id="trash"></i>
                  </div>
                  <div style='clear:both'></div>
                  {{-- <xspan class="tt">x</xspan> --}}
                </div>
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
</div>
<script src='https://code.jquery.com/jquery-1.11.2.min.js'></script>
<script src='https://code.jquery.com/ui/1.11.2/jquery-ui.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js'></script>


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
    /* initialize the calendar
    -----------------------------------------------------------------*/

    // $('#calendar').fullCalendar({
    //   header: {
    //     left: 'prev,next today',
    //     center: 'title',
    //     right: 'month,agendaWeek,agendaDay'
    //   },
    //   editable: true,
    //   droppable: true, // this allows things to be dropped onto the calendar
    //   drop: function() {
    //     $(this).remove();
    //   },
      

  // var  json_events;
    $.ajax({
      url: '{{ route("user.fetch") }}',
      method: 'get', // Send post data
      data: {'type':'fetch'},
      // async: false,
      success: function(s){
             // $(document).click(function(event) {
             //  // console.log(JSON.stringify(event));
             //  console.log(event);
             // var text = $(event.target);
             // var id = text[0]['childNodes'][1]['value'];
             // // alert(id);
             //  });
        json_events = s;
        $('#calendar').fullCalendar({
            events: JSON.parse(s),
          utc: true,
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
          eventDragStop: function (event, jsEvent, ui, view) {
            if (isElemOverDiv()) {
              var con = confirm('Are you sure to delete this permanently?');
              if(con == true) {
              var id = event.id;
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
            console.log(event);
            var dish = event.did;
            var be = event.be;
            var om = 2;
            var start = event.start.format("YYYY-MM-DD[T]HH:MM:SS");
            var end = (event.end == null) ? start : event.end.format();
            $.ajax({
              url: "{{ route('user.storeplans') }}",
              // data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
              data: {'title':title,'start':start,'end':end,'dish_id':dish,'be_id':be,'plan_id':'2','om_id':om},
              method: "GET",
              dataType: 'json',
              success: function(){
                // event.id = response.eventid;
                // console.log(title);
                // alert('success');
                $('#calendar').fullCalendar('updateEvent',event);
              },
              error: function(e){
                console.log('error');
              }
            });
            $('#calendar').fullCalendar('updateEvent',event);
          },
          eventDrop: function(event, delta, revertFunc) {
            var id = event.id;
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
          eventResize: function(event, delta, revertFunc) {
            // console.log(event);
            var id = event.id;
            // console.log(event.id);
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

        /* initialize the external events
        -----------------------------------------------------------------*/
  // $('#external-events .fc-event').each(function() {
  //   // store data so the calendar knows to render an event upon drop
  //   $(this).data('event', {
  //     title: $.trim($(this).text()), // use the element's text as the event title
  //     stick: true // maintain when user navigates (see docs on the renderEvent method)
  //   });
  //   // make the event draggable using jQuery UI
  //   $(this).draggable({
  //     zIndex: 999,
  //     revert: true,      // will cause the event to go back to its
  //     revertDuration: 0  //  original position after the drag
  //   });
  // });
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



  
</script>





                    
