@extends('admin.admin-layout')

@section('title', 'Administration Users')

@section('card-header')

<div class="row">
  <div class="col-4">
    <h5 class="card-title">Users</h5>
  </div>
  <div class="col-8">
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
  <div class="card-body">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">ID</th>
        <th scope="col">Username</th>
        <th scope="col">Full Name</th>
        <th scope="col">Email</th>
        <th scope="col">Joined at</th>
        <th scope="col">Last Session</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td scope="row">
          <div class="text-center">
            <input type="checkbox" value="">
          </div>
        </td>
        <td>1</td>
        <td><span class="text-link" href="#">@mateus</span></td>
        <td>Mateus Pedroza</th>
        <td>mpcm@lbaw.com</th>
        <td>01/01/2018</th>
        <td>01/03/2018</th>
      </tr>
      <tr>
        <td scope="row">
          <div class="text-center">
            <input type="checkbox" value="">
          </div>
        </td>
        <td>2</td>
        <td><span class="text-link" href="#">@bmcb</span></td>
        <td>Bernardo Barbosa</td>
        <td>bmcb@lbaw.com</td>
        <td>05/02/2018</td>
        <td>02/03/2018</td>
      </tr>
    </tbody>
  </table>
  </div>
</div>
@endsection

@section('card-footer')
<button type="button" class="btn btn-terciary btn-block more">...</button>
<div class="card-footer">
  <div class="float-right">
    <a class="btn btn-terciary" href="#" role="button">
      <span class="octicon octicon-pencil">
        Edit
      </span></a>
    <a class="btn btn-secondary" href="#" role="button">
        <span class="octicon octicon-circle-slash">
          Ban
        </span></a>
    <a class="btn btn-primary" href="#" role="button">
          <span class="octicon octicon-trashcan">
            Remove
          </span></a>
  </div>
</div>
@endsection
