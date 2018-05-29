@extends('project.project-layout')

@section('title', 'Manage Tasks')

@section('card-header')

<div class="row">
  <div class="col-md-8">
    <h5>Manage Tasks</h5>
  </div>
  <div class="col-md-4">
    @include('layouts.search-input', ['name' => 'project_tasks_search', 'search' => 'search-tasks', 'url' => '/project/'.$project->idproject.'/manage_tasks'])
  </div>
</div>

@endsection

@section('card-body')
<form method="POST" id="removeTasks">
  {{ csrf_field() }}
  <div class="nopadding">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">
          </th>
          <th scope="col">
            <div class="text-left font-weight-bold">
              Name
            </div>
          </th>
          <th scope="col">
            <div class="text-left font-weight-bold">
              Members Assigned
            </div>
          </th>
          <th scope="col">
            <div class="text-left font-weight-bold">
              Assigned
            </div>
          </th>
          <th scope="col">
            <div class="text-left font-weight-bold">
              Status
            </div>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($tasks as $task)
        <tr>
          <th scope="row">
            <div class="text-center">
              @if ( Auth::check() && $project->editors->contains('iduser', Auth::user()->iduser))
              @include('layouts.checkbox-input', ['name' => 'task'.$task->idtask])
              @endif
            </div>
          </th>
          <td>
            <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask) }}">{{$task->title}}</a>
          </td>
          <td>
            <div class="text-left">{{count($task->assigned)}}</div>
          </td>
          <td>
            <div class="text-left">
              @if (count($task->assigned))
              Yes
              @else
              No
              @endif
            </div>
          </td>
          <td>
            <div class="text-left">
              @if ($task->completed)
              Completed
              @else
              Open
              @endif
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</form>

@endsection

@section('card-footer')
@if(count($tasks) > 0)
<div class="card-footer">
  <div class="float-right">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#removeTasksModal">
      <span class="octicon octicon-trashcan"></span>
      Remove
    </button>
  </div>
</div>

<div class="modal fade" id="removeTasksModal" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Remove Tasks ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Warning</b>: this action is destructive!
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="removeTasks" formaction="{{ url('project/'.$project->idproject.'/manage_tasks/remove') }}">Remove</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

@endsection
