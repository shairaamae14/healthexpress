@extends('cook-layouts.cook-master')
<style>
 .D:hover{
  background-color: #31A0DC !important;
  color:white !important;
  border:white !important;
}

 .C:hover{
  background-color: #DC3131 !important;
  color:white !important;
  border:white !important;
}

.R:hover{
  background-color: #30BB6D !important;
  color:white !important;
  border:white !important;
}
</style>
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <h1>
        Dashboard
        <small>it all starts here</small>
      </h1> -->
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
<!--         <li class="active"><a href="#">Dashboard</a></li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
<h1 style="padding-left:20px">Express Orders</h1>
<select style="float:right; margin-right:20px">
  <option value="today">Today</option>
  <option value="yesterday">Yesterday</option>
  <option value="Week ago">Week ago</option>
  <option value="Others">Others</option>
</select>
<label style="float:right">Sort By:</label>

        </div>
        <div class="row">
      
          <div class="col-md-5">
          <div class="box box-solid">
            <div class="box-header with-border" id="header" style="background-color: #30BB6D">
              <h3 class="box-title" style="color:white;"><i class="fa fa-user"></i> 
               Shayne Dingle</h3>
               <label id="stats" style="float:right; color:white">Pending</label>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <dl class="dl-horizontal">
               <dt><i class="fa fa-spoon"></i> Order(s):</dt>
               <dd class="dd_order"> <strong>Italian Quinoa Salad </strong>(2)</dd>
               <dt><i class="fa fa-check"></i> Order mode:</dt>
               <dd>Express Meal</dd>
               <dt><i class="fa fa-calendar"></i>  Date & Time Ordered:</dt>
               <dd>July 28, 8:42 AM</dd>
                <dt><i class="fa fa-times"></i> Allergies:</dt>
                <dd>Shrimp, Nuts, Milk</dd>
              <dt><i class="fa fa-sticky-note"></i>  Side note(s):</dt>
              <dd>Don't put too much carrots. Please add more sauce </dd>

              </dl>
                     <a href="#"><button type="button" class="btn btn-flat btn-success btn-sm">Order details</button></a>
                     <a href="#"><button type="button"  class="C btn btn-flat btn-success btn-sm" id="cooking" onclick="btnCook()" style="float:right; color:#DC3131; border:2px solid  #DC3131; background-color: white;">Cooking</button></a>
                     <a href="#"><button type="button"  class="D btn btn-flat btn-success btn-sm" id="deliver" onclick="btnDel()"  style="float:right; color:#31A0DC; border:2px solid #31A0DC;  background-color: white; margin-right:5px">Ready</button></a>
                      <a href="#"><button type="button"  class="R btn btn-flat btn-success btn-sm" id="done" onclick="btnDone()"  style="float:right; color:#30BB6D; border:2px solid #30BB6D;  background-color: white; margin-right:5px">Received</button></a>

                    
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->





     
<!--ROW!-->
</div>

</section>

    <section class="content">
    <!--SECOND BOX!-->

               <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Planned Meal Orders</h3>

          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button> -->
          </div>
        </div>
        <div class="box-body">
          <!--CONTENT!-->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="#">
          <div class="info-box">
            <a href="#"><span class="info-box-icon bg-aqua"><i class="fa fa-spoon"></i></span></a>
            <div class="info-box-content">
             <span class="info-box-text">04/28/97, 4:30PM</span>
              <span class="info-box-text">Planned Meal</span>
               <a href="#"><span class="info-box-number">Shayne Dingle</span></a>
              <span class="info-box-number">1 week</span>
          
            </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


       
        <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="#">
          <div class="info-box">
          <a href="#"><span class="info-box-icon bg-aqua"><i class="fa fa-spoon"></i></span></a>
            <div class="info-box-content">
             <span class="info-box-text">04/28/97, 4:20PM</span>
             <span class="info-box-text">Planned Meal</span>
               <a href="#"><span class="info-box-number">Beatrice Dingle</span></a>
              <span class="info-box-number">3 days</span>
            </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>



         
        <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="#">
          <div class="info-box">
            <a href="#"><span class="info-box-icon bg-aqua"><i class="fa fa-spoon"></i></span></a>
            <div class="info-box-content">
             <span class="info-box-text">04/28/97, 5:00PM</span>
             <span class="info-box-text">Planned Meal</span>
               <a href="#"><span class="info-box-number">Jo Yook</span></a>
              <span class="info-box-number">2 weeks</span>
            </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


       <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="#">
          <div class="info-box">
            <a href="#"><span class="info-box-icon bg-aqua"><i class="fa fa-spoon"></i></span></a>
            <div class="info-box-content">
             <span class="info-box-text">04/28/97, 2:10PM</span>
             <span class="info-box-text">Planned Meal</span>
               <a href="#"><span class="info-box-number">Shai Ped</span></a>
              <span class="info-box-number">2 weeks</span>
            </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>



       <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="#">
          <div class="info-box">
            <a href="#"><span class="info-box-icon bg-aqua"><i class="fa fa-spoon"></i></span></a>
            <div class="info-box-content">
             <span class="info-box-text">04/28/97, 2:10PM</span>
             <span class="info-box-text">Planned Meal</span>
               <a href="#"><span class="info-box-number">Shai Ped</span></a>
              <span class="info-box-number">2 weeks</span>
            </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        
       <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="#">
          <div class="info-box">
            <a href="#"><span class="info-box-icon bg-aqua"><i class="fa fa-spoon"></i></span></a>
            <div class="info-box-content">
             <span class="info-box-text">04/28/97, 2:10PM</span>
             <span class="info-box-text">Planned Meal</span>
               <a href="#"><span class="info-box-number">Shai Ped</span></a>
              <span class="info-box-number">2 weeks</span>
            </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

<!--ROW!-->
</div>


        <!-- /.box-body -->
  <!--       <div class="box-footer">
          Footer
        </div> -->
        <!-- /.box-footer-->
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

@endsection