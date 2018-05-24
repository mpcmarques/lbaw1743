<div class="list-group">
  <li class="list-group-item list-group-item-info">
    Project
  </li>
  <a href="{{ url('project/'.$project->idproject.'/tasks') }}" class="list-group-item list-group-item-action" role="button">
    Tasks
  </a>
  <a href="{{ url('project/'.$project->idproject.'/members') }}" class="list-group-item list-group-item-action" role="button">
    Members
  </a>
  <a href="{{ url('project/'.$project->idproject.'/forum') }}" class="list-group-item list-group-item-action" role="button">
    Forum
  </a>

  @if ( Auth::check() && $project->editors->contains('iduser', Auth::user()->iduser) )
  <li class="list-group-item list-group-item-info">
    Administration
  </li>
  <a href="{{ url('project/'.$project->idproject.'/options') }}" class="list-group-item list-group-item-action" role="button">
    Options
  </a>
  <a href="{{ url('project/'.$project->idproject.'/manage_tasks') }}" class="list-group-item list-group-item-action" role="button">
    Manage Tasks
  </a>
  <a href="{{ url('project/'.$project->idproject.'/manage_users') }}" class="list-group-item list-group-item-action" role="button">
    Manage Users
  </a>
  @endif
</div>
