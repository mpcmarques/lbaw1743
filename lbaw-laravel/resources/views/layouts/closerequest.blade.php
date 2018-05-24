<?php use Carbon\Carbon; ?>

<div class="card closerequest-card">
  <div class="card-header">
    <button class="btn btn-terciary card-edit-button" data-toggle="modal" data-target="#approve-closerequest-modal">
      <span class="octicon octicon-check">
      </span>
    </button>
    <div class="row">
      <div class="col-6">
        <h5 class="panel-title">{{$closerequest->title}}</h5>
      </div>
      <div class="col-6">
        <p class="text-right">
          @if($closerequest->approved)
          Status: Approved
          @else
          Status: Not Approved
          @endif
        </p>
      </div>
    </div>
  </div>
  <div class="card-body">
    <p>
      {{$closerequest->description}}
    </p>
  </div>
  <div class="card-footer mt-0 pt-0">
    <p class="text-justify">
      <small>
        created by
        <a href="{{ url('profile/'.$closerequest->user->iduser) }}">{{ $closerequest->user->username }}</a>
        on {{ Carbon::parse($closerequest->creationdate)->format('d/m/Y') }}
      </small>
    </p>
  </div>
</div>

<div class="modal fade" id="approve-closerequest-modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Approve Close Request?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/approve-cr/'.$closerequest->iduser) }}"
          class="btn btn-primary">
          Approve
        </a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
