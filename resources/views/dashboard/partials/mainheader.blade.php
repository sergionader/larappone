
    <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>L</b>App<b>One</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Lar</b>App<b>One</b></span>
      </a>
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- <li>
                <a>
                <b>Records:</b> </a>
            </li> -->
              <li><a href="http://thedevproject.info/site/blog/" target="_blank">Blog</a></li>
              <!-- Authentication Links -->
     
              @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
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
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
              @endif  
            <li>
              <a href="#" id="controleSideBar" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
            
          </ul> 
          <span 
          </span>
        </div>
      </nav>
    </header>
  
  