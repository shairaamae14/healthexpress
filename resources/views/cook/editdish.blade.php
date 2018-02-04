@extends('cook-layouts.cook-master')
<style>

fieldset{
    background: #FCFCFC;
    padding: 16px;
    border: 1px solid #D5D5D5;
}
.remove{
    background: #C76868;
    color: #FFF;
    font-weight: bold;
    font-size: 24px;
    border: 0;
    cursor: pointer;
    display: inline-block;
    padding: 4px 9px;
    vertical-align: top;
    line-height: 100%;
}   
.durationpicker-container {
    background-color: white;
    border: 1px solid darkgrey;
    display: inline-block;
    width: auto;
}

.durationpicker-innercontainer {
    display: inline-block;
    width: auto;
    padding-right: 5px;
}

.durationpicker-duration {
    width: 50px;
    display: inline-block;
    border: none;
    padding-left: 10%;
    text-align: right;
}

.durationpicker-label {
    display: inline-block;
}
</style>


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Dishes</h1>
            <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dishes</li>
            </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1"  class="btn-primary" style="background-color: #30BB6D; color:white; border-radius:150px"><center><img src="{{asset('img/food.svg')}}" style="width:55px; height:45px"/></center></a>
                        <p>Dish Details</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" class="btn-default" style="background-color: #30BB6D; color:white; border-radius:150px" disabled="disabled"><center><img src="{{asset('img/ingredients.svg')}}" style="width:75px; height:55px"/></center></a>
                        <p>Ingredients</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" class="btn-default" style="background-color: #30BB6D; color:white; border-radius:150px" disabled="disabled"><center><img src="{{asset('img/plus.svg')}}" style="width:55px; height:45px"/></center></a>
                        <p>Save Dish</p>
                    </div>
                </div>
            </div>
        @foreach($dishes as $dish)
        <form role="form"  method="post" action="{{route('cook.dishes.update', ['id' => $dish->did])}}" enctype="multipart/form-data">
         {{csrf_field()}}
            <div class="row setup-content" id="step-1">
                <div class="col-xs-9 col-md-offset-3 ">
                    <div class="col-md-12">
                        <h3>Dish Details</h3>

                            <div class="form-group col-md-5">
                                <img src="{{asset('dish_imgs/'.$dish->dish_img)}}" class="img-circle" id="img-tag" width="200px" />
                                <br>
                                <label for="exampleInputFile">Dish Image</label>
                                <input type="hidden" name="img" value="{{$dish->dish_img}}">
                                <input type="file" id="img" name="img">
                                  <p class="help-block">jpg., jpeg., png. extension only</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Name:</label>
                                <input type="text" class="form-control" id="dish_name" name="dish_name" placeholder="Name" value="{{$dish->dish_name}}" required autofocus>
                            </div>
                            <div class="form-group col-md-4">
                                <label>No. of Serving:</label>
                                <input type="number" class="form-control" id="serving" name="serving" placeholder="No. of serving(s)" min="1" value="{{$dish->no_of_servings}}" required autofocus>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Preparation Time:</label> 
                                <input type="text" id="duration" name="duration" value="{{$dish->preparation_time}}" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Price:</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{$dish->basePrice}}" required>
                            </div>
                            <div class="form-group col-md-8">
                                <label>Best Eaten during: {{$dish->name}}</label><br>
                                @foreach($beaten as $be)
                                    @if($dish->be_id == $be->be_id)
                                    <input type="checkbox" class="flat-red" value="{{$be->be_id}}" id="best" name="best[]" checked><label>{{$be->name}}</label>
                                    @else
                                    <input type="checkbox" class="flat-red" value="{{$be->be_id}}" id="best" name="best[]"><label>{{$be->name}}</label>
                                    @endif
                                @endforeach
                            </div> 
                            <div class="form-group col-md-8">
                                <label>Signature Dish:</label><br>
                                @if($dish->isSignatureDish == '1')
                                <input type="checkbox" id="signDish" name="signDish" value="1" checked><label>Yes</label>
                                <input type="checkbox" id="signDish" name="signDish" value="0"><label>No</label>
                                @else
                                <input type="checkbox" id="signDish" name="signDish" value="1" ><label>Yes</label>
                                <input type="checkbox" id="signDish" name="signDish" value="0" checked><label>No</label>
                                @endif
                            </div> 
                            <div class="form-group col-md-9">
                                <label>Description:</label>
                                <textarea class="form-control" rows="3" id="dish_desc" name="dish_desc" placeholder="Description" required autofocus>{!!$dish->dish_desc!!}</textarea>                
                           </div>

                            <div class="col-md-10">
                                <button type="button" class="btn btn-primary nextBtn btn-lg" id="cancel">Cancel</button>
                                <button class="btn btn-success nextBtn btn-lg pull-right" onclick="summary()" type="button">Next</button>
                            </div>

                    </div>
                </div>
            </div>

            <div class="row setup-content" id="step-2">
                <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                        <h3>Ingredient Details</h3>
                            <div class="form-group ui-widget">
                              <input type="text" class="form-control" name="ingredients" id="ingredients" placeholder="Search" autofocus>
                              <input type="hidden" id="ing_id" multiple name="ing_id[]" value=""/>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" id="quantity" name="quantity[]" placeholder="Quantity" ng-model="choice.name" min="0" autofocus>
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control" id="preparation" name="preparation[]" id="preparation" name="preparation" style="width:100px;" autofocus>
                                    @foreach($preps as $prep)
                                        <option value="{{ $prep->p_id }}">{{$prep->p_name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" id="um" name="um[]" name="um" style="width:150px;">
                                  @foreach($units as $um)
                                    <option value="{{ $um->um_id }}">{{$um->um_name}}</option> 
                                  @endforeach
                                </select>
                            </div>
                            <button class="remove" ng-show="$last" ng-click="removeChoice()">-</button>
                            
                            <button class="addfields remove" onclick="addChoice(); return false;" ng-click="addNewChoice()">+</button>  
                            <div class="form-group">
                            <table id="part">
                                <tr>
                                  <th style="width:150px">Ingredient Name</th>
                                  <th style="width:150px">Quantity</th>
                                  <th style="width:150px">Preparation</th>
                                  <th style="width:150px">Unit of Measure</th>
                                  <th style="width:200px">Option</th>
                                </tr>
                                @foreach($dish_ingredients as $di)
                                <tr class="iRow" id="iRow">
                                    <input type="hidden" name="ding_id[]" value="{{$di->ding_id}}">
                                    <td>{{$di->Shrt_Desc}}</td>
                                    <input type="hidden" id="ingid" name="ingids[]" value="{{$di->ding_id}}">
                                    <td id="quanN">{{$di->quantity}}</td>
                                    <input type="hidden" id="qtyy" name="qtyys[]" value="{{$di->quantity}}">
                                    <td id="prepN">{{$di->p_name}}</td>
                                    <input type="hidden" id="prepp" name="prepps[]" value="{{$di->preparation}}">
                                    <td id="unitN">{{$di->um_name}}</td>
                                    <input type="hidden" id="umm" name="umms[]" value="{{$di->um_id}}">
                                    <td><button type="button" id="remove" onclick="remove({{$di->ding_id}})" class="remove"><i class="fa fa-times"></i></button>&nbsp;<button type="button" class="btn btn-flat fa fa-edit" style="background-color:#30BB6D; color:white; border:none; margin-top: 0px; line-height: 100%; float:right" data-toggle="modal" data-target="#myModal{{$di->id}}"></button></td>
                                </tr>
                                @endforeach
                            </table>
                            </div>
                            <div>    
                                <button class="btn btn-primary btn-lg pull-left" type="button" href="step-1">Previous</button>    
                                <button class="btn btn-success nextBtn btn-lg pull-right" type="button" >Next</button>
                            </div>



                            
                    </div>
                </div>
            </div>


            <div class="row setup-content" id="step-3">
                <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                        <h3> Step 3</h3>
                        <div>
                            <p>Dish Details</p>
                            <div id="summary"></div>                   
                        </div>
                        <button type="submit" class="btn btn-block btn-success pull-right" href="{{route('cook.dishes.update', ['id' => $dish->did])}}"><i class="fa fa-plus"></i>Update Dish</button> 
                    </div>
                </div>
            </div>
        </form>
        @endforeach
        </div>


        <!-- modal -->
                            @foreach($dish_ingredients as $di)
                                <div class="modal fade" id="myModal{{$di->id}} mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Change</b></h4>
                                            </div>&nbsp;&nbsp;
                                            <div class="modal-body">
                                                <form method="post" action="#" enctype="multipart/form-data">
                                                {{csrf_field()}} 
                                                    <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;<b>Ingredient Details</b></h4>
                                                <div class="col-sm-12">
                                                    <div class="form-group label-floating has-success">
                                                        <label class="control-label">Quantity</label>
                                                        <input type="text" class="form-control" id="quantityN" name="quantityN" value="{{$di->quantity}}" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating has-success">
                                                        <label class="control-label">Preparation</label>
                                                        <select class="form-control" id="preparationN" name="preparationN[]" id="preparation" name="preparation" style="width:100px;" autofocus>
                                                            @foreach($preps as $prep)
                                                                @if($di->preparation == $prep->p_id)
                                                                <option selected value="{{ $prep->p_id }}">{{$prep->p_name}}</option>
                                                                @else
                                                                <option value="{{ $prep->p_id }}">{{$prep->p_name}}</option> 
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating has-success">
                                                        <label class="control-label">Unit of Measure</label>
                                                        <select class="form-control" id="umN" name="umN[]" style="width:150px;">
                                                            @foreach($units as $um)
                                                                @if($di->um_id == $um->um_id)
                                                                <option selected value="{{ $um->um_id }}">{{$um->um_name}}</option>
                                                                @else
                                                                <option value="{{ $um->um_id }}">{{$um->um_name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-info btn-simple" data-dismiss="modal" onclick="changes({{$di->id}}); return false;" style="color:#30BB6D">Change</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- end of modal -->



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

@endsection
@section('addtl_scripts')
<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('js/durationpicker.js')}}"></script>


<script type="text/javascript">
    // Duration

    $('#duration').durationPicker();
    $('#button').on('click', function() {
        var input= $('#duration').val();
        alert(input);
    });
    
    //Change image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#img").change(function(){
        readURL(this);
    });

