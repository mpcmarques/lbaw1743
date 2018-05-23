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
        <th scope="col">
        </th>
        <th scope="col">
          <div class="text-left font-weight-bold">
            Username
          </div>
        </th>
        <th scope="col">
          <div class="text-left font-weight-bold">
            Name
          </div>
        </th>
        <th scope="col">
          <div class="text-left font-weight-bold">
            Role
          </div>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($project->members as $member)
      <tr>
        <th scope="row">
          <img src="{{ asset('img/profile/'.$member->iduser.'.png')}}" class="img-round img-center thumbnail-small" alt="Profile Picture">
        </th>
        <td>
          <div class="text-left">
            <a href="{{ url('profile/'.$member->iduser) }}">{{$member->username}}</a>
          </div>
        </td>
        <td>
          <div class="text-left">
            {{$member->name}}
          </div>
        </td>
        <td>
          <div class="text-left">
            {{$member->pivot->role}}
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('card-footer')

<div class="card-footer">
</div>

@endsection
