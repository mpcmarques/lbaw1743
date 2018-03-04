
<link rel="stylesheet" type="text/css" href="templates/admin/admin.css"/>

{* if user is logged in*}
<!-- navbar -->
	<nav class="navbar navbar-expand-md navbar-white bg-white">
		<a class="navbar-brand" href="#">
			<img class="company-icon" src="images/logo.png" alt="Plenum" width="30" height="30"/>
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"/>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="admin.php">Administration</a>
				</li>
			</ul>

		<div class="nav-item dropdown">
			<a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
				@mpcm
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="#">Logout</a>
			</div>
		</div>
	</nav>

	{* if user is not logged in*}
