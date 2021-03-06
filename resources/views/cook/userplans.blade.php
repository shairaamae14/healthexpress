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
             <h1>Planned Meals</h1>
            <ol class="breadcrumb">
                <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            </ol>
        </section>

       <br> 
        <section class="content">
            <button type="button" class="btn btn-flat btn-success" onclick="window.location.href='{{route('cook.porders')}}'" style="margin-bottom:20px"><i class="fa fa-mail-reply"></i> Back</button>
        <div class="box">
            <div class="box-body">
                <form id ="sortorder" action =" {{url('cook/')}}" method ='POST'>
                    {{csrf_field()}}
                <div class="form-inline">
                    <select id="chooseStatus" class="form-control" name="chooseStatus">
                        <option value="none" class="w" selected disabled hidden>Sort Orders</option>
                        <option value="All" class="w" value = "All">All</option>
                        <option value="Pending" class="w" value = "Pending">Pending</option>
                        <option value="Cooking" class="w" value = "Ongoing">Cooking</option>
                        <option value="Delivering" class="w" value = "Complete">Delivering</option>
                        <option value="Completed" class="w" value = "Complete">Completed</option>
                    </select>
                </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Order(s)</th>
                                <th>Date & Time Ordered</th>
                                <th>Meal For</th>
                                <th>Side Note(s)</th>
                                <th class="disabled-sorting text-right">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($meals)
                            @foreach($meals as $order)
                            <tr>
                                <td>{{$order->fname}} {{$order->lname}}</td>
                                {{-- <td>{{$order->dishes[0]['dish_name']}}</td> --}}
                                <td>{{$order->dish_name}}</td>
                                {{-- <td>February 02, 2018 12:30:00 PM</td> --}}
                                {{-- <td>{{date_format($order->start,'F d Y h:i:s A')}}</td> --}}
                                <td>{{Carbon\Carbon::parse($order->start)->format('F d Y h:i:s A')}}</td>
                                <td>{{$order->name}}</td>
                                @if($order->note != null)
                                    <td>{{$order->note}}</td>
                                @else
                                  <td>None</td>
                                @endif
                                
                                @if($order->order_status == 'Pending')
                                <td><span class="label label-default">Pending</span></td>
                                <td class="text-right">
                                    <button class="btn btn-default btn-flat" data-toggle="tooltip" data-placement="top" title="Change to Cooking" onclick="cooking({{$order->uo_id}})" id="Cooking" value="Cooking">Cooking</button>
                                </td>
                                @elseif($order->order_status == 'Cooking')
                                <td><span class="label label-warning">Cooking</span></td>
                                <td class="text-right">
                                    <button class="btn btn-default btn-flat" onclick="delivering({{$order->uo_id}})" id="Done" value="Done" data-toggle="tooltip" data-placement="top" title="Change to Delivering">Deliver</button></a>
                                </td>
                                @elseif($order->order_status == 'Delivering')
                                <td><span class="label label-info">Delivering</span></td>
                                <td class="text-right">
                                    {{-- <button class="btn btn-default btn-flat" data-toggle="modal" data-target="#view_details{{$order->user_id}}">View Details</button> --}}
                                    Waiting for customer response.
                                </td>
                                @else
                                <td><span class="label label-success">Complete</span></td>
                                <td class="text-right">Done</td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>              
            </div>
        </div>
    </section>
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
<!-- PACE -->
<script src="{{asset('adminlte/plugins/pace/pace.js')}}"></script>
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
<!-- DataTables -->
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>




 <script type="text/javascript">
    $(document).ready(function() {
        $('.dataTable').DataTable({ 
            "lengthChange": false,
            aoColumnDefs: [
              {
                 bSortable: false,
                 aTargets: [ -1 ]
              }
            ]
        });
        $("#chooseStatus").on('change',function(e)
         {
            e.preventDefault();
            Pace.restart();
            $('#sortorder').submit();

         });
    });
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
                        Pace.restart();
                        location.reload();
                    },
                    error: function(xhr,error){
                        console.log(xhr);
                    }
                });
        }

         function delivering(id){
            var status="Delivering";
            // alert(status);
            $.ajax({
                    method: 'POST',
                    url: "{{ url('/cook/orderstat') }}" ,
                    dataType: 'json',
                    headers: {'X_CSRF_TOKEN': '{{csrf_token()}}'},
                    data: {'status':status,'id':id},
                    success: function(json) {
                        Pace.restart();
                        location.reload();
                    },
                    error: function(xhr,error){
                        console.log(xhr);
                    }
                });
         }

        function received(id){
            var status="Received";
            alert(status);
            $.ajax({
                    method: 'POST',
                    url: "{{ url('/cook/orderstat') }}" ,
                    dataType: 'json',
                    headers: {'X_CSRF_TOKEN': '{{csrf_token()}}'},
                    data: {'status':status, 'id':id},
                    success: function(json) {
                        Pace.restart();
                        location.reload();
                    },
                    error: function(xhr,error){
                        console.log(xhr);
                    }
                });
        }

    </script>
@endsection