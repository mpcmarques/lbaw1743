
<link rel="stylesheet" type="text/css" href="templates/common/navbar/navbar.css"/>

<!-- navbar -->
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="#">
			<img class="company-icon" src="images/logo.png" alt="Plenum" width="30" height="30"/>
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"/>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="home.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about.php">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="faq.php">FAQ</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="dashboard.php">Dashboard</a>
				</li>
				<li>
			</ul>

			<!-- search input -->
			{include file="templates/common/navbar/navbar_search_input.tpl"}

			<div class="nav-item dropdown">
				<a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
					Authentification
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#">Sign In</a>
					<a class="dropdown-item" href="#">Sign Up</a>
				</div>
			</div>
		</nav>