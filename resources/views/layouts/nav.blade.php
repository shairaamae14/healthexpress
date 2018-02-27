<!-- Navbar -->
<nav class="navbar navbar-success navbar-fixed-top navbar-color-on-scroll">
    <div class="container">
         <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>

          <a href="./home">
        <div class="logo-container" style="font-size: 20px;">
        <div class="logo">
        <a class="navbar-brand" href="/home"><img src="{{asset('img/healthlogo.png')}}" width="80" height="40" style="margin-right:2px; margin-top:5px"></a>
        <div class="pull-left" style="margin-top:20px; color:white;">
            <b style="color:white; font-size:20px;" class="navbar-left">HEALTHEXPRESS</b>
        </div>
            
        </div>
        </div>
        </a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-success">
            <ul class="nav navbar-nav navbar-right">

                <li>
                    <a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
                        <i class="material-icons">help</i> Help
                    </a>
                </li>
                <li>
                    <a href="#works">
                        How it works
                    </a>
                </li>

                <li>
                    <a href="#about">
                        About us
                    </a>
                </li>
                @if(Auth::guest())
                <li>
                    <a href="./login">
                        Login
                    </a>
                </li>

                <li>
                    <a href="./register" target="_blank">
                        Register
                    </a>
                </li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="material-icons">account_circle</i> {{ Auth::user()->fname}} {{Auth::user()->lname}}</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{route('user.profile', ['id'=> Auth::id()])}}">Profile</a></li>
                        <li><a href="#">Order History</a></li>
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
<!-- End Navbar -->

