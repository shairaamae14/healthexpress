@extends('cook-layouts.cook-master')
<style>

{
  color:orange;
}
</style>

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dish Rating
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dishes</li>
        <li class="active">Reviews</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- row -->
      <div class="row">
        <div class="col-md-12">
        @foreach($avg as $a)
         <span class="badge" style="font-family: verdana; border-radius:5px; background-color:#30BB6D; font-size: 15px">{{$a->dish_name}}</span><br><br>
         <span class="badge" style="font-family: verdana; border-radius:2px; color:black; background-color:transparent; font-size: 15px">{{$a->average}} out of 5 stars</span><br><br>
        @endforeach
           <ul class="timeline">
           @if(count($rate))
           @foreach($rate as $r)
            <li class="time-label">
                  <span class="bg-green">
                  {{$r->fname}}&nbsp;{{$r->lname}}
                  </span>
            </li>
            <li>
              <img src="{{url('./user_imgs/'.$r->profpic    )}}" class="img-circle" style="width:50px; height:50px"/>
               <div class="timeline-item">
                <h3 class="timeline-header">
                    <label style="font-size: 12px">{{$r->date_rated}}<br>
                   <div class="avg">
                    <label class="avgbox" id="avgbox"></label>
                    <label class="avgbox2" id="avgbox2"></label><br>
                    <input type="hidden" class="avg" value="{{$r->rating}}"/>
                    <label>{{$r->rating}} out of 5 stars</label>
                   </div>
                </h3>
      
                <div class="timeline-body" style="margin-left:10px">
                @if($r->comment)
                  {{$r->comment}}
                @else
                  <label style="color:gray"> No comment</label>
                @endif
                </div>
          
              </div>
            </li>
            @endforeach
            </ul>
              <div class="text-center">
            {{$rate->links()}}
            </div>
            </div>
            </div>
             @else
            <center><label style="font-size:50px; color:gray; font-family: arial; margin: 50px;">NO REVIEWS FOR THIS DISH</label>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->
</div>



@endsection
@section('addtl_scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    $(document).ready(function(){
    var avg = $('input[class=avg]').val();
    console.log(avg);
    // $(this).closest('.rate').find('.ratingbox').append(rating);
    if(avg < 5){
    var num=5;
    // console.log(avg);
      var temp=num-avg;
      // console.log(temp);
      for(var i=1; i<=temp; i++){
          $('.avgbox2').append('<i class="fa fa-star-o" aria-hidden="true" style="color:orange; font-size:25px"></i>');
      }
    }
    while(avg >= 1){
      $('.avgbox').append('<i class="fa fa-star" aria-hidden="true" style="color:orange; font-size:25px"></i>');
      avg -= 1;
    }
    if(avg > 0) {
      $('.avgbox').append('<i class="fa fa-star-half-o" aria-hidden="true" style="color:orange; font-size:25px"></i>');
    }
    
  

  });

  </script>

  @endsection

