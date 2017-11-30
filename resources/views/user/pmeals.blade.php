@extends('user-layouts.master')
<link href="{{asset('datetimepicker/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
<link href="{{asset('datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
@section('heading')
 <!-- Calendar -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
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
 
            <div class="card" style="width:30rem; margin-left: 5px; padding:10px">
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
              <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
              <label class="card-title text-center" style="color:#4caf50;">Breakfast</label>
              <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
              <div class="card" style="margin-bottom: 10px">
                <div class="card-block">
                  <input type="checkbox" style="float:left; margin-top:15px; margin-right: 8px; margin-left: 8px">
                  <img src="{{asset('img/tunapatties.jpg')}}" style="width:50px; height:50px; float:left; margin: 5px"/>
                  <label style="color:black" name="dish_id" value="1">Tuna patties</label><br>
                  <label class="control-label">SMALL DESCRIPTION</label>
                </div><!--cardblock!-->
                <div class="form-group">
                 <!--STARTDATETIME!-->
                  <div class="input-group date form_datetime col-md-5" data-date="2017-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input class="form-control" size="16" type="text" value="" placeholder="start date" style="width:150px; font-size:10px" name="start" readonly>
                    <span class="input-group-addon"><span class="fa fa-times" aria-hidden="true"></span></span>
                    <span class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></span>
                  </div>
                  <input type="hidden" id="dtp_input1" value="" /><br/>
                 <!--ENDDATETIME!-->
                  <div class="input-group date form_datetime col-md-5" data-date="2017-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input class="form-control" size="16" type="text" value="" placeholder="end date" style="width:150px; font-size:10px" name="end" readonly>
                    <span class="input-group-addon"><span class="fa fa-times" aria-hidden="true"></span></span>
                    <span class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></span>
                  </div>
                  <input type="hidden" id="dtp_input1" value="" /><br/>
                </div><!--datetime!-->
              </div><!--CARD!-->
              <!--endofbfast!-->
              <!--LUNCH-->
              <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
              <label class="card-title text-center" style="color:#4caf50;">Lunch</label>
              <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
              <div class="card" style="margin-bottom: 10px">
                <div class="card-block">
                  <input type="checkbox" style="float:left; margin-top:15px; margin-right: 5px; margin-left: 5px">
                  <img src="{{asset('img/tunapatties.jpg')}}" style="width:50px; height:50px; float:left; margin: 5px"/>
                  <label style="color:black">Teriyaki Chicken Casserole</label><br>
                </div><!--cardblock!-->
                <div class="form-group">
                  <div class="input-group date form_datetime col-md-5" data-date="2017-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input class="form-control" size="16" type="text" value="" placeholder="choose schedule" style="width:180px; font-size:12px" readonly>
                    <span class="input-group-addon"><span class="fa fa-times" aria-hidden="true"></span></span>
                    <span class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></span>
                  </div>
                  <input type="hidden" id="dtp_input1" value="" /><br/>
                </div><!--CALENDAR!-->
              </div><!--CARD!-->
              <!--endoflunch!-->
              <!--DINNER-->
             
              <!--ENDOF!-->
              <h3 style="border-bottom: 1px solid #4caf50; margin-top: 1px"></h3>
              <div class="card-block">
                <button type="submit" class="btn btn-success btn-flat">Save Schedule</button>
              </div>
              </form>
              </div>

         
          <div class="card" style="width:80rem; float:right; margin-left: 5px; padding:10px">
            @if($type == 'daily')
              <div id="daily">
                {!! $calendar->calendar() !!}
              </div>
              <script>
                $(document).ready(function(){
                  $('#daily').fullCalendar({
                                    "defaultView":"agendaDay",
                                    "header":{"left":"prev,next today",
                                                    "center":"title",
                                                    "right":"agendaDay"
                                    },
                                    "editable":true,
                                    "droppable":true,
                                    "eventLimit":true,
                                    "events":[{"id":null,"title":"Hello","allDay":false,"start":"2017-11-11T08:00:00+00:00","end":"2017-11-11T09:00:00+00:00"},{"id":null,"title":"Another","allDay":false,"start":"2017-11-09T12:00:00+00:00","end":"2017-11-09T13:00:00+00:00"}]
                  });
                });
              </script>
            @elseif($type == 'weekly')
              <div id="weekly">
                {!! $calendar->calendar() !!}
              </div>
              <script>
                $(document).ready(function(){
                  $('#weekly').fullCalendar({
                                      "defaultView":"agendaWeek",
                                      "header":{"left":"prev,next today",
                                                        "center":"title",
                                                        "right":"agendaWeek"
                                      },
                                      "editable":true,
                                      "droppable":true,
                                      "eventLimit":true,
                                      "events":[{"id":null,"title":"Hello","allDay":false,"start":"2017-11-11T08:00:00+00:00","end":"2017-11-11T09:00:00+00:00"},{"id":null,"title":"Another","allDay":false,"start":"2017-11-09T12:00:00+00:00","end":"2017-11-09T13:00:00+00:00"}]
                  });
                });
              </script>
            @else
              <div id="monthly">
                {!! $calendar->calendar() !!}
              </div>
              <script>
                $(document).ready(function(){
                  $('#monthly').fullCalendar({
                                      "defaultView":"month",
                                      "header":{"left":"prev,next today",
                                                      "center":"title",
                                                      "right":"month"
                                      },
                                      "editable":true,
                                      "droppable":true,
                                      "eventLimit":true,
                                      "events":[{"id":null,"title":"Hello","allDay":false,"start":"2017-11-11T08:00:00+00:00","end":"2017-11-11T09:00:00+00:00"},{"id":null,"title":"Another","allDay":false,"start":"2017-11-09T12:00:00+00:00","end":"2017-11-09T13:00:00+00:00"}]
                  });
                });
              </script>
            @endif
          </div>
        </div><br><br><!--content!-->
      </div><!--row!-->
    </div><!--section!-->
  </div><!--main raised!-->
</div><!--wrapper!-->
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

<!-- <script>


$(document).ready(function(){
    $(".form-addcart").submit(function(e)
    {

      // alert('hello');
     e.preventDefault();
      var that= $(this),
         url=that.attr('action'),
         type=that.attr('method'),
         data={};
    
    $(this).find('[name]').each(function(index, value){
      var that=$(this),
          name=that.attr('name'),
          value=that.val();

          data[name]=value;
    });

    console.log(data);
  


$.ajax({
        url:url,
        type:type,
        data:data,
        sucess:function(response){
           console.log(data);
        }
    });
    return false;
  });
  });

</script> -->
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





                    
