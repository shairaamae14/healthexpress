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




/*Resize the wrap to see the search bar change!*/

}

</style>
@section('content')
<div class="wrapper">
  <div class="header header-filter" style="background-image: url('{{asset('img/bgindex.jpg')}}')"">
    <div class="container">
      <div class="row">
      <center>
        <div class="col-md-6">
        <br>
          <h1 class="title text-center" style="font-family: 'Lobster', cursive; font-size: 30px;">Choose your order mode:</h1>

    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class=" btn btn-danger btn-raised btn-lg" style="background-color:transparent;border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px " id="ordermode">
            <center> Express Meal</center>
            </a>
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class=" btn btn-danger btn-raised btn-lg" id="ordermode" style="background-color:transparent;  border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px ">
             <center>Planned Meal</center>
            </a>

        </div>

      
      </div>
    </div>
  </div>

    <div class="main main-raised">
        <div class="section">
    <div class="container">
        <div class="row">
            <div id="sortDiv" class="col-md-4">
                <label  style="display:inline-block;">Sort by:</label>
                
                  
                    <select id="sort" name="sortBy" class="form-control"  style="display:inline-block;">
                         <option disabled selected value> -- select an option -- </option>
                        <option value="Best Eaten">Best Eaten</option>
                        <option value="Calorie Count">Calorie Count</option>
                    </select>
                
                <div id="bestEaten" style="display:none">
                <form id="sortBy" action ="{{url('/home') }}" method="POST">
                      {{csrf_field()}}
                    <select id="category" name='category' class='form-control'>
                        <option disabled selected value> -- select an option -- </option>
                        <option value='Breakfast'>Breakfast</option>
                        <option value='Lunch'>Lunch</option>
                        <option value='Dinner'>Dinner</option>
                    </select>
                </form>
                </div>
            </div>

</ul>

   <div class="search" style="float:right; margin-right: 50px; display: inline-block;">
      <input type="text" class="searchTerm" placeholder="Search" style="height:30px">
      <button type="submit" style="background-color: transparent; border:none; color:black">
       <i class="material-icons">search</i>
     </button>
   </div>
</div>
<br>
<div class="index-content" style="border-top:2px solid #30BB6D; border-bottom: 2px solid #30BB6D">
    <div class="container">
        @if(!$sortDishes)
        @foreach($sortDishes as $sdish)
            <a href="blog-ici.html">
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{asset('dish_imgs/'.$sdish->dish_img)}}">
                       <center> <h4 style="font-size: 18px; border-top: 1px solid #30BB6D; color:#30BB6D; border-bottom: 1px solid #30BB6D">{{$sdish->dish_name}}</h4></center>
                         <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                          <a href="blog-ici.html" class="blue-button">View Details</a>
                         
                    
                    </div>
                </div>
            </a>
        @endforeach
        @else
        @foreach($sortDishes as $dish)
            <a href="blog-ici.html">
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{asset('dish_imgs/'.$dish->dish_img)}}">
                       <center> <h4 style="font-size: 18px; border-top: 1px solid #30BB6D; color:#30BB6D; border-bottom: 1px solid #30BB6D">{{$dish->dish_name}}</h4></center>
                         <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                          <a href="blog-ici.html" class="blue-button">View Details</a>
                         
                    
                    </div>
                </div>
            </a>
        @endforeach
        @endif
        
        
<!--            <a href="blog-ici.html">
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{asset('img/shrimpandbroccolipenne.jpg')}}">
                       <center> <h4 style="font-size: 18px; border-top: 1px solid #30BB6D; color:#30BB6D; border-bottom: 1px solid #30BB6D">Caldereta</h4></center>
                         <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                          <center><a href="blog-ici.html" class="blue-button">View Details</a>
                       
                    
                    </div>
                </div>
            </a>

            <a href="blog-ici.html">
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{asset('img/shrimpandbroccolipenne.jpg')}}">
                       <center> <h4 style="font-size: 18px; border-top: 1px solid #30BB6D; color:#30BB6D; border-bottom: 1px solid #30BB6D">Caldereta</h4></center>
                         <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                          <center><a href="blog-ici.html" class="blue-button">View Details</a>
                       
                    
                    </div>
                </div>
            </a>

            <a href="blog-ici.html">
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{asset('img/shrimpandbroccolipenne.jpg')}}">
                       <center> <h4 style="font-size: 18px; border-top: 1px solid #30BB6D; color:#30BB6D; border-bottom: 1px solid #30BB6D">Caldereta</h4></center>
                         <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                          <center><a href="blog-ici.html" class="blue-button">View Details</a>
                       
                    
                    </div>
                </div>
            </a>

                <a href="blog-ici.html">
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{asset('img/shrimpandbroccolipenne.jpg')}}">
                       <center> <h4 style="font-size: 18px; border-top: 1px solid #30BB6D; color:#30BB6D; border-bottom: 1px solid #30BB6D">Caldereta</h4></center>
                         <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                          <center><a href="blog-ici.html" class="blue-button">View Details</a>
                       
                    
                    </div>
                </div>
            </a>

        <a href="blog-ici.html">
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{asset('img/shrimpandbroccolipenne.jpg')}}">
                       <center> <h4 style="font-size: 18px; border-top: 1px solid #30BB6D; color:#30BB6D; border-bottom: 1px solid #30BB6D">Caldereta</h4></center>
                         <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                          <center><a href="blog-ici.html" class="blue-button">View Details</a>
                       
                    
                    </div>
                </div>
            </a>

                <a href="blog-ici.html">
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{asset('img/shrimpandbroccolipenne.jpg')}}">
                       <center> <h4 style="font-size: 18px; border-top: 1px solid #30BB6D; color:#30BB6D; border-bottom: 1px solid #30BB6D">Caldereta</h4></center>
                         <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                          <center><a href="blog-ici.html" class="blue-button">View Details</a>
                       
                    
                    </div>
                </div>
            </a>

                <a href="blog-ici.html">
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{asset('img/shrimpandbroccolipenne.jpg')}}">
                       <center> <h4 style="font-size: 18px; border-top: 1px solid #30BB6D; color:#30BB6D; border-bottom: 1px solid #30BB6D">Caldereta</h4></center>
                         <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                          <center><a href="blog-ici.html" class="blue-button">View Details</a>
                       
                    
                    </div>
                </div>
            </a>-->

     <center><a href="#" style="font-family: verdana; color:#30BB6D; font-size: 15px">See all ></a>


    </div>
</div>

     </div><!--row!-->
       </div><!--container!-->
         </div><!--section!-->
    </div><!--main raised!-->

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
      $(document).ready(function() {
          $('#sort').on('change', function() {
              $value = $('#sort').val();
              if($value == "Best Eaten") {
                 $('#bestEaten').show();
              }
          });
          $('#category').on('change', function() {
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
@endsection