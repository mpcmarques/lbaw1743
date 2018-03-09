@extends('layouts.dashboard')

@section('title', 'Tasks')

@section('card')
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-6">
          <h5>My Tasks</h5>
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
      <ul class="nav nav-pills justify-content-end">
        <li class="nav-item">
          <a class="nav-link active " href="#">Active</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Unassigned</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Completed</a>
        </li>
      </ul>
      <table class="table pb-0 mb-0">
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
      <button type="button" class="btn btn-block btn-xs m-0 p-0">...</button>
    </div>
    <div class="card-footer mt-0 pt-0">
      <p class="text-justify">
        last task activity task name, 2 days ago.
      </p>
    </div>
  </div>
</div>

@endsection
