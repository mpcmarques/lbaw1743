@extends('dashboard.dashboard-layout')

@section('title', 'My Projects')

@section('card-header')
<div class="row">
  <div class="col-4">
    <h5 class="panel-title">My Projects</h5>
  </div>
  <div class="col-4">
    <nav class="nav nav-pills">
      <a class="nav-link active" href="#">Last seen</a>
      <a class="nav-link" href="#">All</a>
    </nav>
  </div>
  <div class="col-4">
    <form>
      <div class="input-group">
        <input class="form-control navbar-search-input" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <span class="octicon octicon-search"/>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('card-body')
  <button type="button" class="btn btn-outline-light btn-block create_new_project">+ create new project</button>
  @include('layouts.project_card')
@endsection
