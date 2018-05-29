@extends('search.search-layout')

@section('title', 'Tasks')

@section('card-header')
<div class="row">
  <div class="col-6">
    <h5 class="panel-title">Tasks</h5>
  </div>
  <div class="col-6">
    <div class="dropdown panel-button">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Sort by
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Best results</a>
      </div>
    </div>
  </div>
</div>
@endsection

<?php use Carbon\Carbon;
$now = Carbon::now();?>

@section('card-body')

@foreach ($tasks as $task)
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col">
        <p class="text-left">#{{$task->idtask}} -
          <a href="{{ url('project/'.$task->project->idproject.'/task/'.$task->idtask) }}" style="text-decoration: underline; color:black;">
            {{$task->title}}
          </a>
        </p>
      </div>
      <div class="col-6">
        <p class="text-right">
          <a href="{{ url('profile/'.$task->creator->iduser) }}" style="text-decoration: none;">{{$task->creator->username}}</a>
        </p>
      </div>
    </div>

  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <h5 class="text-left">
          <a href="{{ url('project/'.$task->project->idproject) }}" style="text-decoration: none; color:black;">{{$task->project->name}}</a>
        </h5>
      </div>
    </div>
    <p>{{ $task->description }}</p>
  </div>
  <div class="card-footer">
    <div class="row">
      <div class="col-6">
        <small>
          <?php $date = Carbon::parse($task->lasteditdate);
          $days = $date->diffInDays($now);
          $hours = $date->diffInHours($now);
          $minutes = $date->diffInMinutes($now);
          $seconds = $date->diffInSeconds($now); ?>
          @if ($days > 0)
          last updated {{ $days }} days ago.
          @elseif ($hours > 0)
          last updated {{ $hours }} hours ago.
          @elseif ($minutes > 0)
          last updated {{ $minutes }} minutes ago.
          @else
          last updated {{ $seconds }} seconds ago.
          @endif
        </small>
      </div>
      <div class="col-6 text-right">
        <span class="octicon octicon-comment-discussion"></span>
        <small>{{count($task->comments)}}</small>
      </div>
      <div class="col text-right">
        <span class="octicon octicon-organization"></span>
        <small>{{count($task->assigned)}}</small>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection
