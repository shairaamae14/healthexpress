  @extends('user-layouts.master')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

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
      @foreach($dishes as $dets)
      <div class="container" style="width: 90%;">
        <div class="row">
        <!--start of profile content!-->
          <div class="profile-content">
            <div class="card card-nav-tabs">
              <div class="content">
                <div class="tab-content text-center">
                    <div class="box-body">
                         <div class="avg">
                          <img src="{{url('./dish_imgs/'.$dets->dish_img)}}" style="width:200px; height:200px; border:2px solid #F0F0F0; border-radius: 10px; margin:10px; float: left"/>  
                          <center><h2 style="margin-top:-10px;">
                          <b>{{$dets->dish_name}}&nbsp;</b>
                          <span class="badge" style="font-family: verdana; border-radius:0px; background-color:#30BB6D; margin-top:-10px;">Php {{$dets->sellingPrice}}</span>
                          </h2>
                          <span class="badge" style="font-family: verdana; background-color:#30BB6D; margin-top:-10px;">Breakfast &nbsp;</span><br>
                            <label class="avgbox" id="avgbox"></label>
                            <label class="avgbox2" id="avgbox2"></label><br>
                            @foreach($avgrate as $avg)
                            <input type="hidden" class="avg" value="{{$avg->average}}"/>
                            <label>{{$avg->average}} out of 5 stars</label>
                          @endforeach
                          <p>{{$dets->dish_desc}}</p>
                          </div>
                       
                    </div>
                </div>
              </div>
            </div>
          </div>
          <!--end of profile content!-->
          <!--start of modal footer!-->
       
          <div class="modal-footer" style="margin-bottom:2px">
           <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default{{$dets->did}}" style="float:right; margin-bottom:-1000px"><i class="fa fa-shopping-cart"></i> ADD TO CART
           </button>
          </div>

          <!-- end of modal footer!-->
          <br><br>
        </div>
      </div><!--end!-->
      @endforeach

              <div class="row" style="margin:10px">
                  <div class="col-sm-6">
                  <div class="col-sm-6">
                   <h4 class="card-title" style="color:black">Details</h4> 
                    @foreach($dishes as $dets)
                    <span class="badge" style="font-family: verdana; border-radius:0px; background-color:#30BB6D; margin-top:-10px;"> Cook:</span><a href="{{route('cook.details',  ['id' => $dets->authorCook_id])}}" style="text-decoration: none; color:#30BB6D; ">&nbsp;<b>{{$dets->first_name}} {{$dets->last_name}}</b></a>
                    <span class="badge" style="font-family: verdana; border-radius:0px; background-color:#30BB6D;"> Preparation:</span><label>&nbsp;<b>{{$dets->preparation_time}}</b></label>
                   <span class="badge" style="font-family: verdana; border-radius:0px; background-color:#30BB6D;"> No. of servings:</span> 
                   <label>&nbsp;<b>{{$dets->no_of_servings}}</b></label><br>
                   @endforeach
                  </div>
                  </div>
                    <div class="col-sm-6">
                        <h4 class="card-title" style="color:black">Nutrional Facts</h4> 
                         <center>
                <b>Amount Per Serving</b>
                <table>
                @foreach($nutritional as $nutrition)
                
                <tr style="border-bottom:2px solid black">
                  <td><b style="margin-right: 50px">Calories</b></td>
                  <td>{{ $nutrition->calories }}g</td>
                </tr>
                <tr>
                  <td><b style="margin-right: 50px">Total Fat</b></td>
                  <td>{{ $nutrition->total_fat }}g</td>
                </tr>
                <tr>
                  <td><b style="margin-right: 50px">Cholesterol</b></td>
                  <td>{{ $nutrition->cholesterol }}g</td>
                </tr>
                <tr>
                  <td><b style="margin-right: 50px">Sodium</b></td>
                  <td>{{ $nutrition->sodium }}g</td>
                </tr>
                <tr style="border-bottom:2px solid black">
                  <td><b style="margin-right: 50px">Total Carbohydrate</b></td>
                  <td>{{ $nutrition->carbohydrate }}g</td>
                </tr>
                <tr>
                  <td><b style="margin-right: 50px">Protein</b></td>
                  <td>{{ $nutrition->protein }}g</td>
                </tr>
                
                @endforeach
              </table>
                  </div>
             </div>

        <div class="row" style="margin: 10px">
        <div class="col-md-12">
             <h3 class="card-title" style="color:black">Reviews</h3>
           <div class="well well-sm">
                <div class="text-right">
                    <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
                </div>
                <div class="row" id="post-review-box" style="display:none;">
                    <div class="col-md-12">
                        <form action="{{route('dish.addRating')}}" method="post">
                        {{csrf_field()}}
                        @foreach($dishes as $dets)
                        <input type="hidden" name="dish_id" value="{{$dets->did}}">
                        @endforeach
                         <h5 class="card-title text-left">Rate this dish</h5>
                                <!--STAR!-->
                                <fieldset class="rating">
                                  <input type="radio" id="star5" name="rating" value="5" />
                                  <label class = "full" for="star5" title="Excellent - 5 stars"></label>
                                  <input type="radio" id="star4half" name="rating" value="4.5" />
                                  <label class="half" for="star4half" title="Super Delicious - 4.5 stars"></label>
                                  <input type="radio" id="star4" name="rating" value="4" />
                                  <label class = "full" for="star4" title="Very Delicious - 4 stars"></label>
                                  <input type="radio" id="star3half" name="rating" value="3.5" />
                                  <label class="half" for="star3half" title="Delicious - 3.5 stars"></label>
                                  <input type="radio" id="star3" name="rating" value="3" />
                                  <label class = "full" for="star3" title="Satisfied - 3 stars"></label>
                                  <input type="radio" id="star2half" name="rating" value="2.5" />
                                  <label class="half" for="star2half" title="Good- 2.5 stars"></label>
                                  <input type="radio" id="star2" name="rating" value="2" />
                                  <label class = "full" for="star2" title="Fair - 2 stars"></label>
                                  <input type="radio" id="star1half" name="rating" value="1.5" />
                                  <label class="half" for="star1half" title="Bad - 1.5 stars"></label>
                                  <input type="radio" id="star1" name="rating" value="1" />
                                  <label class = "full" for="star1" title="Very Bad- 1 star"></label>
                                  <input type="radio" id="starhalf" name="rating" value="0.5" />
                                  <label class="half" for="starhalf" title="Poor - 0.5 stars"></label>
                                </fieldset><br><br>

                                <!--ENDOFSTAR!-->
                        <h4 class="card-title text-left">Give a review</h4>
                        <!--     <input id="ratings-hidden" name="rating" type="hidden">  -->
                            <div class="form-group label-floating has-success">
                            <textarea class="form-control animated" cols="100" id="new-review" name="review" placeholder="Enter your review here..." rows="5"></textarea>
                            </div> 
            
                            <div class="text-right">
                                <div class="stars starrr" data-rating="5">
                                </div>
                               
                                <a class="btn btn-simple btn-success" href="#" id="close-review-box" style="display:none; margin-right: 10px;">Cancel</a>
                                <button type="submit" class="btn btn-success btn-lg" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div><!--end of review!-->
      </div>

       <div class="row" style="margin: 10px">
        @if($ratings)
       @foreach($ratings as $rate)
        <div class="col-md-12 rate" id="ratebox">
           <div class="well well-sm">
            <div class="text-left">
              <img src="{{url('./user_imgs/'.$rate->profpic)}}" class="img-circle" style="width:50px; height:50px"/>
               <label style="color:#4caf50"><b>&nbsp;&nbsp;{{$rate->fname}}&nbsp;{{$rate->lname}}</b></label>
                <label style="margin-left:10px">{{$rate->comment}}</label>
            </div>
               <br>
               <label class="ratingbox" id="ratingbox"></label>
               <label class="ratingbox2" id="ratingbox2"></label><br>
               <label>{{$rate->rating}} out of 5 stars</label><br>
               <ul>
                 <li>
                 <input type="hidden" class="ratings" id="rate_{{$rate->rating}}"  value="{{$rate->rating}}">
                 <li>
            </div> 
        </div>
        @endforeach
        @else
        <h1> No ratings and reviews for this dish </h1>
        @endif
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
        <dl class="dl-horizontal">
            <div id="cartdiv" style="padding-left: 5px">  
              <dt style="margin-left:-65px">
                 <label  name="quantity" style="color:black; margin-right:20px"><b> {{$item->qty}} x</b></label>
                    <a class="cart_quantity_up" href='{{url("detcart/update?dish_id=$item->id&increment=1")}}'>
                    <i class="material-icons"  style="color:#30BB6D">add_circle</i></a>
                    <a class="cart_quantity_down" href='{{url("detcart/update?dish_id=$item->id&decrease=1")}}'>
                    <i class="material-icons"  style="color:#30BB6D" id="dec">remove_circle</i></a>
               </dt>

              <dd style="margin-left: 2px">
                <label style="float: left; margin-left:0px; margin-right: 0px; font-size: 15px; color:black">
                <b>&nbsp;&nbsp;{{$item->name}}</b>
                <br>
                <label style="font-size: 12px"><b>Side note:{{$item->sidenote}}</label>
               <br>
                </label>
                <a href='{{url("/detcart/dish/remove?dish_id=$item->id&remove=true")}}' style="float:right">
                  <i class="fa fa-trash-o" aria-hidden="true" style="color:black; font-size: 20px"></i>
                </a>
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
        <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
        <form method="POST" action="{{url('cart/checkout')}}">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <button class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:right; margin-top: 2px; border:none" id="chkt">
                        Proceed
                      </button>
          </form>
          <form method="POST" action="{{url('detcart/clear')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="dish_id" value="$item->id">
              <input type="submit" class="btn btn-danger btn-simple" style="float:left; margin-left: 3px; margin-top: -50px; border:none; font-size:15px" value="Clear Cart">
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

              <form method="POST" action="{{url('detcart/clear')}}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" class="btn btn-danger btn-simple" style="float:left; border:none; font-size:15px"  disabled>Clear Cart
              </button>
              </form>
         </div>

   @endif


 </div>
   </div>
      </div>
         </div>
         

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
              <form method="POST" action="{{url('detcart')}}">
              {{csrf_field()}}
              <input type="hidden" name="dish_id" value="{{$dish->did}}">


                     <label>If you have any request or specifications regarding your meal. Please indicate below:</label>
                     <input type="text" name="sidenote" style="width:100%;" value="None">
            

                   <div class="modal-footer">
                   <br>
                        <button type="button" class="btn btn btn-danger btn-simple" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" class="btn btn-success addCart" id="{{$dish->did}}"  style="border:transparent">
                            <b> Add to cart</b>
                        </button>    
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



@endsection

