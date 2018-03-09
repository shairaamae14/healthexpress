@extends('cook-layouts.cook-master')
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.1/css/select2.min.css" />
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
<div class="content-wrapper" id="content">
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
              <input type="hidden" name="img" value="{{$dish->dish_img}}"/>
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
            <input type="text" id="duration" name="duration" required>
            <input type="hidden" name="cduration" value="{{$dish->preparation_time}}"/>
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
            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" autofocus >
            <label style="color:red" id="error"></label>
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
            <table id="part" style="margin-top:45px; margin-right:30px">
                <tr>
                  <th style="width:150px">Ingredient Name</th>
                  <th style="width:150px">Quantity</th>
                  <th style="width:150px">Preparation</th>
                  <th style="width:150px">Unit of Measure</th>
                  <th style="width:150px">Option</th>
                </tr>
                @foreach($dish_ingredients as $di)
                <tr class="iRow" id="remove{{$di->ding_id}}">
                    <input type="hidden" name="ding_id[]" value="{{$di->ding_id}}">
                    <td>{{$di->Shrt_Desc}}</td>
                    <input type="hidden" id="ingid{{$di->ding_id}}" name="ingids[]" value="{{$di->ding_id}}">

                    <td id="quanN{{$di->ding_id}}">{{$di->quantity}}</td>
                    <input type="hidden" id="qtyy{{$di->ding_id}}" name="qtyys[]" value="{{$di->quantity}}">

                    <td id="prepN{{$di->ding_id}}">{{$di->p_name}}</td>
                    <input type="hidden" id="prepp{{$di->ding_id}}" name="prepps[]" value="{{$di->preparation}}">

                    <td id="unitN{{$di->ding_id}}">{{$di->um_name}}</td>
                    <input type="hidden" id="umm{{$di->ding_id}}" name="umms[]" value="{{$di->um_id}}">
                    <td><button type="button" id="remove" data-toggle="modal" data-target="#confirm{{$di->ding_id}}" class="remove"><i class="fa fa-times"></i></button><button type="button" class="btn btn-flat fa fa-edit" style="background-color:#30BB6D; color:white; border:none; margin-top: 0px; line-height: 100%; float:right" data-toggle="modal" data-target="#myModal{{$di->ding_id}}" {{-- data-id="{{$di->ding_id}}" --}}></button></td>
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
    </fieldset>

    <script type="text/javascript">
        $(document).ready(function(){
            var time = '{{$dish->preparation_time}}';
            var split = time.split(",");
            var hour = split[0].slice(0,-1);
            var min = split[1].slice(0,-1);

            $('#duration-hours').attr('value',hour);
            $('#duration-hours').attr('name','hours');
            $('#duration-minutes').attr('value',min);
            $('#duration-minutes').attr('name','mins');
        });
    </script>
</form>
@endforeach
</div>



<div id="modals"></div>

 <!-- modal -->
