@extends('project.project-layout')

@section('title', 'Manage Tasks')

@section('card')

<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-6">
          <h5>Manage tasks</h5>
        </div>
        <div class="col-6">
          <form>
            <div class="form-group text-right">
              <input type="text" class="form-control" name="search" placeholder="Search">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="card-body">
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
    </div>
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
  </div>
</div>

@endsection
