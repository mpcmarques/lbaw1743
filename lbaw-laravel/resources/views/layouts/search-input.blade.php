<!-- search input -->
<div class="{{$name}}">
  <form method="POST" action="{{ url($url) }}">
    {{ csrf_field() }}
    <div class="input-group">
      <input class="form-control input" type="search" placeholder="Search" aria-label="Search" name="{{$search}}">
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit">
          <span class="octicon octicon-search"></span>
        </button>
      </div>
    </div>
  </form>
</div>
