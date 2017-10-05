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

</style>
<script>
  // $(document).ready(function(){
    function openCity(evt, cityName) {
      // Declare all variables
      var i, tabcontent, tablinks;

      // Get all elements with class="tabcontent" and hide them
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
      }

      // Get all elements with class="tablinks" and remove the class "active"
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      // Show the current tab, and add an "active" class to the button that opened the tab
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
      }
    document.getElementById("defaultOpen").click();
  // });
</script>
@section('content')
<div class="wrapper">
  <div class="header header-filter" style="background-image: url('{{asset('img/bgindex.jpg')}}')"">
    <div class="container">
      <div class="row">
      <center>
        <div class="col-md-6">
        
        </div>      
      </div>
    </div>
  </div><!-- header -->
  <div class="main main-raised"  style="width: 65%; float: left">
    <div class="section">
      <div class="container" style="width: 90%;">
        <div class="row">
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
  
        </div><!-- row -->
        <br>

        <div ng-cloak="" class="tabsdemoDynamicHeight" ng-app="MyApp">
          <md-content>
            <md-tabs md-dynamic-height="" md-border-bottom="">
              <md-tab label="all">
                <md-content class="md-padding">
                  <h1 class="md-display-2"></h1>
                  <p>
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
                              </br>
                          </div>
                        </div>
                    @endforeach
                @endif
                  </p>
                </md-content>
              </md-tab>

              <md-tab label="breakfast">
                <md-content class="md-padding">
                  <p>
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
                              </br>
                          </div>
                        </div>
                    @endforeach
                @endif
                  </p>
                </md-content>
              </md-tab>

              <md-tab label="lunch">
                <md-content class="md-padding">
                  <p>
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
                              </br>
                          </div>
                        </div>
                      @endforeach
                     @endif
                  </p>
                </md-content>
              </md-tab>

              <md-tab label="dinner">
                <md-content class="md-padding">
                  <p>
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
                              </br>
                          </div>
                        </div>
                      @endforeach
                     @endif
                  </p>
                </md-content>
              </md-tab>
            </md-tabs>
          </md-content>
        </div>

      <!-- </div> -->
      <!--row!-->
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

<!-- View Details -->       

<div class="main main-raised"  style="width: 25%; float: right;">
  <div class="section" style="padding-bottom: 2px">
    <div class="container" style="width: 100%">
      <p style="color: black; float:left; margin-top: -60px;font-size: 20px; font-family: 'Lobster', cursive;"><i class="material-icons" style="font-size:20px">shopping_cart</i> &nbsp;Your Cart</p>
      <div class="row" style="padding-right:8px; padding-left: 8px">
        I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.
        <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
          <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lobster', cursive;" id="tots"><b>Total:</b> 150.00</p>
          <button type="button" class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:left; margin-top: 2px; border:none">Checkout</button>
        </div>
      </div>
    </div>
  </div>
</div>

@foreach($dishes as $dish)
  <div class="modal fade" id="dtlModal{{$dish->did}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:350px; float:center;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cutlery"></i>&nbsp; Dish Details</h4>
        </div>
        <div class="modal-body">
          <center><h4 style="color:#30BB6D; margin-top: 2px"><strong>{{$dish->dish_name}}</strong></h1></center>
          <center><img src="{{url('./dish_imgs/'.$dish->dish_img)}}" style="width:85%; height:240px; border-radius: 10px"></center><br>
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
@endforeach<!--  End View Details -->
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


    <link href="https://ajax.googleapis.com/ajax/libs/angular_material/0.9.4/angular-material.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-aria.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/0.9.4/angular-material.min.js"></script>










  
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


      angular.module("MyApp", ["ngMaterial", "ngAnimate"])

.controller("tabCtrl", ["$scope", function($scope) {
    $scope.selectedTab = 0;
    
    $scope.changeTab = function() {
        if ($scope.selectedTab === 2) {
            $scope.selectedTab = 0;
        }
        else {
            $scope.selectedTab++;
        }
        
    }
}]);
  </script>

