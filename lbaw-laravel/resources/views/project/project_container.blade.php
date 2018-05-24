<div id="project-card" class="card">
  <div class="card-header">
    <h3 class="text-center">{{$project->name}}</h3>

    @if ( Auth::check() && $project->members->contains('iduser', Auth::user()->iduser))
    <a href="{{ url('project/'.$project->idproject.'/leave/'.Auth::user()->iduser) }}" class="btn btn-primary card-leave-button">
      <span class="octicon octicon-sign-out">
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
