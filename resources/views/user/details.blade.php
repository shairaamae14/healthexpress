  @extends('user-layouts.master')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

<style>
@import url('https://fonts.googleapis.com/css?family=Lobster');
@import url('https://fonts.googleapis.com/css?family=Anton');
@import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
@import url('https://fonts.googleapis.com/css?family=Archivo+Black');
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
@import url('https://fonts.googleapis.com/css?family=Raleway');
.wrap {
  box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 3px 1px -2px rgba(0, 0, 0, 0.2), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);
  border-radius: 4px;
}

a:focus,
a:hover,
a:active {
  outline: 0;
  text-decoration: none;
}

.panel {
  border-width: 0 0 1px 0;
  border-style: solid;
  border-color: #fff;
  background: none;
  box-shadow: none;
  margin-bottom: -20px !important;
  border-bottom: 1px solid #eeeeee !important;
 /* margin-bottom: 0px !important;*/
}
.panel:last-child {
  border-bottom: none;
}

.panel-group > .panel:first-child .panel-heading {
  border-radius: 4px 4px 0 0;
}

.panel-group .panel {
  border-radius: 0;
}

.panel-group .panel + .panel {
  margin-top: 0;
}

.panel-heading {
  background-color: #ffffff !important;
  border-radius: 0;
  border: none;
  color: #fff;
  padding:0px;
  padding-bottom: 5px;
  height: 7%;
}

.panel-title a {
  display: block;
  color: #fff;
  padding: 15px;
  position: relative;
  font-size: 16px;
  font-weight: 400;
}

.panel-body {
  background: #fff;
}

.panel:last-child .panel-body {
  border-radius: 0 0 4px 4px;
}

.panel:last-child .panel-heading {
  border-radius: 0 0 4px 4px;
  transition: border-radius 0.3s linear 0.2s;
}

.panel:last-child .panel-heading.active {
  border-radius: 0;
  transition: border-radius linear 0s;
}
/* #bs-collapse icon scale option */

.panel-heading a:before {
  content: '\e146';
  position: absolute;
  font-family: 'Material Icons';
  right: 5px;
  top: 10px;
  font-size: 24px;
  transition: all 0.5s;
  transform: scale(1);
}

.panel-heading.active a:before {
  content: ' ';
  transition: all 0.5s;
  transform: scale(0);
}

#bs-collapse .panel-heading a:after {
  content: ' ';
  font-size: 18px !important;
  position: absolute;
  font-family: 'Material Icons';
  right: 5px;
  top: 10px;
  transform: scale(0);
  transition: all 0.5s;
}

#bs-collapse .panel-heading.active a:after {
  content: '\e909';
  transform: scale(1);
  transition: all 0.5s;
}
/* #accordion rotate icon option */

#accordion .panel-heading a:before {
  content: '\e316';
  font-size: 18px;
  position: absolute;
  font-family: 'Material Icons';
  right: 5px;
  top: 10px;
  transform: rotate(180deg);
  transition: all 0.5s;
}

#accordion .panel-heading.active a:before {
  transform: rotate(0deg);
  transition: all 0.5s;
}

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
 <a href="{{route('user.index')}}" class="btn-simple btn btn-succes">
          <i class="material-icons">arrow_back</i>Go back to home</a>
@if(session('success'))
          <div class="alert alert-success">
            <div class="container">
                <div class="alert-icon">
                    <i class="material-icons">check</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <b>Success!</b> {{session('success')}}
            </div>
        </div>
 @endif
 @if($errors->any())
  <div class="alert alert-danger">
     <div class="container-fluid">
         <div class="alert-icon">
         <i class="material-icons">error_outline</i>
         </div>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
       <b>Error Alert:</b>&nbsp; {{$errors->first()}}
    </div>
  </div>
  @endif
   <div class="section">
    @foreach($dishes as $dets)
      <div class="container" style="width: 90%;">
          <div class="row">
            <!--start of profile content!-->
          <div class="profile-content" style="margin-top:-75px">
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
                           @if(count($avgrate))
                            <label class="avgbox" id="avgbox"></label>
                            <label class="avgbox2" id="avgbox2"></label><br>
                            @foreach($avgrate as $avg)
                            <input type="hidden" class="avg" value="{{$avg->average}}"/>
                           <!--  <label>{{$avg->average}} out of 5 stars</label><br><br> -->
                          @endforeach
                          @else
                          <center><small>
                           <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                          </small></center>
                          @endif
                          <span class="badge" style="font-family: verdana; background-color:#30BB6D; margin-top:10px;">{{$dets->name}}&nbsp;</span><br>
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

