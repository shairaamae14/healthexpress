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

#rev:hover{
  text-decoration: none !important;
  color:black !important;
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

    <div class="main main-raised"  style="width: 65%; float: left">
        <div class="section">
            <div class="container" style="width: 90%;">
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


  @if($dishes)
        @foreach($dishes as $dish)
  <div class="col-sm-3">
                 <div class="box box-solid" style="border-radius:5px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                        <div class="box-header with-border">
                        
                            <center><img src="{{asset('dish_imgs/'.$dish->dish_img)}}" style="width:150px; height:150px; border-radius:10px; border:1px solid #F0F0F0; margin-top: 10px;"></center>

                        </div>

                        <center><h4 class="openModal box-title" style="margin-top: 5px; font-size: 12px;"><a href="{{route('home.details', ['id' => $dish->did])}}" style="border-top: 1px solid #30BB6D; border-bottom: 1px solid #30BB6D; color:#30BB6D;" value="{{$dish->dish_name}}"  id="dish_name"><b>{{$dish->dish_name}}</b></a><br>
                        <br>
                      <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                      <a href="{{route('cook.rating')}}" id="rev"><p style="font-size: 12px; color:#30BB6D; background-color:#E3E3E3">See Reviews</p></a>
                      </center>
                      
                         <p style="float:left; margin-left:5px; margin-top: 12px; font-size: 20px; font-family: 'Lobster', cursive; color:gray;" id="tots">Php {{$dish->basePrice}}</p>
                          <p onclick="myFunction('{{$dish->dish_name}}', '{{$dish->basePrice}}')" id="addme"><i class="material-icons" style="color:#30BB6D; font-size: 30px">add_circle</i></p>
                      </br>
                   

                  </div>
                </a>
                </div>
            @endforeach
        @endif 

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

            <p style="color: black; float:left; margin-top: -60px;font-size: 20px; font-family: 'Lobster', cursive;"><i class="material-icons" style="font-size:20px">shopping_cart</i> &nbsp;Your Cart</p>

                <div class="row" style="padding-right:8px; padding-left: 8px">
                   <dl class="dl-horizontal">
                             <div id="cartdiv">
                       
                        
                            
                           </div>

                         
                        </dl>




        <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
         <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lobster', cursive;" id="tots"><b>Subtotal:</b> Php 56.00</p><br>
         </div>
          <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
         <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lobster', cursive;" id="tots"><b>Delivery Fee:</b> Php 40 .00</p><br></div>
          <div class="modal-footer" style="padding-top:2px; padding-bottom: 2px; margin-top: 3px">
       <p style="float:right; margin-right:2px; font-size: 17px; color:black; font-family: 'Lobster', cursive;" id="tots"><b>Total:</b> Php 150.00</p>
     
          <button type="button" class="btn btn-flat btn-primary edit"  style="background-color:#30BB6D; float:left; margin-top: 2px; border:none" id="chkt">Checkout</button>
        </div>

                </div>
                </div>
                </div>
                </div>












<!-- View Details -->       
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
  <script type="text/javascript">
      
  </script>
  <script>

     function myFunction(name, price){
        // alert("ALERT NA PLEASE");

        var div = document.getElementById("cartdiv");
      
       
        div.innerHTML+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:black; font-size:20px">&times;</button><dt style="margin-left:-120px"><input type="number" min="1" placeholder="1" style="width: 45px; height:20px"></dt><dd style="margin-left: 2px"><label style="float: left; margin-left:0px; margin-right: 0px; font-size: 15px; color:black"><b>&nbsp;&nbsp;'+name+'</b></label> '+
           ' <label style="font-size: 15px; color: black; float:right"><b>'+price+'</b></label></dd>';
     

           }
     

</script>

