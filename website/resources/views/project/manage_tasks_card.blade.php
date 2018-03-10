@extends('project.project-layout')

@section('title', 'Manage Tasks')

@section('card-header')

<div class="row">
  <div class="col-6">
    <h5>Manage tasks</h5>
  </div>
  <div class="col-6">
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

<table class="table">
  <thead>
    <tr>
      <th scope="col-3">
        <p class="text-left font-weight-bold">Name</p>
      </th>
      <th scope="col-3">
        <p class="text-left font-weight-bold">Members assigned</p>
      </th>
      <th scope="col-3">
        <p class="text-left font-weight-bold">Status</p>
      </th>
      <th scope="col-3">
        <p class="text-left font-weight-bold">Close request</p>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">
        <p class"text-left">UI Design</p>
      </th>
      <td>
        <p class="text-left">11</p>
      </td>
      <td>
        <p class="text-left">Assigned</p>
      </td>
      <td>
        <p class="text-left">No</p>
      </td>
    </tr>
  </tbody>
</table>

@endsection

<div class="card-footer">
  <ul class="nav nav-pills justify-content-end">
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="octicon octicon-pencil"/>
        Edit
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="octicon octicon-trashcan"/>
        Remove
      </a>
    </li>
  </ul>
</div>
