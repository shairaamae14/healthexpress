@extends('user-layouts.master')
@section('heading')
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- <link href="{{asset('css/bootstrap2.css')}}" rel="stylesheet" /> -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
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
  .heading{
    color:black;
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
      @if(session('success'))
               <div class="alert alert-success">
                 <div class="container">
                    <div class="alert-icon">
                        <i class="material-icons">check</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <b>Success!</b> {{session('success')}}
                </div>
            </div>
        @endif
        <a href="{{route('pmorder.orderhistory')}}">
        <button type="submit" class="btn btn-success btn-flat btn-sm" style="margin-top: -10px; float:left">
        View Planned Meal Status
        </button>
        </a>
        <a href="{{route('order.pastorders')}}">
        <button type="submit" class="btn btn-success btn-flat btn-sm" style="margin-top: -10px; float:right">
        View Order history
        </button>
        </a><br>
        <h1 class="text-left">Express Order Status</h1>
        <!-- Tabs on Plain Card -->
                <div class="form-inline">
                <form id ="sortorder" action ="{{route('user.order.sortOrder')}}" method ="post">
                    {{csrf_field()}}
                    <!-- <input type="radio" name="chooseStatus" value="Pending">
                    <label style="font:color:black">PENDING</label>
                    <input type="radio" name="chooseStatus" value="Cooking">
                    <label style="font:color:black">Cooking</label>
                    <input type="radio" name="chooseStatus" value="Delivering">
                    <label style="font:color:black">Delivering</label>
                    <input type="radio" name="chooseStatus" value="Completed">
                    <label style="font:color:black">Completed</label> -->
                    <select id="chooseStatus" class="form-control" name="chooseStatus">
                        <option value="none" class="w" selected disabled hidden>Sort Orders</option>
                        <option value="All" class="w" value = "All">All</option>
                        <option class="w" value = "Pending">Pending</option>
                        <option class="w" value = "Cooking">Cooking</option>
                        <option class="w" value = "Delivering">Delivering</option>
                        <option  class="w" value = "Completed">Completed</option>
                    </select>
                     </form>
                </div>
           
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      
                        <thead>
                            <tr>
                                 <th class="text-center">Quantity</th>
                                <th>Order</th>
                                <th>Amount</th>
                                <th class="text-center">Date Ordered</th>
                                <th class="text-center">Delivery Address</th>
                                <th class="text-center">Status</th>
                                <th class="disabled-sorting text-center">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($orders)
                            @foreach($orders as $order)
                            <tr>
                              <td class="text-center">{{$order->totalQty}}</td>
                                  <td>
                                  <label style="font-size:10px; margin-bottom:0px">Cook:{{$order->dishes->cook['first_name']}}&nbsp;{{$order->dishes->cook['last_name']}}</label><br>
                                    <img src="{{url('./dish_imgs/'.$order->dishes['dish_img'])}}"  style="width:30px; height:30px; float:left; margin-right: 10px" class="img-responsive img-rounded imagesize" alt="Responsive image">
                                  {{$order->dishes['dish_name']}}<br>
                                </td>
                                <td>Php {{$order->totalAmount}}</td>
                                <td class="text-center">{{$order->order_date}}</td>
                                <td class="text-center">{{$order->address}}</td>
                                <td class="text-center"><span class="badge" style="color:white; background-color:#66bb6a;">{{$order->order_status}}</span></td>
                                <td>
                                @if($order->order_status=="Pending")
                                @if($order->created_at->diffInMinutes(Carbon\Carbon::now())<=15)
                                <a href="{{route('order.cancel',  ['id'=>$order->uo_id])}}" class="btn btn-flat btn-danger btn-sm">Cancel Order</a> 
                                @else
                                    <button href="#" class="btn btn-flat btn-danger btn-sm" disabled>Cancel Order</button>
                                @endif
                                @endif
                                @if($order->order_status=="Delivering")
                                <form method="post" action="{{route('dish.orderReview')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="dish_id" value="{{$order->dishes['did']}}">
                                <input type="hidden" name="uo_id" value="{{$order->uo_id}}">
                                <button type="submit" rel="tooltip" title="Did you receive your order?" class="btn btn-success btn-flat btn-sm">
                                Order Received
                                </button>
                                 </form>
                                @endif
                                </td>
                                
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>    
        
      </div>
      <!--row!-->
    </div>
    <!--container!-->
  </div>
  <!--section!-->
</div>
<!--main raised!-->
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
        //  $('input[type=radio]').on('change', function() {
        //     $(this).closest("form").submit();
        // });
          $("#chooseStatus").on('change',function(e)
         {
            e.preventDefault();
            // Pace.restart();
            $('#sortorder').submit();

         });
      });
</script>
<script>
  $(document).ready(function() {
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
    } );
  
  
  
  
  
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
  
  
  
  
  
  //          $.ajax({
  //              method: "post",
  //              data: { '_token': CSRF_TOKEN,
  //                  
  //              },
  //            success: function() {
  //                
  //            },
  //            error: function() {
  //                alert('An error occured');
  //            }
  //          });
  });
  
  
  
</script>