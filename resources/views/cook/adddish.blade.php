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

</style>


@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dishes
      </h1>
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
 
  <form role="form"  method="post" action="{{route('cook.dishes.create')}}" enctype="multipart/form-data">
   {{csrf_field()}}
    <div class="row setup-content" id="step-1">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>Dish Details</h3>

        <div class="form-group col-md-6">
              <label>Name:</label>
                <input type="text" class="form-control" id="dish_name" name="dish_name" placeholder="Name" required>
            </div>
                <div class="form-group col-md-4">
              <label>Serving:</label>
                <input type="number" class="form-control" id="serving" name="serving" placeholder="No. of serving(s)" min="1" required>
            </div>
              <div class="form-group col-md-3">
              <label>Preparation Time:(Start)</label> 
                <input type="time" class="form-control" id="ptime" name="ptime" placeholder="Lead time">
            </div>
          <div class="form-group col-md-3">
              <label>Preparation Time:(End)</label>
                <input type="time" class="form-control" id="pend" name="pend" placeholder="Lead time">
            </div>
 
            <div class="form-group col-md-4">
              <label>Price:</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Price" required>
            </div>
             <div class="form-group col-md-10 ">
              <label>Description:</label>
                <textarea class="form-control" rows="3" id="dish_desc" name="dish_desc" placeholder="Description" required></textarea>                
            </div>
                
             


           <div class="form-group col-md-8">
              <label>Best Eaten during:</label><br>
              <select multiple class="form-control" id="best" name="best[]">
                  @foreach($beaten as $be)
                  <option value="{{$be->be_id}}">{{$be->name}}</option>
                  @endforeach
              </select>
               
            </div>
          <div class="form-group col-md-4">
              <label>Serving Size:</label>
                <input type="number" class="form-control" id="serveSize" name="serveSize" placeholder="Serving Size" min="1" required>
            </div>

            <div class="form-group col-md-5">
              <label for="exampleInputFile">Dish Image</label>
                <input type="file" id="img" name="img">
                  <p class="help-block">jpg., jpeg., png. extension only</p>
                  </div>
                   <div class="form-group col-md-5">
                  <img src="{{asset('img/chooseimg.jpg')}}" id="img-tag" width="200px" />
            </div>
       <div class="col-md-10">
       <button type="button" class="btn btn-primary nextBtn btn-lg" id="cancel">Cancel</button>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" style="background-color: #30BB6D " >Next</button>
        </div>
         
        </div>
      </div>
    </div>


    
    <div class="row setup-content" id="step-2">
      <div class="col-xs-6 col-md-offset-3" style="margin-left:0px;width:50%">
        <div class="col-md-14">
          <h3> Ingredient Details</h3>

          <!-- <div class="container"> -->

      <div ng-app="angularjs-starter" ng-controller="MainCtrl" style="background-color: transparent;">

      <fieldset  data-ng-repeat="choice in choices" style="background-color: transparent; margin-bottom: 20px">
      <!-- <div class="form-group col-md-3"> -->
              <select class="selectpicker" data-show-subtext="true" data-live-search="true">
                  @foreach($list as $part)
                    <option value="{{$part->id}}">{{$part->Shrt_Desc}}</option>
                  @endforeach
              </select>
              
       <div class="form-group col-md-3">

      <input type="text" class="form-control" id="quantity" multiple name="quantity[]" placeholder="Quantity" ng-model="choice.name" required>
      </div>
      <div class="form-group col-md-3">
       <select class="form-control" id="preparation" multiple name="preparation[]" id="preparation" name="preparation" style="width:100px;">
          @foreach($preps as $prep)
              <option value="{{ $prep->p_id }}">{{$prep->p_name}}</option> 
          @endforeach
          </select></div>
      

        <div class="form-group col-md-5">
        <select  class="form-control" id="unit" multiple name="um[]">
      @foreach($units as $unit)
          <option value="{{$unit->um_id}}">{{$unit->um_name}}</option>
      @endforeach
      </select>
      </div>
        <div class="form-group col-md-1">
      <button class="remove" ng-show="$last" ng-click="removeChoice()">-</button>
      </div>
           <!-- </fieldset> -->
           <button class="addfields remove" onclick="addChoice(); return false;" ng-click="addNewChoice()">+</button>    
        </div>
        </div>
      </div>

      <div class="col-xs-6 col-md-offset-3" style="margin-left:0px;width:50%">
        <table id="part">
            <tr>
              <th style="width:150px">Ingredient Name</th>
              <th style="width:150px">Quantity</th>
              <th style="width:150px">Preparation</th>
              <th style="width:150px">Unit of Measure</th>
            </tr>
           <!-- <div id="part"></div> -->
        </table>
        <br>

        
          <button class="btn btn-primary nextBtn btn-lg pull-right"  onClick="summary()" type="button" >Next</button>
      </div>
    </div>
  
    
    <div class="row setup-content" id="step-3">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3> Step 3</h3>
          <div>
          <p>Dish Details</p>
          <div id="summary">
            
          </div>
          <p>Ingredient Details</p>

        <button type="submit" class="btn btn-block btn-success submit" href="{{route('cook.dishes.create')}}"><i class="fa fa-plus"></i>Add Dish</button> 
        </div>
      </div>
    </div>
  </form>
  
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

