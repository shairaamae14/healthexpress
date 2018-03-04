@extends('user-layouts.master')
@section('heading')
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
<style>
  @import url('http://fonts.googleapis.com/css?family=Lobster');
  @import url('http://fonts.googleapis.com/css?family=Anton');
  @import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
  @import url('https://fonts.googleapis.com/css?family=Archivo+Black');

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
   box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3) !important;

 }

 .box-solid img:hover{
   box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3) !important;
   border-radius: 10px !important;
   border:2px solid #30BB6D !important;
 }

 #tots:hover{
  font-size: 20px !important;
}



.form-control, .form-group .form-control {
  background-image: linear-gradient(#30bb6d,#30bb6d), linear-gradient(#d2d2d2, #d2d2d2) !important; 
}



/*Resize the wrap to see the search bar change!*/

div.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  color:grey;
}

/* Change background color of buttons on hover */
div.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
  /*background-color: #ccc;*/
  border-bottom: 2px #30bb6d solid;
  color:black;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

.imagesize{
  width:80px;
  height:80px;
  float:left;
}
  
fieldset, label { margin: 0; padding: 0; }
body{ margin: 20px; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float:left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 3.0em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: orange;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: orange;  } 



/****** Style Star Rating Widget *****/

.rating2 { 
  border: none;
  float:left;
}

