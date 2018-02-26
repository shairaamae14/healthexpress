 @extends('user-layouts.master')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<!-- <link href="css/bootstrap.css" rel="stylesheet" /> -->
<link href="{{asset('css/rotating-card.css')}}" rel="stylesheet" />
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />


<style>
@import url('https://fonts.googleapis.com/css?family=Lobster');
@import url('https://fonts.googleapis.com/css?family=Anton');
@import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
@import url('https://fonts.googleapis.com/css?family=Archivo+Black');
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);


.avaliar{
    margin-top:5px;
  background-color:#EDEDED;
}
.avaliar textarea{
  width:100%;
}
.stars
{
    margin: 20px 0;
    font-size: 24px;
    color: #d17581;
}





label{
  color:black;
}
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

#tb{
  color:white !important;
}



/*Resize the wrap to see the search bar change!*/


    #map {
        height: 40%;
        margin-bottom: 10px;
      }

  
fieldset, label { margin: 0; padding: 0; }
body{ margin: 20px; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
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
.name{
 overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
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
     
        </div>
      </div>
    </div>
  </div>

<div class="main main-raised"  style="width: 65%; float: left">

   <div class="section">
      <div class="container" style="width: 90%;">
        <div class="row">
          <div class="profile-content" style="margin-top:-75px">
            <div class="card card-nav-tabs">
              <div class="content">
                <div class="tab-content text-center">
                    <div class="box-body">
                        <div class="avg">
                        @foreach($cook as $ck)
                        <h2 style="margin-top:-5px; color:#30BB6D">
                          <b>{{$ck->first_name}} {{$ck->last_name}}</b><br>
                          <label>{{$ck->location}}</label>
                          </h2>
                            <label class="avgbox" id="avgbox"></label>
                            <label class="avgbox2" id="avgbox2"></label><br>
                        @foreach($avgrate as $avg)
                            <input type="hidden" class="avg" value="{{$avg->average}}">
                        @endforeach
                        @endforeach
                          </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>   


<div class="row" style="margin:15px;">
    <h4 class="text-left" style="color:white; background-color: #4caf50; padding:5px"><b>Reviews</b></h4>
    @if(count($ratings))
       @foreach($ratings as $rate)
        <div class="col-md-12 rate" id="ratebox">
           <div class="well well-sm">
            <div class="text-left">
              <img src="{{url('./user_imgs/'.$rate->profpic)}}" class="img-circle" style="width:50px; height:50px"/>
               <label style="color:#4caf50"><b>&nbsp;&nbsp;{{$rate->fname}}&nbsp;{{$rate->lname}}</b></label>
                <label style="margin-left:10px">{{$rate->comment}}</label>
                 <label class="ratingbox" id="ratingbox" style="float:right"></label>
               <label class="ratingbox2" id="ratingbox2" style="float:right"></label>
            </div>
               <ul>
                 <li>
                 <input type="hidden" class="ratings" id="rate_{{$rate->rating}}"  value="{{$rate->rating}}">
                 <li>
            </div> 
        </div>
        @endforeach
      @else
       <center><h2 style="color:gray"> No ratings and reviews for this cook </h2></center>
      @endif
        </div>
          <div class="text-center">
            {{$ratings->links()}}
            </div>
<div class="row" style="margin:15px;">
  <h4 class="text-left" style="color:white; background-color: #4caf50; padding:5px">
  <b>Dishes</b></h4>
 @if($dishes)
                      @foreach($dishes as $dish)
                    <div class="col-md-4 col-sm-4">
                      <div class="card-container manual-flip">
                          <div class="card">
                              <div class="front rate" style="height:290px">
                                <div class="cover">
                                  <img src="{{asset('dish_imgs/'.$dish->dish_img)}}""/>
                                    </div>
                                  <!--   <div class="user">
                                  <img class="img-circle" src="{{asset('dish_imgs/'.$dish->dish_img)}}"/>
                                </div> -->
                                <div class="content" style="height:50px">
                                  <a class="linkname" href="{{route('home.details', ['id' => $dish->did])}}"><h4 class="name">{{$dish->dish_name}}</h4></a>
                                  @if($dish->average['average'])
                                   <small><center>
                                   <label class="ratingbox" id="ratingbox"></label>
                                   <label class="ratingbox2" id="ratingbox2"></label><br>
                                   <center></small>
                                   <input type="hidden" class="ratings" id="rate_{{$dish->average['average']}}" value="{{$dish->average['average']}}">
                                 @else
                                  <center><small>
                                   <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                                   <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                                   <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                                   <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                                   <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                                  </small><br>
                                 @endif
                                   <label style="color:#30BB6D">Php&nbsp;{{$dish->sellingPrice}}</label><br>
                                    
                                   </center>
                                  <div class="footer" style="padding:3px">
                                     <!--  <button type="button" class="btn btn-flat btn-sm btn-success" data-target="#modal-default{{$dish->did}}" data-toggle="modal" style="margin-right:10px;  background-color:#30BB6D; margin-left: 10px"><i class="material-icons">add_circle</i>&nbsp;Add to cart
                                   </button> -->
                                  </div>
                               </div>
                             </div> 
                        </div> <!-- end card -->
                    </div> <!-- end card-container -->
                    </div> <!-- end col sm 3 -->     
                    @endforeach
                   @endif 
</div>
  <div class="text-center">
  {{$dishes->links('vendor.pagination.custom')}}
  </div>
              
   </div>
</div> 
  </div><!--section!-->
</div><!--main-raised!-->



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
     <div class="col-md-12">
         <label style="font-size: 12px"><b>Cook:{{$item->cookname}}</b></label>
     </div>
     <div class="col-sm-6">
      <label class="name" style="float: left; font-size: 15px; color:black"><b class="name">{{$item->name}}</b><br></label>
     </div>
     <div class="col-md-6">
     <label  name="quantity" style="color:black; margin-right:20px"><b> x {{$item->qty}} </b></label>
       <a class="cart_quantity_up" href='{{url("detcart/update?dish_id=$item->id&increment=1")}}'>
       <i class="material-icons"  style="color:#30BB6D;">add_circle</i></a>
       <a class="cart_quantity_down" href='{{url("detcart/update?dish_id=$item->id&decrease=1")}}'>
       <i class="material-icons"  style="color:#30BB6D" id="dec">remove_circle</i></a>
       <a href='{{url("/detcart/dish/remove?dish_id=$item->id&remove=true")}}' style="float:right">
       <i class="fa fa-trash-o" aria-hidden="true" style="color:black; font-size: 20px"></i>
       </a>
     </div>
     <div class="col-md-12">
     @if($item->sidenote)
      <label style="font-size: 12px"><b>Side note:{{$item->sidenote}}</b></label>
    @else
      <label></label>
    @endif
    </div>
     <div class="col-md-12">
         <label style="font-size: 12px; color: gray; float:left"> Price: <b id="price">{{$item->price}}.00</b></label>
          <label style="font-size: 12px; color: gray; float:right">Total Amount:<b id="itemamount">Php {{$item->subtotal}}.00</b></label>
     </div>
     @endforeach
       @else
        <center>
          <label style="font-size: 30px">Your cart is empty</label>
        </center>
   @endif
   </div>
    <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
           <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lato', sans-serif" id="tots">
           <b>Subtotal:</b>&nbsp;Php
           <label style="color:black" id="subtotal">{{Cart::subtotal()}}</label>
           </p>
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
                                      @endforeach
                                      @endif
        <button type="submit" class="btn btn-flat btn-primary btn-md"  style="background-color:#30BB6D; float:right; padding-bottom:2px; margin-top:15px; border:none" id="chkt"> Proceed </butoon>
        </form>
        <form method="POST" action="{{url('detcart/clear')}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="dish_id" value="$item->id">
          <button type="submit" class="btn btn-flat btn-danger" style="float:right; margin-top: 2px; border:none; margin-right:20px" id="clearcrt"> Clear Cart </button>
          </button>
         </form>
      </div>
    @else
      <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
        <form method="POST" action="#">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <button type="submit" class="btn btn-flat btn-success btn edit" style="float:right; margin-top: 3px;  border:none" id="chkt" disabled>Checkout</button>
        </form>
        <form method="POST" action="{{url('detcart/clear')}}">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <button type="submit" class="btn btn-flat btn-danger" style="float:right; margin-top: -11px; border:none;" id="clearcrt" disabled> Clear Cart </button>
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
  <script>
  $(".ratingbox").closest('.rate').find('input[class=ratings]').each(function(index, data){
    var rating = $(this).val();
    // $(this).closest('.rate').find('.ratingbox').append(rating);
    if(rating < 5){
    var num=5;
    // console.log(rating);
      var temp=num-rating;
      // console.log(temp);
      for(var i=1; i<=temp; i++){
          $(this).closest('.rate').find('.ratingbox2').append('<i class="fa fa-star-o" aria-hidden="true" style="color:orange; font-size:20px"></i>');
      }
    }
    while(rating >= 1){
      $(this).closest('.rate').find('.ratingbox').append('<i class="fa fa-star" aria-hidden="true" style="color:orange; font-size:20px"></i>');
      rating -= 1;
    }
    if(rating > 0) {
      $(this).closest('.rate').find('.ratingbox').append('<i class="fa fa-star-half-o" aria-hidden="true" style="color:orange; font-size:20px"></i>');
    }
    
  

  });

  </script>
   <script>
  // $(".avgbox").closest('.avg').find('input[class=avg]').each(function(index, data){
    $(document).ready(function(){
    var avg = $('input[class=avg]').val();
    console.log(avg);
    // $(this).closest('.rate').find('.ratingbox').append(rating);
    if(avg < 5){
    var num=5;
    // console.log(avg);
      var temp=num-avg;
      // console.log(temp);
      for(var i=1; i<=temp; i++){
          $('.avgbox2').append('<i class="fa fa-star-o" aria-hidden="true" style="color:orange; font-size:20px"></i>');
      }
    }
    while(avg >= 1){
      $('.avgbox').append('<i class="fa fa-star" aria-hidden="true" style="color:orange; font-size:20px"></i>');
      avg -= 1;
    }
    if(avg > 0) {
      $('.avgbox').append('<i class="fa fa-star-half-o" aria-hidden="true" style="color:orange; font-size:20px"></i>');
    }
    
  

  });

  </script>

  
  <script src="{{asset('js/expanding.js')}}" type="text/javascript"></script>
<script>
 
$(function(){

  $('#new-review').autosize({append: "\n"});

  var reviewBox = $('#post-review-box');
  var newReview = $('#new-review');
  var openReviewBtn = $('#open-review-box');
  var closeReviewBtn = $('#close-review-box');
  var ratingsField = $('#ratings-hidden');

  openReviewBtn.click(function(e)
  {
    reviewBox.slideDown(400, function()
      {
        $('#new-review').trigger('autosize.resize');
        newReview.focus();
      });
    openReviewBtn.fadeOut(100);
    closeReviewBtn.show();
  });

  closeReviewBtn.click(function(e)
  {
    e.preventDefault();
    reviewBox.slideUp(300, function()
      {
        newReview.focus();
        openReviewBtn.fadeIn(200);
      });
    closeReviewBtn.hide();
    
  });

  $('.starrr').on('starrr:change', function(e, value){
    ratingsField.val(value);
  });
});


  </script>

<script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();

    });

    function rotateCard(btn){
        var $card = $(btn).closest('.card-container');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }
</script>


@endsection

