@extends('project.project-layout')

@section('title', 'Manage Users')

@section('card-header')

<div class="row">
  <div class="col-md-8">
    <h5>Manage Users</h5>
  </div>
  <div class="col-md-4">
    @include('layouts.search-input', ['name' => 'project_users_search', 'search' => 'search-users', 'url' => '/project/'.$project->idproject.'/manage_users'])
  </div>
  </div>
</div>

@endsection

@section('card-body')
<form method="POST" id="manageUsers">
  {{ csrf_field() }}
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
        @foreach($members as $member)
        <tr>
          <th scope="row">
            <div class="text-center">
              @if ( Auth::check() && $member->pivot->role != 'Owner' && $project->owner->contains('iduser', Auth::user()->iduser))
              @include('layouts.checkbox-input', ['name' => 'user'.$member->iduser])
              @elseif ( Auth::check() && $member->pivot->role != 'Owner' && $member->pivot->role != 'Manager'
              && $project->managers->contains('iduser', Auth::user()->iduser) )
              @include('layouts.checkbox-input', ['name' => 'user'.$member->iduser])
              @endif
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
            <?php $allowOwner = $project->private == true ? $member->premium == true : true; ?>
            @if ( Auth::check() && $project->owner->contains('iduser', Auth::user()->iduser) )
            @include('layouts.role-input', ['role' => $member->pivot->role, 'user' => 'Owner', 'iduser' => $member->iduser, 'allowOwner' => $allowOwner])
            @elseif ( Auth::check() && $member->pivot->role != 'Owner' && $member->pivot->role != 'Manager'
            && $project->managers->contains('iduser', Auth::user()->iduser) )
            @include('layouts.role-input', ['role' => $member->pivot->role, 'user' => 'Manager', 'iduser' => $member->iduser])
            @else
            <div class="text-left">{{$member->pivot->role}}</div>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</form>
@endsection

@section('card-footer')

<div class="card-footer">
  <div class="float-right">
    <button type="submit" class="btn btn-terciary" form="manageUsers" formaction="{{ url('project/'.$project->idproject.'/manage_users/update') }}">
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
        <h5>Remove Users ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Warning</b>: this action is destructive!
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="manageUsers" formaction="{{ url('project/'.$project->idproject.'/manage_users/remove') }}">Remove</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
