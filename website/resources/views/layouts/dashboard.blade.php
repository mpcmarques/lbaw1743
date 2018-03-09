@extends ('layouts.app')

@section('title')
@yield('title')
@endsection

@section('content')

{{-- dashboard --}}
<div class="dashboard">
  <div class="row">
    <div class="col-md-3">
      <div class="container-fluid dashboard-menu">
        <div class="list-group">
          <a href="dashboard" class="list-group-item list-group-item-action header" role="button">
            Dashboard
          </a>
          <a href="dashboard_my_projects" class="list-group-item list-group-item-action" role="button">
            My Projects
          </a>
          <a href="dashboard_tasks" class="list-group-item list-group-item-action" role="button">
            Tasks
          </a>
          <a href="#" class="list-group-item list-group-item-action" role="button">
            Public Projects
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      @yield('card')
    </div>
  </div>
</div>

@endsection
