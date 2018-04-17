@extends ('layouts.app')

@section('title', 'Edit Task')

@section('content')

<div class="container-fluid page-container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url( 'project/'.$project->idproject)}}">Project</a></li>
      <li class="breadcrumb-item"><a href="{{ url('project/'.$project->idproject.'/task/'.$task->idtask) }}">Task Name</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
  </nav>
  <div class="card">
    <div class="card-header panel-header">
      <h5>Edit task</h5>
    </div>
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="task_name">Task title</label>
          <input type="text" class="form-control" id="task_name" placeholder="{{$task->title}}">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" id="description" style="min-height: 150px;">
          {{ $task->description }}
          </textarea>
        </div>
        <button type="submit" class="btn btn-primary float-right">Accept Changes</button>
      </form>
    </div>
  </div>
</div>

@endsection
