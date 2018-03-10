@extends('dashboard.dashboard-layout')

@section('title', 'Dashboard')

@section('card-header')
<div class="grid">
  <div class="row">
    <div class="col-7">
      <h5 class="panel-title">Dashboard</h5>
    </div>
    <div class="col-5">
      <div class="dropdown panel-button">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sort by
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Most recent</a>
          <a class="dropdown-item" href="#">Oldest</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('card-body')
<div class="media">
  <img class="align-self-center mr-1"src="img/task-placeholder.svg" alt="Dashboard Image">
  <div class="media-body">
    <p class="description">
      @mateus created task #133 - Finish Design on project Manager.
    </p>
  </div>
</div>
<div class="media">
  <img class="align-self-center mr-1" src="img/task-placeholder.svg" alt="Dashboard Image">
  <div class="media-body">
    <p class="description">
      New people invited to project Project name.
    </p>
    <small class="description-footer">
      @mateus @joao were added to project Project name as members.
    </small>
  </div>
</div>
<div class="media">
  <img class="align-self-center mr-1" src="img/task-placeholder.svg" alt="Dashboard Image">
  <div class="media-body">
    <p class="description">
      @mateus closed task #923 - Do this on project Project 2.
    </p>
  </div>
</div>
@endsection
