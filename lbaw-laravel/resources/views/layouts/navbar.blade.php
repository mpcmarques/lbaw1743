<nav id="header" class="navbar navbar-expand-md navbar-dark bg-dark">
	<a class="navbar-brand" href="{{ url('/') }}">
		<img class="company-icon" src="{{ asset('img/logo.png')}}" alt="Plenum" width="40" height="40"/>
	</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto mt-2 mt-md-0">
			<li class="nav-item">
				<a class="nav-link" href="{{ url('dashboard') }}">Dashboard</a>
			</li>

			@if(Auth::check())
			<li class="nav-item">
				<a class="nav-link" href="{{ url('/profile/'.Auth::user()->iduser) }}">Profile</a>
			</li>
			@endif
		</ul>

		{{-- search input --}}
		<div class="navbar-search">
			<form class="form-inline" method="POST" action="{{ route('/search') }}">
				{{ csrf_field() }}

				<div class="input-group">
					<input id="search-text"
					name="search-text"
					class="form-control input"
					type="search"
					placeholder="Search"
					aria-label="Search"
					value="{{ old('search-text') }}"
					>
					<div class="input-group-append">
						<button type="submit" class="btn input-button">
							<span class="octicon octicon-search"></span>
						</button>
					</div>
				</div>
			</form>
		</div>

		{{-- buttons --}}
		<div class="buttons">

			@if(!Auth::check())
			<button class="btn btn-outline-terciary my-2 my-sm-0" data-toggle="modal" data-target="#signup-modal">
				Register
			</button>
			<button class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#signin-modal">
				Login
			</button>

			@else

			<div class="nav-item dropdown text-right">
				<img class="img-round dropdown-toggle" data-toggle="dropdown" src="{{ Auth::user()->getPicture() }}" alt="Profile Picture" width="40" height="40">
		      <div class="dropdown-menu dropdown-menu-right">
		        <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
		      </div>
		  </div>

			<a class="logout" href="{{ url('/logout') }}">
				<button class="btn btn-outline-primary my-2 my-sm-0">
					Logout
				</button>
			</a>
			@endif

		</div>
	</div>
</nav>


@if(!Auth::check())

{{-- Show login when $login is not empty and true --}}
@if( ! empty($login) && $login)

<script type="text/javascript">
	$(document).ready(function() {
		$("#signin-modal").modal({show: true});
	});
</script>

@endif

<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-center bg-primary">
				<h4 class="modal-title w-100 font-weight-bold">Login</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body mx-3">

				<form method="POST" action="{{ route('login') }}">
					{{ csrf_field() }}

					<div class="form-group">
						<label>Email</label>

						@include('layouts.validation-input', ['name' => 'email', 'type' => 'email'])

					</div>

					<div class="form-group">
						<label>Password</label>

						@include('layouts.validation-input', ['name' => 'password', 'type' => 'password'])

					</div>

					<div class="nav-item">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>

			</div>

			<div class="modal-footer justify-content-center">
				<div class="buttons text-center">
					<button class="btn facebook">
						<img src="{{ asset('img/facebook.svg') }}" alt="facebook" width="30">
						Facebook
					</button>
					<button class="btn google">
						<img src="{{ asset('img/google.png') }}" alt="google" width="30">
						Google+
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Show login when $login is not empty and true --}}
@if( ! empty($showRegisterModal) && $showRegisterModal)

<script type="text/javascript">
	$(document).ready(function() {
		$("#signup-modal").modal({show: true});
	});
</script>

@endif

<div class="modal fade bd-example-modal-lg" id="signup-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header text-center bg-primary">
				<h4 class="modal-title w-100 font-weight-bold">Register</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<form method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}

					<div class="form-group row required">
						<label class="col-sm-4 col-form-label">Full Name</label>
						<div class="col-sm-8">

							@include('layouts.validation-input', ['name' => 'name'])

						</div>
					</div>

					<div class="form-group row required">
						<label class="col-sm-4 col-form-label">Username</label>
						<div class="col-sm-8">

							@include('layouts.validation-input', ['name' => 'username'])

						</div>

					</div>

					<div class="form-group row required">
						<label class="col-sm-4 col-form-label">Email</label>
						<div class="col-sm-8">

							@include('layouts.validation-input', ['name' => 'email', 'type' => 'email'])

						</div>

					</div>

					<div class="form-group row required">
						<label class="col-sm-4 col-form-label">Password</label>
						<div class="col-sm-8">

							@include('layouts.validation-input', ['name' => 'password', 'type' => 'password'])

						</div>

					</div>

					<div class="form-group row required">
						<label class="col-sm-4 col-form-label">Repeat Password</label>
						<div class="col-sm-8">
							@include('layouts.validation-input', ['name' => 'password_confirmation', 'type' => 'password'])
						</div>
					</div>

					<fieldset class="form-group row">
              <label class="col-sm-4 col-form-label">Gender</label>
							<div class="radioGender">
								<label class="radio-inline"><input type="radio" name="gender" id="gender" value="Male" checked>Male</label>
								<label class="radio-inline"><input type="radio" name="gender" id="gender" value="Female">Female</label>
							</div>
          </fieldset>

					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Institution / Company</label>
						<div class="col-sm-8">
							<input id="institution_company" name="institution_company" class="form-control"></input>
						</div>
					</div>


					<div class="form-group row required">
						<label class="col-sm-4 col-form-label">Birthday</label>
						<div class="col-sm-8">
							@include('layouts.validation-input', ['name' => 'birthdate', 'type' => 'date'])
						</div>
					</div>

					<div class="modal-footer d-flex justify-content-end">
						<div class="form-check">

							@if (isset($errors) && $errors->has('checkbox'))

							<input id="checkbox" name="checkbox" class="form-check-input is-invalid" type="checkbox">

							<span class="invalid-feedback">
								{{ $errors->first('checkbox') }}
							</span>

							@else

							<input id="checkbox" name="checkbox" class="form-check-input" type="checkbox">

							@endif

							<label class="form-check-label">
								I read and agreed with the Terms of Service and the Privacy Policy
							</label>

						</div>
						<button type="submit" class="btn btn-primary">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>

@endif
