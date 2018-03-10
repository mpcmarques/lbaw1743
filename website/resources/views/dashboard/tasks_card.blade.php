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
<div class="my-tasks-card no-padding">
  <ul id="tasks-nav-pills" class="nav nav-pills justify-content-end bg-primary">
    <li class="nav-item">
      <a class="nav-link active " href="#">Assigned</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Unassigned</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Completed</a>
    </li>
  </ul>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col-1">
            <p class="text-left font-weight-bold">#</p>
          </th>
          <th scope="col-4">
            <p class="text-left font-weight-bold">Task Name</p>
          </th>
          <th scope="col-4">
            <p class="text-left font-weight-bold">Category</p>
          </th>
          <th scope="col-3">
            <p class="text-left font-weight-bold">Project</p>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">
            <p class"text-left">123</p>
          </th>
          <td>
            <p class="text-left">Bug Correction</p>
          </td>
          <td>
            <p class="text-left">Bug fix</p>
          </td>
          <td>
            <p class="text-left">Project name</p>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <p class"text-left">142</p>
          </th>
          <td>
            <p class="text-left">UI Improvement</p>
          </td>
          <td>
            <p class="text-left">Design</p>
          </td>
          <td>
            <p class="text-left">Project name</p>
          </td>
        </tr>
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
