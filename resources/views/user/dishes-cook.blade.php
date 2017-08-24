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
            <h3 class="box-title">{{$cook->first_name." ".$cook->last_name}}</h3> <br>
            <center><small><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></small></center>
          </center>
          </div>
        </div>
        <!-- /.box -->

       <div class="row">
            <div class="box-body">
                <div class="col-md-8">
                  <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Menu</a></li>
              <li><a href="#tab_2" data-toggle="tab">Information</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              @foreach($dishes as $dish)
                <div class="box box-solid">
                  <div class="box-header with-border" id="divDishes" data-id="">
                      <strong>{{$dish->dish_name}}</strong>
                    <div class="pull-right">
                      <strong>Php {{$dish->dish_price}}</strong>
                      <button type="button" class="addToCart"><i class="fa fa-plus-square text-success"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                   <dl>
                    <dd>{{$dish->dish_desc}}</dd>
                   </dl>
                  </div>

                </div>
              @endforeach
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <h4><strong>Beatrice Ylaya</strong></h4>
                <small>Cebu City</small>

                
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
                </div>
            
          <div class="col-md-4">
            <div class="box box-solid">
            <div class="box-header with-border"><strong>Orders</strong></div>
            <div class="box box-body">

            <div id="cart_empty">
            <center> 
                <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                <p>Add dishes in your cart</p>
            </center>
            </div>

            <div class="food_cart">
              <td>1x</td>
              <td>Vegetable Salad</td>
              <td><div class="pull-right">Php 120.00</div></td>
            </div>


            <div class="cart_summary">
            </div>
            </div>
            </div>
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

  <script type="text/javascript">
    $(document).ready(function(){
        $("#divDishes").on('click', '.addToCart' function(){
          var url =  $(this).val();
          alert(url);
          // window.location= 
        });
    })
</script>
@endsection