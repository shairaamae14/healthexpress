@extends('cook-layouts.cook-master')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js" ></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js" ></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
            <div>
                <button type="button" class="btn bg-olive btn-flat btn-lg" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Cancel</button>
            </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
             <div class="container">
    @foreach($dishes as $dish)
       <form id="example-advanced-form" method="post" action="{{route('cook.dishes.update', ['id' => $dish->did])}}" enctype="multipart/form-data">
        {{csrf_field()}}
    <h3>Dish</h3>
    <fieldset>
        <legend>Dish Details</legend>
            <div class="form-group col-md-4">
              <input type="file" class="dropify" data-height="160" data-default-file="{{asset('dish_imgs/'.$dish->dish_img)}}" data-allowed-file-extensions="jpg jpeg png svg" name="img">
        </div>

        <div class="form-group col-md-3">
            <!-- <label>Name:</label> -->
            <input type="text" class="form-control" id="dish_name" name="dish_name" placeholder="Name" value="{{$dish->dish_name}}" required autofocus>
        </div>
        <div class="form-group col-md-3">
            <!-- <label>No.of Serving:</label> -->
            <input type="number" class="form-control" id="serving" name="serving" placeholder="No. of serving(s)" min="1" value="{{$dish->no_of_servings}}" required autofocus>
        </div>
        <div class="form-group col-md-3">
            <!-- <label>Preparation Time:</label>  -->
            <input type="text" id="duration" name="duration"  required>
        </div>

        <div class="form-group col-md-3">
            <!-- <label>Price:</label> -->
            <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{$dish->basePrice}}" required>
        </div>
        <div class="form-group col-md-3">
            <label>Best Eaten during:</label><br>
            @foreach($beaten as $be)
                @if($dish->be_id == $be->be_id)
                <input type="checkbox" class="flat-red" value="{{$be->be_id}}" id="best" name="best[]" checked><label>{{$be->name}}</label>
                @else
                <input type="checkbox" class="flat-red" value="{{$be->be_id}}" id="best" name="best[]"><label>{{$be->name}}</label>
                @endif
            @endforeach
        </div> 

        <div class="form-group col-md-3 ">
            <label>Signature Dish:</label><br>
            @if($dish->isSignatureDish == '1')
            <input type="checkbox" id="signDish" name="signDish" value="1" checked><label>Yes</label>
            <input type="checkbox" id="signDish" name="signDish" value="0"><label>No</label>
            @else
            <input type="checkbox" id="signDish" name="signDish" value="1" ><label>Yes</label>
            <input type="checkbox" id="signDish" name="signDish" value="0" checked><label>No</label>
            @endif
        </div>
        <div class="form-group col-md-12">
            <label>Description:</label>
            <textarea class="form-control" rows="3" id="dish_desc" name="dish_desc" placeholder="Description" required autofocus>{!!$dish->dish_desc!!}</textarea>               
        </div>
    </fieldset>
 
    <h3>Ingredients</h3>
    <fieldset>
        <legend>Ingredient Details</legend>
        <div class="form-group">
          <select class="js-data-example-ajax form-control col-md-12 select2" id="ingredients" name="ingredients" autofocus="">
            @foreach($list as $ing)
              <option value="{{$ing->id}}">{{$ing->Shrt_Desc}}</option>
            @endforeach
          </select>
          <input type="hidden" id="ing_id" multiple name="ing_id[]" value=""/>
        </div>
        <div class="form-group col-md-4">
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" ng-model="choice.name" min="0" autofocus >
        </div>
        <div class="form-group col-md-3">
            <select class="form-control" id="preparation" name="preparation" style="width:100px;" autofocus>
                @foreach($preps as $prep)
                    <option value="{{ $prep->p_id }}">{{$prep->p_name}}</option> 
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <select class="form-control" id="um" name="um" style="width:150px;">
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
                  <th style="width:150px">Option</th>
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
                    <td><button type="button" id="remove" onclick="remove({{$di->ding_id}})" class="remove"><i class="fa fa-times"></i></button><button type="button" class="btn btn-flat fa fa-edit" style="background-color:#30BB6D; color:white; border:none; margin-top: 0px; line-height: 100%; float:right" data-toggle="modal" data-target="#myModal{{$di->id}}"></button></td>
                </tr>
                @endforeach
            </table>
        </div>
    </fieldset>
 
    <h3>Dish Summary</h3>
    <fieldset>
        <legend>Dish Summary</legend>
 
        <p>Dish Details</p>
        <div id="summary"></div>
        <p>Ingredient Details</p>
    </fieldset>
