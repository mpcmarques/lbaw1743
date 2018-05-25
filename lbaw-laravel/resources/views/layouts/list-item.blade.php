@if (strpos($_SERVER['PATH_INFO'], $path) !== false)
<a href="{{ url($url) }}" class="list-group-item list-group-item-action active" role="button">
@else
<a href="{{ url($url) }}" class="list-group-item list-group-item-action" role="button">
@endif
  {{$name}}
</a>
