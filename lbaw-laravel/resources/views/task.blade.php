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
                Warning: this action is destructive!
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
      <small class="float-right">
      @if($task->deadline && !$task->completed)
        deadline at {{ $task->deadline }}
      @elseif ($task->completed)
        completed on {{ $task->completetiondate }}
      @endif
      </small>
    </div>
  </div>
  <div class="card">
    <div class="card-header panel-header">
      <h5 class="panel-title">Assigned</h5>
      @if ( Auth::check() && $task->assigned->contains('iduser', Auth::user()->iduser))
      <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/unassign/'.Auth::user()->iduser) }}" class="btn btn-terciary card-leave-button">
        <span class="octicon octicon-sign-out">
        </span>
      </a>
      @elseif (Auth::check() && $task->project->members->contains('iduser', Auth::user()->iduser))
      <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/assign/'.Auth::user()->iduser) }}" class="btn btn-terciary card-enter-button">
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

    <div class="card tags-card">
      <div class="card-header panel-header">
        <h5 class="panel-title">Tags</h5>
      </div>
      <div class="card-body">
        @foreach($task->tags as $tag)
          <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/remove-tag/'.$tag->idtag) }}" class="btn btn-primary">
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
                  <h5>Add new tag</h5>
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
                    <button type="button submit" class="btn btn-primary">Confirm</button>
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

</div>

@endsection
