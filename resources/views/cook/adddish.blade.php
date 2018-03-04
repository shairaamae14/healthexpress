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
            <input type="checkbox" class="best" value="{{$be->be_id}}" id="best" name="best[]"><label>{{$be->name}}</label>
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
            <input type="text" class="form-control quantity" id="quantity" name="quantity" placeholder="Quantity" required autofocus >
            <label style="color:red" id="err"></label>
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
        <div class="col-md-12">
            <table id="part" style="margin-top:30px; margin-right:30px">
                <tr>
                  <th style="width:250px; text-align:center;">Ingredient Name</th>
                  <th style="width:150px; text-align:center;">Quantity</th>
                  <th style="width:150px; text-align:center;">Preparation</th>
                  <th style="width:150px; text-align:center;">Unit of Measure</th>
                  <th style="width:150px; text-align:center;">Action</th>
                </tr>
            </table>
        </div>
    </fieldset>
 
    <h3>Dish Summary</h3>
    <fieldset>
 
        <legend style="color:#30bb6d">Dish Summary</legend>
        <div id="summary"></div>
    </fieldset>

    </form>
    

</div>




{{-- 
@foreach($list as $ing)
<div class="modal fade" id="myModal{{$ing->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Change</b></h4>
            </div>&nbsp;&nbsp;{{-- 
            <form method="post" action="changes({{$di->ding_id}})" enctype="multipart/form-data">
                {{csrf_field()}}  --}}
            {{-- <div class="modal-body">
                
                    <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;<b>Ingredient Details</b></h4>
                <div class="col-sm-12">
                    <div class="form-group label-floating has-success">
                        <label class="control-label">Quantity</label>
                        <input type="text" class="form-control" id="quantityN{{$ing->ding_id}}" name="quantityN" value="{{$ing->quantity}}" />
                        <label style="color:red" id="err"></label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group label-floating has-success">
                        <label class="control-label">Preparation</label>
                        <select class="form-control" id="preparationN{{$ing->ding_id}}" name="preparationN[]" id="preparation" name="preparation" style="width:100px;" autofocus>
                            @foreach($preps as $prep)
                                @if($ing->preparation == $prep->p_id)
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
                        <select class="form-control" id="umN{{$ing->ding_id}}" name="umN[]" style="width:150px;">
                            @foreach($units as $um)
                                @if($ing->um_id == $um->um_id)
                                <option selected value="{{ $um->um_id }}">{{$um->um_name}}</option>
                                @else
                                <option value="{{ $um->um_id }}">{{$um->um_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" id="dishid" value="{{$ing->ding_id}}"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="changes({{$ing->ding_id}})">Save Changes</button>
            </div>
            {{-- </form> --}}
        {{-- </div>
        
    </div>
</div>
@endforeach --}}












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

{{-- <script>
    $('#myModal'+id).on('shown.bs.modal', function() {
        
    });
</script>
 --}}
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

        if(currentIndex == 0)
        {
            $('.actions > ul > li:eq(1)').removeAttr("class");
            $('.actions > ul > li:eq(1) > a').attr("href",'#next');
        }

        if(currentIndex == 1)
        {
            // alert("This script works");
            if($('#part').find('tr.ingredappend').length == 0)
            {
                $('.actions > ul > li:eq(1) > a').removeAttr('href');
                $('.actions > ul > li:eq(1)').attr('class','disabled');
                // $('.actions > ul > li:eq(1)').attr('hidden',true);
            }
            
            $('#summary').empty();


        }

        if(currentIndex === 2 || currentIndex === 3)
        {
            if ( $('#summary').children().length == 0 ) {
                summary();
            }
            
        }
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        $container = $('#add_dish').find('section[data-step="' + currentIndex +'"]');
        console.log($container);

        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        var form = $(this); form.submit();
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
        'best' : { checked: true },
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

    $.validator.addMethod("checked", function(value, elem, param) {
    if($(".best:checkbox:checked").length > 0){
       return true;
    }else {
       return false;
    }


    },"You must select one!");



    $(document).ready(function(){
        $('.js-data-example-ajax').css('width', '100%');
        $('.js-data-example-ajax').select2();
        // $('.action ').find(attr(role))
        

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

    function remove(id){

        $('#remove'+id).remove();

        if($('#part').find('tr.ingredappend').length == 0)
            {
                $('.actions > ul > li:eq(1) > a').removeAttr('href');
                $('.actions > ul > li:eq(1)').attr('class','disabled');
                // $('.actions > ul > li:eq(1)').attr('hidden',true);
            }
    }


    // function calc($str) {
    //     $int = 0;
    //     $float = 0;
    //     $parts = explode(' ', $str);
    //     if (count($parts) >= 1) {
    //         $int = $parts[0];
    //     }
    //     if (count($parts) >= 2) {
    //         $float_str = $parts[1];
    //         list($top, $bottom) = explode('/', $float_str);
    //         $float = $top / $bottom;
    //     }
    //     return $int + $float;
    // }

    function calc(str){
        var int = 0;
        var float = 0;
        // alert(str.indexOf(' ') >= 0);   
        if (str.indexOf(' ') >= 0){
            var parts = str.split(' ');

            int = parts[0];
            float = eval(parts[1]);

            // let's get the position of the radix-point
            var radixPos = String(float).indexOf('.');

            // now we can use slice, on a String, to get '.15'
            var value = String(float).slice(radixPos);
        
            return int + value;
        }
        else{
            return eval(str);
        }

        

    }

    function addChoice()
    {

        

        var ingid = document.getElementById('ingredients').value;
        var squan = document.getElementById('quantity').value;
        var quan = calc(squan);
        console.log(quan);
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


        if(quan == null || quan == 0 || quan == ''){
            document.getElementById('err').innerHTML+="This field is required";
        }
        else{
            
            $('.actions > ul > li:eq(1)').removeAttr("class");
            $('.actions > ul > li:eq(1) > a').attr("href",'#next');
            $('#err').empty();

            var div = document.getElementById("part");

            div.innerHTML += 
                '<tr class="ingredappend" id="remove'+ingid+'">'+
                '<td style="text-align:center;" multiple>'+ingred+'</td>'+
                '<input type="hidden" id="ingid" name="ingid[]" value="'+ingid+'">'+
                '<td style="text-align:center;" multiple name="qty[]">'+squan+'</td>'+
                '<input type="hidden" id="qtyy" name="qtyy[]" value="'+quan+'">'+
                '<td style="text-align:center;" multiple name="prep[]">'+prep+'</td>'+
                '<input type="hidden" id="prepp" name="prepp[]" value="'+prepp+'">'+
                '<td style="text-align:center;" multiple name="unit[]">'+um+'</td>'+
                '<input type="hidden" id="umm" name="umm[]" value="'+umm+'">'+
                '<td style="text-align:center;"><button type="button" onclick="remove('+ingid+')" class="remove"><i class="fa fa-times"></i></button></td>'+
                '</tr>';

            // console.log($("#part").find("td").text());

            $('select').select2().select2('val', $('#ingredients option:eq(0)').val());
          
            document.getElementById('quantity').value='';
            $('#preparation option').prop('selected', function() {
                return this.defaultSelected;
            });
            $('#um option').prop('selected', function() {
                return this.defaultSelected;
            });
        }
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
          // var div2 = document.getElementById('ingred-part');
          
            div.innerHTML +=  '<div class="col-md-6">'+
                                '<span class="" style="font-family: verdana; color:#30bb6d; font-size: 12px">NAME</span>&nbsp;<br>'+
                                    '<div style="padding:10px;"><span style="margin-left:30px; font-size:15px">'+name+'</span></div><br>'+
                                '<span class="" style="font-family: verdana; color:#30bb6d; font-size: 12px">SERVING</span>&nbsp;<br>'+
                                    '<div style="padding:10px;"><span style="margin-left:30px; font-size:15px">'+serving+'</span></div><br>'+
                                '<span class="" style="font-family: verdana; color:#30bb6d; font-size: 12px">PREPARATION TIME</span>&nbsp;<br>'+
                                    '<div style="padding:10px;"><span style="margin-left:30px; font-size:15px">'+ptime+'</span></div><br>'+
                                '<span class="" style="font-family: verdana; color:#30bb6d; font-size: 12px">PRICE</span>&nbsp;<br>'+
                                    '<div style="padding:10px;"><span style="margin-left:30px; font-size:15px">'+price+'</span></div><br>'+
                              '</div>'+
                              '<div class="col-md-6">'+
                                '<span class="" style="font-family: verdana; color:#30bb6d; font-size: 12px">DESCRIPTION</span>&nbsp;<br>'+'<div style="padding:10px;"><span style="margin-left:30px; font-size:15px">'+desc+'</span></div><br>'+
                                '<span class="" style="font-family: verdana; color:#30bb6d; font-size: 12px">BEST EATEN</span>&nbsp;<br>'+
                                    '<div style="padding:10px;"><span style="margin-left:30px; font-size:15px">'+best+'</span></div><br>'+
                                '<span class="" style="font-family: verdana; color:#30bb6d; font-size: 12px">SIGN DISH</span>&nbsp;<br>'+
                                    '<div style="padding:10px;"><span style="margin-left:30px; font-size:15px">'+signDish+'</span></div><br>'+
                                '</div>';

    }
</script>

@endsection


