<div class="list-group">
  <li class="list-group-item list-group-item-info">
    Results
    <span class="float-right badge badge-pill badge-primary">{{$countProjects+$countTasks+$countUsers}}</span>
  </li>
  <a href="{{ url('search/'.$text.'/projects') }}" class="list-group-item list-group-item-action" role="button">
    Projects
    <span class="float-right badge badge-pill badge-primary">{{$countProjects}}</span>
  </a>
  <a href="{{ url('search/'.$text.'/tasks') }}" class="list-group-item list-group-item-action" role="button">
    Tasks
    <span class="float-right badge badge-pill badge-primary">{{$countTasks}}</span>
  </a>
  <a href="{{ url('search/'.$text.'/users') }}" class="list-group-item list-group-item-action" role="button">
    Users
    <span class="float-right badge badge-pill badge-primary">{{$countUsers}}</span>
  </a>
</div>
