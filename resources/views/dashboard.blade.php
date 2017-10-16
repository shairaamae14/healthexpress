@extends('cook-layouts.cook-master')
<style>
 .D:hover{
  background-color: #6E9BF0 !important;
  color:white !important;
  border:white !important;
}

 .C:hover{
  background-color: #DC3131 !important;
  color:white !important;
  border:white !important;
}

.R:hover{
  background-color: #FFA233 !important;
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
            



            <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#all" data-toggle="tab">ALL</a></li>
                                <li role="presentation"><a href="#pending" data-toggle="tab">PENDING</a></li>
                                <li role="presentation"><a href="#cooking" data-toggle="tab">COOKING</a></li>
                                <li role="presentation"><a href="#done" data-toggle="tab">DONE</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="all">
                                    <b>All Orders</b>
                                    <p>

                                        <div class="body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Order(s)</th>
                                                            <th>Order Mode</th>
                                                            <th>Date & Time Ordered</th>
                                                            <th>Allergies</th>
                                                            <th>Side Note(s)</th>
                                                            <th>Action</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($dishes as $orders)
                                                        <tr>

                                                            <td>{{$orders->fname}} {{$orders->lname}}</td>
                                                            <td>{{$orders->dish_name}}</td>
                                                            <td>{{$orders->om_name}}</td>
                                                            <td>{{$orders->order_date}}</td>
                                                            <td>{{$orders->allergen_name}}</td>
                                                            <td>Don't put too much carrots. Please add more sauce</td>

                                                            @if($orders->order_status == 'Pending')
                                                            <td><a href="javascript:void(0);" onclick="cooking({{$orders->uo_id}})" id="Cooking" value="Cooking"><i class="fa fa-cutlery" data-toggle="tooltip" data-placement="top" style="color:#DC3131" title="cooking"></i></a></td>
                                                            @elseif($orders->order_status == 'Cooking')
                                                            <td><a href="javascript:void(0);" onclick="done({{$orders->uo_id}})" id="Done" value="Done"><i class="fa fa-suitcase" data-toggle="tooltip" data-placement="top" title="done" style="color:#FFA233"></i></a></td>
                                                            @elseif($orders->order_status == 'Done')
                                                            <td><a href="javascript:void(0);" onclick="deliver({{$orders->uo_id}})" id="Deliver" value="Deliver"><i class="fa fa-truck" data-toggle="tooltip" data-placement="top" title="deliver" style="color:#6E9BF0"></i></a></td>
                                                            @else
                                                            <td><a href="javascript:void(0);" id="Delivered" value="Delivered"><i class="fa fa-check-circle" style="color:green" data-toggle="tooltip" data-placement="top" title="delivered"></i></a></td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="pending">
                                    <b>Pending</b>
                                    <p>
                                        <div class="body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Order(s)</th>
                                                            <th>Order Mode</th>
                                                            <th>Date & Time Ordered</th>
                                                            <th>Allergies</th>
                                                            <th>Side Note(s)</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach($dishes as $orders)
                                                            @if($orders->order_status == 'Pending')
                                                        <tr>
                                                            <input type="hidden" id="id" value="{{$orders->uo_id}}">
                                                            <td>{{$orders->fname}} {{$orders->lname}}</td>
                                                            <td>{{$orders->dish_name}}</td>
                                                            <td>{{$orders->om_name}}</td>
                                                            <td>{{$orders->order_date}}</td>
                                                            <td>{{$orders->allergen_name}}</td>
                                                            <td>Please add more sauce</td>
                                                            <td><a href="javascript:void(0);" onclick="cooking({{$orders->uo_id}})" id="Cooking"  value="Cooking"><i class="fa fa-cutlery" data-toggle="tooltip" data-placement="top" style="color:#DC3131" title="cooking"></i></a></td>
                                                        </tr>
                                                            @endif
                                                        @endforeach
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="cooking">
                                    <b>Cooking</b>
                                    <p>
                                        <div class="body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Order(s)</th>
                                                            <th>Order Mode</th>
                                                            <th>Date & Time Ordered</th>
                                                            <th>Allergies</th>
                                                            <th>Side Note(s)</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($dishes as $cook)
                                                            @if($cook->order_status == 'Cooking')
                                                        <tr>
                                                            <input type="hidden" id="id" value="{{$cook->uo_id}}">
                                                            
                                                            <td>{{$cook->fname}} {{$cook->lname}}<label id="id"></label></td>
                                                            <td>{{$cook->dish_name}}</td>
                                                            <td>{{$cook->om_name}}</td>
                                                            <td>{{$cook->order_date}}</td>
                                                            <td>{{$cook->allergen_name}}</td>
                                                            <td>Please add more sauce</td>
                                                            <td><a href="#" onclick="done({{$cook->uo_id}})" id="Done" value="Done"><i class="fa fa-suitcase" data-toggle="tooltip" data-placement="top" title="done" style="color:#FFA233"></i></a></td>
                                                        </tr>
                                                            @endif
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="done">
                                    <b>Done</b>
                                    <p>
                                        <div class="body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Order(s)</th>
                                                            <th>Order Mode</th>
                                                            <th>Date & Time Ordered</th>
                                                            <th>Allergies</th>
                                                            <th>Side Note(s)</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       @foreach($dishes as $done)
                                                            @if($done->order_status == 'Done')
                                                        <tr>
                                                            <input type="hidden" id="id" value="{{$done->uo_id}}">
                                                            
                                                            <td>{{$done->fname}} {{$done->lname}}<label id="id"></label></td>
                                                            <td>{{$done->dish_name}}</td>
                                                            <td>{{$done->om_name}}</td>
                                                            <td>{{$done->order_date}}</td>
                                                            <td>{{$done->allergen_name}}</td>
                                                            <td>Please add more sauce</td>
                                                            <td><a href="javascript:void(0);" onclick="deliver({{$done->uo_id}})" id="Deliver" value="Deliver"><i class="fa fa-truck" data-toggle="tooltip" data-placement="top" title="deliver" style="color:#6E9BF0"></i></a></td>
                                                        </tr>
                                                            @endif
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </p>
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




<script src="{{asset('js/pages/ui/tooltips-popovers.js')}}"></script>


    <!-- Bootstrap Core Js -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Select Plugin Js -->
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('plugins/node-waves/waves.js')}}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>

    <!-- Demo Js -->
    <script src="{{asset('js/demo.js')}}"></script>










 <script type="text/javascript">
        function cooking(id){
                var status= "Cooking";
                // alert(status);
                var data 
                $.ajax({
                    method: 'POST',
                    url: "{{ url('/cook/orderstat') }}" ,
                    dataType: 'json',
                    headers: {'X_CSRF_TOKEN': '{{csrf_token()}}'},
                    data: {'status':status,'id':id},
                    success: function(json) {
                        location.reload();
                    },
                    error: function(xhr,error){
                        console.log(xhr);
                    }
                });
        }

         function done(id){
            var status="Done";
            // alert(status);
            $.ajax({
                    method: 'POST',
                    url: "{{ url('/cook/orderstat') }}" ,
                    dataType: 'json',
                    headers: {'X_CSRF_TOKEN': '{{csrf_token()}}'},
                    data: {'status':status,'id':id},
                    success: function(json) {
                        location.reload();
                    },
                    error: function(xhr,error){
                        console.log(xhr);
                    }
                });
         }

        function deliver(id){
            var status="Deliver";
            alert(status);
            $.ajax({
                    method: 'POST',
                    url: "{{ url('/cook/orderstat') }}" ,
                    dataType: 'json',
                    headers: {'X_CSRF_TOKEN': '{{csrf_token()}}'},
                    data: {'status':status, 'id':id},
                    success: function(json) {
                        location.reload();
                    },
                    error: function(xhr,error){
                        console.log(xhr);
                    }
                });
        }

    </script>
@endsection