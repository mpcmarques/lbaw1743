@extends('dashboard.dashboard-layout')

@section('title', 'Tasks')

@section('card-header')
<div class="row">
  <div class="col-md-6">
    <h5>My Tasks</h5>
  </div>
  <div class="col-md-6">
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
<div class="tasks-card nopadding">
  <div class="container-fluid">
    <div class="row bg-primary">
      <div class="col-md-12">
        <div class="float-right">
          <div class="nav nav-pills">
            <a class="nav-link active" href="#">Assigned</a>
            <a class="nav-link" href="#">Unassigned</a>
            <a class="nav-link" href="#">Completed</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col-1">
            #
          </th>
          <th scope="col-4">
            Task Name
          </th>
          <th scope="col-4">
            Category
          </th>
          <th scope="col-3">
            Project
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($user->tasks as $task)

        <tr>
          <th scope="row">
            <p class"text-left">{{$task->idtask}}</p>
          </th>
          <td>
            <p class="text-left">{{$task->title}}</p>
          </td>
          <td>
            <p class="text-left">{{$task->description}}</p>
          </td>
          <td>
            <p class="text-left">{{$task->project->name}}</p>
          </td>
        </tr>
        @endforeach
        
      </tbody>
    </table>
  </div>
  <button type="button" class="btn btn-white btn-block m-0 p-0">...</button>
</div>
@endsection

@section('card-footer')

<div class="card-footer">
  <small>
    last task activity <span class="text-link">task name</span>, 2 days ago.
  </small>
</div>

@endsection
