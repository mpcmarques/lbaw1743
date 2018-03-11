@extends('admin.admin-layout')

@section('title', 'Administration Projects')

@section('card-header')
<div class="row">
  <div class="col-5">
    <h5 class="card-title">Projects</h5>
  </div>
  <div class="col-7">
    <form>
      <div class="input-group">
        <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search">
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
<div class="card-body p-0 m-0">
  <table class="table pb-0 mb-0">
    <thead>
      <tr>
        <th scope="col-1">
          <p class="text-left font-weight-bold">ID</p>
        </th>
        <th scope="col-4">
          <p class="text-left font-weight-bold">Name</p>
        </th>
        <th scope="col-4">
          <p class="text-left font-weight-bold">Owner</p>
        </th>
        <th scope="col-4">
          <p class="text-left font-weight-bold">Members</p>
        </th>
        <th scope="col-3">
          <p class="text-left font-weight-bold">Tasks</p>
        </th>
        <th scope="col-3">
          <p class="text-left font-weight-bold">Created at</p>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <p class"text-left">1</p>
        </th>
        <td>
          <p class="text-left">Atom</p>
        </td>
        <td>
          <p class="text-left">@mpcm</p>
        </td>
        <td>
          <p class="text-left">22</p>
        </td>
        <td>
          <p class="text-left">177</p>
        </td>
        <td>
          <p class="text-left">01/02/2018</p>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <p class"text-left">2</p>
        </th>
        <td>
          <p class="text-left">Yarn</p>
        </td>
        <td>
          <p class="text-left">@jotapsa</p>
        </td>
        <td>
          <p class="text-left">5</p>
        </td>
        <td>
          <p class="text-left">58</p>
        </td>
        <td>
          <p class="text-left">20/01/2018</p>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<button type="button" class="btn btn-terciary btn-block m-0 p-0">...</button>
@endsection

@section('card-footer')
<div class="card-footer">
  <ul class="nav nav-pills justify-content-end">
    <li class="nav-item">
      <button class="btn btn-secondary">
        <span class="octicon octicon-pencil"/>
        Edit
      </button>
    </li>
    <li class="nav-item">
      <button  class="btn btn-primary">
        <span class="octicon octicon-trashcan"/>
        Remove
      </button>
    </li>
  </ul>
</div>
@endsection


<!--
<div class="container projects-card">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-4">
          <h5 class="card-title">Projects</h5>
        </div>
        <div class="col-8">
          <form>
            <div class="input-group">
              <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <span class="octicon octicon-search"/>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="card-body p-0 m-0">
      <table class="table pb-0 mb-0">
        <thead>
          <tr>
            <th scope="col-1">
              <p class="text-left font-weight-bold">ID</p>
            </th>
            <th scope="col-4">
              <p class="text-left font-weight-bold">Name</p>
            </th>
            <th scope="col-4">
              <p class="text-left font-weight-bold">Owner</p>
            </th>
            <th scope="col-4">
              <p class="text-left font-weight-bold">Members</p>
            </th>
            <th scope="col-3">
              <p class="text-left font-weight-bold">Tasks</p>
            </th>
            <th scope="col-3">
              <p class="text-left font-weight-bold">Created at</p>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">
              <p class"text-left">1</p>
            </th>
            <td>
              <p class="text-left">Atom</p>
            </td>
            <td>
              <p class="text-left">@mpcm</p>
            </td>
            <td>
              <p class="text-left">22</p>
            </td>
            <td>
              <p class="text-left">177</p>
            </td>
            <td>
              <p class="text-left">01/02/2018</p>
            </td>
          </tr>
          <tr>
            <th scope="row">
              <p class"text-left">2</p>
            </th>
            <td>
              <p class="text-left">Yarn</p>
            </td>
            <td>
              <p class="text-left">@jotapsa</p>
            </td>
            <td>
              <p class="text-left">5</p>
            </td>
            <td>
              <p class="text-left">58</p>
            </td>
            <td>
              <p class="text-left">20/01/2018</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <button type="button" class="btn btn-terciary btn-block m-0 p-0">...</button>
    <div class="card-footer">
      <ul class="nav nav-pills justify-content-end">
        <li class="nav-item">
          <button class="btn btn-secondary">
            <span class="octicon octicon-pencil"/>
            Edit
          </button>
        </li>
        <li class="nav-item">
          <button  class="btn btn-primary">
            <span class="octicon octicon-trashcan"/>
            Remove
          </button>
        </li>
      </ul>
    </div>
  </div>
</div> -->
