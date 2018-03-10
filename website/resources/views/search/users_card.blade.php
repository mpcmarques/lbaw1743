@extends('search')

@section('title', 'Users')

@section('card')

<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-6">
          <h5>Users</h5>
        </div>
        <div class="col-6">
          <form>
            <div class="form-group text-right">
              <select class="form-control" id="sel_filter">
                <option>Best match</option>
              </select>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-3">
          <a href="#">
            <div class="card">
              <img src="images/profile_pic.png" class="card-img-top" alt="Profile Picture">
              <div class="card-body">
                <h5 class="card-title text-center">Name Lastname</h5>
              </div>
            </div>
          </a>
        </div>
        <div class="col-3">
          <a href="#">
            <div class="card">
              <img src="images/profile_pic.png" class="card-img-top" alt="Profile Picture">
              <div class="card-body">
                <h5 class="card-title text-center">Name Lastname</h5>
              </div>
            </div>
          </a>
        </div>
        <div class="col-3">
          <a href="#">
            <div class="card">
              <img src="images/profile_pic.png" class="card-img-top" alt="Profile Picture">
              <div class="card-body">
                <h5 class="card-title text-center">Name Lastname</h5>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <a href="#">
            <div class="card">
              <img src="images/profile_pic.png" class="card-img-top" alt="Profile Picture">
              <div class="card-body">
                <h5 class="card-title text-center">Name Lastname</h5>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection