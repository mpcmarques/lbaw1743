<div class="list-group">
  <li class="list-group-item list-group-item-info">
    Project
  </li>
  <!-- project tasks -->
  @include('layouts.list-item', ['name' => 'Tasks', 'path' => '/tasks', 'url' => 'project/'.$project->idproject.'/tasks'])
  <!-- project members -->
  @include('layouts.list-item', ['name' => 'Members', 'path' => '/members', 'url' => 'project/'.$project->idproject.'/members'])
  <!-- project forum -->
  @include('layouts.list-item', ['name' => 'Forum', 'path' => '/forum', 'url' => 'project/'.$project->idproject.'/forum'])

  @if ( Auth::check() && $project->editors->contains('iduser', Auth::user()->iduser) )
  <li class="list-group-item list-group-item-info">
    Administration
  </li>
  <!-- project options -->
  @if ( Auth::check() && $project->owner[0]->iduser == Auth::user()->iduser )
  @include('layouts.list-item', ['name' => 'Options', 'path' => '/options', 'url' => 'project/'.$project->idproject.'/options'])
  @endif
  <!-- project manage tasks -->
  @include('layouts.list-item', ['name' => 'Manage Tasks', 'path' => '/manage_tasks', 'url' => 'project/'.$project->idproject.'/manage_tasks'])
  <!-- project manage users -->
  @include('layouts.list-item', ['name' => 'Manage Users', 'path' => '/manage_users', 'url' => 'project/'.$project->idproject.'/manage_users'])
  @endif
</div>
