@extends('admin-layouts.master')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Dashboard</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Matrix</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<button type="button" class="btn btn-flat btn-success" style="margin-bottom:20px" data-toggle="modal" data-target="#modal-allergen"	><i class="fa fa-plus"></i> Add Allergens</button>


				<div class="box box-solid"> 
					<div class="box-body">
           <h3 class="box-title">Users</h3>
           <table id="allergens" class="table table-bordered table-hover">
             <thead>
              <tr>
               <th>Name</th>
               <th>Weight</th>
               <th>Height</th>
               <th>DCR</th>
               <th>Allergies</th>
               <th>Tolerance</th>
               <th>Medical Condition</th>
             </tr>
           </thead>
           <tbody>

            <tr id="">
             <td>{{$user->fname." ".$user->lname}}</td>
             <td>{{$user->weight}} kg</td>
             <td>{{$user->height}} cm</td>
             <td>{{$user->dcr}}
              </td>
              @if($allergies)
              @foreach($allergies as $allergy)
             <td>{{$allergy->allergen_name}}</td>
             <td>{{$allergy->tolerance_level}}</td>
             @endforeach
             @else
             <td>None</td>
             <td>None</td>
             @endif
             @if($medcondition)
             <td>
             @foreach($medcondition as $cond)
             {{$cond->medcon_name}} 
             @endforeach
             </td>
             @else
             <td>None</td>
             @endif

        </tbody>

      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

  <div class="box box-solid"> 
          <div class="box-body">
           <h3 class="box-title">Dishes</h3>
           <table id="allergens" class="table table-bordered table-hover">
             <thead>
              <tr>
               <th>Name</th>
               <th>Price</th>
               <th>Desc</th>
               <th>No. of Servings</th>
             </tr>
           </thead>
           <tbody>
            @foreach($recommendation as $rec)
            <tr id="">
             <td>{{$rec['dish_name']}}</td>
             <td>{{$rec['sellingPrice']}}</td>
             <td>{{$rec['dish_desc']}}</td>
             <td>{{$rec['no_of_servings']}}</td>
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>
    <!-- /.box-body -->
  </div>

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
	
});
</script>
@endsection