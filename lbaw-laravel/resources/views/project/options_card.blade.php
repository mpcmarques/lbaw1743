@extends('project.project-layout')

@section('title', 'Options')

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
          <img id="atualProjectPicture" src="{{ $project->getPicture() }}" alt="Project Picture" class="img-center thumbnail">
        </div>
        <div class="col-md-10">
          <div id="upload-image" class="input-group">
            <div class="custom-file">
              <label class="custom-file-label" id="projectPictureName">Choose File</label>
              <input type="file" class="custom-file-input" id="projectPicture" name="projectPicture">
            </div>
          </div>
        </div>
      </div>

      <script>
      document.getElementById('projectPicture').addEventListener("change", updateImage);

      function updateImage(event){
        var reader = new FileReader();
        var selectedFile = event.target.files[0];

        var imgtag = document.getElementById("atualProjectPicture");
        document.getElementById("projectPictureName").innerHTML = selectedFile.name;
        imgtag.title = selectedFile.name;

        reader.onload = function(event) {
          imgtag.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
      }
      </script>

    </div>
    <div class="form-group">
      <label class="form-check-label">Project Name</label>
      @include('layouts.validation-input', ['name' => 'name', 'value' => $project->name])
    </div>
    <div class="form-group">
      <label class="form-check-label">Description</label>
      @include('layouts.validation-input-textarea', ['name' => 'description', 'rows' => '4', 'value' => $project->description])
    </div>
    <div class="form-group">
      <label class="form-check-label">Type</label>
      <div class="radioType">
        @if ($project->private)
        <label class="radio-inline"><input type="radio" name="private" id="public" value="false">Public</label>
        @else
        <label class="radio-inline"><input type="radio" name="private" id="public" value="false" checked>Public</label>
        @endif

        @if (Auth::user()->premium)
        @if ($project->private)
        <label class="radio-inline"><input type="radio" name="private" id="private" value="true" checked>Private</label>
        @else
        <label class="radio-inline"><input type="radio" name="private" id="private" value="true">Private</label>
        @endif
        @endif
      </div>
    </div>
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
            <h5>Delete Project?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <b>Warning</b>: this action is destructive!
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
