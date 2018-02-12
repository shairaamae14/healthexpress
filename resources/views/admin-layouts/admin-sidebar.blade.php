<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if(Route::currentRouteName() == 'admin.home')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i>
            <span>Dishes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-circle-o"></i> Express Meals</a></li>
            <li><a href="{{route('cook.porders')}}"><i class="fa fa-circle-o"></i> Planned Meals</a></li>
          </ul>
        </li>
        <li>
          <a href="{{route('admin.user.addtl')}}">
            <i class="fa fa-child"></i>
            <span>User</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.order.addtl')}}">
            <i class="fa fa-inbox"></i>
            <span>Orders</span>
          </a>
        </li>
        <li>
          <a href="./admin/matrix">
            <i class="fa fa-files-o"></i>
            <span>Matrix</span>
          </a>
        </li>
        @elseif(Route::currentRouteName() == 'admin.user.addtl')
        <li>
          <a href="{{route('admin.home')}}">
            <i class="fa fa-dashboard"></i> <span>Dishes</span>
          </a>
        </li>
        <li class="active">
          <a href="{{route('admin.user.addtl')}}">
            <i class="fa fa-child"></i>
            <span>User</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.order.addtl')}}">
            <i class="fa fa-inbox"></i>
            <span>Orders</span>
          </a>
        </li>
        @elseif(Route::currentRouteName() == 'admin.order.addtl')
        <li>
          <a href="{{route('admin.home')}}">
            <i class="fa fa-dashboard"></i> <span>Dishes</span>
          </a>
        </li>
        <li >
          <a href="{{route('admin.user.addtl')}}">
            <i class="fa fa-child"></i>
            <span>User</span>
          </a>
        </li>
        <li class="active">
          <a href="{{route('admin.order.addtl')}}">
            <i class="fa fa-inbox"></i>
            <span>Orders</span>
          </a>
        </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>