<div id="profile-projects-card" class="card">
  <h5 class="card-header panel-header">
    Projects
  </h5>
  <div class="card-body">
    {{-- project card --}}
    @foreach($projects as $project)

    @include('layouts.project_card', ['project' => $project])

    @endforeach
  </div>
</div>
