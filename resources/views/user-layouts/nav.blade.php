<nav class="navbar navbar-transparent navbar-absolute">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="{{asset('img/healthexpress.png')}}" style="width:160px; height:100px; "></img></a>
          </div>
        
        <div style="background-color: white; width:100%; height:10%"><a href="#" style="float:right; color:white; margin-left:5px"><i class="material-icons">shopping_cart</i>Cart is empty</a></div>
        <br><br>


          <div class="collapse navbar-collapse" id="navigation-example">

                
            <ul class="nav navbar-nav navbar-right">

              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="material-icons">account_circle</i>Beatrice Ylaya
                                </a>
                                <ul class="dropdown-menu" role="menu">

                                 <li><a href="#">Profile</a></li>
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
                            <li><a href="#"><i class="material-icons">help</i>Help</a></li>

                          
          
            </ul>
          </div>
      </div>
    </nav>