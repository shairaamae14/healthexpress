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

.box-solid:hover{
 box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 20px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3) !important;

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

#load{
  
}

/*Resize the wrap to see the search bar change!*/

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
            <h1 class="title text-left" style="font-size: 80px; font-family: 'Lobster', cursive;">Planned Meals</h1>
             
             <a href="./home"><button id="ordermode" style="background-color:transparent;  border:2px solid white; font-size: 40px; margin-top:-20px; margin-left:10px; font-family: 'Lobster', cursive; color:white; width: 300px">Express Meal
             </button>
             </a>

        </div>

      
      </div>
    </div>
  </div>

    <div class="main main-raised">
        <div class="section">
            <div class="container">
                <div class="row">

                <div class="card card-signup">
                <div class="header header-success text-center">
                  <h1 style="font-family: Lato">CHOOSE YOUR PLAN</h1>
                  <!-- <div class="social-line">
                    <a href="#pablo" class="btn btn-simple btn-just-icon">
                      <i class="fa fa-facebook-square"></i>
                    </a>
                    <a href="#pablo" class="btn btn-simple btn-just-icon">
                      <i class="fa fa-twitter"></i>
                    </a>
                    <a href="#pablo" class="btn btn-simple btn-just-icon">
                      <i class="fa fa-google-plus"></i>
                    </a>
                  </div> -->
                </div> 
                <div class="content">
                <div id="content">
                   @foreach($plans as $plan)
                <div class="col-sm-4">
                    <div class="box box-solid" style="box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                         <div class="box-header with-border">  

                          <h3 class="text-center">{{$plan->name}}</h3>
                          <select class="form-control">
                               <option>1 Person</option>
                                 <option>2 Person/s</option>
                                   <option>3 Person/s</option>
                                     <option>4 Person/s</option>
                          </select>
                          <h2 class="text-center"> {{ number_format($plan->cost, 2) }}</h2>
                                    @if ($plan->description)
                                                  <p>{{ $plan->description }}</p>
                                      @endif
                          <center><button type="button" class="btn btn-success" id="btnplan">CHOOSE PLAN</button>
                         <br>
                       </div>
                       <br>
                   </div>
                </div>
                   @endforeach
                        

<!--                         <div class="col-sm-4">
                         <div class="box box-solid" style="box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                              <div class="box-header with-border">  
                               
                               <h3 class="text-center"> Meal Plan 1</h3>
                                 <select class="form-control">
                                    <option>1 Person</option>
                                      <option>2 Person/s</option>
                                        <option>3 Person/s</option>
                                          <option>4 Person/s</option>
                               </select>
                               <h2 class="text-center"> Php 450.00</h2>
                                  <center> <button type="button" class="btn btn-success">CHOOSE PLAN</button>
                              <br>
                            </div>
                            <br>
                        </div>
                        </div>
                       

                         <div class="col-sm-4">
                         <div class="box box-solid" style="box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                              <div class="box-header with-border">  
                               
                               <h3 class="text-center"> Meal Plan 1</h3>
                                 <select class="form-control">
                                    <option>1 Person</option>
                                      <option>2 Person/s</option>
                                        <option>3 Person/s</option>
                                          <option>4 Person/s</option>
                               </select>
                               <h2 class="text-center"> Php 450.00</h2>
                                  <center> <button type="button" class="btn btn-success">CHOOSE PLAN</button>
                              <br>
                            </div>
                            <br>
                        </div>
                        </div>-->
                        <br>

                  </div>

                      </div>
                  


                   <div id="content2" style="display:none">
                          <div class="col-sm-3">
                     <div class="form-group label-floating has-success">
                          <label class="control-label">Number of days:</label>
                          <input type="number" name="numberof" id="umberof" class="form-control" min="1" max="6" required autofocus/>
                      </div>

                    </div>

                    <div class="footer text-center">
                    <button type="button" class="btn btn-success" id="next">Next</button>
                     <center> <button type="button" class="btn btn-success" id="back">Back</button>
                    </div>
                
                      

                  </div>



                  <div id="content3" style="display:none">
                       <div class="col-sm-8">
                         <div class="box box-solid" style="box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                              <div class="box-header with-border">  
                               
                               <h3 class="text-center">Dish</h3>
                               <center><button type="button" class="btn btn-success" id="btnplan">+</button>
                              <br>
                            </div>
                            <br>
                        </div>
                      </div>

                      <div class="col-sm-4">
                         <div class="box box-solid" style="box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                              <div class="box-header with-border">  
                               
                               <h3 class="text-center">Your Meals</h3>
                               <select class="form-control">
                                    <option>1 Person</option>
                                      <option>2 Person/s</option>
                                        <option>3 Person/s</option>
                                          <option>4 Person/s</option>
                               </select>
                               <h2 class="text-center"> Php 450.00</h2>
                               <center><button type="button" class="btn btn-success" id="btnplan">+</button>
                              <br>
                            </div>
                            <br>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-sm-8" style="margin-top:0;">
                      <div class="box box-solid" style="box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
                              <div class="box-header with-border">  
                               
                               <h3 class="text-center">Dish</h3>
                               <center><button type="button" class="btn btn-success" id="btnplan">+</button>
                              <br>
                            </div>
                            <br>
                        </div>
                      </div>
                      </div>

                      <div class="footer text-center">
                      
                       <center> <button type="button" class="btn btn-success" id="back">Back</button>
                      </div>
                  </div>
                 


                        </div><!--content!-->













                    </div><!--cardsignup!-->

                
                <br><br>
                </div>
             


                           



        </div><!--row!-->
       </div><!--container!-->


    </div><!--section!-->

</div><!--main raised!-->
</div><!--wrapper!-->








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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

$(document).ready(function (){
$('#btnplan').on('click', function(){
$('#content').hide();
$('#content2').show();
});

$('#back').on('click', function() {
  $('#content2').hide();
  $('#content').show();x
});
$('#next').on('click', function() {
  $('#content2').hide();
  $('#content3').show();
});


});






$(document).ready(function(){
    $('#quantity').on('keyup change', function() {

        alert('yey');   
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

                    
