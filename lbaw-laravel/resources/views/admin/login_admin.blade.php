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
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="form-control"  placeholder="Email" required>

                    @if ($errors->has('email'))
                    <div class="card text-white bg-danger">
                        <div class="card-header">{{ $errors->first('email') }}</div>
                    </div>
                    @endif

                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                    @if ($errors->has('password'))
                        <div class="card text-white bg-danger">
                            <div class="card-header">{{ $errors->first('password') }}</div>
                        </div>
                    @endif
                </div>

                <div class="nav-item">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>

</div>