$(document).ready(function () {
    $("#change").on('click',function(){
        $('#mod').modal('hide');
    });

    $('#part').on('click','.remove', function() {
          $(this).closest(".iRow").remove();
      });
    $('#cancel').on('click', function() {
      window.location = '{{url("/cook/dishes")}}';
    });
// Wizard Step
var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
    });


    function remove(id){
        $.get( "{{ url('/cook/remove?id=') }}"+id);
    }



    function changes(id){

        var quan = document.getElementById('quantityN').value;
        var prep = $("#preparationN option:selected").map(function() {
            return $(this).text();
          }).get();
        var prepp = $('#preparationN').val();
        var um = $("#umN option:selected").map(function() {
            return $(this).text();
          }).get();
        var umm = $('#umN').val();

        document.getElementById("quanN").innerHTML = quan;
        document.getElementById("prepN").innerHTML = prep;
        document.getElementById("unitN").innerHTML = um;

        document.getElementById("qtyy").value = quan;
        document.getElementById("prepp").value = prepp;
        document.getElementById("umm").value = umm;


        $('#closemodal').click(function() {
            $('#modalwindow').modal('hide');
        });
        return false;


    }

    function addChoice()
    {
        
        var div = document.getElementById("part");

        var ingred = document.getElementById('ingredients').value;
        var quan = document.getElementById('quantity').value;
        var ingid = document.getElementById('ing_id').value;
        var prep = $("#preparation option:selected").map(function() {
            return $(this).text();
          }).get();
        var prepp = $('#preparation').val();
        var um = $("#um option:selected").map(function() {
            return $(this).text();
          }).get();
        var umm = $('#um').val();

                div.innerHTML += 
                        '<tr style="text-align:center">'+
                        '<td >'+ingred+'</td>'+
                        '<input type="hidden" id="ingid" name="ingid[]" value="'+ingid+'">'+
                        '<td multiple name="qty[]">'+quan+'</td>'+
                        '<input type="hidden" id="qtyy" name="qtyy[]" value="'+quan+'">'+
                        '<td multiple name="prep[]">'+prep+'</td>'+
                        '<input type="hidden" id="prepp" name="prepp[]" value="'+prepp+'">'+
                        '<td multiple name="unit[]">'+um+'</td>'+
                        '<input type="hidden" id="umm" name="umm[]" value="'+umm+'">'+
                        '<td><button type="button" id="remove" class="remove"><i class="fa fa-times"></i></button></td>'+
                        '</tr>';

                        return false;
    }

    function summary(){

          var name = document.getElementById("dish_name").value;
          var serving = document.getElementById("serving").value;
          var ptime = document.getElementById("duration").value;
          var price = document.getElementById("price").value;
          var desc = document.getElementById("dish_desc").value;
     
          var best = $('#best:checked').map(function() {
            return $(this).next('label').text();
          }).get();
          var signDish = $('#signDish:checked').map(function() {
            return $(this).next('label').text();
          }).get();

          var div = document.getElementById('summary');
          var div2 = document.getElementById('ingred-part');
          // var i;
            div.innerHTML += 'Name: '+name+'<br>'+
                              'Serving: '+serving+'<br>'+
                              'Preparation Time: '+ptime+'<br>'+
                              'Price: '+price+'<br>'+
                              'Description: '+desc+'<br>'+
                              'Best Eaten: '+best+'<br>'+
                              'Sign Dish: '+signDish+'<br>';

    }
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
<script>

$(document).ready(function(){

    $( "#ingredients" ).autocomplete({
        source: function( request, response ) {
            $.ajax( {
              url: "{{ url('/cook/searchIngredients') }}",
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
                            id: d.id,
                            value: d.Shrt_Desc,
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

            $('#ing_id').val(ui.item.id);

            displayPreviewDish(ui.item.id);
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

//When unchecking the checkbox
$("#check-all").on('ifUnchecked', function (event) {
  //Uncheck all checkboxes
  $("input[type='checkbox']", ".user_permissions_table").iCheck("uncheck");
});
//When checking the checkbox
$("#check-all").on('ifChecked', function (event) {
  //Check all checkboxes
  $("input[type='checkbox']", ".user_permissions_table").iCheck("check");
});
    

   
});
  
</script>
@endsection


