<div class="card project-card">
    <img class="card-img-top img-responsive" src="{{ asset('img/task-placeholder.svg') }}" alt="profilePicture">
    <div class="card-body text-center">
        <h5>{{$project->name}}</h5>
        <div class="btn-group">
            <a href="{{ url('project/'.$project->idproject.'/tasks')}}" class="btn btn-terciary">
                <span  class="octicon octicon-clippy"></span>
            </a>

            <a href="{{ url('project/'.$project->idproject.'/forum')}}"  class="btn btn-secondary">
                <span  class="octicon octicon-comment-discussion"></span>
            </a>

            <a href="{{ url('project/'.$project->idproject.'/options') }}" class="btn btn-primary">
                <span  class="octicon octicon-tools"></span>
            </a>

        </div>
    </div>
</div>
