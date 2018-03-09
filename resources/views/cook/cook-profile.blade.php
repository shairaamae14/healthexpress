@extends('cook-layouts.cook-master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cook Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
            	<div class="img-circle text-center">
               <label style="font-size: 40px;">{{Auth::user()->first_name[0].Auth::user()->last_name[0]}}</label>
             </div>
              <!-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->

              <h3 class="profile-username text-center">{{Auth::user()->first_name." ".Auth::user()->last_name}}</h3>

              <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#uploadModal{{Auth::user()->id}}" style="background-color:#30BB6D"><b>Add Profile picture</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-phone margin-r-5"></i> Contact Number</strong>

              <p class="text-muted">
               {{Auth::user()->contact->contact_number}}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">{{Auth::user()->location}}</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Email</strong>

              <p class="text-muted">{{Auth::user()->email}}</p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Reviews</a></li>
             <!--  <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                     <div class="row">
                        <div class="col-md-12">
                         @foreach($avgrate as $cookavg)
                        <span class="badge" style="font-family: verdana; border-radius:2px; border:2px solid #30BB6D; color:black; background-color:transparent; font-size: 15px"> {{$cookavg->average}} out of 5 stars</span><br><br>
                         @endforeach
                         <br>
                           <ul class="timeline">
                           @if(count($ratings))
                           @foreach($ratings as $cr)
                            <li class="time-label">
                                  <span class="bg-green">
                                  {{$cr->fname}}&nbsp;{{$cr->lname}}
                                  </span>
                            </li>
                            <li>
                              <i class="fa fa-star bg-orange"></i>
                               <div class="timeline-item">
                                <h3 class="timeline-header">
                                   <div class="avg">
                                    <label class="avgbox" id="avgbox"></label>
                                    <label class="avgbox2" id="avgbox2"></label><br>
                                    <input type="hidden" class="avg" value="{{$cr->rating}}"/>
                                    <label>{{$cr->rating}} out of 5 stars</label>
                                   </div>
                                </h3>
                      
                                <div class="timeline-body" style="margin-left:10px">
                                @if($cr->comment)
                                  {{$cr->comment}}
                                @else
                                  <label style="color:gray"> No comment</label>
                                @endif
                                </div>
                          
                              </div>
                            </li>
                            @endforeach
                            </ul>
                            </div>
                            </div>
                             @else
                            <center><label style="font-size:50px; color:gray; font-family: arial; margin: 50px;">NO REVIEWS</label>
                            @endif
                            <!-- END timeline item -->
                            <!-- timeline item -->
            

            
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

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

<!-- Upload Picture -->
  <div class="modal fade" id="uploadModal{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><b>Upload Image</b></h4>
      </div>
        <form method="post" action="" enctype="multipart/form-data">    
           {{csrf_field()}}
        <div class="modal-body">  
        <center>
          <input type="file" class="dropify" data-height="160" data-allowed-file-extensions="jpg jpeg png svg"/ name="img" id="img">

        </div> <!--MODAL BODY!-->
        <div class="modal-footer">
              <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-info btn-simple">Save</button>
         </div>
         </form>
    </div>   
  </div>
</div>
<!-- Upload Picture -->
@endsection
@section('addtl_scripts')
<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('js/dropify.min.js')}}"></script>

<script type="text/javascript">
	var dropify = $('.dropify').dropify({
        messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happened.'
    }
       });<script type="text/javascript">
  $(document).ready(function() {
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
  });
</script>
    
</script>
<script type="text/javascript">
  $(document).ready(function() {
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
  });
</script>
    
@endsection