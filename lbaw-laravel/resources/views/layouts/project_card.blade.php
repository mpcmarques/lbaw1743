<div class="card project-card">
    <img class="card-img-top img-responsive" src="{{ asset('img/task-placeholder.svg') }}">
    <div class="card-body text-center">
        <h5>{{$project->name}}</h5>
        <div class="btn-group">
            <a href="{{ url('project/'.$project->idproject.'/tasks')}}" class="btn btn-terciary">
                <span  class="octicon octicon-clippy"></span>
            </a>
            
            <button type="button" class="btn btn-secondary">
                <a href="{{ url('project_forum')}}">
                    <span  class="octicon octicon-comment-discussion"></span>
                </a>
            </button>
            <button type="button" class="btn btn-primary">
                <a href="{{ url('project_options') }}">
                    <span  class="octicon octicon-tools"></span>
                </a>
            </button>
        </div>
    </div>
</div>
