@extends('project.project-layout')

@section('title', 'Members')

@section('card-header')

<div class="row">
  <div class="col-md-8">
    <h5>Members</h5>
  </div>
  <div class="col-md-4">
    <div class="float-right">
      <form>
        <div class="form-group">
          <select class="form-control slct-primary" id="sel_filter">
            <option class="slct-primary">Show all</option>
            <option class="slct-primary">Show only Managers</option>
            <option class="slct-primary">Show only Members</option>
          </select>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('card-body')

<div class="nopadding">
  <table class="table">
    <thead>
      <tr>
        <th scope="col-3">
        </th>
        <th scope="col-3">
          <div class="text-left font-weight-bold">
            Username
          </div>
        </th>
        <th scope="col-3">
          <div class="text-left font-weight-bold">
            Name
          </div>
        </th>
        <th scope="col-3">
          <div class="text-left font-weight-bold">
            Role
          </div>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <img src="{{ asset('img/profile_pic.png')}}" class="img-round img-center thumbnail-small" alt="Profile Picture">
        </th>
        <td>
          <div class="text-left">
            jotapsa
          </div>
        </td>
        <td>
          <div class="text-left">
            João Sá
          </div>
        </td>
        <td>
          <div class="text-left">
            Member
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <img src="{{ asset('img/profile_pic.png')}}" class="img-round img-center thumbnail-small" alt="Profile Picture">
        </th>
        <td>
          <div class="text-left">
            mpcm
          </div>
        </td>
        <td>
          <div class="text-left">
            Mateus Pedroza
          </div>
        </td>
        <td>
          <div class="text-left">
            Member
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
