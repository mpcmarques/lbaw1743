<nav id="header" class="navbar navbar-expand-md navbar-dark bg-dark">
	<a class="navbar-brand" href="/">
		<img class="company-icon" src="img/logo.png" alt="Plenum" width="40" height="40"/>
	</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"/>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto mt-2 mt-md-0">
			<li class="nav-item">
				<a class="nav-link" href="dashboard">Dashboard</a>
			</li>
			<li>
			</ul>

			{{-- search input --}}
			@include('layouts.search-input', ['name' => 'navbar-search'])

			<div class="buttons text-center">
				<button class="btn btn-outline-terciary my-2 my-sm-0" data-toggle="modal" data-target="#signup-modal">
					Register
				</button>
				<button class="btn btn-outline-primary my-2 my-sm-0"  data-toggle="modal" data-target="#signin-modal">
					Login
				</button>
			</div>
		</div>
	</nav>

	<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center bg-primary">
					<h4 class="modal-title w-100 font-weight-bold">Login</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body mx-3">
					<div class="md-form mb-3">
						<label data-error="wrong" data-success="right" for="defaultForm-email">Username / Email</label>
						<input type="email" id="defaultForm-email" class="form-control validate">
					</div>

					<div class="md-form mb-3">
						<label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
						<input type="password" id="defaultForm-pass" class="form-control validate">
						<small><a id="forgotPassword" href="forgot_password.php">Forgot Password?</a></small>
					</div>

				</div>
				<div class="buttons text-center">
						<button type="submit" class="btn btn-primary">Login</button>
				</div>

				<div class="modal-footer d-flex justify-content-center">
					<div class="buttons">
						<button class="btn facebook">
							<img src="img/facebook.svg" alt="facebook" width="25">
							Facebook
						</button>
						<button class="btn google">
							<img src="img/google.png" alt="google" width="30">
							Google+
						</button>
					</div>
				</div>


			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header text-center bg-primary">
					<h4 class="modal-title w-100 font-weight-bold">Register</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row required">
						<label for="inputName" class="col-sm-4 col-form-label">Full Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Full Name" required>
						</div>
					</div>
					<div class="form-group row required">
						<label for="inputUsername" class="col-sm-4 col-form-label">Username</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Username" required>
						</div>
					</div>
					<div class="form-group row required">
						<label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
						<div class="col-sm-8">
							<input type="email" class="form-control" placeholder="Email" required>
						</div>
					</div>
					<div class="form-group row required">
						<label for="inputPassword" class="col-sm-4 col-form-label">Password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control validate" placeholder="password" required>
						</div>
					</div>
					<div class="form-group row required">
						<label for="inputRepeatPassword" class="col-sm-4 col-form-label">Repeat Password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control validate" placeholder="password" required>
						</div>
					</div>
					<!--  Gender -->
					<div class="form-group row">
						<label for="inputInstCompany" class="col-sm-4 col-form-label">Institucion / Company</label>
						<div class="col-sm-8">
							<input type="text" class="form-control validate" placeholder="Institucion / Company">
						</div>
					</div>
					<div class="form-group row required">
						<label for="inputInstCompany" class="col-sm-4 col-form-label">Birthday</label>
						<div class="col-sm-8">
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
						<button type="submit" class="btn btn-primary">Register</button>
					</ul>
				</div>
			</div>
		</div>
	</div>

</div>
