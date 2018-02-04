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
    </section>

    <!-- Main content -->
    <!-- <section class="content"> -->
        <!-- <div class="container">
            <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1"  class="btn-success" style="background-color: #30BB6D; color:white; border-radius:150px"><center><img src="{{asset('img/food.svg')}}" style="width:55px; height:45px"/></center></a>
                        <p>Dish Details</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" class="btn-success" style="background-color: #30BB6D; color:white; border-radius:150px" disabled="disabled"><center><img src="{{asset('img/ingredients.svg')}}" style="width:75px; height:55px"/></center></a>
                        <p>Ingredients</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" class="btn-success" style="background-color: #30BB6D; color:white; border-radius:150px" disabled="disabled"><center><img src="{{asset('img/plus.svg')}}" style="width:55px; height:45px"/></center></a>
                    <p>Save Dish</p>
                    </div>
                </div>
            </div> -->
 
        <div class="container">
            <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Dish Details</p>
                  </div>
                  <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Ingredient Details</p>
                  </div>
                  <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>Dish Summary</p>
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
                                <img src="{{asset('img/choose.png')}}" class="img-circle" id="img-tag" width="200px" />
                                <br>
                                <label for="exampleInputFile">Dish Image</label>
                                <input type="file" id="img" name="img">
                                  <p class="help-block">jpg., jpeg., png. extension only</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Name:</label>
                                <input type="text" class="form-control" id="dish_name" name="dish_name" placeholder="Name" required autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label>No. of Serving:</label>
                                <input type="number" class="form-control" id="serving" name="serving" placeholder="No. of serving(s)" min="1" required autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Preparation Time:</label> 
                                <input type="text" id="duration" name="duration" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Price:</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Price" required>
                            </div>
                            <div class="form-group col-md-8">
                                <label>Best Eaten during:</label><br>
                                @foreach($beaten as $be)
                                <input type="checkbox" class="flat-red" value="{{$be->be_id}}" id="best" name="best[]"><label>{{$be->name}}</label>
                                @endforeach
                            </div> 
                            <div class="form-group col-md-8">
                                <label>Signature Dish:</label><br>
                                <input type="checkbox" id="signDish" name="signDish" value="1"><label>Yes</label>
                                <input type="checkbox" id="signDish" name="signDish" value="0"><label>No</label>
                            </div> 
                            <div class="form-group col-md-9">
                                <label>Description:</label>
                                <textarea class="form-control" rows="3" id="dish_desc" name="dish_desc" placeholder="Description" required autofocus></textarea>                
                           </div>

              <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" onclick="summary()" >Next</button>
        </div>
      </div>
    </div>
    <div class="row setup-content" id="step-2">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>Ingredient Details</h3>
              
                 <div class="form-group ui-widget">
                              {{-- <input type="text" class="form-control" name="ingredients" id="ingredients" placeholder="Search" autofocus> --}}



                              <select class="js-data-example-ajax form-control"></select>



                              <input type="hidden" id="ing_id" multiple name="ing_id[]" value=""/>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" ng-model="choice.name" min="0" autofocus >
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control" id="preparation" name="preparation" id="preparation" name="preparation" style="width:100px;" autofocus>
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
                                <div ng-app="angularjs-starter" ng-controller="MainCtrl">
                            <table id="part">
                                <tr>
                                  <th style="width:150px">Ingredient Name</th>
                                  <th style="width:150px">Quantity</th>
                                  <th style="width:150px">Preparation</th>
                                  <th style="width:150px">Unit of Measure</th>
                                  <th style="width:150px">Action</th>
                                </tr>

                            </table>
                        </div>
                            </div>
                            <div>    
              <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
        </div>
      </div>
    </div>
</div>
    <div class="row setup-content" id="step-3">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>Dish Summary</h3>

                    <p>Dish Details</p>
                    <div id="summary"></div>
                    <p>Ingredient Details</p>

             <button type="submit" class="btn btn-block btn-success pull-right" href="{{route('cook.dishes.create')}}"><i class="fa fa-plus"></i>Add Dish</button> 
        </div>
      </div>
    </div>
  </form>
        </div>
    <!-- </section> -->




   <!-- </div> -->
</div>



<script>

$(".js-example-data-ajax").select2({
  ajax: {
    url: "https://api.github.com/search/repositories",
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        q: params.term, // search term
        page: params.page
      };
    },
    processResults: function (data, params) {
      // parse the results into the format expected by Select2
      // since we are using custom formatting functions we do not need to
      // alter the remote JSON data, except to indicate that infinite
      // scrolling can be used
      params.page = params.page || 1;

      return {
        results: data.items,
        pagination: {
          more: (params.page * 30) < data.total_count
        }
      };
    },
    cache: true
  },
  placeholder: 'Search for a repository',
  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
  minimumInputLength: 1,
  templateResult: formatRepo,
  templateSelection: formatRepoSelection
});

function formatRepo (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var markup = "<div class='select2-result-repository clearfix'>" +
    "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
    "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

  if (repo.description) {
    markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
  }

  markup += "<div class='select2-result-repository__statistics'>" +
    "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
    "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
    "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
  "</div>" +
  "</div></div>";

  return markup;
}

function formatRepoSelection (repo) {
  return repo.full_name || repo.text;
}





</script>






















<script>
$(document).ready(function(){

    $('.js-data-example-ajax').select2({
        
        // source: function( request, response ) {
            ajax: {
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
        // },

        // select: function( event, ui) {

        //     this.value = ui.item.value;
        //     $(this).next("input").val(ui.item.value);
        //     event.preventDefault();  

        //     $('#ing_id').val(ui.item.id);

        //     displayPreviewDish(ui.item.id);
        //     console.log( "Selected: " + ui.item.value + " id " + ui.item.id );
        // }
        });
    // .data("ui-autocomplete")._renderItem = function (ul, item) {

    //         if(item.value == 'No dishes found.'){
    //             return $('<li class="ui-state-disabled">'+item.label+'</li>').appendTo(ul);
    //         }else{
    //             return $("<li>")
    //             .append("<a>" + item.label + "</a>")
    //             .appendTo(ul);
    //         }
    //     };

});
  
</script>
























        <!-- </div> -->

    <!-- </section> -->
    <!-- /.content -->
<!-- </div> -->
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
{{-- <script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script> --}}
<!-- jQuery UI 1.11.4 -->
{{-- <script src="{{asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script> --}}
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
  
    $('#cancel').on('click', function() {
      window.location = '{{url("/cook/dishes")}}';
    });
    $('#part').on('click','.remove', function() {
          $(this).closest(".iRow").remove();
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

   


    function addChoice()
    {
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

        var div = document.getElementById("part");

        div.innerHTML += 
                        '<tr style="text-align:center" class="iRow" id="iRow">'+
                        '<td multiple>'+ingred+'</td>'+
                        '<input type="hidden" id="ingid" name="ingid[]" value="'+ingid+'">'+
                        '<td multiple multiple name="qty[]">'+quan+'</td>'+
                        '<input type="hidden" id="qtyy" name="qtyy[]" value="'+quan+'">'+
                        '<td multiple name="prep[]">'+prep+'</td>'+
                        '<input type="hidden" id="prepp" name="prepp[]" value="'+prepp+'">'+
                        '<td multiple name="unit[]">'+um+'</td>'+
                        '<input type="hidden" id="umm" name="umm[]" value="'+umm+'">'+
                        '<td><button class="remove" ng-show="$last" ng-click="removeChoice()">-</button></td>'+
                        '</tr>';


                        document.getElementById('ingredients').value='';
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

});
  
</script>
@endsection


