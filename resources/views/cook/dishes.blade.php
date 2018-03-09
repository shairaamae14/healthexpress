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
<!--             <button type="button" class="btn btn-flat btn-success add-dish" onclick="window.location.href='{{route('dish.catalog')}}'" style="margin-bottom:20px"><i class="fa fa-plus"></i> Add to Catalog</button> -->
            <button type="button" class="btn btn-flat btn-success add-dish" onclick="window.location.href='{{route('cook.view.plan')}}'" style="margin-bottom:20px"><i class="fa fa-plus"></i> Create Plan</button>
        <div class="box box-solid"> 
            <div class="box-body">
              <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dishes-list dataTable">
                        <thead>
                            <tr>
                                <th width="7%"></th>
                                <th width="40%">Dish Name</th>
                                <th width="20%">Reviews</th>
                                <th class="disabled-sorting text-right" width="20%">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($dishes as $dish)
                            <tr>
                                <td width="7%"><img src="{{url('./dish_imgs/'.$dish->dish_img)}}" style="width:90px; height:90px; border:2px solid #F0F0F0"></td>
                                <td width="40%"><h4 class="openModal box-title" style="margin-top: 5px; font-size: 15px;"><a href="{{route('cook.dishes.show', ['id' => $dish->did])}}" style="color:#30BB6D">{{$dish['dish_name']}}</a></h4></td>
                                <td width="20%">
                                  @if($dish->average['average'])
                                    <label class="ratingbox" id="ratingbox"></label>
                                    <label class="ratingbox2" id="ratingbox2"></label><br>
                                    <input type="hidden" class="ratings" id="rate_{{$dish->average['average']}}" value="{{$dish->average['average']}}">
                                   @else
                                     <center><small>
                                     <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                                     <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                                     <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                                     <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                                     <i class="fa fa-star-o" aria-hidden="true" style="font-size:13px"></i>
                                    </small></center>
                                   @endif
                                </td>
                                <td width="20%"><a class="btn btn-success" href="{{route('cook.rating', ['id' => $dish->did])}}">See Reviews</a>
                                <a class="btn btn-success" href="{{route('cook.dishes.show', ['id' => $dish->did])}}">View Details</a></td>
                            </tr>
                             @endforeach 
                        </tbody>
                    </table>
                </div>

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
<!-- Slimscroll -->
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

<!-- <script src="{{asset('js/app.js')}}"></script> -->
  
<!-- DataTables -->
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(document).ready(function(){
      $('.dishes-list').DataTable({ 
            "pageLength": 5,
            "lengthChange": false,
            aoColumnDefs: [
              {
                 bSortable: false,
                 aTargets: [ -1 ,-2, -4]
              }
            ]
        });
       $("#statlist li").click(function(){
      var val=$(this).find("a").text();
      $.ajax({
      url: "{{route('status.change')}}",
      method: "get",
      data: {'data':val},
      success: function(){
        // location.reload();
        if(val==" Accept Orders "){
         $('.status').find(".dispstats").html("<i class='fa fa-circle text-success'></i>"+val+"<span class='caret'></span></a>");
        }
        else if(val==" Not Accepting "){
            $('.status').find(".dispstats").html("<i class='fa fa-circle text-default'></i>"+val+"<span class='caret'></span></a>");
        }
       
      }
    });
    });
  $(".ratingbox").closest('.rate').find('input[class=ratings]').each(function(index, data){
    var rating = $(this).val();
    // $(this).closest('.rate').find('.ratingbox').append(rating);
    if(rating < 5){
    var num=5;
    console.log(rating);
      var temp=num-rating;
      // console.log(temp);
      for(var i=1; i<=temp; i++){
          $(this).closest('.rate').find('.ratingbox2').append('<i class="fa fa-star-o" aria-hidden="true" style="color:orange; font-size:13px"></i>');
      }
    }
    
    while(rating >= 1){
      $(this).closest('.rate').find('.ratingbox').append('<i class="fa fa-star" aria-hidden="true" style="color:orange; font-size:13px"></i>');
      rating -= 1;
    }
    if(rating > 0) {
      $(this).closest('.rate').find('.ratingbox').append('<i class="fa fa-star-half-o" aria-hidden="true" style="color:orange; font-size:13px"></i>');
    }
    
  

});
  });

  </script>
  



    
@endsection