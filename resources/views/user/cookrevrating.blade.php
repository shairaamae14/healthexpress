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
  font-size: 10.0em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating2 > .half2:before { 
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
              <center>
               <div class="col-sm-12">
               <h2 class="card-title tex-center" style="color:#30bb6d">How's the cook?</h2>
               <form action="{{route('dish.cook.addRating')}}" method="post">
              {{csrf_field()}}
              @foreach($cook as $d)
              <h4 class="card-title tex-center" style="color:#30bb6d">{{$d->dishes->cook['first_name']}}&nbsp;{{$d->dishes->cook['last_name']}}</h2>
                <input type="hidden" name="cook_id" value="{{$d->dishes['authorCook_id']}}">
                <input type="hidden" name="dish_id" value="{{$d->dish_id}}">
                <input type="hidden" name="uo_id" value="{{$d->uo_id}}">
                <!-- <input type="text" name="uorder_id" value="{{$d->uo_id}}"> -->
               
                  <fieldset class="rating" style="margin-left:450px">
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
                  </fieldset>
                  <!--ENDOFSTAR!-->
                  <br><br>
                  <center>
                  <div class="col-sm-12">
                  <h2 class="card-title text-center" style="color:#30bb6d">Leave a comment</h2>
                  <label> Tell us what you think!</label>
                  <textarea class="form-control animated"  id="new-review" name="review" placeholder="Was the service good?" rows="1" style="margin-left: 5px; width:50%"></textarea>
                  </div>
                <button type="submit" class="btn btn-flat btn-success">Proceed</button>
           
              <!--   <a href="{{route('user.confirmorder', ['id'=>$d->did])}}" class="btn btn-danger btn-simple "><b>Skip</b></a>
                </center> -->
                 @endforeach
                </form>
                 @foreach($cook as $d)
               <!--  <a href="{{route('user.cookReview', ['id'=> $d->did])}}" class="btn btn-danger btn-simple btn-flat"><b>Skip</b> -->
                  <form  method="post" action="{{route('user.confirmorder')}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="dish_id" value="{{$d->dish_id}}">
                          <input type="hidden" name="uo_id" value="{{$d->uo_id}}">
                          <input type="hidden" name="cook_id" value="{{$d->dishes['authorCook_id']}}">
                          <button type="submit" class="btn btn-danger btn-simple" style="margin-top:-1px; margin-left:10px">
                          Skip
                          </button>
                        </form>
                @endforeach
                </div>
               


               

         </div><!--row!-->
       </div><!--container!-->
     </div><!--section!-->
   </div><!--main raised!-->
<br><br>

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

