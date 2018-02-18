@extends('user-layouts.master')
<link href="{{asset('datetimepicker/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
<link href="{{asset('datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>

<link href="{{asset('css/smart_wizard_vertical.css')}}" rel="stylesheet" type="text/css">

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
div#calendar .fc-center h2 {
  color: black;
}

/*Resize the wrap to see the search bar change!*/






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
            <center>
              <h1 style="color:#30bb6d">PAYMENT METHOD</h1><br>








                <div class="col-md-6 col-md-offset-3"> 
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

                    <form method="POST" action="{{route('user.pmstore')}}">
                      {{csrf_field()}}
                      @if($items)
                        @foreach($items as $item)
                          <input type="hidden" name="uo_id[]" value="{{$item->uo_id}}">
                          {{-- <input type="hidden" name="user_id" value="{{$item->user_id}}"> --}}
                          {{-- <input type="hidden" name="total[]" value="{{$total}}">
                          <input type="hidden" name="allcost[]" value="{{$allcost}}">
                          <input type="hidden" name="delfee[]" value="{{$delfee}}">
                          <input type="hidden" name="price[]" value="{{$item->sellingPrice}}"> --}}
                          <input type="hidden" name="payment_mode" value="COD">
                          <input type="hidden" name="delivery_fee" id="del_fee" value="">
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
                        <form method="POST" id="payment-form" action="{{ route('user.pmpayment') }}">
                            {{csrf_field()}}
                            @foreach($items as $item)
                              <input name="amount" value="" type="hidden">
                            @endforeach
                            @if(count($items))
                              @foreach($items as $item)
                                <input type="hidden" name="uo_id[]" value="{{$item->uo_id}}">
                                {{-- <input type="hidden" name="user_id" value="{{$item->user_id}}"> --}}
                                {{-- <input type="hidden" name="total[]" value="{{$total}}">
                                <input type="hidden" name="allcost[]" value="{{$allcost}}">
                                <input type="hidden" name="delfee[]" value="{{$delfee}}">
                                <input type="hidden" name="price[]" value="{{$item->sellingPrice}}"> --}}
                                <input type="hidden" name="payment_mode" value="COD">
                                <input type="hidden" name="delivery_fee" id="del_fee1" value="">
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
            



            




          </div><br><br><!--content!-->
        </div><!--row!-->
      </div><!--section!-->
    </div><!--main raised!-->
  </div><!--wrapper!-->
</div>






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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script src="https://js.braintreegateway.com/web/dropin/1.8.0/js/dropin.min.js"></script>
  <script type="text/javascript" src="{{asset('js/jquery-2.0.0.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.smartWizard.js')}}"></script>

  <script type="text/javascript" src="{{asset('datetimepicker/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('datetimepicker/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('datetimepicker/js/locales/bootstrap-datetimepicker.fr.js')}}" charset="UTF-8">
</script>

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
    
  </script>
<script>
 $(document).ready(function(){
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
 var total=parseInt(subtotal) + 40;
 var fee = 40;
 var delivery = fee.toFixed(2);
 document.getElementById('subtotal').textContent=total.toFixed(2);
 $('#del_fee').val(fee);
 $('#del_fee1').val(fee);
})
</script>





                    
