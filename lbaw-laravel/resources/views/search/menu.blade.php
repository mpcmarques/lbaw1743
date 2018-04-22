<div class="list-group">
  <li class="list-group-item list-group-item-info">
    Results
  </li>
  <a href="{{ url('search/'.$text.'/projects') }}" class="list-group-item list-group-item-action" role="button">
    Projects
  </a>
  <a href="{{ url('search/'.$text.'/tasks') }}" class="list-group-item list-group-item-action" role="button">
    Tasks
  </a>
  <a href="{{ url('search/'.$text.'/users') }}" class="list-group-item list-group-item-action" role="button">
    Users
  </a>
</div>
