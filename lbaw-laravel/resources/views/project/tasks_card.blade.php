@extends('project.project-layout')

@section('title', 'Tasks')

@section('card-header')

<div class="row">
  <div class="col-md-4">
    <h5>Tasks</h5>
  </div>
  <div class="col-md-8">
    <div class="float-right">
      <nav class="nav nav-pills">
        @if (strpos($_SERVER['PATH_INFO'], 'completed') !== false)
        <a class="nav-link" href="{{ url('/project/'.$project->idproject.'/tasks')}}">Active</a>
        <a class="nav-link" href="{{ url('/project/'.$project->idproject.'/tasks/unassigned')}}">Unassigned</a>
        <a class="nav-link active" href="{{ url('/project/'.$project->idproject.'/tasks/completed')}}">Completed</a>
        @elseif (strpos($_SERVER['PATH_INFO'], 'unassigned') !== false)
        <a class="nav-link" href="{{ url('/project/'.$project->idproject.'/tasks')}}">Active</a>
        <a class="nav-link active" href="{{ url('/project/'.$project->idproject.'/tasks/unassigned')}}">Unassigned</a>
        <a class="nav-link" href="{{ url('/project/'.$project->idproject.'/tasks/completed')}}">Completed</a>
        @else
        <a class="nav-link active" href="{{ url('/project/'.$project->idproject.'/tasks')}}">Active</a>
        <a class="nav-link" href="{{ url('/project/'.$project->idproject.'/tasks/unassigned')}}">Unassigned</a>
        <a class="nav-link" href="{{ url('/project/'.$project->idproject.'/tasks/completed')}}">Completed</a>
        @endif
      </nav>
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
          <p class="text-left font-weight-bold">#</p>
        </th>
        <th scope="col">
          <p class="text-left font-weight-bold">Task Name</p>
        </th>
        <th scope="col">
          <p class="text-left font-weight-bold">Tags</p>
        </th>
        <th scope="col">
          <p class="text-left font-weight-bold">Assigned</p>
        </th>
        <th scope="col">
          <p class="text-left font-weight-bold">Status</p>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach($tasks as $task)
      <tr>
        <th scope="row">
          <p class="text-left">{{$task->idtask}}</p>
        </th>
        <td>
          <p class="text-left">
            <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask) }}">{{$task->title}}</a>
          </p>
        </td>
        <td>
          <p class="text-left">
            @if(count($task->tags) > 0)

            @foreach($task->tags as $tag)
            {{$tag->name}}
            @endforeach

            @else
            none
            @endif
          </p>
        </td>
        <td>
          <p class="text-left">
            @if (count($task->assigned))
            Yes
            @else
            No
            @endif
          </p>
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
  @if( Auth::check() && $project->members->contains('iduser', Auth::user()->iduser) )
  <a class="create-new-project btn btn-outline-light btn-block" href="{{ url('/project/'.$project->idproject.'/new-task')}}">
    + create new task
  </a>
  @endif
</div>

@endsection

<?php use Carbon\Carbon;
$now = Carbon::now();?>

@section('card-footer')
@if(count($tasks) > 0)
<div class="card-footer">
  <small>
    <?php $task = $tasks->first();
    $date = Carbon::parse($task->lasteditdate);
    $days = $date->diffInDays($now);
    $hours = $date->diffInHours($now);
    $minutes = $date->diffInMinutes($now);
    $seconds = $date->diffInSeconds($now); ?>
    @if ($days > 0)
    last task activity <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask) }}">{{ $task->title }}</a>, {{ $days }} days ago.
    @elseif ($hours > 0)
    last task activity <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask) }}">{{ $task->title }}</a>, {{ $hours }} hours ago.
    @elseif ($minutes > 0)
    last task activity <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask) }}">{{ $task->title }}</a>, {{ $minutes }} minutes ago.
    @else
    last task activity <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask) }}">{{ $task->title }}</a>, {{ $seconds }} seconds ago.
    @endif
  </small>
</div>
@endif

@endsection
