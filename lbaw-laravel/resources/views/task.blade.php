@extends ('layouts.app')

@section('title', 'Task')

@section('content')

@if($project->idProject != $task->idProject)
  abort(404);
@endif


<div id="task" class="container-fluid">
  {{-- breadcrumb --}}
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{
        url('project/'.$project->idproject.'/')
      }}">{{ $project->name }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">

        {{ $task->title }}

      </li>
    </ol>
  </nav>
  {{-- card --}}
  <div class="card">
    <div class="card-header panel-header">
      @include('layouts.card-edit-button', ['href' => $task->idtask.'/edit', 'extra' => ''])
      <div class="row">
        <div class="col-6">
          <h5 class="panel-title">{{ $task->title }}</h5>
        </div>
        <div class="col-6">
          <p class="text-right status">
            @if($task->completed)
            Status: Completed
            @else
            Status: Open
            @endif
          </p>
        </div>
      </div>
    </div>
    <div class="card-body">
      {{ $task->description}}
    </div>
    <div class="card-footer">
      <small>
        created by
        <a href="{{ url('profile/'.$task->creator->iduser) }}">{{ $task->creator->username }}</a>
         on {{ $task->creationdate }}
      </small>
    </div>
  </div>
  <div class="card">
    <div class="card-header panel-header">
      <h5 class="panel-title">Assigned</h5>
    </div>
    <div class="card-body">
      @foreach($task->assigned as $user)
      @include('layouts.user-card', ['user' => $user])
      @endforeach
    </div>
  </div>
  <div class="card discussion-card">
    <div class="card-header panel-header">
      <h5 class="panel-title">Discussion</h5>
    </div>
    <div class="card-body">

      @foreach($task->comments as $comment)
      <div class="media">
        <img class="mr-3" src="{{ asset('img/task-placeholder.svg') }}" alt="Generic placeholder image">
        <div class="media-body">
          <h5 class="mt-0">{{$comment->user->username}}</h5>
          {{$comment->content}}
        </div>
      </div>
      @endforeach

      @if(count($task->comments) > 8)
      <button type="button" class="btn btn-block btn-xs m-0 p-0">...</button>
      @endif
    </div>
  </div>
</div>

@endsection
