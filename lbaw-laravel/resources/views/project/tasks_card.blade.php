@extends('project.project-layout')

@section('title', 'Tasks')

@section('card-header')

<div class="row">
  <div class="col-md-4">
    <h5>Tasks</h5>
  </div>
  <div class="col-md-8">
    <div class="float-right">
      <nav class="nav nav-pills">
        <a class="nav-link active" href="#">Active</a>
        <a class="nav-link" href="#">Unassigned</a>
        <a class="nav-link" href="#">Completed</a>
      </nav>
    </div>
  </div>
</div>

@endsection

@section('card-body')

<div class="nopadding">
  <table class="table">
    <thead>
      <tr>
        <th scope="col-1">
          <p class="text-left font-weight-bold">#</p>
        </th>
        <th scope="col-4">
          <p class="text-left font-weight-bold">Task Name</p>
        </th>
        <th scope="col-4">
          <p class="text-left font-weight-bold">Category</p>
        </th>
        <th scope="col-3">
          <p class="text-left font-weight-bold">Assigned</p>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach($project->tasks as $task)
      <tr>
        <th scope="row">
          <p class"text-left">{{$task->idtask}}</p>
        </th>
        <td>
          <p class="text-left">{{$task->title}}</p>
        </td>
        <td>
          <p class="text-left">{{$task->title}}</p>
        </td>
        <td>
          <p class="text-left">
            @if (count($task->assigned))
              Yes
            @else
              No
            @endif
          </p>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <a id="newtask-button" class="btn btn-block btn-xs m-0 p-0" href="#" role="button">+ create new task</a>
</div>

@endsection

@section('card-footer')

<div class="card-footer">
  <p class="text-center">
    last task activity task name, 2 days ago.
  </p>
</div>

@endsection
