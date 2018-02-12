@extends('admin-layouts.master')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Order Additionals</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Order</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<button type="button" class="btn btn-flat btn-success" style="margin-bottom:20px" data-toggle="modal" data-target="#modal-mode"	><i class="fa fa-plus"></i> Add Order Mode</button>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-solid"> 
					<div class="box-body">
						 <h3 class="box-title">Order Mode</h3>
						<table id="modes" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th class="col-md-2">Option</th>
								</tr>
							</thead>
							<tbody>
								@foreach($modes as $mode) 
								<tr id="{{$mode->id}}">
                  <td>{{$mode->id}}</td>
									<td>{{$mode->om_name}}</td>
									<td>
										<button type="button" id="delete" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-modes{{$mode->id}}" value=""><i class="fa fa-edit"></i></button>
										<button type="button" class="btn btn-danger btn-sm delete" value="{{$mode->id}}"><i class="fa fa-times-circle danger"></i></button>
									</td>
								</tr>
								@endforeach
							</tbody>

						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>

      	</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- OrderMode Modal -->
 <div class="modal fade" id="modal-mode">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Order Mode</h4>
              </div>
              <form method="POST" action="{{route('add.mode')}}">
              	{{csrf_field()}}
              <div class="modal-body">
              	<label>Order Mode Name</label>
                <input type="text" class="form-control" name="mname" required autofocus>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
          	</form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<!-- End OrderMode Modal -->




<!-- update OrderMode Modal -->
@foreach($modes as $mode)
 <div class="modal fade" id="modal-mode{{$mode->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Order Mode</h4>
              </div>
              <form method="POST" action="{{route('update.mode', ['id' => $mode->id])}}">
              	{{csrf_field()}}
              <div class="modal-body">
              	<label>Mode Name</label>
                <input type="text" class="form-control" name="mname" value="{{$mode->om_name}}" required autofocus>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
          	</form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
@endforeach
        <!-- /.modal -->
<!-- End OrderMode Modal -->

<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> 2.4.0
	</div>
	<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
	reserved.
</footer>
@endsection

@section('scripts')
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
<script src="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('#modes').DataTable({
		'lengthChange' : false,
		'searching'   : false,
	});





	 $("#modes").on("click",".delete", function(){
        var id = $(this).closest('.delete').val();
         
        if(confirm("Are you sure you want to delete this order mode?")) {
             
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
             $.ajax({
                method: "post",
                url: "./deleteOrderMode",
                data: {'_token': CSRF_TOKEN,
                       'id': id
                       },
                success: function() {
                  var table = $('#modes').DataTable();
                  console.log(id);
                  table
                    .row('#'+id)
                    .remove()
                    .draw();
                  alert("Order Mode successfully deleted.");
                },
                error: function() {
                     
                    alert('An error occured.');
                }
            });
        }
        });

});
</script>
@endsection