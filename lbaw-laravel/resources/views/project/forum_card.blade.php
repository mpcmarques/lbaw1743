@extends('project.project-layout')

@section('title', 'Forum')

@section('card-header')

<div class="row">
  <div class="col-md-8">
    <h5>Forum</h5>
  </div>
  <div class="col-md-4">
    <div class="float-right">
      <form>
        <div class="form-group">
          <select class="form-control slct-primary" id="sel_filter">
            <option class="slct-primary">Recently Updated</option>
            <option class="slct-primary">Most Replys</option>
            <option class="slct-primary">Last Updated</option>
          </select>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
<!-- TODO:creationDate -->
<!--  TODO:show more button-->
<!-- TODO: Last message -->

<?php use Carbon\Carbon;
$now = Carbon::now();?>

@section('card-body')
@foreach($project->forumPosts as $post)
<div class="card forum-card">
  <div class="card-header">
    <p>{{$post->title}}</p>
  </div>
  <div class="card-body">
    <p>
      <b>Last message by
        <a href="{{ url('profile/'.$post->user->iduser) }}">{{$post->user->username}}</a>:
      </b>
    </p>
    <p>
      {{$post->content}}
    </p>
    <!-- <p>
    show more...
  </p> -->
</div>
<!-- <div class="card-footer mt-0 pt-0">
<p class="text-justify">
{{$post->creationDate}}
</p>
</div> -->
<div class="card-footer">
  <small>
    <?php $date = Carbon::parse($post->lasteditdate);
    $days = $date->diffInDays($now);
    $hours = $date->diffInHours($now);
    $minutes = $date->diffInMinutes($now);
    $seconds = $date->diffInSeconds($now); ?>
    @if ($days > 0)
    last activity {{ $days }} days ago.
    @elseif ($hours > 0)
    last activity {{ $hours }} hours ago.
    @elseif ($minutes > 0)
    last activity {{ $minutes }} minutes ago.
    @else
    last activity {{ $seconds }} seconds ago.
    @endif
  </small>
</div>
</div>
@endforeach
<button type="button" id="forum-button" class="btn btn-block btn-xs m-0 p-0">...</button>

@endsection
