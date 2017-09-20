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
            <h1>Dishes</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dishes</li>
                </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <button type="button" class="btn btn-flat btn-success add-dish" value="./dishes/add" onclick="window.location.href='{{route('cook.dishes.add')}}'" style="margin-bottom:20px"><i class="fa fa-plus"></i> Add Dish</button>

        <div class="box box-solid"> 
            <div class="box-body">
                @foreach($dishes as $dish)
                    <div class="col-sm-3">
                        <div class="box box-solid" style="border-radius: 20px;">
                            <div class="box-header with-border">
                                <center>
                                <img src="{{url('./dish_imgs/'.$dish->dish_img)}}" style="width:150px; height:150px; border:2px solid #F0F0F0">
                                </center>
                            </div>

                                <center>
                                    <h4 class="openModal box-title" style="margin-top: 5px; font-size: 15px;"><a href="{{route('cook.dishes.show', ['id' => $dish->did])}}" style="color:#30BB6D">{{$dish['dish_name']}}</a></h4><br>
                                </center>
                                    <br>
                          <center><small>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star" id="rate"></i>
                          <i class="fa fa-star-o" id="rate"></i>
                          <i class="fa fa-star-o" id="rate"></i>
                          </small><br>
                          <a href="{{route('cook.rating')}}"><p style="font-size: 12px; color:#30BB6D;">See Reviews</p></a>

                            <a class="btn btn-success" href="{{route('cook.dishes.show', ['id' => $dish->did])}}">View Details</a>

                          </center>
                           <br>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>
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

  

<script type="text/javascript">
    
    $(".delete").on('click', function(){
     var id =  $(this).val();
      window.location= './dishes/'+id+'/delete';
    });

    function viewdetails(){
      var id = document.getElementById('viewDetails').value;
      alert("hey");
    }
</script>
@endsection