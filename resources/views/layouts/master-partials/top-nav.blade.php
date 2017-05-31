<nav class="navbar navbar-custom-with-shadow navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand big-logo" href="/">EVERCODE 1</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
            @if(! Auth::check())

                <li><a href="/register" ><span class="glyphicon glyphicon-user"></span> &nbsp; Sign Up</a></li>
                <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Login</a></li>
                <li><a href="/auth/facebook">fb</a></li>

                @else

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">

                        <li><a href="/determine-profile-route">Profile</a></li>
                        <li><a href="/settings">Settings</a></li>
                        <li>
                            <a href="/auth/facebook">
                                <i class="fa fa-facebook"></i>&nbsp;&nbsp; Sync </a>
                        </li>
                        <li><a href="/auth/github">
                                <i class="fa fa-github"></i>
                                &nbsp;&nbsp; Github Sync </a>
                        </li>

                        <li>
                            <a href="/logout"
                               onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>


            @endif
        </ul>
        <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
        </form>
    </div>


</nav>