<div id="project-card" class="card">
  <div class="card-header">
    <h3 class="text-center">{{$project->name}}</h3>

    @if ( Auth::check() && $project->members->contains('iduser', Auth::user()->iduser) && !$project->owner->contains('iduser', Auth::user()->iduser))
    <a href="{{ url('project/'.$project->idproject.'/leave') }}" class="btn btn-primary card-leave-button">
      <span class="octicon octicon-sign-out">
      </span>
    </a>
    @elseif ( Auth::check() && !$project->owner->contains('iduser', Auth::user()->iduser))
    <a href="{{ url('project/'.$project->idproject.'/join') }}" class="btn btn-terciary card-enter-button">
      <span class="octicon octicon-sign-in">
      </span>
    </a>
    @endif

    @if($project->private)
    <a class="btn btn-secondary card-private-button">
      <span class="octicon octicon-lock">
      </span>
    </a>
    @endif
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-3">
        <img src="{{ $project->getPicture() }}" class="img-round img-center thumbnail-big" alt="Project Picture">
      </div>
      <div class="col-md-9">
        <div class="text-left">{{$project->description}}</div>
      </div>
    </div>
  </div>
</div>
