@extends('admin-layouts.master')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>User Additionals</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<button type="button" class="btn btn-flat btn-success" style="margin-bottom:20px" data-toggle="modal" data-target="#modal-allergen"	><i class="fa fa-plus"></i> Add Allergens</button>
		<button type="button" class="btn btn-flat btn-success" data-toggle="modal" data-target="#modal-medcon" style="margin-bottom:20px"><i class="fa fa-plus"></i> Add Medical Conditions</button>
	 <button type="button" class="btn btn-flat btn-success add-dish" data-toggle="modal" data-target="#modal-tolerance"  style="margin-bottom:20px"><i class="fa fa-plus"></i> Add Tolerance Level Value</button>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-solid"> 
					<div class="box-body">
						 <h3 class="box-title">Allergens</h3>
						<table id="allergens" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Status</th>
									<th class="col-md-2">Option</th>
								</tr>
							</thead>
							<tbody>
								@foreach($allergens as $allergen) 
								<tr id="{{$allergen->allergen_id}}">
									<td>{{$allergen->allergen_id}}</td>
									<td>{{$allergen->allergen_name}}</td>
									@if($allergen->status == 1)
									<td>Active</td>
									@endif
									<td>
										<button type="button" id="delete" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-allergen{{$allergen->allergen_id}}" value=""><i class="fa fa-edit"></i></button>
										<button type="button" class="btn btn-danger btn-sm delete" value="{{$allergen->allergen_id }}"><i class="fa fa-times-circle danger"></i></button>
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

			<div class="col-md-6">
				<div class="box box-solid"> 
					<div class="box-body">
						 <h3 class="box-title">Medical Conditions</h3>
						<table id="medcon" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Status</th>
									<th class="col-md-2">Option</th>
								</tr>
							</thead>
							<tbody>
								@foreach($medcons as $mc)
								<tr id="{{$mc->medcon_id}}">
									<td>{{$mc->medcon_id}}</td>
									<td>{{$mc->medcon_name}}</td>
									@if($mc->status == 1)
									<td>Active</td>
									@endif
									<td>
										<button type="button" id="delete" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-medcon{{$mc->medcon_id}}" value=""><i class="fa fa-edit"></i></button>
										<button type="button" class="btn btn-danger btn-sm delete" value="{{$mc->medcon_id }}"><i class="fa fa-times-circle danger"></i></button>
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

<!-- Allergens Modal -->
 <div class="modal fade" id="modal-allergen">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Allergen</h4>
              </div>
              <form method="POST" action="{{route('add.allergen')}}">
              	{{csrf_field()}}
              <div class="modal-body">
              	<label>Allergen Name</label>
                <input type="text" class="form-control" name="aname" required autofocus>
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
<!-- End Allergens Modal -->


<!-- Medical Conditions Modal -->
 <div class="modal fade" id="modal-medcon">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Medical Condition</h4>
              </div>
               <form method="POST" action="{{route('add.medcon')}}">
               	{{csrf_field()}}
              <div class="modal-body">
                <label>Medical Condition Name</label>
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
<!-- End Medical Conditions Modal -->


<!-- Tolerance Modal -->
 <div class="modal fade" id="modal-tolerance">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Tolerance Value</h4>
              </div>
              <form method="POST" action="{{route('add.tolerance')}}">
                {{csrf_field()}}
              <div class="modal-body">
                <label>Allergen</label>
                <select class="form-control" name="allergen">
                  @foreach($allergens as $allergen)
                  <option value="{{$allergen->allergen_id}}">{{$allergen->allergen_name}}</option>
                  @endforeach
                </select>
                <label>Level</label>
                <select class="form-control" name="level">
                  <option value="Low">Low</option>
                  <option value="Medium">Medium</option>
                  <option value="High">High</option>
                </select>
                <label>Threshold Value</label>
                <input type="text" class="form-control" name="value">
                <label>Minimum</label>
                <input type="text" class="form-control" name="min">
                <label>Maximum</label>
                <input type="text" class="form-control" name="max">
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
<!-- End Tolerance Modal -->

<!-- update Allergens Modal -->
@foreach($allergens as $allergen)
 <div class="modal fade" id="modal-allergen{{$allergen->allergen_id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Allergen</h4>
              </div>
              <form method="POST" action="{{route('update.allergen', ['id' => $allergen->allergen_id])}}">
              	{{csrf_field()}}
              <div class="modal-body">
              	<label>Allergen Name</label>
                <input type="text" class="form-control" name="aname" value="{{$allergen->allergen_name}}" required autofocus>
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
<!-- End Allergens Modal -->

<!-- update Medical Conditions Modal -->
@foreach($medcons as $mc)
 <div class="modal fade" id="modal-medcon{{$mc->medcon_id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Medical Condition</h4>
              </div>
               <form method="POST" action="{{route('update.medcon', ['id' => $allergen->allergen_id])}}">
               	{{csrf_field()}}
              <div class="modal-body">
                <label>Medical Condition Name</label>
                <input type="text" class="form-control" name="mname" value="{{$mc->medcon_name}}" required autofocus>
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
<!-- End Medical Conditions Modal -->


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
	$('#allergens').DataTable({
		'lengthChange' : false,
		'searching'   : false,
	});

	$('#medcon').DataTable({
		'lengthChange' : false,
		'searching'   : false,
	});

	$('#prep').DataTable({
		'lengthChange' : false,
		'searching'   : false,
	});

	$('#measurement').DataTable({
		'lengthChange' : false,	
		'searching'   : false,
	});

	 $('.timepicker').timepicker({
      showInputs: false
    })


	 $("#allergens").on("click",".delete", function(){
        var id = $(this).closest('.delete').val();
         
        if(confirm("Are you sure you want to delete this allergen?")) {
             
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
             $.ajax({
                method: "post",
                url: "./deleteAllergen",
                data: {'_token': CSRF_TOKEN,
                       'id': id
                       },
                success: function() {
                  var table = $('#allergens').DataTable();
                  console.log(id);
                  table
                    .row('#'+id)
                    .remove()
                    .draw();
                  alert("Allergens successfully deleted.");
                },
                error: function() {
                     
                    alert('An error occured.');
                }
            });
        }
        });

	  $("#medcon").on("click",".delete", function(){
        var id = $(this).closest('.delete').val();
         
        if(confirm("Are you sure you want to delete this medical condition?")) {
             
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
             $.ajax({
                method: "post",
                url: "./deleteMedCon",
                data: {'_token': CSRF_TOKEN,
                       'id': id
                       },
                success: function() {
                  var table = $('#medcon').DataTable();
                  console.log(id);
                  table
                    .row('#'+id)
                    .remove()
                    .draw();
                  alert("Medical Condition successfully deleted.");
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