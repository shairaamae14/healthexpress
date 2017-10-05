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
      <div class="row">
          <center>
       <div class="col-md-6">
           <br>
            <h1 class="title text-center" style="font-family: 'Lobster', cursive; font-size: 30px;">Choose your order mode:</h1>

            <a href="{{url('/home/express')}}" class=" btn btn-danger btn-raised btn-lg" style="background-color:transparent;border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px " id="ordermode"> <center> Express Meal</center>
            </a>
                <a href="{{url('/home/planned')}}" class=" btn btn-danger btn-raised btn-lg" id="ordermode" style="background-color:transparent;  border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px "><center>Planned Meal</center>
            </a>

        </div>

      
      </div>
    </div>
  </div>

    <div class="main main-raised"  style="width: 65%; float: left">
        <div class="section">
            <div class="container" style="width: 90%;">
                <div class="row">

            <!--       <div id="bestEaten" style="float:left">
                  <span class="label label-default" style="float:left; margin-bottom: 2px">Sort by</span>
                <form id="sortBy" action ="{{url('/home') }}" method="POST">
                      {{csrf_field()}}
                    <select id="category" name='category' class='form-control' style="width:200px; height:40px">
                        <option disabled selected value> -- select an option -- </option>
                        <option value='Breakfast'>Breakfast</option>
                        <option value='Lunch'>Lunch</option>
                        <option value='Dinner'>Dinner</option>
                    </select>
                </form>
                </div> -->

                  <div class="search" style="float:right">
                  <form method="POST" action="{{route('user.index')}}">
                        {{csrf_field()}}
                  <input type="text" id="input" class="searchTerm search-query mac-style" placeholder="Search"  name="search" value="" style="height:40px" autofocus >
                   <input type="hidden" id="dish_id" name="id" value="">
                    <button type="submit" class="btn btn-success btnSearch" id="btnSearch"><i class="material-icons">search</i></button>
                </div>
                              <ul id="dishNames" style="display:none">
                           @foreach($dishes as $dish)
                           <li><a href="#"></a>{{$dish->dish_name}}</li>
                           @endforeach
                       </ul>
                        </form>
                       </div>
                           

                

  <br>

      <!-- Tabs on Plain Card -->
            <div class="card card-nav-tabs card-plain">
              <div class="header header-success" style="box-shadow: none">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="active"><a href="#all" data-toggle="tab">All</a></li>
                      <li><a href="#home" data-toggle="tab">Breakfast</a></li>
                      <li><a href="#updates" data-toggle="tab">Lunch</a></li>
                      <li><a href="#history" data-toggle="tab">Dinner</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content">
                <div class="tab-content text-center">

                     <div class="tab-pane active" id="all">
                 @if($dishes)
                      @foreach($dishes as $dish)
                        <div class="col-sm-3">
                         <div class="box box-solid" style="border-radius:5px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                              <div class="box-header with-border">  
                                <center><img src="{{asset('dish_imgs/'.$dish->dish_img)}}" style="width:150px; height:150px; border-radius:10px; border:1px solid #F0F0F0; margin-top: 10px;"></center>
                              </div>
                              <center><h4 class="openModal box-title" style="margin-top: 5px; font-size: 12px;"><a href="" style="border-top: 1px solid #30BB6D; border-bottom: 1px solid #30BB6D; color:#30BB6D; " data-toggle="modal" data-target="#modal-default{{$dish->did}}"><b>{{$dish->dish_name}}</b></a><br>
                                <br>
                              <center><small>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star-o" id="rate"></i>
                              <i class="fa fa-star-o" id="rate"></i>
                              </small><br>
                              <a href="{{route('cook.rating')}}"><p style="font-size: 12px; color:#30BB6D; background-color:#E3E3E3">See Reviews</p></a>
                              </center>
                                <p style="float:left; margin-left:5px; margin-top: 12px; font-size: 20px; font-family: 'Lobster', cursive; color:black;" id="tots">Php {{$dish->sellingPrice}}</p>
                       
                                          <form method="POST" action="{{url('cart')}}">
                                          <input type="hidden" name="dish_id" value="{{$dish->did}}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" style="width:10px; background-color:transparent; border:transparent; margin-right: 30px">
                                               <i class="material-icons"  style="color:#30BB6D; font-size:40px">add_circle</i>
                                            </button>
                            </form>
                              </br>
                          </div>
                        </div>
                    @endforeach
                @endif
                  </div> 

                  <div class="tab-pane active" id="home">
                 @if($breakfast)
                      @foreach($breakfast as $dish)
                        <div class="col-sm-3">
                         <div class="box box-solid" style="border-radius:5px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                              <div class="box-header with-border">  
                                <center><img src="{{asset('dish_imgs/'.$dish->dish_img)}}" style="width:150px; height:150px; border-radius:10px; border:1px solid #F0F0F0; margin-top: 10px;"></center>
                              </div>
                              <center><h4 class="openModal box-title" style="margin-top: 5px; font-size: 12px;"><a href="" style="border-top: 1px solid #30BB6D; border-bottom: 1px solid #30BB6D; color:#30BB6D; " data-toggle="modal" data-target="#modal-default{{$dish->did}}"><b>{{$dish->dish_name}}</b></a><br>
                                <br>
                              <center><small>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star-o" id="rate"></i>
                              <i class="fa fa-star-o" id="rate"></i>
                              </small><br>
                              <a href="{{route('cook.rating')}}"><p style="font-size: 12px; color:#30BB6D; background-color:#E3E3E3">See Reviews</p></a>
                              </center>
                              <p style="float:left; margin-left:5px; margin-top: 12px; font-size: 20px; font-family: 'Lobster', cursive; color:black;" id="tots">Php {{$dish->sellingPrice}}</p>
                       
                                          <form method="POST" action="{{url('cart')}}">
                                          <input type="hidden" name="dish_id" value="{{$dish->did}}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" style="width:10px; background-color:transparent; border:transparent; margin-right: 30px">
                                               <i class="material-icons"  style="color:#30BB6D; font-size:40px">add_circle</i>
                                            </button>
                            </form>
                              </br>
                          </div>
                        </div>
                    @endforeach
                @endif
                  </div>

                  <div class="tab-pane" id="updates">
                   @if($lunch)
                      @foreach($lunch as $dish)
                        <div class="col-sm-3">
                         <div class="box box-solid" style="border-radius:5px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                              <div class="box-header with-border">  
                                <center><img src="{{asset('dish_imgs/'.$dish->dish_img)}}" style="width:150px; height:150px; border-radius:10px; border:1px solid #F0F0F0; margin-top: 10px;"></center>
                              </div>
                              <center><h4 class="openModal box-title" style="margin-top: 5px; font-size: 12px;"><a href="" style="border-top: 1px solid #30BB6D; border-bottom: 1px solid #30BB6D; color:#30BB6D; " data-toggle="modal" data-target="#modal-default{{$dish->did}}"><b>{{$dish->dish_name}}</b></a><br>
                                <br>
                              <center><small>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star-o" id="rate"></i>
                              <i class="fa fa-star-o" id="rate"></i>
                              </small><br>
                              <a href="{{route('cook.rating')}}"><p style="font-size: 12px; color:#30BB6D; background-color:#E3E3E3">See Reviews</p></a>
                              </center>
                              <p style="float:left; margin-left:5px; margin-top: 12px; font-size: 20px; font-family: 'Lobster', cursive; color:black;" id="tots">Php {{$dish->sellingPrice}}</p>
                       
                                          <form method="POST" action="{{url('cart')}}">
                                          <input type="hidden" name="dish_id" value="{{$dish->did}}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" style="width:10px; background-color:transparent; border:transparent; margin-right: 30px">
                                               <i class="material-icons"  style="color:#30BB6D; font-size:40px">add_circle</i>
                                            </button>
                            </form>
                              </br>
                          </div>
                        </div>
                      @endforeach
                     @endif
                  </div>

                  <div class="tab-pane" id="history">
                             @if($dinner)
                      @foreach($dinner as $dish)
                        <div class="col-sm-3">
                         <div class="box box-solid" style="border-radius:5px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                              <div class="box-header with-border">  
                                <center><img src="{{asset('dish_imgs/'.$dish->dish_img)}}" style="width:150px; height:150px; border-radius:10px; border:1px solid #F0F0F0; margin-top: 10px;"></center>
                              </div>
                              <center><h4 class="openModal box-title" style="margin-top: 5px; font-size: 12px;"><a href="" style="border-top: 1px solid #30BB6D; border-bottom: 1px solid #30BB6D; color:#30BB6D; " data-toggle="modal" data-target="#modal-default{{$dish->did}}"><b>{{$dish->dish_name}}</b></a><br>
                                <br>
                              <center><small>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star" id="rate"></i>
                              <i class="fa fa-star-o" id="rate"></i>
                              <i class="fa fa-star-o" id="rate"></i>
                              </small><br>
                              <a href="{{route('cook.rating')}}"><p style="font-size: 12px; color:#30BB6D; background-color:#E3E3E3">See Reviews</p></a>
                              </center>
                              <p style="float:left; margin-left:5px; margin-top: 12px; font-size: 20px; font-family: 'Lobster', cursive; color:black;" id="tots">Php {{$dish->sellingPrice}}</p>
                       
                                          <form method="POST" action="{{url('cart')}}">
                                          <input type="hidden" name="dish_id" value="{{$dish->did}}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" style="width:10px; background-color:transparent; border:transparent; margin-right: 30px">
                                               <i class="material-icons"  style="color:#30BB6D; font-size:40px">add_circle</i>
                                            </button>
                            </form>
                              </br>
                          </div>
                        </div>
                      @endforeach
                     @endif
                  </div>
                </div>
              </div>
            </div>
            <!-- End Tabs on plain Card -->



        </div><!--row!-->
       </div><!--container!-->

<center>
 <ul class="pagination pagination-success" style="float:right">
        <li><a href="javascript:void(0);">< prev</a></li>
        <li class="active"><a href="javascript:void(0);">1</a></li>
        <li><a href="javascript:void(0);">2</a></li>
        <li><a href="javascript:void(0);">3</a></li>
        <li><a href="javascript:void(0);">4</a></li>
        <li><a href="javascript:void(0);">5</a></li>
        <li><a href="javascript:void(0);">next ></a></li>
    </ul>
</center>

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
// $(document).ready(function(){
// $('#addcart').on('click', function(){
// // document.getElementById('amounts').textContent={{sprintf("%.2f", Cart::subtotal()+40)}};
// });
// });






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