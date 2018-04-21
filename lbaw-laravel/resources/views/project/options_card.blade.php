@extends('project.project-layout')

@section('title', 'Manage Tasks')

@section('card-header')

<h5>Options</h5>

@endsection

@section('card-body')

<form>
  <div class="form-group">
    <div class="row">
      <div class="col-md-2">
        <img src="img/project_placeholder.png" alt="Project current image" class="img-center thumbnail">
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
  <button type="submit" class="btn btn-primary">Save Changes</button>
</form>

@endsection
