@extends('user-layouts.master')
  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" media="all" href="{{asset('datetimepicker/daterangepicker.css')}}"/>

  
<!-- <link href="{{asset('datetimepicker/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
<link href="{{asset('datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen"> -->
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
          <a href="./home"><button id="ordermode" style="background-color:transparent;  border:2px solid white; font-size: 40px; margin-top:-20px; margin-left:10px; font-family: 'Lobster', cursive; color:white; width: 300px">Express Meal</button>
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
            <h1 style="color:white; background-color: #4caf50"><b>WHAT'S YOUR PLAN?</b></h1>
            <div style="border:2px solid #4caf50; padding:30px;">
              <form role="form" method="post" action="{{route('user.plan.index')}}">
                {{csrf_field()}}
                <center><h3> Please select your type of plan </h3>
                  <select class="form-control plan" id="type" name="type" style="width:250px; height:60px; border:2px solid #4caf50; font-size: 20px; ">
                    <option></option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                  </select>
                  <div class="ask" id="ask">
                    <!--numberofquestiongoeshere!-->
                  </div>
                  <a href="" style="color:white; text-decoration: none; font-size: 20px"><button type="submit" class="btn btn-flat savebtn" style="background-color: #4caf50" disabled>Next</button></a>
                </center>
              </form>
            </div>
          </div><br><br><!--content!-->
        </div><!--row!-->
      </div><!--container!-->
    </div><!--section!-->
  </div><!--main-raised!-->
</div><!--wrapper-->
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
  <!--datetimepicker!-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="{{asset('datetimepicker/moment.js')}}"></script>
      <script type="text/javascript" src="{{asset('datetimepicker/daterangepicker.js')}}"></script>



 <!--  <script type="text/javascript" src="{{asset('datetimepicker/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('datetimepicker/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('datetimepicker/js/locales/bootstrap-datetimepicker.fr.js')}}" charset="UTF-8">
</script> -->
  <script>
    $(document).ready(function(){
      $('.plan').change(function(e){
        e.preventDefault();
         var val = $(".plan option:selected").val();
        if(val=="daily"){
         document.getElementById('ask').innerHTML="<center><div class='col-md-4 col-md-offset-2 demo'><h4>Your Date Range Picker</h4> <input type='text' name='daterange' id='config-demo' class='form-control'><i class='fa fa-calendar'></i></div><br>";
         $('.savebtn').removeAttr('disabled');  
        }
        else if(val=="weekly"){
         document.getElementById('ask').innerHTML="<center><h3>How many weeks? </h3><input type='number' style='width:70px; height:50px; border:2px solid #4caf50; font-size: 25px;' placeholder='1'>";
          $('.savebtn').removeAttr('disabled'); 
        }
        else{
         document.getElementById('ask').innerHTML="<center><h3> How many months?</h3><input type='number' style='width:70px; height:50px; border:2px solid #4caf50; font-size: 25px;' placeholder='1'>";
          $('.savebtn').removeAttr('disabled'); 
        }
      })
    });
  </script>

 <script>
 $(document).ready(function(){
 $('.plan').change($(function() {
 $('#config-demo').daterangepicker(options, function(start, end, label) { console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')'); });
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
@endsection



                    
