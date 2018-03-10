@extends('search.search-layout')

@section('title', 'Users')

@section('card-header')
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
@endsection

@section('card-body')
<div class="row">
  <div class="col">
    <a href="#">
      <div class="card">
        <img src="{{ asset('img/profile_pic.png')}}" class="card-img-top" alt="Profile Picture">
        <div class="card-body">
          <h5 class="card-title text-center">Name Lastname</h5>
        </div>
      </div>
    </a>
  </div>
  <div class="col">
    <a href="#">
      <div class="card">
        <img src="{{ asset('img/profile_pic.png')}}" class="card-img-top" alt="Profile Picture">
        <div class="card-body">
          <h5 class="card-title text-center">Name Lastname</h5>
        </div>
      </div>
    </a>
  </div>
  <div class="col">
    <a href="#">
      <div class="card">
        <img src="{{ asset('img/profile_pic.png')}}" class="card-img-top" alt="Profile Picture">
        <div class="card-body">
          <h5 class="card-title text-center">Name Lastname</h5>
        </div>
      </div>
    </a>
  </div>
</div>
@endsection
