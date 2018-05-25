<div class="list-group">
  <!-- dashboard -->
  @if ( $_SERVER['PATH_INFO'] == '/dashboard')
  <a href="{{ url('dashboard') }}" class="list-group-item list-group-item-action active" role="button">
  @else
  <a href="{{ url('dashboard') }}" class="list-group-item list-group-item-action" role="button">
  @endif
    Dashboard
  </a> 
  <!-- user projects -->
  @include('layouts.list-item', ['name' => 'Projects', 'path' => '/dashboard/projects', 'url' => '/dashboard/projects'])
  <!-- user tasks -->
  @include('layouts.list-item', ['name' => 'Tasks', 'path' => '/dashboard/tasks', 'url' => '/dashboard/tasks'])
</div>