@foreach($dish_ingredients as $di)
<div class="modal fade" id="myModal{{$di->ding_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Change</b></h4>
            </div>&nbsp;&nbsp;{{-- 
            <form method="post" action="changes({{$di->ding_id}})" enctype="multipart/form-data">
                {{csrf_field()}}  --}}
            <div class="modal-body">
                
                    <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;<b>Ingredient Details</b></h4>
                <div class="col-sm-12">
                    <div class="form-group label-floating has-success">
                        <label class="control-label">Quantity</label>
                        <input type="text" class="form-control" id="quantityN{{$di->ding_id}}" name="quantityN" value="{{$di->quantity}}" />
                        <label style="color:red" id="err"></label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group label-floating has-success">
                        <label class="control-label">Preparation</label>
                        <select class="form-control" id="preparationN{{$di->ding_id}}" name="preparationN[]" id="preparation" name="preparation" style="width:100px;" autofocus>
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
                        <select class="form-control" id="umN{{$di->ding_id}}" name="umN[]" style="width:150px;">
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
                <input type="hidden" id="dishid" value="{{$di->ding_id}}"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="changes({{$di->ding_id}})">Save Changes</button>
            </div>
            {{-- </form> --}}
        </div>
        
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" class="confirm" aria-hidden="true" id="confirm{{$di->ding_id}}">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure you want to remove ingredient?</h4>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" data-dismiss="modal" onclick="remove({{$di->ding_id}})" id="modal-btn-yes">Yes</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-btn-no">No</button>
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
{{-- <div id="modals"></div> --}}
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

            if(currentIndex == 0)
            {
                $('.actions > ul > li:eq(1)').removeAttr("class");
                $('.actions > ul > li:eq(1) > a').attr("href",'#next');
            }          
            
            if(currentIndex === 1)
            {
                if($('#part').find('tr.iRow').length == 0)
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
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            var form = $(this); form.submit();
        }
    }).validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            confirm: {
                equalTo: "#password-2"
            }
        }
    });

        $(document).ready(function(){
            $('.js-data-example-ajax').css('width', '100%');
            $('.js-data-example-ajax').select2();
        });
      
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
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
      $("#statlist li").click(function(){
      var val=$(this).find("a").text();
      $.ajax({
      url: "{{route('status.change')}}",
      method: "get",
      data: {'data':val},
      success: function(){
        // location.reload();
        if(val==" Accept Orders "){
         $('.status').find(".dispstats").html("<i class='fa fa-circle text-success'></i>"+val+"<span class='caret'></span></a>");
        }
        else if(val==" Not Accepting "){
            $('.status').find(".dispstats").html("<i class='fa fa-circle text-default'></i>"+val+"<span class='caret'></span></a>");
        }
       
      }
    });
    });

    $('#cancel').on('click', function() {
      window.location = '{{url("/cook/dishes")}}';
    });

});

    function remove(id){
        // $('modal-btn-yes').modal('hide');
        $('#remove'+id).remove();
        $('#myModal'+id).remove();
        // $('#confirm'+id).remove();

        if($('#part').find('tr.iRow').length == 0)
            {
                $('.actions > ul > li:eq(1) > a').removeAttr('href');
                $('.actions > ul > li:eq(1)').attr('class','disabled');
       
            }
            return false;
    }

    function del(rand,id){
       $('#remove'+id).remove();
       $('#modal'+rand).remove();

        if($('#part').find('tr.iRow').length == 0)
            {
                $('.actions > ul > li:eq(1) > a').removeAttr('href');
                $('.actions > ul > li:eq(1)').attr('class','disabled');
              
            }
        
    }

    function setAttributes(el, attrs) {
      for(var key in attrs) {
        el.setAttribute(key, attrs[key]);
      }
    }

    function calc(str){
        var int = 0;
        var float = 0;  
        if (str.indexOf(' ') >= 0){
            var parts = str.split(' ');
            int = parts[0];
            float = eval(parts[1]);
            var radixPos = String(float).indexOf('.');
            var value = String(float).slice(radixPos);
        
            return int + value;
        }
        else{
            return eval(str);
        }
    }

    function changes(id){
        // alert(id);

        // var id = document.getElementById('dishid').value;
        var squan = document.getElementById('quantityN'+id).value;
        var quan = calc(squan);
        var prep = $("#preparationN"+id+" option:selected").map(function() {
            return $(this).text();
          }).get();
        var prepp = $('#preparationN'+id).val();
        var um = $("#umN"+id+" option:selected").map(function() {
            return $(this).text();
          }).get();
        var umm = $('#umN'+id).val();



        document.getElementById("quanN"+id).innerHTML = squan;
        document.getElementById("prepN"+id).innerHTML = prep;
        document.getElementById("unitN"+id).innerHTML = um;

        document.getElementById("qtyy"+id).value = quan;
        document.getElementById("prepp"+id).value = prepp;
        document.getElementById("umm"+id).value = umm;



        return false;


    }

    function addChoice()
    {
        
        var ingid = document.getElementById('ingredients').value;
        var squan = document.getElementById('quantity').value;
        var quan = calc(squan);
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
            $('#error').empty();
            if($('#error').children().length == 0){
                document.getElementById('error').innerHTML+="This field is required";
            }
        }
        else{
            // alert($('#part').find('tr#remove'+ingid).length == 1);
            if($('#part').find('tr#remove'+ingid).length == 1){

                $('.actions > ul > li:eq(1)').removeAttr("class");
                $('.actions > ul > li:eq(1) > a').attr("href",'#next');
                $('#error').empty();

                var div = document.getElementById("part");
                var newdiv = document.getElementById("content");
                var rand = Math.floor((Math.random() * 100) + 1);

                $("<div id='modal"+rand+"'></div>").insertAfter("#content");
                var div2 = document.getElementById("modal"+rand);
                var confirm = document.getElementById("modals");

                 div.innerHTML += 
                    '<tr style="text-align:center" class="iRow" id="remove'+ingid+'">'+
                            '<td multiple>'+ingred+'</td>'+
                            '<input type="hidden" id="ingid" name="ingid[]" value="'+ingid+'">'+
                            '<td multiple multiple id="qty'+ingid+'" name="qty[]">'+squan+'</td>'+
                            '<input type="hidden" id="qtyy'+ingid+'" name="qtyy[]" value="'+quan+'">'+
                            '<td multiple id="prep'+ingid+'" name="prep[]">'+prep+'</td>'+
                            '<input type="hidden" id="prepp'+ingid+'" name="prepp[]" value="'+prepp+'">'+
                            '<td multiple id="um'+ingid+'" name="unit[]">'+um+'</td>'+
                            '<input type="hidden" id="umm'+ingid+'" name="umm[]" value="'+umm+'">'+
                            '<td><button type="button" data-toggle="modal" data-target="#confirm'+rand+'" class="remove"><i class="fa fa-times"></i></button><button type="button" class="btn btn-flat fa fa-edit" style="background-color:#30BB6D; color:white; border:none; margin-top: 0px; line-height: 100%; float:right" data-toggle="modal" data-target="#myModal'+ingid+'" ></button></td>'+
                            '</tr>';

                div2.innerHTML += '<div class="modal fade" id="myModal'+ingid+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
                        '<div class="modal-dialog">'+
                            '<div class="modal-content">'+
                                '<div class="modal-header">'+
                                    '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>'+
                                    '<h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><b>&nbsp;&nbsp;Change</b></h4>'+
                                '</div>&nbsp;&nbsp;'+
                                '<form method="post" action="changes('+ingid+')" enctype="multipart/form-data">'+
                                    '{{csrf_field()}} '+
                                '<div class="modal-body">'+
                                '<h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;<b>Ingredient Details</b></h4>'+
                                '<div class="col-sm-12">'+
                                    '<div class="form-group label-floating has-success">'+
                                        '<label class="control-label">Quantity</label>'+
                                        '<input type="text" class="form-control" id="quantityN'+ingid+'" name="quantityN" value="'+squan+'" />'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-sm-6">'+
                                    '<div class="form-group label-floating has-success">'+
                                        '<label class="control-label">Preparation</label>'+
                                        '<select class="form-control" id="preparationN'+ingid+'" name="preparationN[]" id="preparation" name="preparation" style="width:100px;" autofocus>'+
                                            '@foreach($preps as $prep)'+
                                                '<option value="{{ $prep->p_id }}">{{$prep->p_name}}</option>'+ 
                                            '@endforeach'+
                                        '</select>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-sm-6">'+
                                    '<div class="form-group label-floating has-success">'+
                                        '<label class="control-label">Unit of Measure</label>'+
                                        '<select class="form-control" id="umN'+ingid+'" name="umN[]" style="width:150px;">'+
                                            '@foreach($units as $um)'+
                                                '<option value="{{ $um->um_id }}">{{$um->um_name}}</option>'+
                                            '@endforeach'+
                                        '</select>'+
                                    '</div>'+
                                '</div>'+

                                '</div>'+
                                '<div class="modal-footer">'+
                                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
                                    '<button type="button" class="btn btn-success" data-dismiss="modal" onclick="changeappend('+ingid+')">Save Changes</button>'+
                                '</div>'+
                                '</form>'+
                            '</div>'+
                            
                        '</div>'+
                    '</div>';

                    confirm.innerHTML += '<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm'+rand+'">'+
                      '<div class="modal-dialog modal-sm">'+
                        '<div class="modal-content">'+
                          '<div class="modal-header">'+
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '<h4 class="modal-title" id="myModalLabel">Are you sure you want to remove ingredient?</h4>'+
                          '</div>'+
                          '<div class="modal-footer">'+
                            '<button type="submit" class="btn btn-default" data-dismiss="modal" onclick="del('+rand+','+ingid+')" id="modal-btn-yes">Yes</button>'+
                            '<button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-btn-no">No</button>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>';

             $('select').select2().select2('val', $('#ingredients option:eq(0)').val());

             document.getElementById('quantity').value='';
            $('#preparation option').prop('selected', function() {
                return this.defaultSelected;
            });
            $('#um option').prop('selected', function() {
                return this.defaultSelected;
            });
        }
        else{
            alert('Ingredient already exists');
        }
    }

        // return false;

    }

    function changeappend(id){
        var squan = document.getElementById('quantityN'+id).value;
        var quan = calc(squan);
        var prep = $("#preparationN"+id+" option:selected").map(function() {
            return $(this).text();
          }).get();
        var prepp = $('#preparationN'+id).val();
        var um = $("#umN"+id+" option:selected").map(function() {
            return $(this).text();
          }).get();
        var umm = $('#umN'+id).val();



        document.getElementById("qty"+id).innerHTML = squan;
        document.getElementById("prep"+id).innerHTML = prep;
        document.getElementById("um"+id).innerHTML = um;

        document.getElementById("qtyy"+id).value = quan;
        document.getElementById("prepp"+id).value = prepp;
        document.getElementById("umm"+id).value = umm;



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
            div.innerHTML += '<div class="col-md-6">'+
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


