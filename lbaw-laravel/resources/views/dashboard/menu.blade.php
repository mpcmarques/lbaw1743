<div class="list-group">
  @if ( $_SERVER['PATH_INFO'] == '/dashboard')
  <a href="{{ url('dashboard') }}" class="list-group-item list-group-item-action active" role="button">
  @else
  <a href="{{ url('dashboard') }}" class="list-group-item list-group-item-action" role="button">
  @endif
    Dashboard
  </a>
  @if ( $_SERVER['PATH_INFO'] == '/dashboard/projects')
  <a href="{{ url('dashboard/projects') }}" class="list-group-item list-group-item-action active" role="button">
  @else
  <a href="{{ url('dashboard/projects') }}" class="list-group-item list-group-item-action" role="button">
  @endif
    My Projects
  </a>
  @if ( $_SERVER['PATH_INFO'] == '/dashboard/tasks')
  <a href="{{ url('dashboard/tasks') }}" class="list-group-item list-group-item-action active" role="button">
  @else
  <a href="{{ url('dashboard/tasks') }}" class="list-group-item list-group-item-action" role="button">
  @endif
    Tasks
  </a>
</div>
