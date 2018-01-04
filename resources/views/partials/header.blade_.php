<nav class="navbar navbar-inverse bg-inverse">
    
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">        
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a href="{{ route('visits.index') }}" class="navbar-brand">LApp</a>
        </div>       
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">     
                <li><a href="{{route('project.index')}}">The Project</a></li>
                <li><a href="{{route('db.index')}}">DB & Data</a></li>
                <li><a href="{{route('technicalnotes.index')}}">Technical Notes</a></li>
                <li><a href="{{route('tests.index')}}">Tests</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    API <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('api.index')}}">Intro, Postman & Authentication</a></li>
                        <li><a href="{{route('api.doc')}}">Documentation</a></li>
                        <li><a href="{{route('tests.index')}}">Tests</a></li>
                    </ul>
                </li>
                <li><a href="{{route('charts.index')}}">Charts</a></li>  
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('app.index')}}">App</a></li>  
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
            </ul>        
        </div>
    </div>
</nav>