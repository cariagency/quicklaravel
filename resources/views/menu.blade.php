<ul class="navbar-nav mr-auto"></ul>

<ul class="navbar-nav">
    @section('user-menu')
    @guest
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-user"></i> @lang("Login")</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-sign-in"></i> @lang("Register")</a>
    </li>
    @else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a  class="dropdown-item" href="{{ route('users.profile') }}"><i class="fa fa-user"></i> @lang("Profile")</a>

            @if(isAdmin())
            <a  class="dropdown-item" href="{{ route('users.index') }}"><i class="fa fa-users"></i> @lang("Users")</a>
            @endif

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> @lang("Logout")</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
    </li>
    @endguest
    @show
</ul>
