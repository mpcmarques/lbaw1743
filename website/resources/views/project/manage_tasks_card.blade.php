@extends('project.project-layout')

@section('title', 'Manage Tasks')

@section('card-header')

<div class="row">
  <div class="col-md-8">
    <h5>Manage tasks</h5>
  </div>
  <div class="col-md-4">
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

<div class="nopadding">
  <table class="table">
    <thead>
      <tr>
        <th scope="col-1">
        </th>
        <th scope="col-3">
          <div class="text-left font-weight-bold">
            Name
          </div>
        </th>
        <th scope="col-3">
          <div class="text-left font-weight-bold">
            Members assigned
          </div>
        </th>
        <th scope="col-3">
          <div class="text-left font-weight-bold">
            Status
          </div>
        </th>
        <th scope="col-2">
          <div class="text-left font-weight-bold">
            Close Request
          </div>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <div class="checkbox">
            <input type="checkbox" value="">
          </div>
        </th>
        <td>
          <div class="text-left">
            UI Design
          </div>
        </td>
        <td>
          <div class="text-left">
            11
          </div>
        </td>
        <td>
          <div class="text-left">
            Assigned
          </div>
        </td>
        <td>
          <div class="text-left">
            No
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>

@endsection

@section('card-footer')

<div class="card-footer">
  <div class="float-right">
    <a class="btn btn-terciary" href="#" role="button">
      <span class="octicon octicon-pencil"/>
      Edit
    </a>
    <a class="btn btn-primary" href="#" role="button">
      <span class="octicon octicon-trashcan"/>
      Remove
    </a>
  </div>
</div>

@endsection
