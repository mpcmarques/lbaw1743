<ol class="list-group">
  <li class="list-group-item list-group-item-info">
    Results
    <span class="float-right badge badge-pill badge-primary">{{$countProjects+$countTasks+$countUsers}}</span>
  </li>
  <!-- search projects -->
  @include('layouts.list-search-item', ['name' => 'Projects', 'path' => '/projects', 'url' => 'search/'.$text.'/projects', 'number' => $countProjects])
  <!-- search users -->
  @include('layouts.list-search-item', ['name' => 'Users', 'path' => '/users', 'url' => 'search/'.$text.'/users', 'number' => $countUsers])
  <!-- search tasks -->
  @include('layouts.list-search-item', ['name' => 'Tasks', 'path' => '/tasks', 'url' => 'search/'.$text.'/tasks', 'number' => $countTasks])
</ol>
