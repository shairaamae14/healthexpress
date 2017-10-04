@extends('user-layouts.master')
<style>
@import url('http://fonts.googleapis.com/css?family=Lobster');
@import url('http://fonts.googleapis.com/css?family=Anton');
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
  <div class="header header-filter" style="background-image: url('{{asset('img/bgindex.jpg')}}')">
    <div class="container">
      

      
      </div>
    </div>
  </div>

    <div class="main main-raised">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="profile-tabs">
                            <div class="nav-align-center">
                                <ul class="nav nav-pills nav-pills-success" role="tablist">
                                    <li class="active">
                                        <a href="#studio" role="tab" data-toggle="tab">
                                            <i class="material-icons">attach_money</i>
                                               Cash On Delivery 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#work" role="tab" data-toggle="tab">
                                            <i class="material-icons">credit_card</i>
                                                Credit / Debit Card
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#shows" role="tab" data-toggle="tab">
                                            <i class="material-icons">favorite</i>
                                            Favorite
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content gallery">
                                    <div class="tab-pane active" id="studio">
                                        <div class="row">
                                            
                                            
                                            <div class="col-md-6 col-md-offset-3">
                                                Payment will be cash on delivery.
                                                <button type="submit" class="btn btn-success">PROCEED TO CHECKOUT</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="tab-pane text-center" id="work">
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <img src="../assets/img/examples/chris5.jpg" class="img-rounded" />
                                                    <img src="../assets/img/examples/chris7.jpg" class="img-rounded" />
                                                    <img src="../assets/img/examples/chris9.jpg" class="img-rounded" />
                                            </div>
                                            <div class="col-md-6">
                                                    <img src="../assets/img/examples/chris6.jpg" class="img-rounded" />
                                                    <img src="../assets/img/examples/chris8.jpg" class="img-rounded" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-center" id="shows">
                                        <div class="row">
                                                <div class="col-md-6">
                                                        <img src="../assets/img/examples/chris4.jpg" class="img-rounded" />
                                                        <img src="../assets/img/examples/chris6.jpg" class="img-rounded" />
                                                </div>
                                                <div class="col-md-6">
                                                        <img src="../assets/img/examples/chris7.jpg" class="img-rounded" />
                                                        <img src="../assets/img/examples/chris5.jpg" class="img-rounded" />
                                                        <img src="../assets/img/examples/chris9.jpg" class="img-rounded" />
                                                </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Profile Tabs -->
                    </div>
                </div>
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

  

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>

<script>
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
  
  
  
  
  
    
    

@endsection
