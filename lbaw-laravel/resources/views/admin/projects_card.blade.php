@extends('admin.admin-layout')

@section('title', 'Administration Projects')

@section('card-header')
<div class="row">
  <div class="col-5">
    <h5 class="card-title">Projects</h5>
  </div>
  <div class="col-7">
    <form>
      <div class="input-group">
        <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <span class="octicon octicon-search"/>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

<?php use Carbon\Carbon; ?>

@section('card-body')
<form method="POST" id="manageProjects">
  {{ csrf_field() }}
<div class="nopadding">
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Owner</th>
          <th scope="col">Members</th>
          <th scope="col">Tasks</th>
          <th scope="col">Type</th>
          <th scope="col">Created</th>
          <th scope="col">Last Edited</th>
        </tr>
      </thead>
      <tbody>
        @foreach($projects as $project)
        <tr>
          <td scope="row">
            <div class="text-center">
              @include('layouts.checkbox-input', ['name' => 'project'.$project->idproject])
            </div>
          </td>
          <td>{{$project->idproject}}</td>
          <td>
            <a href="{{ url('project/'.$project->idproject) }}">{{$project->name}}</a>
          </td>
          <td>
            <a class="owners" href="{{ url('profile/'.$project->owner->first()->iduser) }}">{{$project->owner->first()->username}}</a>
          </td>
          <td>{{count($project->members)}}</td>
          <td>{{count($project->tasks)}}</td>
          @if($project->private)
          <td>Private</td>
          @else
          <td>Public</td>
          @endif
          <td>{{ Carbon::parse($project->creationdate)->format('d/m/Y')}}</td>
          <td>{{ Carbon::parse($project->lasteditdate)->format('d/m/Y')}}</td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>
</form>
@endsection

@section('card-footer')
<button type="button" class="btn btn-terciary btn-block more">...</button>
<div class="card-footer">
  <div class="float-right">
    <button type="submit" class="btn btn-primary" form="manageProjects" formaction="{{ url('/admin/projects/remove') }}">
      <span class="octicon octicon-trashcan"></span>
      Remove
    </button>
  </div>
</div>
@endsection
