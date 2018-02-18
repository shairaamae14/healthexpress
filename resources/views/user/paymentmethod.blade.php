@extends('user-layouts.master')
<link href="{{asset('css/smart_wizard_vertical.css')}}" rel="stylesheet" type="text/css">


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

 .name{
 overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
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
                    <h1 class="title text-left" style="font-size: 80px; font-family: 'Lobster', cursive;">Express Order</h1>

                     <a href="{{route('user.plan.home')}}"><button id="ordermode" style="background-color:transparent;  border:2px solid white; font-size: 40px; margin-top:-20px; margin-left:10px; font-family: 'Lobster', cursive; color:white; width: 300px">Planned Meal
                     </button>
                     </a>


                </div>
        </div>


    </div>
  </div>
</div>

<div class="main main-raised"  style="width: 65%; float: left">
  <div class="section">
    <div class="container" style="width: 100%;">
      <div class="row">
     <h1 class="text-center" style="color:#30bb6d">PAYMENT METHOD</h1><br>
        <div class="col-md-6 col-md-offset-3" style="padding-top: 20px"> 
          <div class="profile-tabs" id="tabpayment">
            <div class="nav-align-center">
              <ul class="nav nav-pills nav-pills-success" role="tablist">
                <li class="active">
                  <a href="#cod" role="tab" data-toggle="tab">
                    Cash On Delivery 
                  </a>
                </li>
                <li>
                  <a href="#cdc" role="tab" data-toggle="tab">
                    Credit / Debit Card
                  </a>
                </li>
              </ul>

              <div class="tab-content gallery">
                <div class="tab-pane active" id="cod">
                  <div class="row">

                    <form method="POST" action="{{route('order.place')}}">
                      {{csrf_field()}}
                      @if(count(Cart::content()))
                      @foreach(Cart::content() as $item)
                            <input type="hidden" name="dish[]" value="{{$item->id}}">
                            <input type="hidden" name="total[]" value="{{$item->subtotal}}">
                            <input type="hidden" name="qty[]" value="{{$item->qty}}">
                            <input type="hidden" name="order_date" value="{{\Carbon\Carbon::now('Asia/Manila')}}">
                            <input type="hidden" name="payment_mode" value="COD">
                            <input type="hidden" name="address" value="{{$address}}">
                            <input type="hidden" name="contact" value="{{$contactnum}}">
                            <input type="hidden" name="mode_delivery" value="{{$mode_delivery}}">
                            <input type="hidden" name="delivery_fee" value="{{$totaldelfee}}">
                            <input type="hidden" name="sidenote[]" value="{{$item->sidenote}}">
                            <input type="hidden" name="lat" value="{{$lat}}">
                            <input type="hidden" name="long" value="{{$long}}">
                      
                      @endforeach
                      @endif

                      <div class="col-md-6 col-md-offset-3">
                          <h3>Payment will be cash on delivery.</h3>
                        <button type="submit" class="btn btn-success">FINISH CHECKOUT</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="tab-pane text-center" id="cdc">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="text-description">
                       We take data privacy and security very seriously. We want to reassure you that we
                           do not save your credit card details in our system - We use a 3rd party billing solution to ensure
                            all financial transactions are safe and secure.
                            You can read more about it here. 
                      </div>
                      
                        <form method="POST" id="payment-form" action="{{ route('order.payment') }}">
                            {{csrf_field()}}
                            @foreach(Cart::content() as $item)
                            <input name="amount" value="{{Cart::subtotal()}}" type="hidden">
                            @endforeach
                            @if(count(Cart::content()))
                            @foreach(Cart::content() as $item)
                            {{-- @foreach($userorder as $order) --}}
                            <input type="hidden" name="dish[]" value="{{$item->id}}">
                            <input type="hidden" name="total[]" value="{{$item->subtotal}}">
                            <input type="hidden" name="qty[]" value="{{$item->qty}}">
                            <input type="hidden" name="order_date" value="{{\Carbon\Carbon::now('Asia/Manila')}}">
                            <input type="hidden" name="payment_mode" value="COD">
                            <input type="hidden" name="address" value="{{$address}}">
                            <input type="hidden" name="contact" value="{{$contactnum}}">
                            <input type="hidden" name="mode_delivery" value="{{$mode_delivery}}">
                            <input type="hidden" name="delivery_fee" value="{{$totaldelfee}}">
                            <input type="hidden" name="sidenote[]" value="{{$item->sidenote}}">
                            <input type="hidden" name="lat" value="{{$lat}}">
                            <input type="hidden" name="long" value="{{$long}}">
                            {{-- <input type="hidden" name="delivery_fee" id="del_fee1" value=""> --}}
                            @endforeach
                            @endif
                        <div id="dropin-container"></div>
                  
                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button id="submit-button" class="btn btn-success">Finish and Pay</button>
                        </form>
                        
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Profile Tabs -->
        </div>     
        </div>
        
      </div>
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
               <div class="row" style="padding-right:8px; padding-left: 8px;">
                 @if(count(Cart::content()))
                   @foreach(Cart::content() as $item) 
                   <div class="col-md-12">
                       <label style="font-size: 12px"><b>Cook:{{$item->cookname}}</b></label>
                   </div>
                     <!-- <div class="col-md-6">
                   <label  name="quantity" style="color:black; margin-right:20px"><b>{{$item->qty}} x </b></label>
                   </div> -->
                   <div class="col-sm-6">
                    <label class="name" style="float: left; font-size: 15px; color:black"><b class="name">{{$item->qty}} x {{$item->name}}</b><br></label>
                   </div>
                   <div class="col-md-12">
                   @if($item->sidenote)
                    <label style="font-size: 12px"><b>Side note:{{$item->sidenote}}</b></label>
                  @else
                    <label></label>
                  @endif
                  </div>
                   <div class="col-md-12" style="border-bottom: 1px solid #e5e5e5">
                       <label style="font-size: 12px; color: gray; float:left"> Price: <b id="price">{{$item->price}}.00</b></label>
                       <label style="font-size: 12px; color: gray; float:right">Total Amount:<b id="itemamount">Php {{$item->subtotal}}.00</b></label>
                   </div>
                   @endforeach
                     @else
                      <center>
                        <label style="font-size: 30px">Your cart is empty</label>
                      </center>
                   @endif
                 </div><br>
                  <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
                         <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lato', sans-serif" id="tots">
                         <b>Subtotal:</b>&nbsp;Php
                         <label style="color:black" id="subtotal" value="{{Cart::subtotal()}}">{{Cart::subtotal()}}</label>
                         </p><br>
                         <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lato', sans-serif" id="tots">
                         <b>Total Delivery Fee:</b>&nbsp;Php
                         <label style="color:black" id="delfee">{{$totaldelfee}}</label>
                         </p><br>
                         <!-- <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lato', sans-serif" id="tots">
                         <b>Total:</b>&nbsp;Php
                         <label style="color:black" id="total"></label>
                         </p> -->
                         <br>
                   </div>
                 @if(count(Cart::content()))
                 <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
                       <form method="post" action="{{route('express.summary')}}">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          @foreach(Cart::content() as $item)
                                          <input name="amount" value="{{Cart::subtotal()}}" type="hidden">
                                          @endforeach
                                          @if(count(Cart::content()))
                                          @foreach(Cart::content() as $item)
                                          <input type="hidden" name="dish[]" value="{{$item->id}}">
                                          <input type="hidden" name="cook_id[]" value="{{$item->cook_id}}">
                                          <input type="hidden" name="total[]" value="{{$item->subtotal}}">
                                          <input type="hidden" name="qty[]" value="{{$item->qty}}">
                                          <input type="hidden" name="order_date" value="{{\Carbon\Carbon::now('Asia/Manila')}}">
                                          <input type="hidden" name="payment_mode" value="COD">
                                          <input type="hidden" name="delivery_fee" id="del_fee1" value="">
                                          <input type="hidden" name="address" value="{{$address}}">
                                          @endforeach
                                          @endif
                        
                   </div>
                @endif
            </div>
        </div>
    </div>
  </div>
       
       

@endsection

@section('addtl_scripts')

<script src="https://js.braintreegateway.com/web/dropin/1.8.0/js/dropin.min.js"></script>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://js.braintreegateway.com/web/dropin/1.8.0/js/dropin.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.28.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.28.0/js/paypal-checkout.min.js"></script>
<script type="text/javascript" src="{{asset('js/jquery-2.0.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('js/pace.min.js')}}"></script>
<script>
    var form = document.querySelector('#payment-form');

    braintree.dropin.create({
      authorization: '{{ $clientToken }}',
      selector: '#dropin-container',
          paypal: {
            flow: 'vault'
        }
    }, function (createErr, instance) {
      form.addEventListener('submit', function (event) {
          event.preventDefault();
          
        instance.requestPaymentMethod(function (err, payload) {
            if (err) {
                console.log('Request Payment Method Error', err);
                return;
            }
            
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();
        });
      });
    });
    paypal.Button.render({
      braintree: braintree,
      client: {
        sandbox: '{{ $clientToken }}'
      },
      env: 'sandbox'
    })
  </script>
<script>
 $(document).ready(function(e){
   $('.service').on('change','input', function() {
   var option = $('input[name=option]:checked').val(); 
   if(option == 'pick-up') {
       $('#finish').show();
       $('#next').hide();
   }
   else {
       $('#next').show();
       $('#finish').hide();
   }
});

   $('#next').on('click', function() {
       $('#service').hide("blind");
       $('#tabpayment').show("blind");
   });
 
   $('#wizard').smartWizard({transitionEffect:'slide'});
 } );

</script>
<script>
$(document).ready(function(){
 var subtotal = document.getElementById('subtotal').textContent;
 alert(subtotal);
 var delfee=document.getElementById('delfee').textContent;
var delivery = delfee.toFixed(2);
 var total=parseInt(subtotal) + delivery;
 // var total=total.toFixed(2);
 document.getElementById('total').textContent=total.toFixed(2);
 // $('#del_fee').val(fee);
 // $('#del_fee1').val(fee);
})
</script>
@endsection
