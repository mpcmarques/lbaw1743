@extends('search.search-layout')

@section('title', 'Projects')

@section('card-header')
<div class="row">
  <div class="col-6">
    <h5 class="panel-title">Projects</h5>
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

@foreach ($projects as $project)
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-6">
        <h5 class="text-left">
          <a href="{{ url('project/'.$project->idproject) }}" style="text-decoration: underline; color:black;">{{$project->name}}</a>
        </h5>
      </div>
      <div class="col-6">
        <p class="text-right">
          <a href="{{ url('profile/'.$project->owner->first()->iduser) }}" style="text-decoration: none;">{{$project->owner->first()->username}}</a>
        </p>
      </div>
    </div>
  </div>
  <div class="card-body">
    <p>{{$project->description}}</p>
  </div>
  <div class="card-footer">
    <div class="row">
      <div class="col-6">
        <small>
          <?php $date = Carbon::parse($project->lasteditdate);
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
        <span class="octicon octicon-file"></span>
        <small>{{count($project->tasks)}}</small>
      </div>
      <div class="col text-right">
        <span class="octicon octicon-organization"></span>
        <small>{{count($project->members)}}</small>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection
