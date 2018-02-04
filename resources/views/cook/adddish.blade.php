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



.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 50%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
.btn-primary{
    background-color: blue;
}
.btn-success{
    background-color: blue;
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

    <div class="container">
       <form id="add_dish" method="post" action="{{route('cook.dishes.create')}}" enctype="multipart/form-data">
        {{csrf_field()}}
    <h3>Dish</h3>
    <fieldset>
        <legend>Dish Details</legend>
            <div class="form-group col-md-4">
           <!--  <img src="{{asset('img/choose.png')}}" class="img-circle" id="img-tag" width="200px" />
            <br>
            <label for="exampleInputFile">Dish Image</label>
            <input type="file" id="img" name="img">
              <p class="help-block">jpg., jpeg., png. extension only</p> -->
              <input type="file" class="dropify" data-height="160" data-allowed-file-extensions="jpg jpeg png svg"/ name="img" id="img">
        </div>

        <div class="form-group col-md-3">
            <!-- <label>Name:</label> -->
            <input type="text" class="form-control" id="dish_name" name="dish_name" placeholder="Name" required autofocus>
        </div>
        <div class="form-group col-md-3">
            <!-- <label>No.of Serving:</label> -->
            <input type="number" class="form-control" id="serving" name="serving" placeholder="No. of serving(s)" min="1" required autofocus>
        </div>
        <div class="form-group col-md-3">
            <!-- <label>Preparation Time:</label>  -->
            <input type="text" id="duration" name="duration" required>
        </div>

        <div class="form-group col-md-3">
            <!-- <label>Price:</label> -->
            <div class="input-group">
            <input type="text" class="form-control" id="price" name="price" placeholder="Price" required>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label>Best Eaten during:</label><br>
            @foreach($beaten as $be)
            <input type="checkbox" class="flat-red" value="{{$be->be_id}}" id="best" name="best[]"><label>{{$be->name}}</label>
            @endforeach
        </div> 

        <div class="form-group col-md-3 ">
            <label>Signature Dish:</label><br>
            <input type="checkbox" class="signDish" id="signDish" name="signDish" value="1"><label>Yes</label>
            <input type="checkbox" class="signDish" id="signDish" name="signDish" value="0"><label>No</label>
        </div>
        <div class="form-group col-md-12">
            <label>Description:</label>
            <textarea class="form-control" rows="3" id="dish_desc" name="dish_desc" placeholder="Description" required autofocus></textarea>                
        </div>
    </fieldset>
 
    <h3>Ingredients</h3>
    <fieldset>
        <legend>Ingredient Details</legend>
        <div class="col-md-12">
        <div class="form-group">
          <select class="js-data-example-ajax form-control col-md-12" id="ingredients" name="ingredients" autofocus="">
            @foreach($list as $ing)
              <option value="{{$ing->id}}">{{$ing->Shrt_Desc}}</option>
            @endforeach
          </select>
          <input type="hidden" id="ing_id" multiple name="ing_id[]" value=""/>
        </div>
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
                </tr>
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
    

</div>


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
{{-- <script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script> --}}
<!-- jQuery UI 1.11.4 -->
{{-- <script src="{{asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script> --}}
<script src="{{asset('js/jquery.steps.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type="text/javascript">

    var form = $("#add_dish").show();
 
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
        'img' : { required: true},
        'dish_name' : {required: true},
        'serving' : {required: true},  
        'duration' : {required: true},
        'price' : {required: true},
        'signDish' : { checked: true },
        'price' : {required: true}

    }

});

    $.validator.addMethod("checked", function(value, elem, param) {
    if($(".signDish:checkbox:checked").length > 0){
       return true;
    }else {
       return false;
    }


    },"You must select at least one!");
    $(document).ready(function(){
      $('.js-data-example-ajax').select2({
      });
    });

  </script>
</script> 
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
<script src="{{asset('js/dropify.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('js/durationpicker.js')}}"></script>


<script type="text/javascript">

    // Duration
    $('#duration').durationPicker();

$(document).ready(function () {
    var dropify = $('.dropify').dropify({
        messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happened.'
    }
       });
  
    $('#cancel').on('click', function() {
      window.location = '{{url("/cook/dishes")}}';
    });

    });


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
                        '<tr style="text-align:center">'+
                        '<td multiple>'+ingred+'</td>'+
                        '<input type="hidden" id="ingid" name="ingid[]" value="'+ingid+'">'+
                        '<td multiple multiple name="qty[]">'+quan+'</td>'+
                        '<input type="hidden" id="qtyy" name="qtyy[]" value="'+quan+'">'+
                        '<td multiple name="prep[]">'+prep+'</td>'+
                        '<input type="hidden" id="prepp" name="prepp[]" value="'+prepp+'">'+
                        '<td multiple name="unit[]">'+um+'</td>'+
                        '<input type="hidden" id="umm" name="umm[]" value="'+umm+'">'+
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
          
            div.innerHTML += 'Name: '+name+'<br>'+
                              'Serving: '+serving+'<br>'+
                              'Preparation Time: '+ptime+'<br>'+
                              'Price: '+price+'<br>'+
                              'Description: '+desc+'<br>'+
                              'Best Eaten: '+best+'<br>'+
                              'Sign Dish: '+signDish+'<br>';

    }
</script>

@endsection


