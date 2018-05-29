@extends('admin.admin-layout')

@section('title', 'Administration Tasks')

@section('card-header')

<div class="row">
  <div class="col-5">
    <h5 class="card-title">Tasks</h5>
  </div>
  <div class="col-7">
    <form method="POST" action="{{ url('/admin/tasks') }}">
      {{ csrf_field() }}
      <div class="input-group">
        <input class="form-control" type="search"
        placeholder="Search" aria-label="Search"
        name="search-task" value="{{ old('search-task') }}">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <span class="octicon octicon-search"></span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

<?php use Carbon\Carbon; ?>

@section('card-body')
<form method="POST" id="manageTasks">
  {{ csrf_field() }}
  <div class="nopadding">
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">#</th>
            <th scope="col">Task Name</th>
            <th scope="col">Members Assigned</th>
            <th scope="col">Project</th>
            <th scope="col">Last Edited</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tasks as $task)
          <tr>
            <td>
              <div class="text-center">
                @include('layouts.checkbox-input', ['name' => 'task'.$task->idtask])
              </div>
            </td>
            <td>{{$task->idtask}}</td>
            <td>
              <a href="{{ url('project/'.$task->project->idproject.'/task/'.$task->idtask) }}">{{$task->title}}</a>
            </td>
            <td>{{count($task->assigned)}}</td>
            <td>
              <a class="projects" href="{{ url('project/'.$task->project->idproject) }}">{{$task->project->name}}</a>
            </td>
            <td>{{ Carbon::parse($task->lasteditdate)->format('d/m/Y')}}</td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</form>
@endsection

@section('card-footer')
<!-- <button type="button" class="btn btn-terciary btn-block more">...</button> -->
<div class="card-footer">
  <div class="float-right">
    <button type="submit" class="btn btn-primary" form="manageTasks" formaction="{{ url('/admin/tasks/remove') }}">
      <span class="octicon octicon-trashcan"></span>
      Remove
    </button>
  </div>
</div>
@endsection
