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

            <a href="{{url('/home/express')}}" class=" btn btn-danger btn-raised btn-lg" style="background-color:transparent;border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px " id="ordermode">
            <center> Express Meal</center>
            </a>
                <a href="{{url('/home/planned')}}" class=" btn btn-danger btn-raised btn-lg" id="ordermode" style="background-color:transparent;  border:2px solid white; font-family: 'Anton', sans-serif; font-size: 20px ">
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
  
                    <div class="search" style="float:right; margin-right: 50px; display: inline-block;">
                       <input type="text" id="input" class="searchTerm" placeholder="Search" style="height:30px">
                       <button type="submit" style="background-color: transparent; border:none; color:black">
                        <i class="material-icons">search</i>
                      </button>
                       
                       <ul id="dishNames" style="display:none">
                           @foreach($dishes as $dish)
                           <li><a href="#"></a>{{$dish->dish_name}}</li>
                           @endforeach
                       </ul>
                    </div>
                </div>
<br>
<div class="index-content" style="border-top:2px solid #30BB6D; border-bottom: 2px solid #30BB6D">
    <div class="container">
        @if($dishes)
        @foreach($dishes as $dish)
            
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{asset('dish_imgs/'.$dish->dish_img)}}" style="width:85%; height:240px; border-radius: 10px">
                       <center> <h4 style="font-size: 18px; border-top: 1px solid #30BB6D; color:#30BB6D; border-bottom: 1px solid #30BB6D">{{$dish->dish_name}}</h4></center>
                         <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                          <button class="btn btn-success" data-toggle="modal" data-target="#dtlModal{{$dish->did}}">View Details</button>
                    </div>
                </div>
            
        @endforeach
        @endif



     <center><a href="#" style="font-family: verdana; color:#30BB6D; font-size: 15px">See all ></a>


    </div>
</div>

        </div><!--row!-->
       </div><!--container!-->
    </div><!--section!-->
</div><!--main raised!-->

<!-- View Details -->       
       @foreach($dishes as $dish)
        <div class="modal fade" id="dtlModal{{$dish->did}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:350px; float:center;">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title" style="color:white"><i class="fa fa-cutlery"></i><strong> Dish Details</strong></h4>
                </div>
                    <div class="modal-body">
                        <center><h4 style="color:#30BB6D;"><strong>{{$dish->dish_name}}</strong></h1></center>
                        <center><img src="{{url('./dish_imgs/'.$dish->dish_img)}}"></center>
                        <center><p style="border-top:2px solid #30BB6D;  margin-top: 10px">{{$dish->dish_desc}}</p></center>
                        <center> 
                        <dl>
                            <dt>Price:</dt>
                            <dd>Php {{$dish->sellingPrice}}</dd>
                            <dt>Preparation Time:</dt>
                            <dd><?php echo date('h:i A', strtotime($dish->preparation_time)); ?></dd>
                            <dt>Serving size:</dt>
                            <dd>{{$dish->no_of_servings}} serving(s)</dd>
                        </dl>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
                    </div>
            </div>
	</div>
        </div>
       @endforeach
<!--  End View Details -->
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
       
      
       
        var slider = $('#sliderDouble').noUiSlider({
	start: [20, 60] ,
	connect: true,
	range: {
	    min: 20,
	    max: 100
	}
        
        });
        
        slider.on('change', function() {
            alert('hey');
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
@endsection