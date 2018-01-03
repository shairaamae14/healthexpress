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
    <!-- <h1>Planned Meal Dishes</h1> -->
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Planned Meals</li>
      </ol>
    </section>
  <!-- Main content -->
    <section class="content"><br><center>
      <div class="box box-solid" style="padding:10px; width:70%"> 
        <h1 class="text-left has-success" style="margin:10px">Planned Meal Dishes</h1>
        <p class="text-left" style="margin: 10px"> Please select a dish to include in your planned meal dishes. You may add a new dish.</p>
        <select class="form-control has-success dishbox" name="dish_id" id="dishbox" style="width:55%; margin: 10px; margin-right: 2px; float:left">
        @foreach($dishes as $dish)
          <option value="{{$dish->did}}" id="dish" class="dish">{{$dish->dish_name}}
          </option>
        @endforeach
        </select>
        <select class="form-control has-success plan" name="plan" id="plan" style="width:15%; margin:10px;float:left">
          <option value="Daily" id="plan" class="plan">Daily</option>
          <option value="Weekly" id="plan" class="plan">Weekly</option>
          <option value="Monthly" id="plan" class="plan">Monthly</option>
        </select>
        <button type="button" class="btnadd btn btn-flat btn-success btn-md" style="float:left; margin: 10px">+ Add</button><br>
        <form action="{{route('cook.addPlan')}}" method="post">
           {{csrf_field()}}
        <table id="part" class="plantable" style="margin:10px; margin-top: 20px; width:60%">
          <tr>
            <th style="width:250px; font-size: 20px; margin:10px">Dish Name</th>
            <th style="width:200px; font-size: 20px; margin:10px">Type of plan</th>
            <th style="width:200px; font-size: 20px; margin:10px">Remove</th>
         </tr>
       </table>
      <button href="{{route('cook.pmdishes')}}" class="btn btn-flat btn-success" style="font-size: 12px; margin: 10px;">View all planned meal dishes</button>
      <input type="submit" class="btn-flat btn btn-success" value="Save Dishes" style="margin-left:100px;"/>
      </form>
    </div>
    </section>
  </div>



      <!-- Default box -->
        </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
@section('addtl_scripts')
   
           
<!-- jQuery 3 --><!-- 
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script> -->
<!-- jQuery UI 1.11.4 -->
<!-- <script src="{{asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- <script>
  $.widget.bridge('uibutton', $.ui.button);
</script> -->
<!-- Bootstrap 3.3.7 -->
<!-- <script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script> -->
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
<!-- <script src="{{asset('adminlte/bower_components/moment/min/moment.min.js')}}"></script> -->
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-1.10.2.js"></script> -->
<script type="text/javascript">
$(document).ready(function(){
    $(".btnadd").click(function(){
        var dish = $(".dishbox option:selected").text();
        var dish_id =$(".dishbox option:selected").val();
          var plan = $(".plan option:selected").val();
        console.log(dish, plan);

        div = document.getElementById('part');
        div.innerHTML += 

                          '<tr class="trtable" style="margin-top:10px">'+
                            '<th style="width:150px; font-size: 15px">'+dish+'</th>'+
                            '<input type="hidden" name="dish_id[]" value="'+dish_id+'"/>'+
                            '<th style="width:150px; font-size: 15px">'+plan+'</th>'+
                            '<input type="hidden" name="plan[]" value="'+plan+'"/>'+
                            '<th style="width:150px; font-size: 15px">'+
                            '<button type="button" class="btnrem btn btn-flat btn-danger btn-sm" id="btnrem">Remove</button></th>'+
                          '</tr>'
        
       });
      });

$('table').on('click','.btnrem ',function(){
   $(this).closest('tr').remove()
});

</script>

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