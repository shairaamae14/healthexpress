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

    



/*Resize the wrap to see the search bar change!*/

}

</style>
@section('content')
<div class="wrapper">
  <div class="header header-filter" style="background-image: url('{{asset('img/bgindex.jpg')}}')">
    <div class="container">
      

      
      </div>
    </div>
  </div>

    <div class="main main-raised"  style="width: 65%; float: left">
        <div class="section">
            <div class="container" style="width: 100%;">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="profile-tabs">
                            <div class="nav-align-center">
                                <ul class="nav nav-pills nav-pills-success" role="tablist">
                                    <li class="active">
                                        <a href="#studio" role="tab" data-toggle="tab">
                                            <i class="material-icons">attach_money</i>
                                               Cash On Delivery 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#work" role="tab" data-toggle="tab">
                                            <i class="material-icons">credit_card</i>
                                                Credit / Debit Card
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#shows" role="tab" data-toggle="tab">
                                            <i class="material-icons">favorite</i>
                                            Favorite
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content gallery">
                                    <div class="tab-pane active" id="studio">
                                        <div class="row">
                                            
                                            
                                            <div class="col-md-6 col-md-offset-3">
                                                Payment will be cash on delivery.
                                                <button type="submit" class="btn btn-success">PROCEED TO CHECKOUT</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="tab-pane text-center" id="work">
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <img src="../assets/img/examples/chris5.jpg" class="img-rounded" />
                                                    <img src="../assets/img/examples/chris7.jpg" class="img-rounded" />
                                                    <img src="../assets/img/examples/chris9.jpg" class="img-rounded" />
                                            </div>
                                            <div class="col-md-6">
                                                    <img src="../assets/img/examples/chris6.jpg" class="img-rounded" />
                                                    <img src="../assets/img/examples/chris8.jpg" class="img-rounded" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-center" id="shows">
                                        <div class="row">
                                                <div class="col-md-6">
                                                        <img src="../assets/img/examples/chris4.jpg" class="img-rounded" />
                                                        <img src="../assets/img/examples/chris6.jpg" class="img-rounded" />
                                                </div>
                                                <div class="col-md-6">
                                                        <img src="../assets/img/examples/chris7.jpg" class="img-rounded" />
                                                        <img src="../assets/img/examples/chris5.jpg" class="img-rounded" />
                                                        <img src="../assets/img/examples/chris9.jpg" class="img-rounded" />
                                                </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Profile Tabs -->
                    </div>
                </div>
            </div><!--container!-->
        </div><!--section!-->
</div><!--main raised!-->






<div class="main main-raised"  style="width: 25%; float: right;">
    <div class="section" style="padding-bottom: 2px">
        <div class="container" style="width: 100%">
                <p style="color: black; float:left; margin-top: -60px;font-size: 21px; font-family: 'Lobster', cursive;">
                <i class="material-icons" style="font-size:21px">shopping_cart</i> &nbsp;Order Summary &nbsp; 
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
              <dd style="margin-left:-5px">
                <label style="float: left; margin-left:0px; margin-right: 0px; font-size: 15px; color:black">
                <b>&nbsp;{{$item->qty}} x {{$item->name}}</b>
                </label>
                   
               </dd>

                <dt style="margin-left:-2px">
                <label style="font-size: 12px; color: gray; float:left"> Price: <b id="price">{{$item->price}}</b></label>
                </dt>

                 <dd style="margin-right: 2px">
                <label style="font-size: 12px; color: gray; float:right">Total Amount:<b id="itemamount">{{$item->subtotal}}</b></label>
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
            <form method="POST" action="{{url('home')}}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:right; margin-top: 2px; border:none" id="chkt">Continue Shopping</button>
              </form>
<!-- 
            <form method="POST" action="{{url('cart/clear')}}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-flat btn edit" style="float:left; margin-top: 2px; border:none" id="chkt">Clear Cart
              </button>
              </form>
              </div> -->
            @else
             <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
          <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lato', sans-serif', cursive;" id="tots">
          <b>Delivery Fee:</b>&nbsp;Php
          <label style="color:black">0.00</label>
          <br>
        </div>
       <!--        <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
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
 -->
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

  

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>

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
  
  
  
  
  
    
    

@endsection
