@extends('user-layouts.master')

<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
  
<!-- <link href="{{asset('datetimepicker/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
<link href="{{asset('datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen"> -->
<style>
@import url('https://fonts.googleapis.com/css?family=Lobster');
@import url('https://fonts.googleapis.com/css?family=Anton');
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
            <div>
              <form role="form" method="get" action="{{route('user.plan.index')}}">
                {{csrf_field()}}
                <center><h3> Please select date range for your plan: </h3>
                    <div class='col-md-4 col-md-offset-2 demo'><h4>Your Date Range Picker</h4> <input type='text' name='daterange' id='config-demo' class='form-control'><i class='fa fa-calendar'></i></div><br>
                  <div class="ask" id="ask">
                    <!--numberofquestiongoeshere!-->
                  </div>
                  <a href="" style="color:white; text-decoration: none; font-size: 20px"><button type="submit" class="btn btn-flat savebtn" style="background-color: #4caf50" disabled>Next</button></a>
                </center>
              </form>
            </div>
          </div><br><br><!--content!-->
        </div><!--row!-->

        <div class="section text-center" id="works">
               <div class="features">
            <div class="row">
                        <div class="col-md-4">
                <div class="info">
                  <div class="icon icon-primary">
                    <i class="material-icons">chat</i>
                  </div>
                  <h4 class="info-title">First Feature</h4>
                  <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                </div>
                        </div>
                        <div class="col-md-4">
                <div class="info">
                  <div class="icon icon-success">
                    <i class="material-icons">verified_user</i>
                  </div>
                  <h4 class="info-title">Second Feature</h4>
                  <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                </div>
                        </div>
                        <div class="col-md-4">
                <div class="info">
                  <div class="icon icon-danger">
                    <i class="material-icons">fingerprint</i>
                  </div>
                  <h4 class="info-title">Third Feature</h4>
                  <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                </div>
                        </div>
                    </div>
          </div>
            </div>
      </div><!--container!-->
    </div><!--section!-->
  </div><!--main-raised!-->
</div><!--wrapper-->
@endsection

@section('addtl_scripts')
<!--   Core JS Files   -->
  <!-- <script src="{{asset('customer/assets/js/jquery.min.js')}}" type="text/javascript"></script> -->
  <script src="{{asset('customer/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('customer/assets/js/material.min.js')}}"></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('customer/assets/js/nouislider.min.js')}}" type="text/javascript"></script>

  <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
  <script src="{{asset('customer/assets/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>

  <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
  <script src="{{asset('customer/assets/js/material-kit.js')}}" type="text/javascript"></script>
  <script>
    $(document).ready(function(){
      $('.plan').change(function(e){
        e.preventDefault();
         
      })

      $('#config-demo').on('change', function(e) {
        e.preventDefault();
        $('.savebtn').removeAttr('disabled');  
      });
      $('input[name="daterange"]').daterangepicker({
                "startDate": "01/24/2018",
                "endDate": "01/30/2018"
            }, function(start, end, label) {
              console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
            });

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
    });
  </script>
@endsection



                    
