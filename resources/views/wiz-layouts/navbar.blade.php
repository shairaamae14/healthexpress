<!-- Navbar -->
<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-success">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="./" id="brndhvr" style="font-size: 20px">
                <div class="logo-container" style="color:white;">
                    <div class="logo">
                        <img src="{{asset('img/healthlogo.png')}}" width="80" height="40" style="margin-right:2px; margin-top:5px"  alt="Creative Tim Logo" rel="tooltip" title="Health Express" data-placement="bottom" data-html="true">
                        <b style="color:white">HEALTH</b>EXPRESS
                    </div>
                    <!-- <div class="brand">
                    
                    </div> -->


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
                  @if(Auth::guest())
                    <li>
                        <a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
                            How it works
                        </a>
                    </li>

                    <li>
                        <a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
                         About us
                        </a>
                    </li>

                    <li>
                        <a href="./login" target="_blank">
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
                                  <span class="caret">  {{ Auth::user()->fname }} </span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
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

