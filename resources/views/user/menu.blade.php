@extends('user-layouts.master')
@section('content')
<!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Express Meal
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Choose</a></li>
          <li class="active">Express</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
       
        <div class="box box-solid">
          <div class="box-header with-border">
          <center>
            <h3 class="box-title">Cooks Nearby</h3> <br>
            <small><i class="fa fa-location-arrow"> Cebu City</i></small>
          </center>
          </div>
        </div>
        <!-- /.box -->

       <div class="box box-solid">
            <div class="box-body">
            @foreach($cooks as $cook)
                <div class="col-md-4">
                <a href="{{route('user.show.dishes',  ['id' => $cook->id])}}">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                        <center><h3 class="box-title"></h3>{{$cook->first_name}} <br>
                        <small><i class="fa fa-circle text-success"> Available</i></small> </center>
                        </div>
                        <center><small><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></small></center>
                        <center><i class="fa fa-angle-right"></i></center>
                    </div>
                </a>
                </div>
            @endforeach
                <div class="col-md-4">
                <a href="#">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                        <center><h3 class="box-title">Shai Pedrosa</h3> <br>
                        <small><i class="fa fa-circle text-success"> Available</i></small> </center>
                        </div>
                        <center><small><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></small></center>
                        <center><i class="fa fa-angle-right"></i></center>
                    </div>
                </a>
                </div>
                <div class="col-md-4">
                <a href="#">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                        <center><h3 class="box-title">Jo Jabagat</h3> <br>
                        <small><i class="fa fa-circle-o"> Not Available</i></small> </center>
                        </div>
                        <center><small><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-full"></i></small></center>
                        <center><i class="fa fa-angle-right"></i></center>
                    </div>
                </a>
                </div>

                <div class="col-md-4">
                <a href="#">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                        <center><h3 class="box-title">Ellen Adarna</h3> <br>
                        <small><i class="fa fa-circle text-success"> Available</i></small> </center>
                        </div>
                        <center><small><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-empty"></i><i class="fa fa-star-o"></i></small></center>
                        <center><i class="fa fa-angle-right"></i></center>
                    </div>
                </a>
                </div>
            </div>
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
@endsection