<script src="{{ asset('js/app.js') }}"></script>

<!-- <script>
$(document).ready(function(){
  document.getElementById('quan').style.display="none";
})

</script> -->

<script type="text/javascript">
    // $(document).ready(function(){
    //     $(".add-dish").on('click', function(){
    //       var url =  $(this).val();
    //       alert(url);
    //       // window.location= 
    //     });
    // })
//FOR WIZARD
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
  

    $('#cancel').on('click', function() {
      window.location = '{{url("/cook/dishes")}}';
    });

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


   // $("#search").keyup(function(){
   //     var str=  $("#search").val();
   //     if(str == "") {
   //             $( "#txtHint" ).html("<b>Ingredient name will be listed here...</b>"); 
   //     }else {
   //             $.get( "{{ url('cook/adddish?id=') }}"+str, function( data ) {
   //                 $( "#txtHint" ).html( data );  
   //          });
   //     }
   // }); 

   // $("#search").change(function(){
   //    alert("change");
   // });

function addChoice()
{
    // var ingred = document.getElementById('ingredients').value;
    var quan = document.getElementById('quantity').value;
    // var prep = document.getElementById('preparation').value;
    // var um = document.getElementById('um').value;

    var ingred = $("#ingredients option:selected").map(function() {
        return $(this).text();
      }).get();

    var prep = $("#preparation option:selected").map(function() {
        return $(this).text();
      }).get();
    var um = $("#unit option:selected").map(function() {
        return $(this).text();
      }).get();
    
    var div = document.getElementById("part");

    div.innerHTML += 
                      '<tr style="text-align:center">'+
                          '<td>'+ingred+'</td>'+
                          '<td>'+quan+'</td>'+
                          '<td>'+prep+'</td>'+
                          '<td>'+um+'</td>'+
                      '</tr>';

                      return false;
}

function summary(){

      var name = document.getElementById("dish_name").value;
      var serving = document.getElementById("serving").value;
      var ptime = document.getElementById("ptime").value;
      var pend = document.getElementById("pend").value;
      var price = document.getElementById("price").value;
      var desc = document.getElementById("dish_desc").value;
      var best = $("#best option:selected").map(function() {
        return $(this).text();
      }).get();
      var serveSize = document.getElementById("serveSize").value;
      // var ingred = $('ingredients').val();
      var ingred=[];
      var ingred = $("#ingredients option:selected").map(function() {
        return $(this).text();
      }).get();
      var quan = $('quantity').val();
      var prep = $('preparation').val();
      var um = $('um').value;

      var div = document.getElementById('summary');
      var div2 = document.getElementById('ingred-part');
      // var i;
        div.innerHTML += 'Name: '+name+'<br>'+
                          'Serving: '+serving+'<br>'+
                          'Preparation Time: '+ptime+'<br>'+
                          'Preparation End: '+pend+'<br>'+
                          'Price: '+price+'<br>'+
                          'Description: '+desc+'<br>'+
                          'Best Eaten: '+best+'<br>'+
                          'Serving Size: '+serveSize+'<br>';
      
} 




</script>




@endsection

