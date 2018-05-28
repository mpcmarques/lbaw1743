@extends('layouts.app')

@section('title', 'New Close Request')

@section('content')

<div id="new-close-request" class="container-fluid">

  {{-- breadcrumb --}}
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{
        url('project/'.$project->idproject.'/')
      }}">{{ $project->name }}</a></li>
      <li class="breadcrumb-item"><a href="{{
        url('project/'.$project->idproject.'/task/'.$task->idtask)
      }}">{{ $task->title }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">New Close Request</li>
    </ol>
  </nav>

  {{-- main card --}}
  <div class="card">
    <div class="card-header panel-header">
      <h5>New Close Request</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ url('/project/'.$project->idproject.'/task/'.$task->idtask.'/new-cr') }}">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Title</label>
          <div class="col-sm-9">
            @include('layouts.validation-input', ['name' => 'title'])
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Description</label>
          <div class="col-sm-9">
            @include('layouts.validation-input-textarea', ['name' => 'description', 'rows' => '4'])
          </div>
        </div>

        <div class="form-group row" style="margin-bottom: 0;">
          <div class="container-fluid">
            <button type="submit" class="btn btn-primary">
              <span class="octicon octicon-plus"></span>
              Create
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
