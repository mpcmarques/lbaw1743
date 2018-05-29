@extends ('layouts.app')

@section('title', 'Task')

@section('content')

<?php use Carbon\Carbon; ?>

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

      @if ( Auth::check() && ( $task->creator->iduser == Auth::user()->iduser
      || $task->project->editors->contains('iduser', Auth::user()->iduser)
      || $task->assigned->contains('iduser', Auth::user()->iduser) ) )

      @include('layouts.card-edit-button', ['href' => $task->idtask.'/edit', 'extra' => ''])

      @endif

      @if ( Auth::check() && ( $task->creator->iduser == Auth::user()->iduser
      || $task->project->editors->contains('iduser', Auth::user()->iduser) ) )

      <button class="btn btn-primary card-delete-button" data-toggle="modal" data-target="#deletetask-modal">
        <span class="octicon octicon-trashcan">
        </span>
      </button>

      <div class="modal fade" id="deletetask-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5>Delete Task?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <b>Warning</b>: this action is destructive!
            </div>
            <div class="modal-footer">

              <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/delete') }}"
                class="btn btn-primary">
                Delete
              </a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      @endif

      {{ $task->description}}
    </div>
    <div class="card-footer">
      <small>
        created by
        <a href="{{ url('profile/'.$task->creator->iduser) }}">{{ $task->creator->username }}</a>
        on {{ Carbon::parse($task->creationdate)->format('d/m/Y') }}
      </small>
      <small class="float-right">
        @if($task->deadline && !$task->completed)
        deadline at {{ Carbon::parse($task->deadline)->format('d/m/Y') }}
        @elseif ($task->completed)
        completed on {{ Carbon::parse($task->completetiondate)->format('d/m/Y') }}
        @endif
      </small>
    </div>
  </div>

  <div class="card">
    <div class="card-header panel-header">
      <h5 class="panel-title">Assigned</h5>
      @if ( Auth::check() && $task->assigned->contains('iduser', Auth::user()->iduser))
      <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/unassign') }}" class="btn btn-primary card-leave-button">
        <span class="octicon octicon-sign-out">
        </span>
      </a>
      @elseif (Auth::check() && $task->project->members->contains('iduser', Auth::user()->iduser))
      <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/assign') }}" class="btn btn-terciary card-enter-button">
        <span class="octicon octicon-sign-in">
        </span>
      </a>
      @endif
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
        <img class="img-round mr-3" src="{{ $comment->user->getPicture() }}" alt="Profile Picture" width="40">
        <div class="media-body">
          <h5 class="mt-0"> <a href="{{ url('profile/'.$comment->user->iduser) }}">{{$comment->user->username}}</a></h5>
          {{$comment->content}}

          @if ( Auth::check() && ( $comment->user == Auth::user()
          || $task->project->editors->contains('iduser', Auth::user()->iduser) ))
          <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/delete-comment/'.$comment->idcomment) }}" class="btn btn-primary removeComment">
            <span class="octicon octicon-x">
            </span>
          </a>
          @endif
        </div>
      </div>
      @endforeach

      @if ( Auth::check() && $task->project->members->contains('iduser', Auth::user()->iduser))
      <form method="POST" action="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/comment') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <!-- <label>Add a Comment:</label> -->
          @include('layouts.validation-input-textarea', ['name' => 'content', 'rows' => '2'])
        </div>
        <button type="submit" class="btn btn-primary float-right">
          <span class="octicon octicon-comment"></span>
          Comment
        </button>
      </form>
      @endif

      @if(count($task->comments) > 8)
      <button type="button" class="btn btn-block btn-xs m-0 p-0">...</button>
      @endif
    </div>
  </div>

  <div class="card tags-card">
    <div class="card-header panel-header">
      <h5 class="panel-title">Tags</h5>
    </div>
    <div class="card-body">
      @foreach($task->tags as $tag)

      @if ( Auth::check() && ( $task->creator->iduser == Auth::user()->iduser
      || $task->project->editors->contains('iduser', Auth::user()->iduser)
      || $task->assigned->contains('iduser', Auth::user()->iduser) ) )
      <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/remove-tag/'.$tag->idtag) }}" class="btn btn-primary tag">
        @else
        <a class="btn btn-primary tag">
          @endif
          {{$tag->name}}
        </a>
        @endforeach

        @if ( Auth::check() && ( $task->creator->iduser == Auth::user()->iduser
        || $task->project->editors->contains('iduser', Auth::user()->iduser)
        || $task->assigned->contains('iduser', Auth::user()->iduser) ) )

        <button class="btn btn-terciary round-buton" data-toggle="modal" data-target="#addtag-modal">
          <span class="octicon octicon-plus"></span>
        </button>

        <div class="modal fade" id="addtag-modal" role="dialog">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5>Add New Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="form-inline" method="POST" action="{{ url('/project/'.$project->idproject.'/task/'.$task->idtask.'/add-tag') }}">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label>Tag:</label>
                    @include('layouts.validation-input', ['name' => 'tag'])
                  </div>
                  <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        @endif
      </div>
    </div>

    <div class="card closerequests-card">
      <div class="card-header panel-header">
        <h5 class="panel-title">Close Requests</h5>
      </div>
      @if(count($task->closerequest) > 0)
      <div class="card-body">
        @foreach($task->closerequest as $closerequest)
        @include('layouts.closerequest')
        @endforeach
      </div>
      @endif

      @if ( Auth::check() && ( $task->project->editors->contains('iduser', Auth::user()->iduser)
      || $task->assigned->contains('iduser', Auth::user()->iduser) ) )
      <div class="card-footer">
        <a class="create-new-closerequest btn btn-outline-light btn-block" href="{{ url('/project/'.$project->idproject.'/task/'.$task->idtask.'/new-cr')}}">
          + create new close request
        </a>
      </div>
      @endif
    </div>

  </div>

  @endsection
