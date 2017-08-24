
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top" style="height:90px;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
           <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="./"><img src="{{asset('img/healthexpress.png')}}" width="140" height="70" style="margin-top:-20px"></a></a>
            </div>

            <!-- Collect <th></th>e nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="height:200px;">
                <ul class="nav navbar-nav navbar-right" id="linkss">
                    <li>
                        <a class="page-scroll" href="#help" style="color:white"><img src="{{asset('img/help.png')}}" width="20" height="15"></img> Help</a>
                    </li>
            @if(Auth::guest())
                    <li>
                        <a class="page-scroll" href="#howitworks" style="color:white">How it Works</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about" style="color:white">About Us</a>
                    </li>
                    <li><a class="page-scroll" href="./login" style="color:white">Login</a></li>
                     <li><a class="page-scroll" href="./register" style="color:white">Register</a></li>
            @else

               <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
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
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>