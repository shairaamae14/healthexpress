@extends('cook-layouts.cook-master')

<style>
a:hover{
  color:black;
}


#rate{
  color:orange;
}

</style>
@section('content')
<meta name ="csrf-token" content = "{{csrf_token() }}"/>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dish Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dish Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <div class="row">
        <div class="col-xs-6 col-md-offset-3">
          <!-- Custom Tabs -->
          @foreach($dishes as $dish)
          
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Dish Details</a></li>
              <li><a href="#tab_2" data-toggle="tab">Ingredients</a></li>
              <li><a href="#tab_3" data-toggle="tab">Nutritional Facts</a></li>
              <li class="pull-right"> <button class="btn btn-box-tool" data-toggle="modal" title="Remove" value="{{$dish->did}}" data-target="#dish-del"><i class="fa fa-times"></i></button></li>
              <li class="pull-right"><button class="btn btn-box-tool edit" data-toggle="tooltip" title="Edit" value="{{$dish->did}}"><i class="fa fa-edit"></i></button></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active text-align" id="tab_1">
                   
                        <center>
                        <img src="{{url('./dish_imgs/'.$dish->dish_img)}}" style="width:200px; height:200px; border:2px solid #F0F0F0; border-radius: 10px;"></img></center> <br>
                        <center>
                        <h3 style="color:#30BB6D"> {{$dish->dish_name}} </h3>
                        <h5>{{$dish->dish_desc}}</h5>
                        </center>

                        <dl class="dl-horizontal">
                            <dt>Price:</dt>
                            <dd>&nbsp;Php {{$dish->basePrice}}</dd>
                            <dt>Preparation time:</dt>
                            <dd>&nbsp;{{$dish->preparation_time}}</dd>
                            <dt>No. of Serving:</dt>
                            <dd>&nbsp;{{$dish->no_of_servings}} serving(s)</dd>
                            <dt>Best Eaten:</dt>
                            <dd>&nbsp;Lunch</dd>
                        </dl>
              
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Ingredient Name</th>
                  <th>Quantity</th>
                  <th>Preparation</th>
                  <th>Unit of Measurement</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($dish_ingredients as $di)
                        <tr>
                          <td>{{$di->Shrt_Desc}}</td>
                          <td>{{$di->quantity}}</td>
                          <td>{{$di->p_name}}</td>
                          <td> {{$di->um_name}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                Nutritional Facts goes here
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          @endforeach
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>    
<!--        <div class="row">
        <div class="col-md-6">
          <div class="box box-default" style="border-top: none">
            <div class="box-header with-border" style="border-top: none">
             
            </div>
             /.box-header 
            <div class="box-body">
             @foreach($dishes as $dish)
              <div class="alert  alert-dismissible" style="float:left; width:50%">
              <center><img src="{{url('./dish_imgs/'.$dish->dish_img)}}" style="width:200px; height:200px; border:2px solid #F0F0F0; border-radius: 10px;"></img></center> <br>
                         <center><h3 style="color:#30BB6D"> {{$dish->dish_name}} </h3> <br>
                         <h5>{{$dish->dish_desc}}</h5></center>
              </div>
              <div class="alert alert-dismissible" style="float:right; width:50%; padding-bottom: 20px">
              <ul class="todo-list">
                <li>
                  <span class="text"><label style="font-size:18px">Price:</label>&nbsp;Php {{$dish->basePrice}}</span>
                  </li>

                      <li>
                  <span class="text"><label style="font-size:18px">Preparation time:</label>&nbsp;1 hr 15 mins</span>
                  </li>
                      <li>
                  <span class="text"><label style="font-size:18px">No. of Serving:</label>&nbsp;{{$dish->no_of_servings}} serving(s)</span>
                  </li>

                      <li>
                  <span class="text"><label style="font-size:18px">Serving size:</label>&nbsp;2 cups</span>
                  </li>

                      <li>
                  <span class="text"><label style="font-size:18px">Best Eaten:</label>Lunch</span>
                  </li>


                </ul>
              </div>
              @endforeach
            </div>
             /.box-body 
          </div>
           /.box 
        </div>
         /.col 
      </div>
       /.row -->
   



  

    
      </section>
    <!-- /.content -->
  </div>
  

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
<div class="modal modal-danger fade" id="dish-del">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Dish</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete dish?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline" class="delete">Delete</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
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
<!-- Slimscroll -->
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

<script type="text/javascript">
    
$(document).ready(function() {
    $('.edit').on('click', function() {
    var id = $(this).val();
    window.location = '../dishes/edit/'+id;
    });
    
    $(".delete").on('click', function(){
    
            var id =  $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: './delete/'+id,
                    method: 'POST',
                    data: {
                        '_token': CSRF_TOKEN
                        },
                    error: function() {
                        console.log('an error occured');
                    }
                });

     });
});


</script>

@endsection

