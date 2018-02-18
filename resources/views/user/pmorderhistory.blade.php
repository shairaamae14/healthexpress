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
        <h1 class="text-left" style="color:#66bb6a">Planned Meal Order Status</h1>
         <!--     <label>Total Amount:Php 650.00 (static)</label> -->
          <!-- Tabs on Plain Card -->
          <div class="card card-nav-tabs card-plain">
            <div class="header header-success">
              <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <center>
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li><a href="#pickup" data-toggle="tab" style="font-size: 15px">To pick up</a></li>
                      <li><a href="#pending" data-toggle="tab" style="font-size: 15px">Pending</a></li>
                      <li><a href="#cooking" data-toggle="tab" style="font-size: 15px">On Process</a></li>
                      <li><a href="#delivering" data-toggle="tab" style="font-size: 15px">To Receive</a></li>
                      <li><a href="#completed" data-toggle="tab" style="font-size: 15px">Completed</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content">
                <div class="tab-content text-center"> 
                <!--to pickup!-->
                  <div class="tab-pane active" id="pickup">
                  @if(count($pickup))
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Order</th>
                          <th class="text-center">Start</th>
                          <th class="text-center">End</th>
                          <th class="text-center">Mode</th>
                          <th class="text-center">Pickup Address</th>
                          <th class="text-right">Status</th>

                        </tr>
                      </thead>
                          @foreach($pickup as $pu)
                      <tbody>
                        <tr>
                          <!-- <td class="text-center">1</td> -->
                          <td><img src="{{url('./dish_imgs/'.$pu->dishes['dish_img'])}}"  style="width:30px; height:30px; float:left; margin-right: 10px" class="img-responsive img-rounded imagesize" alt="Responsive image">
                            {{$pu->title}}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($pu->start)->format('Y-M-d H:m') }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($pu->end)->format('Y-M-d H:m') }}</td>
                            <td class="text-center">{{$pu->mode_delivery}}</td>
                            <td class="text-center">{{$pu->address}}</td>
                            <td class="text-right"><span class="badge" style="color:white; background-color:#66bb6a; float:right">{{$pu->order_status}}</span></td>
                          </tr>

                        </tbody>
                        @endforeach
                      
                     
                      </table>
                      @else
                      <center>
                       <label style="font-size: 35px; margin-top: 20px">No orders to be picked up</label>
                     </center>
                   @endif
                   </div>    
                   <!--END!-->

                  <!--TO PAY/PENDING!-->
                  <div class="tab-pane" id="pending">

                  @if(count($pending))
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Order</th>
                          <th class="text-center">Start</th>
                          <th class="text-center">End</th>
                          <th class="text-center">Mode</th>
                          <th class="text-center">Delivery Address</th>
                          <th class="text-center">Delivery Fee</th>
                          <th class="text-right">Status</th>


                        </tr>
                      </thead>
                          @foreach($pending as $mode => $pen)
                            <!-- {{$mode}} -->
                          @endforeach
                          @foreach($pending as $p)
                      <tbody>
                        <tr>
                          <!-- <td class="text-center">1</td> -->
                          <td><img src="{{url('./dish_imgs/'.$p->dishes['dish_img'])}}"  style="width:30px; height:30px; float:left; margin-right: 10px" class="img-responsive img-rounded imagesize" alt="Responsive image">
                            {{$p->title}}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($p->start)->format('Y-M-d H:m') }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($p->end)->format('Y-M-d H:m') }}</td>
                              <td class="text-center">{{$p->mode_delivery}}</td>
                            <td class="text-center">{{$p->address}}</td>
                            <td class="text-center">{{$p->delivery_fee}}</td>
                            <td class="text-right"><span class="badge" style="color:white; background-color:#66bb6a; float:right">{{$p->order_status}}</span></td>
                          </tr>

                        </tbody>
                        @endforeach
                      
                     
                      </table>
                      @else
                      <center>
                       <label style="font-size: 35px; margin-top: 20px">No orders has been placed</label>
                     </center>
                   @endif
                   </div>    
                   <!--END!-->



                   <!--COOKING/ON PROCESS!-->
                   <div class="tab-pane" id="cooking">
                   @if(count($cooking))
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Order</th>
                          <th class="text-center">Start</th>
                          <th class="text-center">End</th>
                          <th class="text-center">Mode</th>
                          <th class="text-center">Delivery Address</th>
                          <th class="text-center">Delivery Fee</th>
                          <th class="text-right">Status</th>

                        </tr>
                      </thead>
                         @foreach($cooking as $c)
                      <tbody>
                        <tr>
                          <!-- <td class="text-center">1</td> -->
                          <td><img src="{{url('./dish_imgs/'.$c->dishes['dish_img'])}}"  style="width:30px; height:30px; float:left; margin-right: 10px" class="img-responsive img-rounded imagesize" alt="Responsive image">
                            {{$c->title}}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($c->start)->format('Y-M-d H:m') }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($c->end)->format('Y-M-d H:m') }}</td>
                              <td class="text-center">{{$c->mode_delivery}}</td>
                            <td class="text-center">{{$c->address}}</td>
                            <td class="text-center">{{$c->delivery_fee}}</td>
                            <td class="text-right"><span class="badge" style="color:white; background-color:#66bb6a; float:right">{{$c->order_status}}</span></td>
                          </tr>

                        </tbody>
                        @endforeach
                      
                     
                      </table>
                      @else
                      <center>
                       <label style="font-size: 35px; margin-top: 20px">You have no orders on processed</label>
                     </center>
                   @endif
                   </div>    
                   <!--END!-->

                   <!--COOKING/ON PROCESS!-->
                   <div class="tab-pane" id="delivering">
                   @if(count($delivering))
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Order</th>
                          <th class="text-center">Start</th>
                          <th class="text-center">End</th>
                          <th class="text-center">Mode</th>
                          <th class="text-center">Delivery Address</th>
                          <th class="text-center">Delivery Fee</th>
                          <th class="text-right">Status</th>



                        </tr>
                      </thead>
                         @foreach($delivering as $d)
                      <tbody>
                        <tr>
                          <!-- <td class="text-center">1</td> -->
                          <td><img src="{{url('./dish_imgs/'.$d->dishes['dish_img'])}}"  style="width:30px; height:30px; float:left; margin-right: 10px" class="img-responsive img-rounded imagesize" alt="Responsive image">
                            {{$d->title}}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($d->start)->format('Y-M-d H:m') }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($d->end)->format('Y-M-d H:m') }}</td>
                            <td class="text-center">{{$p->mode_delivery}}</td>
                            <td class="text-center">{{$p->address}}</td>
                            <td class="text-center">{{$p->delivery_fee}}</td>
                            <td class="text-right"><span class="badge" style="color:white; background-color:#66bb6a; float:right">{{$d->order_status}}</span></td>
                            <td class="td-actions text-right">
                           <!--   <a href="{{route('dish.pmorderReview', ['id'=> $d->did])}}" rel="tooltip" title="Did you receive your order?" class="btn btn-success btn-flat btn-sm" style="margin-top:-1px; margin-left:10px">
                              Order Received
                              </button>
                              </form> -->
                            <!-- Order Received -->
                                <form method="post" action="{{route('dish.pmorderReview')}}">
                                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                     <input type="hidden" name="dish_id" value="{{$d->dish_id}}">
                                      <button type="submit" rel="tooltip" title="Did you receive your order?" class="btn btn-success btn-flat btn-sm" style="margin-top:-1px; margin-left:10px">
                          Order Received
                          </button>
                        </form>
                           </td>
                          </tr>
                        </tbody>
                        @endforeach
                      </table>
                      @else
                      <center>
                       <label style="font-size: 35px; margin-top: 20px">You have no orders to be received</label>
                     </center>
                   @endif
                   </div>    
                   <!--END!-->





                   <!--COMPLETED!-->
                   <div class="tab-pane" id="completed">
                   @if(count($completed))
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Order</th>
                          <th class="text-center">Start</th>
                          <th class="text-center">End</th>
                          <th class="text-center">Mode</th>
                          <th class="text-center">Delivery/Pickup Address</th>
                          <th class="text-center">Delivery Fee</th>
                          <th class="text-right">Status</th>

                        </tr>
                      </thead>
                         @foreach($completed as $com)
                      <tbody>
                        <tr>
                          <!-- <td class="text-center">1</td> -->
                          <td><img src="{{url('./dish_imgs/'.$com->dishes['dish_img'])}}"  style="width:30px; height:30px; float:left; margin-right: 10px" class="img-responsive img-rounded imagesize" alt="Responsive image">
                            {{$com->title}}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($com->start)->format('Y-M-d H:m') }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($com->end)->format('Y-M-d H:m') }}</td>
                            <td class="text-center">{{$com->mode_delivery}}</td>
                            <td class="text-center">{{$com->address}}</td>
                            <td class="text-center">{{$com->delivery_fee}}</td>
                            <td class="text-right"><span class="badge" style="color:white; background-color:#66bb6a; float:right">{{$com->order_status}}</span></td>
                          </tr>

                        </tbody>
                        @endforeach
                      
                     
                      </table>
                      @else
                      <center>
                       <label style="font-size: 35px; margin-top: 20px">You have no orders completed</label>
                     </center>
                   @endif
                   </div>    
                   <!--END!-->



                 </div>
               </div>
             </div>
             <!-- End Tabs on plain Card -->   


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

