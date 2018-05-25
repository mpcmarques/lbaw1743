<div class="card project-card">
    <a href="{{ url('project/'.$project->idproject) }}">
      <img class="card-img-top img-responsive" src="{{ $project->getPicture() }}" alt="profilePicture">
    </a>
    <div class="card-body text-center">
        <h5><a href="{{ url('project/'.$project->idproject) }}">{{$project->name}}</a></h5>
        <div class="btn-group">
            <a href="{{ url('project/'.$project->idproject.'/tasks')}}" class="btn btn-terciary">
                <span class="octicon octicon-clippy"></span>
            </a>

            <a href="{{ url('project/'.$project->idproject.'/forum')}}"  class="btn btn-secondary">
                <span class="octicon octicon-comment-discussion"></span>
            </a>

            @if ( Auth::check() && $project->editors->contains('iduser', Auth::user()->iduser) )
            <a href="{{ url('project/'.$project->idproject.'/manage_tasks') }}" class="btn btn-primary">
                <span class="octicon octicon-tools"></span>
            </a>
            @endif
        </div>
    </div>
</div>
