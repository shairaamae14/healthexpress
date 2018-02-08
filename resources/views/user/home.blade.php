@extends('user-layouts.master')
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
/*  .box-solid:hover{
  box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3) !important;
  }
  .box-solid img:hover{
  box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3) !important;
  border-radius: 10px !important;
  border:2px solid #30BB6D !important;
  }*/
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
  .ui-helper-hidden-accessible {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
  }
  .ui-autocomplete {
  position: absolute;
  z-index: 100;
  }
  .ui-autocomplete ul, li {
  display:list-item;
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
        <a href="./plannedm"><button id="ordermode" style="background-color:transparent;  border:2px solid white; font-size: 40px; margin-top:-20px; margin-left:10px; font-family: 'Lobster', cursive; color:white; width: 300px">Planned Meal
        </button>
        </a>
      </div>
      </center>
    </div>
    <!--row!-->
  </div>
  <!--container!-->
</div>
<!--headder!-->
<div class="main main-raised"  style="width: 65%; float: left">
  <div class="section">
    <div class="container" style="width: 90%;">
      <div class="row">
        <div id="bestEaten" style="float:left">
          <span class="label label-default" style="float:left; margin-bottom: 2px">Sort by</span>
          <form id="sortBy" action ="{{url('/home') }}" method="POST">
            {{csrf_field()}}
            <select id="category" name='sortOption' class='form-control' style="width:200px; height:40px">
              <option disabled selected hidden>All</option>
              <option value='All'>All</option>
              <option value='Breakfast'>Breakfast</option>
              <option value='Lunch'>Lunch</option>
              <option value='Dinner'>Dinner</option>
            </select>
          </form>
        </div>

        <div class="search col-md-4">
          <form method="POST" action="{{route('show.dish')}}">
            {{csrf_field()}}
            <input type="text" id="input"  class="form-control" placeholder="Search"  name="search" value="" style="color:black; float:right; margin-right:-300px" required>
            <input type="hidden" id="dish_id" name="id" value="">
            <button type="submit" class="btnSearch pull-right" id="btnSearch" style="background-color: transparent; border:none; float:right; margin-right:-350px; margin-top: 8px">
            <i class="material-icons">search</i></button>
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
                  <li class="active"><a href="#all" data-toggle="tab" style="color:#30BB6D">{{$title}} Dishes</a></li>
                </ul>
              </div>
            </div>
          </div><!--header-success!-->

          <div class="content">
            <div class="tab-content text-center">
              <div class="tab-pane active" id="all">
                @if($dishes)
                @foreach($dishes as $dish)
                <div class="col-sm-3 rate" style="margin-top: 20px">
                  <div class="box box-solid" style="border-radius:5px; box-shadow: 0 4px 0px 0 rgba(0,0,0,0), 0 1px 0px 0 rgba(0,0,0,0), 0 2px 4px 0px rgba(0,0,0,0.3); height:190px">
                    <div class="box-header with-border">
                      <a href="{{route('home.details', ['id' => $dish->did])}}">
                      <center><img src="{{asset('dish_imgs/'.$dish->dish_img)}}" style="width:100%; height:150px; border:1px solid #F0F0F0;"></center>
                      </a>
                    </div>
                     <center>
                     <a href="{{route('home.details', ['id' => $dish->did])}}" style="border-top: 1px solid #30BB6D; border-bottom: 1px solid #30BB6D; color:#30BB6D; font-size:11px" value="{{$dish->dish_name}}" id="dish_name">
                     <b>{{$dish->dish_name}}</b>
                     </a><br>
                    </center>
                  </div>
                    <br>
                    @if($dish->average['average'])
                     <label class="ratingbox" id="ratingbox"></label>
                     <label class="ratingbox2" id="ratingbox2"></label><br>
                     <!-- <label style="font-size: 12px">{{$dish->average['average']}} out of 5 stars</label><br> -->
                     <input type="hidden" class="ratings" id="rate_{{$dish->average['average']}}"  value="{{$dish->average['average']}}">
                  @else
                  <center><small>
                   <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                   <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                   <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                   <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                   <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                  </small></center>
                 @endif
                    <p style="margin-left:5px; margin-top: 12px; font-size: 12px; color:black;" id="tots">Php {{$dish->sellingPrice}}</p>
                    <br>
                    <button type="button" class="btn btn-flat btn-sm btn-success" data-toggle="modal" data-target="#modal-default{{$dish->did}}" style="margin-top:-15px; margin-right:10px; margin-left: 10px"><i class="material-icons">add_circle</i>&nbsp;Add to cart
                    </button>
                    </br>
                </div>
                <!--RATE!-->
                @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
        <!-- End Tabs on plain Card -->
      </div>
      <!--row!-->
    </div>
    <!--container!-->
    </div>
  <!--section!-->
</div>
<!--main-raised!-->
</div>



<!--main raised!-->
<div class="main main-raised"  style="width: 25%; float: right;">
  <div class="section" style="padding-bottom: 2px">
    <div class="container" style="width: 100%">
      <p style="color: black; float:left; margin-top: -60px;font-size: 21px; font-family: 'Lobster', cursive;">
        <i class="material-icons" style="font-size:21px">shopping_cart</i> &nbsp;Your Cart &nbsp; 
        <span class="badge" style="font-family: verdana; background-color:#30BB6D" id="totalqty">
        {{Cart::content() ? Cart::content()->count() : 0}}
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
              <br>
              <label style="font-size: 12px"><b>Side note:{{$item->sidenote}}</label>
              <br>
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
              <h1>{{($item->options->has('note') ? $item->options->note : '') }}</h1>
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
          <form method="POST" action="{{url('cart/checkout')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:right; margin-top: 2px; border:none" id="chkt">
            Proceed
            </button>
          </form>
          <form method="POST" action="{{url('cart/clear')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-flat btn edit" style="float:left; margin-top: 2px; border:none" id="chkt">Clear Cart
            </button>
          </form>
        </div>
        @else
        <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
          <form method="POST" action="{{url('cart/checkout')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-flat btn-success btn edit" style="float:right; margin-top: 2px; border:none" id="chkt" disabled>
            Checkout
            </button>
          </form>
          <form method="POST" action="{{url('cart/clear')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger btn-simple" style="float:left; margin-top: -10px; border:none; font-size:15px"  disabled>Clear Cart
            </button>
          </form>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
<!--main-raised!-->
</div>
<!--wrappler!-->

<!-- Sart Modal -->
@foreach($dishes as $dish)
<div class="modal fade" id="modal-default{{$dish->did}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="color:#30BB6D"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><b>&nbsp;ADD SIDE NOTE</b></h4>
      </div>
      <div class="modal-body">
        <form action="{{url('cart')}}" method="POST" id="add_to_cart">
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <input type="hidden" name="dish_id" value="{{$dish->did}}">
          <label>If you have any request or specifications regarding your meal. Please indicate below:</label>
          <input type="text" name="sidenote" style="width:100%;" value="None">
          <div class="modal-footer">
            <br>
            <button type="button" class="btn btn btn-danger btn-simple" data-dismiss="modal" aria-label="Close">Cancel</button>
            <button type="submit" class="btn btn-success addCart" id="addCart" value="{{$dish->did}}">
            <b> Add to cart</b>
            </a>    
          </div>
        </form>
      </div>
      <!--modalbody!-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach
<!--  End Modal -->
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
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
<script src="{{asset('js/jquery.form.min.js')}}"></script>
<script src="{{asset('js/pace.min.js')}}"></script>
<script>
    $(document).ready(function(){
  $(".ratingbox").closest('.rate').find('input[class=ratings]').each(function(index, data){
    var rating = $(this).val();
    // $(this).closest('.rate').find('.ratingbox').append(rating);
    if(rating < 5){
    var num=5;
    console.log(rating);
      var temp=num-rating;
      // console.log(temp);
      for(var i=1; i<=temp; i++){
          $(this).closest('.rate').find('.ratingbox2').append('<i class="fa fa-star-o" aria-hidden="true" style="color:orange; font-size:13px"></i>');
      }
    }
    
    while(rating >= 1){
      $(this).closest('.rate').find('.ratingbox').append('<i class="fa fa-star" aria-hidden="true" style="color:orange; font-size:13px"></i>');
      rating -= 1;
    }
    if(rating > 0) {
      $(this).closest('.rate').find('.ratingbox').append('<i class="fa fa-star-half-o" aria-hidden="true" style="color:orange; font-size:13px"></i>');
    }
    
  

});
  });

  </script>
<!-- <script>
  $(document).ready(function(e){
    $('.addCart').click(function(e){
      alert('HELLOOO');
      e.preventDefault();
       var dish_id=$(this).attr("id");
       // var be_id=$('#be_id').val();
       console.log(dish_id);
       $.ajax({
        type:"GET",
        url:"/cart/"+dish_id+",
          success:function(data){
           $("#modal.close").click();
           console.log(data);
         // alert(data);
           // $(".cntnt").append(data);
  
                                    
          },
          error:function(data)
          {
            alert("Error");
          }
      });
    });
  
  
  
  });
  </script>
  -->
<script>
  $(document).ready(function(){
  
    // $('#addCart').on('click', '.modal', function(){
    //   alert('hey');
    //   var id = $('#addCart').val();
    //   alert(id);
    // });
  
    $('#add_to_cart').submit(function(e) {
     
      var dish_id = $('#addCart').val();
      if(dish_id) {
        e.preventDefault();
      $.ajax({
        type: 'POST'
        url: '{{url("cart")}}',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        data: {
          dish_id : dish_id,
  
        },
        success:function(data) {
          // $('#totalqty').html(data.cart.qty);
  
        },
        error: function(xhr, error) {
          console.log(xhr);
        }
      });
      }
    });
  
    $('#category').on('change', function() {
      $('#sortBy').submit();
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