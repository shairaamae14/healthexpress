@extends('user-layouts.master')
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

#rev:hover{
  text-decoration: none !important;
  color:black !important;
}

#load{
  
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
             
             <a href="./home"><button id="ordermode" style="background-color:transparent;  border:2px solid white; font-size: 40px; margin-top:-20px; margin-left:10px; font-family: 'Lobster', cursive; color:white; width: 300px">Express Meal
             </button>
             </a>

        </div>

      
      </div>
    </div>
  </div>

    <div class="main main-raised"  style="width: 65%; float: left">
        <div class="section">
            <div class="container" style="width: 90%;">
                <div class="row">

                <div class="card card-signup">
              <form class="form" method="" action="">
                <div class="header header-success text-center">
                  <h1 style="font-family: Lato">What is your plan range?</h1>
                  <!-- <div class="social-line">
                    <a href="#pablo" class="btn btn-simple btn-just-icon">
                      <i class="fa fa-facebook-square"></i>
                    </a>
                    <a href="#pablo" class="btn btn-simple btn-just-icon">
                      <i class="fa fa-twitter"></i>
                    </a>
                    <a href="#pablo" class="btn btn-simple btn-just-icon">
                      <i class="fa fa-google-plus"></i>
                    </a>
                  </div> -->
                </div>
                <div class="content">
                     <div class="col-sm-6">
                     <div class="form-group label-floating has-success">
                          <label class="control-label">(example: 3 days, 1 week, 1 month)</label>
                          <input type="text" class="form-control" name="lname"  />
                      </div>
                    </div>

                
              

                      </div>
                    </div>

                  <!-- If you want to add a checkbox to this form, uncomment this code

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="optionsCheckboxes" checked>
                      Subscribe to newsletter
                    </label>
                  </div> -->
                  <br>
                  <br>
                </div>
                <div class="footer text-center">
                  <a href="#pablo" class="btn btn-flat btn-success btn-lg">Get Started</a>
                </div>
              </form>
            </div>


                           



        </div><!--row!-->
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

 <div class="row" style="padding-right:8px; padding-left: 8px">
      @if(count(Cart::content()))
      @foreach(Cart::content() as $item) 
        <dl class="dl-horizontal">
            <div id="cartdiv" style="padding-left: 5px">  
              <dt style="margin-left:-65px">
                 <label  name="quantity" style="color:black; margin-right:20px"><b> {{$item->qty}} x</b></label>
                    <a class="cart_quantity_up" href='{{url("cart/update?dish_id=$item->id&increment=1")}}'>
                    <i class="material-icons"  style="color:#30BB6D">add_circle</i></a>
                    <a class="cart_quantity_down" href='{{url("cart/update?dish_id=$item->id&decrease=1")}}'>
                    <i class="material-icons"  style="color:#30BB6D" id="dec">remove_circle</i></a>
               </dt>

              <dd style="margin-left: 2px">
                <label style="float: left; margin-left:0px; margin-right: 0px; font-size: 15px; color:black">
                <b>&nbsp;&nbsp;{{$item->name}}</b>
               <br>{{$item->sidenote}}
                </label>
                <a href='{{url("/cart/dish/remove?dish_id=$item->id&remove=true")}}' style="float:right">
                  <i class="fa fa-trash-o" aria-hidden="true" style="color:black; font-size: 20px"></i>
                </a>
              <!--   <a href="#" data-toggle="modal" data-target="#myModal1" style="float:right">
                    <i class="material-icons" style="color:black;">note_add</i>
                </a> -->
              
               
              </dd>


              <dt style="margin-left:-2px">
                <label style="font-size: 12px; color: gray; float:left"> Price: <b id="price">{{$item->price}} </b></label>
              </dt>

              <dd style="margin-right: 2px">
                <label style="font-size: 12px; color: gray; float:right">Total Amount:<b id="itemamount">{{$item->subtotal}}</b></label>
              </dd>

          </div>
      </dl>   

      @endforeach
      @else
            <center>
            <label style="font-size: 30px">Your cart is empty</label>
            </center>
      @endif
      
          <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
                 <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lato', sans-serif" id="tots">
                 <b>Subtotal:</b>&nbsp;Php
                 <label style="color:black" id="subtotal">{{Cart::subtotal()}}</label>
                 </p>
                 <br>
          </div>
        
      @if(count(Cart::content()))
        
        <!--   <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
              <p style="float:right; margin-right:2px; font-size: 17px; color:black;font-family: 'Lato', sans-serif" id="tots">
              <b>Total:</b>&nbsp;Php
              <label style="color:black" id="alltotal">{{Cart::subtotal()}}</label>
              </p>
          </div> -->

        
        <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
      
               <button class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:right; margin-top: 2px; border:none" id="chkt"data-toggle="modal" data-target="#myModal">
                        Proceed
                      </button>

          <form method="POST" action="{{url('cart/clear')}}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-flat btn edit" style="float:left; margin-top: 2px; border:none" id="chkt">Clear Cart
              </button>
              </form>
        </div>
       

      @else

         <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
           <!--  <a href="{{url('cart/checkout')}}">
            <button type="submit" class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:right; margin-top: 2px; border:none" id="chkt" disabled>Checkout</button>
            </a> -->

             <button  class="btn btn-flat btn-success btn edit" style="float:right; margin-top: 2px; border:none" id="chkt" data-toggle="modal" data-target="#myModal" disabled>
                        Proceed
                      </button>

              <form method="POST" action="{{url('cart/clear')}}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-flat btn edit" style="float:left; margin-top: 2px; border:none" id="chkt" disabled>Clear Cart
              </button>
              </form>
         </div>

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>







$(document).ready(function(){
    $('#quantity').on('keyup change', function() {

        alert('yey');   
    });
    $( "#input" ).autocomplete({
        source: function( request, response ) {
            $.ajax( {
              url: "{{ url('/displayDishes') }}",
              dataType: "json",
              data: {
                term: request.term
              },
              success: function( data ) {

                response($.map(data,function(d) {
                    if(d == 'No dishes found')
                    {
                        return { 
                            label: 'No dishes found.'
                        };
                    }
                    else {
                        return {
                            id: d.did,
                            value: d.dish_name,
                        };    
                    }
                }));
              }
            } );
        },

        select: function( event, ui) {

            this.value = ui.item.value;
            $(this).next("input").val(ui.item.value);
            event.preventDefault();  

            $('#dish_id').val(ui.item.id);

            
            console.log( "Selected: " + ui.item.value + " id " + ui.item.id );
        }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {

            if(item.value == 'No dishes found.'){
                return $('<li class="ui-state-disabled">'+item.label+'</li>').appendTo(ul);
            }else{
                return $("<li>")
                .append("<a>" + item.label + "</a>")
                .appendTo(ul);
            }
        };
        
        
    
  } );

</script>

                    
