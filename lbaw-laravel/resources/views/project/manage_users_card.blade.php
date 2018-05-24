@extends('project.project-layout')

@section('title', 'Manage Users')

@section('card-header')

<div class="row">
  <div class="col-md-8">
    <h5>Manage Users</h5>
  </div>
  <div class="col-md-4">
    <form>
      <div class="input-group">
        <input class="form-control navbar-search-input" type="search" placeholder="Search" aria-label="Search">
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
            Tasks Assigned
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
      @foreach($project->members as $member)
      <tr>
        <th scope="row">
          <div class="text-center">
            @include('layouts.validation-input', ['name' => 'user'.$member->iduser, 'type' => 'checkbox'])
          </div>
        </th>
        <td>
          <a href="{{ url('profile/'.$member->iduser) }}">{{$member->username}}</a>
        </td>
        <td>
          <div class="text-left">{{ count($member->assignedTasksForProject($project->idproject)->get() ) }}</div>
        </td>
        <td>
          <div class="text-left">{{$member->name}}</div>
        </td>
        <td>
          @if ( Auth::check() && $project->owner->contains('iduser', Auth::user()->iduser) )
          @include('layouts.role-input', ['role' => $member->pivot->role])
          @elseif ( Auth::check() && $member->pivot->role != 'Owner' && $project->managers->contains('iduser', Auth::user()->iduser) )
          @include('layouts.role-input', ['role' => $member->pivot->role])
          @else
          <div class="text-left">{{$member->pivot->role}}</div>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('card-footer')

<div class="card-footer">
  <div class="float-right">
    <button type="button" class="btn btn-terciary">
      <span class="octicon octicon-clippy"></span>
      Save
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#removeUsersModal">
      <span class="octicon octicon-trashcan"></span>
      Remove
    </button>
  </div>
</div>

<div class="modal fade" id="removeUsersModal" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Remove users?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Warning: this action is destructive!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Remove</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
