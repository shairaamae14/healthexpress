
@extends('cook-layouts.cook-master')
<style>
a:hover{
  color:black;
}
dt{
 background-color: #30BB6D;
 color:white;
}

#rate{
  color:orange;
}

</style>
@section('content')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Dishes Catalog</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dishes Catalog</li>
                </ol>      
        </section>

        <!-- Main content -->

            <section class="content">
                <form role="form" method="POST" action="{{route('dish.catalog.create')}}">
                {{csrf_field()}}
                <div class="col-md-3">
                    <div class="box box-solid"> 
                        <div class="box-body">
                                <div class="col-md-12">
                                Search:  <input type="text" id="input" name="input" class="form-control" required autofocus>  
                                <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                Signature Dish:
                                <input type="checkbox" id="signDish" name="signDish" value="1" > Yes
                                <input type="checkbox" id="signDish" name="signDish" value="0" required autofocus> No
                                <input type="hidden" id="dish_id" name="dish_id" value="">
                                </div> 
                       </div>
                        <div class="box-footer">
                        <button type="submit" class="btn btn-flat btn-success add-dish"><i class="fa fa-plus"></i> Add to Catalog</button>
                        <button type="button" class="btn btn-flat btn-default">Cancel</button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Preview</h3>
                        </div>

                        <div class="box-body">
                            <div class="box-title" id="prevDiv">
                                <h2>Caldereta</h2>
                            </div>
                            <div class="img col-md-4">
                                <img class="img-circle" src="{{asset('dish_imgs/calda.jpg')}}">
                            </div>
                            <div class="info col-md-5">
                                
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">Price</span>
                                  <span class="info-box-number">410</span>
                                </div>
        
                                </div>
       
                                <h4>Preparation time:</h4> 1 hr
                                <h4>No of servings:</h4> 1
                                <h4>Best Eaten:</h4> Lunch
                                <h4>Preparation time:</h4> 1 hr
                            </div>
                            
                        </div>

                    </div>

                </div>
                
                </form>
          <!-- Default box -->
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('adminlte/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
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


<script>
$(document).ready(function(){

    $( "#input" ).autocomplete({
        source: function( request, response ) {
            $.ajax( {
              url: "{{ url('/cook/displayDishes') }}",
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
        
        
        
        function displayPreviewDish(id) {
           $.ajax({
                url: "/cook/previewDishes/"+id,
                method: 'GET',
                dataType: "json",
                success: function(data) {
                  
                  console.log('data sa gawas' + data.dish_name);
                    var title = "<h4>"+data[0].dish_name+"</h4>";
                    $('#prevDiv').append(title);
//                    var img = "<img src='/dish_imgs/"+data.dish_image+"')}}>" ;
                    console.log(img);
                    $('.img').append(img);
                    
                }
            });
            
        }
    
  } );

</script>
 
@endsection