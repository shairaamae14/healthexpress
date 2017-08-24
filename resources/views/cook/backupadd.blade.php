@extends('layouts.c_master')

<style>

fieldset{
    background: #FCFCFC;
    padding: 16px;
    border: 1px solid #D5D5D5;
}
.remove{
    background: #C76868;
    color: #FFF;
    font-weight: bold;
    font-size: 24px;
    border: 0;
    cursor: pointer;
    display: inline-block;
    padding: 4px 9px;
    vertical-align: top;
    line-height: 100%;   
}

</style>
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dishes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dishes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Dishes</h3>

        </div>
        <form method="post" action="{{route('cook.dishes.create')}}">
        {{csrf_field()}}
        <div class="box-body">
        <div class="row">
          
            <div class="form-group col-md-3">
              <label>Name:</label>
                <input type="text" class="form-control" name="dish_name" placeholder="Name">
            </div>

           <div class="form-group col-md-3">
              <label>Category:</label>
                <input type="text" class="form-control" name="dish_cat" placeholder="Category">
            </div>

           <div class="form-group col-md-3">
              <label>Serving:</label>
                <input type="number" class="form-control" name="serving" placeholder="Number of serving" min="1">
            </div>

            <div class="form-group col-md-3">
              <label>Price:</label>
                <input type="text" class="form-control" name="price" placeholder="Price">
            </div>

           <div class="form-group col-md-3">
              <label>Lead Time:</label>	
                <input type="datetime-local" class="form-control" name="lead_time" placeholder="Lead time">
            </div>

            <div class="form-group col-md-3">
              <label>Description:</label>
                <textarea class="form-control" rows="3" name="dish_desc" placeholder="Description"></textarea>                
            </div>

            <div class="form-group col-md-3">
              <label for="exampleInputFile">Dish Image</label>
                <input type="file" id="file" name="file">
                  <p class="help-block">jpg., jpeg., png. extension only</p>
            </div>
          </div> <!-- row -->
       
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <div class="col-md-2">
         <button type="submit" class="btn btn-block btn-success submit"><i class="fa fa-plus"></i> Add Dish</button> 
        </div>
        
        </div>
        <!-- /.box-footer-->
        </form>
      </div>
      <!-- /.box -->
  <!-- Main content -->
    

      <!-- Default box -->
    
 <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Ingredients</h3>
          <div class="box-body">
        <div class="row">

      <div ng-app="angularjs-starter" ng-controller="MainCtrl">
           <fieldset  data-ng-repeat="choice in choices">
             
             <div class="form-group col-md-3">
              <label>Name:</label>
                <input type="text" ng-model="choice.name" class="form-control" name="ingredient_name" placeholder="Ingredient Name">
            
              </div>
              <div class="form-group col-md-3">
              <label>Quantity:</label>
                <input type="text" ng-model="choice.quantity" class="form-control" name="quantity" placeholder="Quantity">
            </div>
            <div class="form-group col-md-2">
              <label>Unit:</label>
               <select class="form-control">
                 <option>Cup(s)</option>
                 <option>Tablespoon</option>
                 <option>Teaspoon</option>
                  <option>Kilogram(s)</option>
                   <option>Gram(s)</option>
                    <option>Ounce(s)</option>
                     <option>Pound(s)</option>
                      <option>Liter(s)</option>
                       <option>Pinch</option>
              </select>
               </div>
         
              <button class="remove"  ng-click="removeChoice()">-</button>
            
           </fieldset>
          
            <div class="box-footer">
        <div class="col-md-2">
         <!-- <button type="submit" class="addfields btn btn-block btn-success submit " ng-click="addNewChoice()"><i class="fa fa-plus"></i></button>  -->
         <button class="addfields remove" ng-click="addNewChoice()" style="background-color:#30BB6D">+</button>
        </div>
        </div>
          <br>
            <div class="box-footer">
        <div class="col-md-2">
         <button type="submit" class="btn btn-block btn-success submit"><i class="fa fa-plus"></i> Add Ingredients</button> 
        </div>

               
           </div>
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".add-dish").on('click', function(){
          var url =  $(this).val();
          alert(url);
          // window.location= 
        });
    })
</script>
@endsection

