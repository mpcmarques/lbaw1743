@extends('project.project-layout')

@section('title', 'Manage Tasks')

@section('card-header')

<h5>Options</h5>

@endsection

@section('card-body')

<form>
  <div class="form-group">
    <div class="row">
      <div class="col-2">
        <img src="img/project_placeholder.png" alt="Project current image" width="100">
      </div>
      <div class="col-10">
        <div class="input-group">
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
    <label class="form-check-label" for="description">Description</label>
    <textarea class="form-control" id="description">
      Senectus et netus et malesuada fames ac turpis. Cras adipiscing enim eu turpis.
      Donec pretium vulputate sapien nec. Molestie a iaculis at erat pellentesque.
      Vitae sapien pellentesque habitant morbi tristique senectus et netus.
      Non curabitur gravida arcu ac tortor dignissim convallis aenean et. Lacus laoreet non curabitur gravida.
      Metus dictum at tempor commodo ullamcorper a lacus. Sapien faucibus et molestie ac feugiat sed lectus.
    </textarea>
  </div>
  <button type="submit" class="btn">Save Changes</button>
</form>

@endsection
