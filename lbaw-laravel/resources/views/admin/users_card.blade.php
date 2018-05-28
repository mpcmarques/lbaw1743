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
            <td scope="row">
              <div class="text-center">
                @include('layouts.checkbox-input', ['name' => 'user'.$user->iduser])
              </div>
            </td>
            <td>{{$user->iduser}}</td>
            <td>
              <a href="{{ url('profile/'.$user->iduser) }}">{{$user->username}}</a>
            </td>
            <td>{{$user->name}}</th>
              <td>{{$user->email}}</th>
                <td>01/03/2018</th>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </form>
      @endsection

      @section('card-footer')
      <button type="button" class="btn btn-terciary btn-block more">...</button>
      <div class="card-footer">
        <div class="float-right">
          <button type="submit" class="btn btn-terciary" form="manageUsers" formaction="{{ url('/admin/users/promote') }}">
            <span class="octicon octicon-octoface"></span>
            Promote
          </button>
          <button type="submit" class="btn btn-secondary" form="manageUsers" formaction="{{ url('/admin/users/ban') }}">
            <span class="octicon octicon-circle-slash"></span>
            Ban
          </button>
          <button type="submit" class="btn btn-primary" form="manageUsers" formaction="{{ url('/admin/users/remove') }}">
            <span class="octicon octicon-trashcan"></span>
            Remove
          </button>
        </div>
      </div>
      @endsection
