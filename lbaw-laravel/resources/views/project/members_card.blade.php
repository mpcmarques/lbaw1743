@extends('project.project-layout')

@section('title', 'Members')

@section('card-header')

<div class="row">
  <div class="col-md-8">
    <h5>Members</h5>
  </div>
  <div class="col-md-4">

    <div class="float-right">
        <div class="form-group">
          <select class="form-control" name="filter" onchange="location = this.value;">
            @if (strpos($_SERVER['REQUEST_URI'], 'members/manager') !== false)
            <option class="slct-primary" value="{{ url('/project/'.$project->idproject.'/members') }}">Show All</option>
            <option class="slct-primary" value="{{ url('/project/'.$project->idproject.'/members/manager') }}" selected>Show only Managers</option>
            <option class="slct-primary" value="{{ url('/project/'.$project->idproject.'/members/member') }}">Show only Members</option>
            @elseif (strpos($_SERVER['REQUEST_URI'], 'members/member') !== false)
            <option class="slct-primary" value="{{ url('/project/'.$project->idproject.'/members') }}">Show All</option>
            <option class="slct-primary" value="{{ url('/project/'.$project->idproject.'/members/manager') }}">Show only Managers</option>
            <option class="slct-primary" value="{{ url('/project/'.$project->idproject.'/members/member') }}" selected>Show only Members</option>
            @else
            <option class="slct-primary" value="{{ url('/project/'.$project->idproject.'/members') }}" selected>Show All</option>
            <option class="slct-primary" value="{{ url('/project/'.$project->idproject.'/members/manager') }}">Show only Managers</option>
            <option class="slct-primary" value="{{ url('/project/'.$project->idproject.'/members/member') }}">Show only Members</option>
            @endif
          </select>
        </div>
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
      @foreach ($members as $member)
      <tr>
        <th scope="row">
          <img src="{{ $member->getPicture() }}" class="img-round img-center thumbnail-small" alt="Profile Picture">
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
