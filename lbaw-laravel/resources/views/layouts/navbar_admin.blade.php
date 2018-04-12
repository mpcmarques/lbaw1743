<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="/admin">
  <img  src="{{ asset('img/logo.png') }}" alt="Plenum" width="40" height="40"/>
  Administration
  </a>
  <!-- if logged in -->
  <div class="nav-item dropdown text-right">
			<a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
        Logged in as
        <span class="text-link" href="#">@admin</span>
			</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="/admin">Logout</a>
			</div>
	</div>
</nav>
