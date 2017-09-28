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


.ui-autocomplete-loading {
    background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
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
        

        </div>

      
      </div>
    </div>
  </div>

  <div class="main main-raised"  style="width: 65%; float: left">
        <div class="section">
            <div class="container" style="width: 90%;">
                <div class="row">
                    <div id="sortDiv" class="col-md-4">
                        <label  style="display:inline-block;">Sort by:</label>
     <form method="POST" id="sortBy">
                        <meta name ="csrf-token" content = "{{csrf_token() }}"/>
                            {{csrf_field()}}
                        <select class="form-control" id="sortOption" name="sortOption">
                            <option disabled selected>- Select Option - </option>
                            <option value="Breakfast">Breakfast</option>
                            <option value="Lunch">Lunch</option>
                            <option value="Dinner">Dinner</option>
                        </select>
                        </form>
                        
                    </div>

<form method="POST" action="{{route('user.index')}}">
                        {{csrf_field()}}
                    <div class="search" style="float:right; margin-right: 50px; display: inline-block;">
                       <input type="text" id="input" class="searchTerm form-control col-md-4" placeholder="Search">
                       <input type="hidden" id="dish_id" name="id" value="">
                       <button type="submit" class="btn btn-success">
                        <i class="material-icons">search</i>
                      </button>
                       
                       <ul id="dishNames" style="display:none">
                           @foreach($dishes as $dish)
                           <li><a href="#"></a>{{$dish->dish_name}}</li>
                           @endforeach
                       </ul>
                    </div>
                    </form>
                </div>


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
                       <br>
                        <center> 
                   <!--       <button type="button" class="btn btn-flat btn-primary edit" style="background-color:#30BB6D; border:none" data-toggle="modal" data-target="#modal-default2{{$dish->did}}"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-flat btn-danger delete" style="background-color:#30BB6D; border:none" data-toggle="modal" data-target="#modal-default3{{$dish->did}}"><i class="fa fa-times"></i></button>
                        <button type="button" class="btn btn-flat btn-danger delete" style="background-color:#30BB6D; border:none; color:white;"><i class="fa fa-list-ul"></i></button>
!-->

                      </center>
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



@endsection
@section('addtl_scripts')

<!--   Core JS Files   -->
  <script src="{{asset('customer/assets/js/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('customer/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('customer/assets/js/material.min.js')}}"></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('customer/assets/js/nouislider.min.js')}}" type="text/javascript"></script>

  <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
  <script src="{{asset('customer/assets/js/bootstrap-datepicker.js')}}" type="text/javascript">
  </script>

<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<!--<script src="{{asset('customer/assets/js/material-kit.js')}}" type="text/javascript"></script>-->
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="{{asset('js/jquery.easy-autocomplete.min.js')}}"></script> 
  
 <script>
$(document).ready(function(){

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

            //displayPreviewDish(ui.item.id);
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
        
        
        
        function displayPreviewDish(id) {
           $.ajax({
                url: "{{ url('/cook/previewDishes') }}",
                dataType: "json",
                data: id,
                success: function(data) {
                    $.each(data, function() {
                        console.log(data.dish_name);
                    });
                  console.log('data sa gawas' + data);
                    var info = "<h4>"+data.dish_name+"</h4>";

                    $('#prevDiv').append(info);
                }
            });
            
        }
    
  } );

</script>
@endsection
