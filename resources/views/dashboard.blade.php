@extends('cook-layouts.cook-master')
<style>
 .D:hover{
  background-color: #31A0DC !important;
  color:white !important;
  border:white !important;
}

 .C:hover{
  background-color: #DC3131 !important;
  color:white !important;
  border:white !important;
}

.R:hover{
  background-color: #30BB6D !important;
  color:white !important;
  border:white !important;
  
}
</style>
@section('content')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">
                <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <h1 style="padding-left:20px">Express Orders</h1>
                    <select style="float:right; margin-right:20px">
                        <option value="today">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="Week ago">Week ago</option>
                        <option value="Others">Others</option>
                    </select>
                <label style="float:right">Sort By:</label>

            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-success box-solid orderCard">
                        <div class="box-header with-border" id="header">
                            <h3 class="box-title" style="color:white;"><i class="fa fa-user"></i> 
                            Shayne Dingle</h3>
                            <label id="stats" style="float:right; color:white">Pending</label>
                        </div>

                        <div class="box-body">
                            <dl class="dl-horizontal">
                                <dt><i class="fa fa-spoon"></i> Order(s):</dt>
                                <dd class="dd_order"> <strong>Italian Quinoa Salad </strong>(2)</dd>
                                <dt><i class="fa fa-check"></i> Order mode:</dt>
                                <dd>Express Meal</dd>
                                <dt><i class="fa fa-calendar"></i>  Date & Time Ordered:</dt>
                                <dd>July 28, 8:42 AM</dd>
                                <dt><i class="fa fa-times"></i> Allergies:</dt>
                                <dd>Shrimp, Nuts, Milk</dd>
                                <dt><i class="fa fa-sticky-note"></i>  Side note(s):</dt>
                                <dd>Don't put too much carrots. Please add more sauce </dd>
                            </dl>
                            <a href="#"><button type="button" class="btn btn-flat btn-success btn-sm">Order details</button></a>
                            <a href="#"><button type="button"  class="C btn btn-flat btn-success btn-sm" id="cooking" onclick="btnCook()" style="float:right; color:#DC3131; border:2px solid  #DC3131; background-color: white;">Cooking</button></a>
                        <!--<a href="#"><button type="button"  class="D btn btn-flat btn-success btn-sm" id="deliver" onclick="btnDel()"  style="float:right; color:#31A0DC; border:2px solid #31A0DC;  background-color: white; margin-right:5px">Ready</button></a>
                            <a href="#"><button type="button"  class="R btn btn-flat btn-success btn-sm" id="done" onclick="btnDone()"  style="float:right; color:#30BB6D; border:2px solid #30BB6D;  background-color: white; margin-right:5px">Received</button></a>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
<script src="{{asset('adminlte/dist/js/app.js')}}"></script>
@endsection