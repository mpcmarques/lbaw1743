<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="/">
    <img  src="{{ asset('img/logo.png') }}" alt="Plenum" width="40" height="40"/>
  </a>

  @if(Auth::check())
  <div class="nav-item dropdown text-right">
    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
      Logged as
      <span class="text-link">{{Auth::user()->username}}</span>
    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="{{ url('/admin/logout') }}">Logout</a>
    </div>
  </div>

  @endif
</nav>
