<div id="project-card" class="card">
  <div class="card-header">
    <h3 class="text-center">{{$project->name}}</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-3">
        <img src="{{ asset('img/project/'.$project->idproject.'.png') }}" class="img-round img-center thumbnail-big" alt="Project Picture">
      </div>
      <div class="col-md-9">
        <div class="text-left">{{$project->description}}</div>
      </div>
    </div>
  </div>
</div>
