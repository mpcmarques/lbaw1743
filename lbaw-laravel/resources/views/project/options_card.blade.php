@extends('project.project-layout')

@section('title', 'Manage Tasks')

@section('card-header')

<h5>Options</h5>

@endsection

@section('card-body')

<div class="container-fluid">
<form>
  <div class="form-group">
    <div class="row">
      <div class="col-md-2">
        <img src="{{ $project->getPicture() }}" alt="Project current image" class="img-center thumbnail">
      </div>
      <div class="col-md-10">
        <div id="upload-image" class="input-group">
          <div class="custom-file">
            <label class="custom-file-label" for="new_image">Choose file</label>
            <input type="file" class="custom-file-input" id="new_image">
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="">Upload</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <input type="text" id="projectname" class="form-control" value="{{$project->name}}" required>
    <label class="form-check-label" for="description">Description</label>
    <textarea class="form-control" id="description">{{$project->description}}</textarea>
  </div>
  <button type="submit" class="btn btn-secondary">Save Changes</button>
</form>

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteProjectModal">
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
  </div>
</div>

@endsection
