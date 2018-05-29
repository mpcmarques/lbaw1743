@extends('admin.admin-layout')

@section('title', 'Administration Users')

@section('card-header')

<div class="row">
  <div class="col-5">
    <h5 class="card-title">Users</h5>
  </div>
  <div class="col-7">
    <form method="POST" action="{{ url('/admin/users') }}">
      {{ csrf_field() }}
      <div class="input-group">
        <input class="form-control" type="search"
        placeholder="Search" aria-label="Search"
        name="search-user" value="{{ old('search-user') }}">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <span class="octicon octicon-search"></span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section('card-body')
<form method="POST" id="manageUsers">
  {{ csrf_field() }}
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
            <th scope="col">Last Session</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>
              <div class="text-center">
                @include('layouts.checkbox-input', ['name' => 'user'.$user->iduser])
              </div>
            </td>
            <td>{{$user->iduser}}</td>
            <td>
              <a href="{{ url('profile/'.$user->iduser) }}">{{$user->username}}</a>
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>01/03/2018</td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</form>
@endsection

@section('card-footer')
<!-- <button type="button" class="btn btn-terciary btn-block more">...</button> -->
<div class="card-footer">
  <div class="float-right">
    <button type="submit" class="btn btn-terciary" form="manageUsers" formaction="{{ url('/admin/users/promote') }}">
      <span class="octicon octicon-octoface"></span>
      Promote
    </button>
    <button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="#banUsersModal">
      <span class="octicon octicon-circle-slash"></span>
      Ban
    </button>
    <button type="submit" class="btn btn-primary" form="manageUsers" formaction="{{ url('/admin/users/remove') }}">
      <span class="octicon octicon-trashcan"></span>
      Remove
    </button>
  </div>

  <div class="modal fade" id="banUsersModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Ban Users</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6>Motive</h6>
          <textarea id="motive" name="motive" rows="3" form="manageUsers" required class="form-control"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" form="manageUsers" formaction="{{ url('/admin/users/ban') }}">Ban</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
