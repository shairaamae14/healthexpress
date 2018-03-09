<style type="text/css">
  .avatar-circle {
  width: 100px;
  height: 100px;
  background-color: green;
  text-align: center;
  border-radius: 50%;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
}
.initials {
  position: relative;
  top: 25px; /* 25% of parent */
  font-size: 50px; /* 50% of parent */
  line-height: 50px; /* 50% of parent */
  color: #fff;
  font-family: "Courier New", monospace;
  font-weight: bold;
}
</style>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <div class="user-image">
            <label style="font-size: 40px; color:black;position: center;">{{Auth::user()->first_name[0].Auth::user()->last_name[0]}}</label>
          </div>
          <!-- <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image"> -->
        </div>
        <div class="pull-left info" id="stat">
          <p>{{ Auth::user()->first_name." ".Auth::user()->last_name  }}</p>
          <li class="dropdown status">
          @if(Auth::user()->cook_status == 'Accepting')
            <a href="#" class="dropdown-toggle dispstats" data-toggle="dropdown">
            <i class="fa fa-circle text-success"></i>&nbsp;Accept Orders <span class="caret"></span></a>
         @else(Auth::user()->cook_status =="NotAccepting")
           <a href="#" class="dropdown-toggle dispstats" data-toggle="dropdown">
            <i class="fa fa-circle text-default"></i>&nbsp;Not Accepting <span class="caret"></span></a>
         @endif
          <ul class="dropdown-menu statlist" id="statlist">
            <li role="presentation" id="stat1" value="Accept"><a href="#" id="cStat" class="dropdown-toggle" data-toggle="dropdown" value="Accept"><i class="fa fa-circle text-success"></i> Accept Orders </a></li>
            <li role="presentation" id="stat2" value="NotAccept"><a href="#"  id="cStat" class="dropdown-toggle" data-toggle="dropdown" value="NotAccept"><i class="fa fa-circle text-default"></i> Not Accepting </a></li>
          </ul>
            </li>
        </div>
        <br><br><br>   <br><br>
      </div>
      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form">
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
        @if(Route::currentRouteName() == 'cook.dashboard' || Route::currentRouteName() == 'cook.sort')
        <li class="active">
          <a href="{{route('cook.dashboard')}}">
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
            <li><a href="{{route('cook.expressorders')}}"><i class="fa fa-circle-o"></i> Express Meals</a></li>
            <li><a href="{{route('cook.porders')}}"><i class="fa fa-circle-o"></i> Planned Meals</a></li>
          </ul>
        </li>
        <li>
          <a href="{{route('cook.pmdishes')}}">
            <i class="fa fa-calendar-check-o"></i>
            <span>Planned Meals</span>
          </a>
        </li>
        @elseif(Route::currentRouteName() == 'cook.dishes' || Route::currentRouteName() == 'cook.dishes.add'
        || Route::currentRouteName() == 'cook.dishes.update' || Route::currentRouteName() == 'cook.dishes.show')
         <li>
          <a href="{{route('cook.dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="active">
          <a href="{{route('cook.dishes')}}">
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
            <li><a href="{{route('cook.expressorders')}}"><i class="fa fa-circle-o"></i> Express Meals</a></li>
            <li><a href="{{route('cook.porders')}}"><i class="fa fa-circle-o"></i> Planned Meals</a></li>
          </ul>
        </li>
        <li>
          <a href="{{route('cook.pmdishes')}}">
            <i class="fa fa-calendar-check-o"></i>
            <span>Planned Meals</span>
          </a>
        </li>
        @elseif(Route::currentRouteName() == 'cook.view.plan' || Route::currentRouteName() == 'cook.add.plan' ||
        Route::currentRouteName() == 'cook.pmdishes')
        <li>
          <a href="{{route('cook.dashboard')}}">
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
            <i class="fa fa-shopping-cart"></i>
            <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('cook.expressorders')}}"><i class="fa fa-circle-o"></i> Express Meals</a></li>
            <li><a href="{{route('cook.porders')}}"><i class="fa fa-circle-o"></i> Planned Meals</a></li>
          </ul>
        </li>
        <li class="active">
          <a href="{{route('cook.pmdishes')}}">
            <i class="fa fa-calendar-check-o"></i>
            <span>Planned Meals</span>
          </a>
        </li>
        @else
          <li>
          <a href="{{route('cook.dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="active">
          <a href="{{route('cook.dishes')}}">
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
            <li><a href="{{route('cook.expressorders')}}"><i class="fa fa-circle-o"></i> Express Meals</a></li>
            <li><a href="{{route('cook.porders')}}"><i class="fa fa-circle-o"></i> Planned Meals</a></li>
          </ul>
        </li>
        <li>
        <a href="{{route('cook.pmdishes')}}">
            <i class="fa fa-calendar-check-o"></i>
            <span>Planned Meals</span>
          </a>
        </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js" ></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script> -->
