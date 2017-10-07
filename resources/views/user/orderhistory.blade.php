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

    <div class="main main-raised"  style="width: 65%; float: left">
        <div class="section">
            <div class="container" style="width: 90%;">
                <div class="row">

                   
            <!-- Tabs on Plain Card -->
            <div class="card card-nav-tabs card-plain">
              <div class="header header-success">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <center>
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="active"><a href="#topay" data-toggle="tab" style="font-size: 20px">To Pay</a></li>
                      <li><a href="#toreceive" data-toggle="tab" style="font-size: 20px">To Receive</a></li>
                      <li><a href="#completed" data-toggle="tab" style="font-size: 20px">Completed</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content">
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="topay">
                    <center><h1 style="color:gray">NO ORDERS YET</h1></center>
                  </div>

                  <div class="tab-pane" id="toreceive">
                   <table class="table table-bordered">
                     <thead>
                      <tr>
                      <th colspan="10" style="background: linear-gradient(60deg, #66bb6a, #388e3c)">
                      <span style="color:white">Date & Time Ordered:</span> 04/28/17, 12:36 PM &nbsp;
                       <span style="color:white;">Is order rreceived?</span>
                      <span style="color:white; float:right">Delivering&nbsp;</span>
                      </th>
                      </tr>
                     </thead>

                    <tbody>
                    <tr>
                    <td>
                        <img src="{{asset('img/teriyakichickencasserole.jpg')}}" class="img-responsive img-rounded imagesize" alt="Responsive image">
                        <span style="color:black; float:left; margin-left: 5px;">Teriyaki Chicken Casserole</span><br>
                        <a href="#">
                        <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Cook: Shayne Pedrosa</span>
                         </a><br>
                         <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Quantity: 2</span>
                   </td>

                   <td>Php 140.00</td>
                   <td>
                    <center>
                      <span style="color:black;">Dish Rating</span><br>
                      <small>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star-o" id="rate"></i>
                          <i class="fa fa-star-o" id="rate"></i>
                     </small>
                    </td>
                    </tr>

                            <tr>
                    <td>
                        <img src="{{asset('img/teriyakichickencasserole.jpg')}}" class="img-responsive img-rounded imagesize" alt="Responsive image">
                        <span style="color:black; float:left; margin-left: 5px;">Teriyaki Chicken Casserole</span><br>
                        <a href="#">
                        <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Cook: Shayne Pedrosa</span>
                         </a><br>
                         <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Quantity: 2</span>
                   </td>

                   <td>Php 140.00</td>
                   <td>
                    <center>
                      <span style="color:black;">Dish Rating</span><br>
                      <small>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star-o" id="rate"></i>
                          <i class="fa fa-star-o" id="rate"></i>
                     </small>
                    </td>
                    </tr>

                            <tr>
                    <td>
                        <img src="{{asset('img/teriyakichickencasserole.jpg')}}" class="img-responsive img-rounded imagesize" alt="Responsive image">
                        <span style="color:black; float:left; margin-left: 5px;">Teriyaki Chicken Casserole</span><br>
                        <a href="#">
                        <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Cook: Shayne Pedrosa</span>
                         </a><br>
                         <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Quantity: 2</span>
                   </td>

                   <td>Php 140.00</td>
                   <td>
                    <center>
                      <span style="color:black;">Dish Rating</span><br>
                      <small>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star-o" id="rate"></i>
                          <i class="fa fa-star-o" id="rate"></i>
                     </small>
                    </td>
                    </tr>


         
                  </tbody>
                  </table>




                  </div>

                  <div class="tab-pane" id="completed">
                  <table class="table table-bordered">
                     <thead>
                      <tr>
                      <th colspan="10" style="background: linear-gradient(60deg, #66bb6a, #388e3c)">
                      <span style="color:white">Date & Time Ordered:</span> 04/28/17, 12:36 PM
                        <span style="color:white; float:right">Completed</span>
                      </th>
                      </tr>
                    </thead>

                    <tbody>
                     <tr>
                     <td>
                        <img src="{{asset('img/teriyakichickencasserole.jpg')}}" class="img-responsive img-rounded imagesize" alt="Responsive image">
                        <span style="color:black; float:left; margin-left: 5px;">Teriyaki Chicken Casserole</span><br>
                         <a href="#">
                            <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Cook: Shayne Pedrosa</span>
                          </a><br>
                          <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Quantity: 2</span>
                    </td>

                   <td>Php 140.00</td>

                    <td>
                    <center>
                    <span style="color:black;">Dish Rating</span><br>
                    <small>
                    <i class="fa fa-star" id="rate"></i>
                    <i class="fa fa-star" id="rate"></i>
                    <i class="fa fa-star" id="rate"></i>
                    <i class="fa fa-star-o" id="rate"></i>
                    <i class="fa fa-star-o" id="rate"></i>
                   </small>
                   </td>
                   </tr>

                    <tr>
                     <td>
                        <img src="{{asset('img/teriyakichickencasserole.jpg')}}" class="img-responsive img-rounded imagesize" alt="Responsive image">
                        <span style="color:black; float:left; margin-left: 5px;">Teriyaki Chicken Casserole</span><br>
                         <a href="#">
                            <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Cook: Shayne Pedrosa</span>
                          </a><br>
                          <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Quantity: 2</span>
                    </td>

                   <td>Php 140.00</td>

                    <td>
                    <center>
                    <span style="color:black;">Dish Rating</span><br>
                    <small>
                    <i class="fa fa-star" id="rate"></i>
                    <i class="fa fa-star" id="rate"></i>
                    <i class="fa fa-star" id="rate"></i>
                    <i class="fa fa-star-o" id="rate"></i>
                    <i class="fa fa-star-o" id="rate"></i>
                   </small>
                   </td>
                   </tr>

                  </tbody>
                  </table>

                    <table class="table table-bordered">
                     <thead>
                      <tr>
                      <th colspan="10" style="background: linear-gradient(60deg, #66bb6a, #388e3c)">
                      <span style="color:white">Date & Time Ordered:</span> 04/28/17, 12:36 PM
                        <span style="color:white; float:right">Completed</span>
                      </th>
                      </tr>
                     </thead>

                    <tbody>
                    <tr>
                    <td>
                        <img src="{{asset('img/teriyakichickencasserole.jpg')}}" class="img-responsive img-rounded imagesize" alt="Responsive image">
                        <span style="color:black; float:left; margin-left: 5px;">Teriyaki Chicken Casserole</span><br>
                        <a href="#">
                        <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Cook: Shayne Pedrosa</span>
                         </a><br>
                         <span style="color:black; float:left; margin-left: 5px; font-size: 12px">Quantity: 2</span>
                   </td>

                   <td>Php 140.00</td>
                   <td>
                    <center>
                      <span style="color:black;">Dish Rating</span><br>
                      <small>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star-o" id="rate"></i>
                          <i class="fa fa-star-o" id="rate"></i>
                     </small>
                    </td>
                    </tr>

         
                  </tbody>
                  </table>
            
                  </div>
                </div>
              </div>
            </div>
            <!-- End Tabs on plain Card -->   












       ` </div><!--row!-->
       </div><!--container!-->
      </div><!--section!-->
    </div><!--main raised!-->




 <div class="main main-raised"  style="width: 25%; float: right;">
    <div class="section" style="padding-bottom: 2px">
        <div class="container" style="width: 100%">
                <p style="color: black; float:left; margin-top: -60px;font-size: 21px; font-family: 'Lobster', cursive;">
                <i class="material-icons" style="font-size:21px">shopping_cart</i> &nbsp;Your Cart &nbsp; 
                <span class="badge" style="font-family: verdana; background-color:#30BB6D" id="totalqty">
              {{Cart::count()}}
                </span>
                </p>

                <!-- <span id="current">hello</span><br>
                   <input type="number" min="1" value="1" style="width: 45px; height:20px;" id="qs"> -->

  <div class="row" style="padding-right:8px; padding-left: 8px">
  @if(count(Cart::content()))
@foreach(Cart::content() as $item)
        
        <dl class="dl-horizontal">
            <div id="cartdiv" style="padding-left: 5px">  
              <dt style="margin-left:-65px">
             
         <!--       <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

                 <input type="text" min="1"  style="width: 40px; height:25px;"  name="quantity" value="{{$item->qty}}" autocomplete="off"/>
                  
                   <a class="cart_quantity_up" href='{{url("cart/update?dish_id=$item->id&increment=1")}}'><i class="material-icons"  style="color:#30BB6D">add_circle</i></a>
                   
                  <a class="cart_quantity_down" href='{{url("cart/update?dish_id=$item->id&decrease=1")}}'><i class="material-icons"  style="color:#30BB6D" id="dec">remove_circle</i></a>
                 
               </dt>
           
              <dd style="margin-left: 2px">
                <label style="float: left; margin-left:0px; margin-right: 0px; font-size: 15px; color:black">
                <b>&nbsp;&nbsp;{{$item->name}}</b>
                </label>
                
              
              <a href='{{url("/cart/dish/remove?dish_id=$item->id&remove=true")}}' style="float:right"><i class="fa fa-times" style="color:red"></i></a>
                 
               </dd>

                <dt style="margin-left:-2px">
                <label style="font-size: 12px; color: gray; float:left"> Price: <b id="price">{{$item->price}}</b></label>
                </dt>

                 <dd style="margin-right: 2px">
                <label style="font-size: 12px; color: gray; float:right">Total Amount:<b id="itemamount">{{sprintf("%.2f",$item->subtotal)}}</b></label>
                </dd>

               
          </div>
      </dl>   

          @endforeach
          

          @else
<center><label style="font-size: 30px">Your cart is empty</label>
       
          @endif
      <div id="amounts">
    <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
           <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lato', sans-serif" id="tots">
           <b>Subtotal:</b>&nbsp;Php
           <label style="color:black" id="subtotal">{{Cart::subtotal()}}</label>
           </p>
           <br>
        </div>
         @if(count(Cart::content()))
        <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
          <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lato', sans-serif', cursive;" id="tots">
          <b>Delivery Fee:</b>&nbsp;Php
          <label style="color:black">40.00</label>
          <br>
        </div>
        
        <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
          <p style="float:right; margin-right:2px; font-size: 17px; color:black;font-family: 'Lato', sans-serif" id="tots">
          <b>Total:</b>&nbsp;Php
          <label style="color:black" id="alltotal">{{sprintf("%.2f", Cart::subtotal()+40)}}</label>
          </p>
        </div>
        
            <form method="POST" action="{{url('cart/checkout')}}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:right; margin-top: 2px; border:none" id="chkt">Checkout</button>
              </form>
              
            <form method="POST" action="{{url('cart/clear')}}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-flat btn edit" style="float:left; margin-top: 2px; border:none" id="chkt">Clear Cart
              </button>
              </form>
              

            @else
             <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
          <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lato', sans-serif', cursive;" id="tots">
          <b>Delivery Fee:</b>&nbsp;Php
          <label style="color:black">0.00</label>
          <br>
        </div>
              <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
          <p style="float:right; margin-right:2px; font-size: 17px; color:black;font-family: 'Lato', sans-serif" id="tots">
          <b>Total:</b>&nbsp;Php
          <label style="color:black" id="alltotal">{{sprintf("%.2f", Cart::subtotal())}}</label>
          </p>
        </div>
              <a href="{{url('cart/checkout')}}">
            <button type="submit" class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:right; margin-top: 2px; border:none" id="chkt" disabled>Checkout</button></a>

              <form method="POST" action="{{url('cart/clear')}}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-flat btn edit" style="float:left; margin-top: 2px; border:none" id="chkt" disabled>Clear Cart
              </button>
              </form>

   @endif
            
       
       
        

 </div>
   </div>
      </div>
         </div>







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