<div class="row" style="margin-top: 20px; margin:10px">
  <div class="panel-group wrap" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <label style="font-size: 14px;color:black; font-family: Arial Regular"> DETAILS </label>
        </a>
      </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
                @foreach($dishes as $dets)
                <label style="font-size:18px; color:black;"> Cook:</label>
                <a href="{{route('cook.details',  ['id' => $dets->authorCook_id])}}" style="text-decoration: none; color:#30BB6D; "> 
                <label style="font-size:15px; color:gray;">
                {{$dets->first_name}} {{$dets->last_name}}
                </label></a>&nbsp;
                <label style="font-size:18px; color:black;"> Cook's Location:</label>
                <label style="font-size:15px; color:gray;">{{$dets->cook['location']}}</label><br>
                <label style="font-size:18px; color:black;"> Serving:</label>
                <label style="font-size:15px; color:gray;">{{$dets->no_of_servings}} serving/s</label><br>

               @endforeach
          </div>
        </div>
      </div>
      </div>

    <div class="panel-group wrap" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel">
        <div class="panel-heading" role="tab" id="headingTwo">
          <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <label style="font-size: 14px;color:black; font-family: Arial Regular">
         NUTRRITIONAL FACTS
        </a>
      </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
          <div class="panel-body">
               <center>
            <div class="col-md-12">
              Amount Per Serving
              <table width="50%">
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
        </div>
      </div>
    </div>

    <div class="panel">
        <div class="panel-heading" role="tab" id="headingThree">
          <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <label style="font-size: 14px;color:black; font-family: Arial Regular"> LEAVE REVIEW
        </a>
      </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
          <div class="panel-body">
          <div class="row" style="margin: 10px;">
            <div class="col-md-12">
              <label>NOTE: You can only rate this dish when you have already ordered this dish.</label>
               <div class="well well-sm">
                    <!-- <div class="text-right">
                        <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
                    </div> -->
                    <div class="row" id="post-review-box">
                        <div class="col-md-12" style="width:100%">
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
          </div>
        </div>
      </div>
      <!-- end of panel -->
</div>

<div class="row" style="margin:4px; margin-top:80px">
  @if(count($ratings))
    @foreach($ratings as $rate)
        <div class="col-md-12 rate" id="ratebox">
           <div class="well well-sm">
            <div class="text-left">
              <img src="{{url('./user_imgs/'.$rate->profpic)}}" class="img-circle" style="width:50px; height:50px"/>
               <label style="color:#4caf50"><b>&nbsp;&nbsp;{{$rate->fname}}&nbsp;{{$rate->lname}}</b><div class="col-md-12" style="margin-left:-12px">
               <label style="font-size:14px;">{{$rate->date_rated}}</label>
               </div></label>
               <label style="margin-left:-80px">{{$rate->comment}}</label>
               <br>
                
            </div>
            <div style="float:right; margin-top: -50px">
               <label class="ratingbox" id="ratingbox"></label>
               <label class="ratingbox2" id="ratingbox2"></label><br>
               <label>{{$rate->rating}} out of 5 stars</label><br>
          </div>
               <ul>
                 <li>
                 <input type="hidden" class="ratings" id="rate_{{$rate->rating}}"  value="{{$rate->rating}}">
                 <li>
            </div> 
        </div>
    @endforeach
  @else
       <center><h2 style="color:gray"> No ratings and reviews for this dish </h2></center>
  @endif
  <div class="text-center">
            {{$ratings->links()}}
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
        <button type="submit" class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:right; margin-top: 2px; border:none" id="chkt"> Proceed </butoon>
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
           <button type="submit" class="btn btn-flat btn-success btn edit" style="float:right; margin-top: 3px; border:none" id="chkt" disabled>Checkout</button>
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
       

<!-- Sart Modal -->
@foreach($dishes as $dish)
<div class="modal fade" id="modal-default{{$dish->did}}">
  <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" style="color:#30BB6D"><i class="fa fa-sticky-note-o" aria-hidden="true"></i>
            <b>&nbsp;ADD SIDE NOTE</b></h4>
        </div>
        <div class="modal-body">
           <form method="POST" action="{{url('detcart')}}">
             {{csrf_field()}}
             <input type="hidden" name="dish_id" value="{{$dish->did}}">
             <input type="hidden" name="cook_id" value="{{$dish->authorCook_id}}">
             <input type="hidden" name="cook_name" value="{{$dish->cook['first_name']}}">
             <label>If you have any request or specifications regarding your meal. Please indicate below:</label>
             <input type="text" name="sidenote" style="width:100%;">
        <div class="modal-footer"><br>
          <button type="button" class="btn btn btn-danger btn-simple" data-dismiss="modal" aria-label="Close">Cancel</button>
          <button type="submit" class="btn btn-success addCart" id="{{$dish->did}}"  style="border:transparent">
          <b> Add to cart</b></button>    
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
  <script>
$(document).ready(function() {
  $('.collapse.in').prev('.panel-heading').addClass('active');
  $('#accordion, #bs-collapse')
    .on('show.bs.collapse', function(a) {
      $(a.target).prev('.panel-heading').addClass('active');
    })
    .on('hide.bs.collapse', function(a) {
      $(a.target).prev('.panel-heading').removeClass('active');
    });
});
 </script>
@endsection

