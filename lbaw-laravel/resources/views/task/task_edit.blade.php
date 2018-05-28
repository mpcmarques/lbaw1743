@extends ('layouts.app')

@section('title', 'Edit Task')

@section('content')

<div class="container-fluid page-container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{
        url('project/'.$project->idproject.'/')
      }}">{{ $project->name }}</a></li>
      <li class="breadcrumb-item"><a href="{{
        url('project/'.$project->idproject.'/task/'.$task->idtask)
      }}">{{ $task->title }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
  </nav>
  <div class="card">
    <div class="card-header panel-header">
      <h5>Edit Task</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ url('project/'.$project->idproject.'/task/'.$task->idtask.'/edit') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label>Task Title</label>
          @include('layouts.validation-input', ['name' => 'title', 'value' => $task->title])
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" id="description" name="description" style="min-height: 150px;">{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
          <label>Deadline</label>
          <input class="form-control" id="deadline" type="date" name="deadline" value="{{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') }}">
        </div>
        <button type="submit" class="btn btn-primary float-right">Save Changes</button>
      </form>
    </div>
  </div>
</div>

@endsection
