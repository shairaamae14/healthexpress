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
        <div class="col-md-6">
          <div class="box box-default" style="border-top: none">
            <div class="box-header with-border" style="border-top: none">
             
            </div>
            <!-- /.box-header -->
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>

              <h3 class="box-title">Callouts</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="callout callout-danger">
                <h4>I am a danger callout!</h4>

                <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul,
                  like these sweet mornings of spring which I enjoy with my whole heart.</p>
              </div>
              <div class="callout callout-info">
                <h4>I am an info callout!</h4>

                <p>Follow the steps to continue to payment.</p>
              </div>
              <div class="callout callout-warning">
                <h4>I am a warning callout!</h4>

                <p>This is a yellow callout.</p>
              </div>
              <div class="callout callout-success">
                <h4>I am a success callout!</h4>

                <p>This is a green callout.</p>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- END ALERTS AND CALLOUTS -->


    
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

