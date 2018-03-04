
<link rel="stylesheet" type="text/css" href="templates/common/navbar/navbar.css"/>
<link rel="stylesheet" type="text/css" href="templates/common/navbar/modal.css"/>

<!-- navbar -->
<nav id="header" class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="index.php">
			<img class="company-icon" src="images/logo.png" alt="Plenum" width="40" height="40"/>
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
										 <label data-error="wrong" data-success="right" for="defaultForm-email">Username / Email</label>
                    <input type="email" id="defaultForm-email" class="form-control validate">
                </div>

                <div class="md-form mb-4">
										<label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
                    <input type="password" id="defaultForm-pass" class="form-control validate">
										<a id="forgotPassword" href="forgot_password.php">Forgot Password?</a>
                </div>

            </div>
						<ul class="nav nav-pills justify-content-start">
			        <li class="nav-item">
			          <button type="submit" class="btn btn-secondary">Sign Up</button>
			        </li>
			        <li class="nav-item">
			          <button type="submit" class="btn btn-primary">Sign In</button>
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
							<div class="form-group row">
						    <label for="inputName" class="col-sm-2 col-form-label">Full Name</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" placeholder="Full Name" required>
						    </div>
						  </div>
							<div class="form-group row">
						    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" placeholder="Username" required>
						    </div>
						  </div>
							<div class="form-group row">
						    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
						    <div class="col-sm-10">
						      <input type="email" class="form-control" placeholder="Email" required>
						    </div>
						  </div>
							<div class="form-group row">
						    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
						    <div class="col-sm-10">
						      <input type="password" class="form-control validate" required>
						    </div>
						  </div>
							<div class="form-group row">
						    <label for="inputRepeatPassword" class="col-sm-2 col-form-label">Repeat Password</label>
						    <div class="col-sm-10">
						      <input type="password" class="form-control validate" required>
						    </div>
						  </div>
							<!--  Gender -->
							<div class="form-group row">
						    <label for="inputInstCompany" class="col-sm-2 col-form-label">Institucion / Company</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control validate" placeholder="Institucion / Company">
						    </div>
						  </div>
							<div class="form-group row">
						    <label for="inputInstCompany" class="col-sm-2 col-form-label">Birthday</label>
						    <div class="col-sm-10">
						      <input type="date" class="form-control validate" required>
						    </div>
						  </div>
							<div class="form-group">
					</div>
					<div class="modal-footer d-flex justify-content-end">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="agreeCheck">
							<label class="form-check-label" for="gridCheck">
								I read and agreed with the Terms of Service and the Privacy Policy
							</label>
						</div>
			      <button type="submit" class="btn btn-primary">Sign Up</button>
			      </ul>
					</div>
			</div>
	</div>
</div>
</div>