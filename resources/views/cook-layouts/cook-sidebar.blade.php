<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if(Route::currentRouteName() == 'cook.dashboard')
        <li class="active">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{route('cook.dishes')}}">
            <i class="fa fa-spoon"></i>
            <span>Dishes</span>
          </a>
        </li>
        <li class="treeview">
          <a href="./orders">
            <i class="fa fa-inbox"></i>
            <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./orders"><i class="fa fa-circle-o"></i> Express Meals</a></li>
            <li><a href="./orders"><i class="fa fa-circle-o"></i> Planned Meals</a></li>
          </ul>
        </li>
        @elseif(Route::currentRouteName() == 'cook.dishes')
         <li>
          <a href="{{route('cook.dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="active">
          <a href="#">
            <i class="fa fa-spoon"></i>
            <span>Dishes</span>
          </a>
        </li>
        <li class="treeview">
          <a href="./orders">
            <i class="fa fa-shopping-cart"></i>
            <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./orders"><i class="fa fa-circle-o"></i> Express Meals</a></li>
            <li><a href="./orders"><i class="fa fa-circle-o"></i> Planned Meals</a></li>
          </ul>
        </li>
        @else
          <li>
          <a href="{{route('cook.dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="active">
          <a href="./cook/dishes">
            <i class="fa fa-spoon"></i>
            <span>Dishes</span>
          </a>
        </li>
        <li class="active treeview">
          <a href="./orders">
            <i class="fa fa-shopping-cart"></i>
            <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./orders"><i class="fa fa-circle-o"></i> Express Meals</a></li>
            <li><a href="./orders"><i class="fa fa-circle-o"></i> Planned Meals</a></li>
          </ul>
        </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