.rating2 > input { display: none; } 
.rating2 > label:before { 
  margin: 5px;
  font-size: 3.0em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating2 > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating2 > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating2 > input:checked ~ label, /* show gold star when clicked */
.rating2:not(:checked) > label:hover, /* hover current star */
.rating2:not(:checked) > label:hover ~ label { color: orange;  } /* hover previous stars in list */

.rating2 > input:checked + label:hover, /* hover current star when changing rating */
.rating2 > input:checked ~ label:hover,
.rating2 > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating2 > input:checked ~ label:hover ~ label { color: orange;  } 







</style>
@section('content')
<div class="wrapper">
  <div class="header header-filter" style="background-image: url('{{asset('img/bgindex.jpg')}}')">
    <div class="container">
      <div class="row">
        <center>
          <div class="col-md-6">
            <br>
       <!--    <h1 class="title text-center" style="font-family: 'Lobster', cursive; font-size: 30px;">Choose your order mode:</h1>

            <a href="{{url('/home/express')}}" class=" btn btn-danger btn-raised btn-lg" style="background-color:transparent;border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px " id="ordermode">
            <center> Express Meal</center>
            </a>
                <a href="{{url('/home/planned')}}" class=" btn btn-danger btn-raised btn-lg" id="ordermode" style="background-color:transparent;  border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px ">
             <center>Planned Meal</center>
           </a> -->

         </div>


       </div>
     </div>
   </div>

<div class="main main-raised">
  <div class="section">
    <div class="container">
      <div class="row">
         <a href="{{route('order.orderhistory')}}">
         <button type="submit" class="btn btn-success btn-flat btn-sm" style="margin-top: -10px; float:left">
         View Express Order Status
         </button>
         </a>
          <a href="{{route('pmorder.pastorders')}}">
          <button type="submit" class="btn btn-success btn-flat btn-sm" style="margin-top: -10px; float:right">
          View Order history
          </button>
          </a><br>
        <h1 class="text-left">Planned Meal Order Status</h1>
         <!--     <label>Total Amount:Php 650.00 (static)</label> -->
          <!-- Tabs on Plain Card -->
                <div class="table table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                          <tr>
                          <th style="border:none"><label class="text-center" style="font-size:20px; color:black;"><b>{{$page_title}}</b></label>
                          </th> 
                          <th style="border:none"></th><th style="border:none"></th><th style="border:none"></th><th style="border:none"></th>
                          <th class="text-right" style="border:none">
                               <form id ="sortorder" action ="{{route('user.pmorder.sortOrder')}}" method ="post" style="height:45px; width:100%">
                                {{csrf_field()}}
                               <select id="chooseStatus" class="form-control" name="chooseStatus">
                                <option value="none" class="w" selected disabled hidden>Sort Orders</option>
                                <option value="All" class="w" value = "All">All</option>
                                <option class="w" value = "Pickup">Pickup</option>
                                <option class="w" value = "Pending">Pending</option>
                                <option class="w" value = "Cooking">Cooking</option>
                                <option class="w" value = "Delivering">Delivering</option>
                                <option  class="w" value = "Completed">Completed</option>
                             </select>
                            </form>
                          </th>   
                          </tr>
                            <tr>
                              <th class="text-left">Order</th>
                              <th class="text-left">Start-End</th>
                              <th class="text-left">Mode of Delivery</th>
                              <th class="text-left">Address</th>
                              <th class="text-left">Status</th>
                              <th class="text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($orders as $pu)
                            <tr>
                            <td><img src="{{url('./dish_imgs/'.$pu->dishes['dish_img'])}}"  style="width:30px; height:30px; float:left; margin-right: 10px" class="img-responsive img-rounded imagesize" alt="Responsive image">
                            {{$pu->title}}
                            </td>
                            <td class="text-center"  style="font-size: 13px">
                            {{ Carbon\Carbon::parse($pu->start)->format('Y-M-d H:m') }} to
                            <br>{{ Carbon\Carbon::parse($pu->end)->format('Y-M-d H:m') }}
                            </td>
                             <td class="text-left" style="font-size: 15px">
                            {{$pu->mode_delivery}}
                            </td>
                            <td class="text-left" style="font-size: 15px">
                            {{$pu->address}}
                            </td>
                            <td class="text-center"><span class="badge" style="color:white; background-color:#66bb6a;">{{$pu->order_status}}</span>
                            </td>
                            <td class="text-center">
                              @if($pu->order_status=="Delivering")
                                <center>
                                <form method="post" action="{{route('dish.orderReview')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="dish_id" value="{{$pu->dish_id}}">
                                <input type="hidden" name="uo_id" value="{{$pu->uo_id}}">
                                <button type="submit" rel="tooltip" title="Did you receive your order?" class="btn btn-success btn-flat btn-sm">
                                Order Received
                                </button>
                                 </form>
                                 </center>
                            @else
                              <center>
                                <label  style="font-size:15px;">NO <br>ACTION</label>
                              </center>
                            @endif
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>              
                 
              


             ` </div><!--row!-->
           </div><!--container!-->
         </div><!--section!-->
       </div><!--main raised!-->



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
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- 
<link href="https://ajax.googleapis.com/ajax/libs/angular_material/0.9.4/angular-material.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-aria.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angular_material/0.9.4/angular-material.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.dataTable').DataTable({ 
            "lengthChange": false,
            aoColumnDefs: [
              {
                 bSortable: false,
                 aTargets: [ -1 ]
              }
            ]
        });
      });
</script>
<script>
      $(document).ready(function() {
           $("#chooseStatus").on('change',function(e)
          {
            e.preventDefault();
            // Pace.restart();
            $('#sortorder').submit();
         });
          $(".mode").click(function(e)
          {
            e.preventDefault();
            // Pace.restart();
            $('#chooseMode').submit();
         });
        $( function() {
          $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 500,
            values: [ 75, 300 ],
            slide: function( event, ui ) {
              $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
          });
          $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
            " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        });

        document.getElementById("defaultOpen").click();

        $('#input').on('keyup', function() {
         var input, filter, ul, li, a, i;
         input = document.getElementById("input");
         filter = input.value.toUpperCase();
         ul = document.getElementById("dishNames");
         li = ul.getElementsByTagName("li");
         for ( i = 0; i < li.length; i++) {
           a = li[i].getElementsByTagName("a")[0];
           if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
          } else {
            li[i].style.display = "none";

          }
        }
      });
        $('#sliderDouble').noUiSlider({
          start: [20, 60] ,
          connect: true,
          range: {
            min: 20,
            max: 100
          }
        });
        $('#sort').on('change', function() {
          $value = $('#sort').val();
          if($value == "Best Eaten") {
           $('#bestEaten').show();
         }
       });

        $('#bfast').on('click', function() {
          $('#sortBy').submit();
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


});



</script>

