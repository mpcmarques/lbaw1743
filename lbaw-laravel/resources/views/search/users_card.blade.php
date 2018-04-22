@extends('search.search-layout')

@section('title', 'Users')

@section('card-header')
<div class="row">
  <div class="col-7">
    <h5 class="panel-title">Users</h5>
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


@foreach ($search_username as $user)
@include('layouts.user-card', ['user' => $user])
@endforeach

@foreach ($search_name as $user)
@include('layouts.user-card', ['user' => $user])
@endforeach

@endsection
