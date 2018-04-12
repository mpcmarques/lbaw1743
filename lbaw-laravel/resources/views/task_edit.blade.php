@extends ('layouts.app')

@section('title', 'Edit Task')

@section('content')

<div class="container-fluid page-container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('project')}}">Project</a></li>
      <li class="breadcrumb-item"><a href="{{ url('task') }}">Task Name</a></li>
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
          <label for="task_name">Task name</label>
          <input type="text" class="form-control" id="task_name" placeholder="Task name">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" id="description" style="min-height: 150px;">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut viverra eros, quis aliquam nibh. Suspendisse potenti. In hac habitasse platea dictumst. Phasellus luctus eget ante hendrerit ultrices. Mauris vel libero quis felis finibus facilisis. Nam sed erat et ipsum scelerisque condimentum. Praesent et mauris porta, ornare metus vitae, sagittis leo. Cras eu volutpat eros, in rhoncus felis. Suspendisse erat leo, blandit in faucibus at, ullamcorper in diam. Sed ut felis ac tellus fermentum accumsan eget nec urna. Etiam fringilla sed lacus ac tristique. Vivamus sed lobortis ex. Vivamus congue magna at diam tempus, sed maximus mi molestie. Mauris id consequat purus. Donec nec enim nec mi consequat feugiat rhoncus sodales neque.
          </textarea>
        </div>
        <button type="submit" class="btn btn-primary float-right">Accept Changes</button>
      </form>
    </div>
  </div>
</div>

@endsection
