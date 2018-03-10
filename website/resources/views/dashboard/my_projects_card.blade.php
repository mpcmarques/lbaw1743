@extends('dashboard')

@section('title', 'My Projects')

@section('card-header')
<div class="row">
  <div class="col-4">
    <h5 class="panel-title">My Projects</h5>
  </div>
  <div class="col-4">
    <ul class="nav nav-pills panel-button">
      <li class="nav-item">
        <a class="nav-link active" href="#">Last seen</a>
      </li>
      <li class="nav-item panel-button">
        <a class="nav-link" href="#">All</a>
      </li>
    </ul>
  </div>
  <div class="col-4">
    <form>
      <div class="form-group text-right panel-button">
        <input type="text" class="form-control" name="search" placeholder="Search">
      </div>
    </form>
  </div>
</div>
@endsection

@section('card-body')
  @include('layouts.project_card')
@endsection
