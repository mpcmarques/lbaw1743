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
<!--  TODO:Reply more button-->
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
</div>

<div class="card-footer">
  <small>
    <?php $date = Carbon::parse($post->lasteditdate);
    $days = $date->diffInDays($now);
    $hours = $date->diffInHours($now);
    $minutes = $date->diffInMinutes($now);
    $seconds = $date->diffInSeconds($now); ?>
    @if ($days > 0)
    last post activity {{ $days }} days ago.
    @elseif ($hours > 0)
    last post activity {{ $hours }} hours ago.
    @elseif ($minutes > 0)
    last post activity {{ $minutes }} minutes ago.
    @else
    last post activity {{ $seconds }} seconds ago.
    @endif
  </small>

  <div class="float-right">
    <button type="button" class="btn btn-terciary" href="{{ url('/project/'.$project->idproject.'/edit-post')}}">
      <span class="octicon octicon-pencil"></span>
      Edit
    </button>
    <button type="button" class="btn btn-primary" href="{{ url('/project/'.$project->idproject.'/new-reply')}}">
      <span class="octicon octicon-comment-discussion"></span>
      Reply
    </button>
  </div>
</div>

</div>
@endforeach

@if( Auth::check() && $project->members->contains('iduser', Auth::user()->iduser) )
<a class="create-new-post btn btn-outline-light btn-block" href="{{ url('/project/'.$project->idproject.'/new-post')}}">
  + create new post
</a>
@endif

@endsection

@section('card-footer')
@if(count($project->forumPosts) > 0)
<div class="card-footer">
  <small>
    <?php $post = $project->forumPosts->first();
    $date = Carbon::parse($post->lasteditdate);
    $days = $date->diffInDays($now);
    $hours = $date->diffInHours($now);
    $minutes = $date->diffInMinutes($now);
    $seconds = $date->diffInSeconds($now); ?>
    @if ($days > 0)
    last forum activity {{ $days }} days ago.
    @elseif ($hours > 0)
    last forum activity {{ $hours }} hours ago.
    @elseif ($minutes > 0)
    last forum activity {{ $minutes }} minutes ago.
    @else
    last forum activity {{ $seconds }} seconds ago.
    @endif
  </small>
</div>
@endif

@endsection
