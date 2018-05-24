@extends('project.project-layout')

@section('title', 'Manage Tasks')

@section('card-header')

<h5>Options</h5>

@endsection

@section('card-body')

<div class="container-fluid">
  <form method="POST" action="{{ url('project/'.$project->idproject.'/options') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
  <div class="form-group">
    <div class="row">
      <div class="col-md-2">
        <img src="{{ $project->getPicture() }}" alt="Project Picture" class="img-center thumbnail">
      </div>
      <div class="col-md-10">
        <div id="upload-image" class="input-group">
          <div class="custom-file">
            <label class="custom-file-label">Choose File</label>
            <input type="file" class="custom-file-input" id="projectPicture" name="projectPicture">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    @include('layouts.validation-input', ['name' => 'name', 'value' => $project->name])
    <label class="form-check-label" for="description">Description</label>
    @include('layouts.validation-input-textarea', ['name' => 'description', 'rows' => '4', 'value' => $project->description])
  </div>
  <fieldset class="form-group row">
      <legend class="col-form-legend col-sm-3">Type</legend>
      <div class="col-sm-9">
          <div class="form-check">
              <label class="form-check-label">
                @if ($project->private)
                <input class="form-check-input form-control" type="radio" name="private" id="public" value="false">
                @else
                <input class="form-check-input form-control" type="radio" name="private" id="public" value="false" checked>
                @endif
                  Public
              </label>
          </div>
          @if (Auth::user()->premium)
          <div class="form-check">
              <label class="form-check-label">
                @if ($project->private)
                <input class="form-check-input form-control" type="radio" name="private" id="private" value="true" checked>
                @else
                <input class="form-check-input form-control" type="radio" name="private" id="private" value="true">
                @endif
                Private
              </label>
          </div>
          @endif
      </div>
  </fieldset>
  <button type="submit" class="btn btn-secondary">
    <span class="octicon octicon-clippy"></span>
    Save Changes
  </button>

  @if ( Auth::check() && $project->owner->contains('iduser', Auth::user()->iduser) )
  <button type="button" class="btn btn-primary deleteProject" data-toggle="modal" data-target="#deleteProjectModal">
      <span class="octicon octicon-trashcan"></span>
      Delete Project
  </button>

  <div class="modal fade" id="deleteProjectModal" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Delete project?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Warning: this action is destructive!
          </div>
          <div class="modal-footer">

            <a href="{{ url('project/'.$project->idproject.'/options/delete') }}"
              class="btn btn-primary">
              Delete
            </a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  @endif
</form>
  </div>

@endsection
