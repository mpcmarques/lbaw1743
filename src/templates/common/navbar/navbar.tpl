
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
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#signin-modal">Sign In</a>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#signup-modal">Sign Up</a>
			</div>
		</div>
	</nav>

	<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
			<div class="modal-content">
					<div class="modal-header text-center">
							<h4 class="modal-title w-100 font-weight-bold">Sign Up</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<div class="modal-body mx-3">
							<div class="md-form mb-5">
									<i class="fa fa-envelope prefix grey-text"></i>
										<label data-error="wrong" data-success="right" for="defaultForm-email">Full Name</label>
									<input type="text" class="form-control validate" required>
							</div>
							<div class="md-form mb-5">
									<i class="fa fa-envelope prefix grey-text"></i>
										<label data-error="wrong" data-success="right" for="defaultForm-email">Username</label>
									<input type="text" class="form-control validate" required>
							</div>
							<div class="md-form mb-5">
									<i class="fa fa-envelope prefix grey-text"></i>
										<label data-error="wrong" data-success="right" for="defaultForm-email">Email</label>
									<input type="email" class="form-control validate" required>
							</div>
							<div class="md-form mb-5">
									<i class="fa fa-envelope prefix grey-text"></i>
										<label data-error="wrong" data-success="right" for="defaultForm-email">Password</label>
									<input type="password" class="form-control validate" required>
							</div>
							<div class="md-form mb-5">
									<i class="fa fa-envelope prefix grey-text"></i>
										<label data-error="wrong" data-success="right" for="defaultForm-email">Repeat Password</label>
									<input type="password" class="form-control validate" required>
							</div>
							<!--  Gender -->
							<div class="md-form mb-5">
									<i class="fa fa-envelope prefix grey-text"></i>
										<label data-error="wrong" data-success="right" for="defaultForm-email">Institucion / Company</label>
									<input type="text" class="form-control validate">
							</div>
							<div class="md-form mb-5">
									<i class="fa fa-envelope prefix grey-text"></i>
										<label data-error="wrong" data-success="right" for="defaultForm-email">Birthday</label>
									<input type="date" class="form-control validate" required>
							</div>
					</div>
					<div class="modal-footer d-flex justify-content-center">
						<label class="form-check-label" for="exampleCheck1">I read and agreed with the Terms of Service and the Privacy Policy</label>
						<ul class="nav nav-pills justify-content-start">
			        <li class="nav-item">
			         <button type="submit" class="btn btn-primary">Sign Up</button>
			        </li>
			      </ul>
					</div>
			</div>
	</div>
</div>
