@extends('user-layouts.master')
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
         <a href="{{route('pmorder.orderhistory')}}" class="btn-simple btn btn-succes"><i class="material-icons">arrow_back</i>Go back to planned meal order status</a>
          <h1 class="text-center" style="color:white; background-color: #4caf50"><b>Order History</b></h1>
              @if(count($done))
                    <table class="table">
                      <thead>
                        <tr>
                         <th>Order</th>
                          <th class="text-center">Quantity</th>
                          <th class="text-center">Total Amount</th>
                          <th class="text-center">Date Ordered</th>
                          <th class="text-center">Mode of Delivery</th>
                          <th class="text-center">Delivery/Pickup Address
                          <th class="text-center">Status</th>

                        </tr>
                      </thead>
                         @foreach($done as $d)
                      <tbody>
                        <tr>
                          <td><img src="{{url('./dish_imgs/'.$d->dishes['dish_img'])}}"  style="width:30px; height:30px; float:left; margin-right: 10px" class="img-responsive img-rounded imagesize" alt="Responsive image">
                            {{$d->dishes['dish_name']}}<br>
                            {{$d->first_name}}&nbsp;{{$d->last_name}}</td>
                             <td class="text-center">{{$d->totalQty}}</td>
                            <td class="text-center">Php {{$d->totalAmount}}</td>
                            <td class="text-center">{{$d->order_date}}</td>
                            <td class="text-center">{{$d->mode_delivery}}</td>
                            <td class="text-center">{{$d->address}}</td>
                            <td class="text-center"><span class="badge" style="color:white; background-color:#66bb6a; float:right">{{$d->order_status}}</span>
                            </td>
                          </tr>

                        </tbody>
                        @endforeach
                      </table>
                      @else
                      <center>
                       <label style="font-size: 35px; margin-top: 20px">You have no past orders</label>
                     </center>
                     @endif   




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

<!-- 
    <link href="https://ajax.googleapis.com/ajax/libs/angular_material/0.9.4/angular-material.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-aria.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/0.9.4/angular-material.min.js"></script> -->











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

