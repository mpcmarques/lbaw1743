
<link rel="stylesheet" type="text/css" href="templates/common/navbar/navbar.css"/>
<link rel="stylesheet" type="text/css" href="templates/common/navbar/modal.css"/>

<!-- navbar -->
<nav id="header" class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="home.php">
			<img class="company-icon" src="images/logo.png" alt="Plenum" width="30" height="30"/>
		</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"/>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="dashboard_my_projects.php">Dashboard</a>
			</li>
			<li>
			</ul>
		</div>
		<!-- search input -->
		{include file="templates/common/navbar/navbar_search_input.tpl"}

		<div class="nav-item dropdown">
			<a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
				Authentification
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#login-modal">Sign In</a>
				<a class="dropdown-item" href="#">Sign Up</a>
			</div>
		</div>
	</nav>

	<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Sign In</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix grey-text"></i>
										  <label data-error="wrong" data-success="right" for="defaultForm-email">Username / Email</label>
                    <input type="email" id="defaultForm-email" class="form-control validate">
                </div>

                <div class="md-form mb-4">
                    <i class="fa fa-lock prefix grey-text"></i>
										<label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
                    <input type="password" id="defaultForm-pass" class="form-control validate">
                </div>

            </div>
						<ul class="nav nav-pills justify-content-start">
			        <li class="nav-item">
			          <a class="nav-link" href="#">Sign up</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link active" href="#">Sign in</a>
			        </li>
			      </ul>
            <div class="modal-footer d-flex justify-content-center">
							<h5 class="modal-title w-100 font-weight-bold">Sign in with</h5>
            </div>
        </div>
    </div>
</div>
