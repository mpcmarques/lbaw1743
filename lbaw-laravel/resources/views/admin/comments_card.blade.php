@extends('admin.admin-layout')

@section('title', 'Administration Comments')

@section('card-header')

<div class="row">
  <div class="col-5">
    <h5 class="card-title">Comments</h5>
  </div>
  <div class="col-7">
    <form method="POST" action="{{ url('/admin/comments') }}">
      {{ csrf_field() }}
      <div class="input-group">
        <input class="form-control" type="search"
        placeholder="Search" aria-label="Search"
        name="search-comment" value="{{ old('search-comment') }}">
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
<form method="POST" id="manageComments">
  {{ csrf_field() }}
  <div class="nopadding">
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Author</th>
            <th scope="col">Content</th>
            <th scope="col">Task Name</th>
            <th scope="col">Project</th>
            <th scope="col">Last Edited</th>
          </tr>
        </thead>
        <tbody>
          @foreach($comments as $comment)
          <tr>
            <td>
              <div class="text-center">
                @include('layouts.checkbox-input', ['name' => 'comment'.$comment->idcomment])
              </div>
            </td>
            <td>
              <a class="owners" href="{{ url('profile/'.$comment->user->iduser) }}">{{$comment->user->username}}</a>
            </td>
            <?php $content = explode(".", $comment->content, 2); $first = $content[0]; ?>
            <td>{{$first}}...</td>
            <td>
              <a href="{{ url('project/'.$comment->task->project->idproject.'/task/'.$comment->task->idtask) }}">{{$comment->task->title}}</a>
            </td>
            <td>
              <a class="projects" href="{{ url('project/'.$comment->task->project->idproject) }}">{{$comment->task->project->name}}</a>
            </td>
            <td>{{ Carbon::parse($comment->lasteditdate)->format('d/m/Y')}}</td>
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
    <button type="submit" class="btn btn-primary" form="manageComments" formaction="{{ url('/admin/comments/remove') }}">
      <span class="octicon octicon-trashcan"></span>
      Remove
    </button>
  </div>
</div>
@endsection