</form>
@endforeach
</div>

 <!-- modal -->
@foreach($dish_ingredients as $di)
<div class="modal fade" id="myModal{{$di->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <button type="buton" class="btn btn-info btn-simple" onclick="changes(); return false;">Change</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- end of modal -->

        </div>
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

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="{{asset('js/jquery.steps.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
   
    var form = $("#example-advanced-form").show();
 
    form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }
            // Forbid next action on "Warning" step if the user is to young
            if (newIndex === 3 && Number($("#age-2").val()) < 18)
            {
                return false;
            }
            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex)
            {
                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {
            // Used to skip the "Warning" step if the user is old enough.
            if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
            {
                form.steps("next");
            }
            // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
            if (currentIndex === 2 && priorIndex === 3)
            {
                form.steps("previous");
            }
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        }
    }).validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            confirm: {
                equalTo: "#password-2"
            }
        }
    });
      $('.js-data-example-ajax').select2();
</script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('js/durationpicker.js')}}"></script>
<script src="{{asset('js/dropify.min.js')}}"></script>

<script type="text/javascript">
    // Duration
    $('#duration').durationPicker();

    
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

    var dropify = $('.dropify').dropify({
        messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
       });

$(document).ready(function () {
   
    $('#part').on('click','.remove', function() {
          $(this).closest(".iRow").remove();
      });
    $('#cancel').on('click', function() {
      window.location = '{{url("/cook/dishes")}}';
    });

    });


    function remove(id){
        $.get( "{{ url('/cook/remove?id=') }}"+id);
    }
    function del(id){
        $('#remove'+id).remove();
    }



    function changes(){

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



        return false;


    }

    function addChoice()
    {
        
        var ingid = document.getElementById('ingredients').value;
        var quan = document.getElementById('quantity').value;
        // var ingid = document.getElementById('ing_id').value;
        var prepp = $('#preparation').val();
        var umm = $('#um').val();

        var ingred = $("#ingredients option:selected").map(function() {
            return $(this).text();
          }).get();

        var prep = $("#preparation option:selected").map(function() {
            return $(this).text();
          }).get();
        
        var um = $("#um option:selected").map(function() {
            return $(this).text();
          }).get();
        

        var div = document.getElementById("part");

             div.innerHTML += 
                '<tr style="text-align:center" id="remove'+ingid+'">'+
                        '<td multiple>'+ingred+'</td>'+
                        '<input type="hidden" id="ingid" name="ingid[]" value="'+ingid+'">'+
                        '<td multiple multiple name="qty[]">'+quan+'</td>'+
                        '<input type="hidden" id="qtyy" name="qtyy[]" value="'+quan+'">'+
                        '<td multiple name="prep[]">'+prep+'</td>'+
                        '<input type="hidden" id="prepp" name="prepp[]" value="'+prepp+'">'+
                        '<td multiple name="unit[]">'+um+'</td>'+
                        '<input type="hidden" id="umm" name="umm[]" value="'+umm+'">'+
                        '<td><button type="button" onclick="del('+ingid+')" class="remove"><i class="fa fa-times"></i></button></td>'+
                        '</tr>';

         $('select').select2().select2('val', $('#ingredients option:eq(0)').val());

         document.getElementById('quantity').value='';
        $('#preparation option').prop('selected', function() {
            return this.defaultSelected;
        });
        $('#um option').prop('selected', function() {
            return this.defaultSelected;
        });

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

<script>

$(document).ready(function(){



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


