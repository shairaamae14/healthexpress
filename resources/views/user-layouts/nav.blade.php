  <nav class="navbar navbar-success navbar-absolute" style="background-color:transparent; box-shadow: none">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

               <a href="http://www.creative-tim.com">
           <div class="logo-container">
                <div class="logo" style="width: 165px; height:90px; border-radius: 0px; border:none">
            <a class="navbar-brand" href="/home"><img src="{{asset('img/healthexpress.png')}}" style="width:160px; height:90px;"></img></a>
           </div>
           </div>

          </div>

          <div class="collapse navbar-collapse" id="navigation-example">
             <ul class="nav navbar-nav navbar-right">
               <li><a href="#"><i class="material-icons">help</i>Help</a></li>
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
                          
                            

                          
          
            </ul>

          </div>
      </div>
    </nav>
