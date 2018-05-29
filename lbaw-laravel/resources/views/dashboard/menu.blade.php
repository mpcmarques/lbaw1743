<ol class="list-group">
  <!-- dashboard -->
  <li>
    @if ( $_SERVER['REQUEST_URI'] == '/dashboard')
    <a href="{{ url('dashboard') }}" class="list-group-item list-group-item-action active" role="button">Dashboard</a>
    @else
    <a href="{{ url('dashboard') }}" class="list-group-item list-group-item-action" role="button">Dashboard</a>
    @endif
  </li>
  <!-- user projects -->
  @include('layouts.list-item', ['name' => 'Projects', 'path' => '/dashboard/projects', 'url' => '/dashboard/projects'])
  <!-- user tasks -->
  @include('layouts.list-item', ['name' => 'Tasks', 'path' => '/dashboard/tasks', 'url' => '/dashboard/tasks'])
</ol>
