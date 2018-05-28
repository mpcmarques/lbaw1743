<div class="container admin-login">
    <div class="card">
        <div class="card-header bg-primary">
            <h4 class="text-center">
                Administration Area
            </h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('/admin/login') }}">
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
    </div>

</div>
