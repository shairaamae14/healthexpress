  <header class="main-header">
    <!-- Logo -->
    <a href="./cook" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
       <span class="logo-mini"><img src="{{asset('img/healthlogo.png')}}" width="60" height="40"></img></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="color:white"><b>HEALTH</b>EXPRESS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{count(Auth::user()->notifications)}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{count(Auth::user()->notifications)}} notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @foreach(Auth::user()->unreadNotifications as $notification)
                  <li>
                    @include('notification.'.snake_case(class_basename($notification->type)))
                  
                  </li>
                  @endforeach 
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <div class="user-image" style="background:white;">
               <label style="font-size: 15px; color:black;margin:2.5px;">{{Auth::user()->first_name[0].Auth::user()->last_name[0]}}</label>
             </div>
              <!-- <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"> -->
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <div class="img-circle" style="background:white;">
               <label style="font-size:40px;">{{Auth::user()->first_name[0].Auth::user()->last_name[0]}}</label>
             </div>

                <p>
                  {{ Auth::user()->first_name." ".Auth::user()->last_name }}
               <!--    <small>Member since Nov. 2012</small> -->
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('cook.profile', ['cook' => Auth::user()->id])}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('cook.logout') }}" class="btn btn-default btn-flat">Sign out
                  <form id="logout-form" action="{{ route('cook.logout') }}" method="POST" style="display: none;"></a>
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         <!--  <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>