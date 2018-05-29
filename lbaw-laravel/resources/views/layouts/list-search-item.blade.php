<li>
  @if (strpos($_SERVER['REQUEST_URI'], $path) !== false)
  <a href="{{ url($url) }}" class="list-group-item list-group-item-action active" role="button">{{$name}}
  @else
  <a href="{{ url($url) }}" class="list-group-item list-group-item-action" role="button">{{$name}}
  @endif
    <span class="float-right badge badge-pill badge-primary">{{$number}}</span>
  </a>
</li>
