
<nav class="navbar navbar-success navbar-absolute" style="background-color:transparent; box-shadow: none">
  <div class="progress" style="display:none;">
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
  <span class="sr-only">30% Complete</span>
  </div>
</div>
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>

          <a href="./home">
        <div class="logo-container" style="font-size: 20px">
        <div class="logo" style="width: 185px; height:90px; border-radius: 0px; border:none">
        <a class="navbar-brand" href="/home"><img src="{{asset('img/healthlogo.png')}}" style="width:130px; height:60px; font-size: 20px; padding-bottom: 10px"></img></a>
        <b style="color:white; font-size:20px">HEALTH</b>EXPRESS
        </div>
        </div>
        </a>
        </div>

        <div class="collapse navbar-collapse" id="navigation-example">
            <ul class="nav navbar-nav navbar-right">
              @if(Auth::guest())
              <li><a href="#"><i class="material-icons">help</i> Help </a></li>
              <li><a href="#works">How it works</a></li>
              <li><a href="#about"> About us</a></li>
              <li><a href="./login">Login</a></li>
              <li><a href="./register" target="_blank">Register</a></li>
              @else
                <li><a href="#"><i class="material-icons">help</i>Help</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="material-icons">account_circle</i> {{ Auth::user()->fname}} {{Auth::user()->lname}}</a>
                <ul class="dropdown-menu" role="menu">

                    <li><a href="{{route('user.profile', ['id'=> Auth::id()])}}">Profile</a></li>
                    <li><a href="{{route('order.orderhistory')}}">Orders</a></li>


                    <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    </form>
                    </li>
                </ul>
                </li>
              @endif
            </ul>
        </div>
    </div>
</nav>
