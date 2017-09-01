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
 <button type="button" class="btn btn-flat btn-success add-dish" value="./dishes/add" onclick="window.location.href='{{route('cook.dishes.add')}}'" style="margin-bottom:20px"><i class="fa fa-plus"></i> Add Dish</button>

    <!--    <div class="box box-solid"> -->
            <div class="box-body">
           @foreach($dishes as $dish)
           
                <div class="col-sm-3">
                                 <div class="box box-solid" style="border-radius: 20px;">
                        <div class="box-header with-border">
                        
                            <center><img src="{{url('./dish_imgs/'.$dish->dish_img)}}" style="width:150px; height:150px; border:2px solid #F0F0F0"></center>

                        </div>

                        <center><h4 class="openModal box-title" style="margin-top: 5px; font-size: 15px;"><a href="" style="color:#30BB6D" data-toggle="modal" data-target="#modal-default{{$dish->id}}">{{$dish['dish_name']}}</a><br>
                        <br>
                      <center><small>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      <i class="fa fa-star-o" id="rate"></i>
                      </small><br>
                      <a href="{{route('cook.rating')}}"><p style="font-size: 12px; color:#30BB6D; background-color:#E3E3E3">See Reviews</p></a>
                      </center>
                       <br>
                        <center>
                         <button type="button" class="btn btn-flat btn-primary edit" style="background-color:#30BB6D; border:none" data-toggle="modal" data-target="#modal-default2{{$dish->id}}"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-flat btn-danger delete" style="background-color:#30BB6D; border:none" data-toggle="modal" data-target="#modal-default3{{$dish->id}}"><i class="fa fa-times"></i></button>
                        <button type="button" class="btn btn-flat btn-danger delete" style="background-color:#30BB6D; border:none; color:white;"><i class="fa fa-list-ul"></i></button>


                      </center>
                      </br>


                        <!-- <center><i class="fa fa-angle-right"></i></center> -->
                    </div>
                </a>
                </div>
            @endforeach

      <!-- Default box -->
   
    
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--MODAL FOR VIEW DETAILS!-->
  @foreach($dishes as $dish)

  <div class="modal fade" id="modal-default{{$dish->id}}">

    <div class="modal-dialog"  style="width:350px; float:center;">
      <div class="modal-content">
          <div class="modal-header" style="background-color:#30BB6D;">
            <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color:white"><i class="fa fa-cutlery"></i><strong> Dish Details</strong></h4>
          </div>
          <div class="modal-body">
            <center><h4 style="color:#30BB6D; margin-top: 2px"><strong>{{$dish->dish_name}}</strong></h1></center>
               <center><img src="{{url('./dish_imgs/'.$dish->dish_img)}}" style="width:85%; height:240px; border-radius: 10px"></center>
          <center><p style="border-top:2px solid #30BB6D;  margin-top: 10px">{{$dish->dish_desc}}</p></center>
   
             <center> <dl>
                   
                <dt>Price:</dt>
                <dd>Php {{$dish->dish_price}}</dd>
                <dt>Lead Time:</dt>
                <dd><?php echo date('h:i A', strtotime($dish->dish_leadTime)); ?></dd>
                <dt>Serving size:</dt>
                <dd>{{$dish->serving_size}} serving(s)</dd>
                 <dt>Best eaten:</dt>

                  @if($dish->dcat_id == 1)
                <dd>Breakfast</dd>
                @elseif($dish->dcat_id == 2)
                <dd>Lunch</dd>
                @elseif($dish->dcat_id == 3)
                <dd>Dinner</dd>
                @endif

                 
              </dl>
          </div>
       
      </div>
            <!-- /.modal-content -->
    </div>
          <!-- /.modal-dialog -->
  </div>
        <!-- /.modal -->

@endforeach

<!--MODAL FOR EDIT!-->
  @foreach($dishes as $dish)

 <div class="modal fade" id="modal-default2{{$dish->id}}">
          <div class="modal-dialog" style="float:center;">
            <div class="modal-content">
              <div class="modal-header" style="background-color:#30BB6D;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title" style="color:white"><i class="fa fa-edit"></i><strong> Edit Dish</strong></h4>
              </div>
              <div class="modal-body" style="background-color: white">
                 
                 <!--START!-->
                 <form method="post" action="{{route('cook.dishes.update', ['id' => $dish->id])}}" enctype="multipart/form-data">
                    {{csrf_field()}}    

                <div class="form-group col-md-6">
                  <label>Name:</label>
                  <input type="text" class="form-control" name="dish_name" placeholder="Name" value="{{$dish->dish_name}}"> 
                 </div>

                  <div class="form-group col-md-6">
              <label>Price:</label>
                <input type="text" class="form-control" name="price" placeholder="Price" value="{{$dish->dish_price}}"> 
                 </div>

                  <div class="form-group col-md-6">
              <label>Serving:</label>
                <input type="number" class="form-control" name="serving" placeholder="Number of serving" min="1" value="{{$dish->serving_size}}"> 
            </div>

           <div class="form-group col-md-6">
              <label>Lead Time:</label>
                <input type="time" class="form-control" name="lead_time" value="{{$dish->dish_leadTime}}"> 
            </div>


                <div class="form-group col-md-6">
                <label>Best Eaten during:</label><br>
                
                <select multiple class="form-control" name="dish_cat[]">
                <option value="{{$dish->dcat_id}}" selected>{{$dish->dcategory_name}}</option>
                
                
                 
              </select>
            </div>

            <div class="form-group col-md-6">
              <label>Description:</label>
                <textarea class="form-control" rows="3" name="dish_desc" placeholder="Description">{!! $dish->dish_desc !!}</textarea>
                 </div>


                   <div class="form-group col-md-6">
              <label for="exampleInputFile">Dish Image</label>
                <input type="file" id="dish" name="img">
                <input type="hidden" name="img" value="{{$dish->dish_img}}">
                  <p class="help-block">jpg., jpeg., png. extension only</p>
                        </div>

                   <div class="form-group col-md-6">
                    <img src="{{url('./dish_imgs/'.$dish->dish_img)}}" id="img-tag" width="200px" />
            </div>
              
                    <div class="modal-footer">
               <div class="col-md-12">
                    <center><button type="submit" class="btn btn-block btn-success submit"><i class="fa fa-plus"></i> Update Dish</button> 
       
              </div>
              </div>


                  </form>
              

              </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

@endforeach

<!--MODAL FOR DELETE!-->
  @foreach($dishes as $dish)
 <div class="modal fade" id="modal-default3{{$dish->id}}">
          <div class="modal-dialog"  style="float:center">
            <div class="modal-content">
              <div class="modal-header" style="background-color:#30BB6D;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"  style="color:white"><i class="fa fa-times"></i> Confirm Delete</h4>
              </div>
             
              <div class="modal-body">
                <p>Are you sure you want to delete  this dish? Do you wish to proceed?</p>
              </div>
              <div class="modal-footer">
                <form method="post" action="{{route('cook.dishes.destroy', ['id' => $dish->id])}}">
                    {{csrf_field()}}
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="background-color:#30BB6D; color:white; border:none">Cancel</button>
                <button type="submit" class="btn btn-primary" style="background-color: #F56D65; border:none">Delete</button>
                </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
@endforeach

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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('adminlte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="{{asset('wizard/assets/js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript">
    
       $(".delete").on('click', function(){
        var id =  $(this).val();
         window.location= './dishes/'+id+'/delete';
        });


       // $(".view").on('click', function(){
       //  var id =  $(this).val();
       //   $('#modal').modal('show');
       //  });
    });

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



</script>

@endsection

