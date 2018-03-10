@extends('search.search-layout')

@section('title', 'Users')

@section('card')

<div class="container">
  <div class="card">
    <div class="card-header panel-header">
      <div class="row">
        <div class="col-7">
          <h5>Users</h5>
        </div>
        <div class="col-5">
          <div class="dropdown panel-button">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sort by
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Best results</a>
            </div>
          </div>
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
