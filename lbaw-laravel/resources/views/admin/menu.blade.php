<div id="admin-menu">
  <ol class="list-group">
    <li class="list-group-item list-group-item-info" style="background-color: #70C1B3; color: #50514f;">
      Control Panel
    </li>
    <!-- Administration Users -->
    @include('layouts.list-item', ['name' => 'Users', 'path' => '/admin/users', 'url' => '/admin/users'])
    <!-- Administration Projects -->
    @include('layouts.list-item', ['name' => 'Projects', 'path' => '/admin/projects', 'url' => '/admin/projects'])
  </ol>
</div>
