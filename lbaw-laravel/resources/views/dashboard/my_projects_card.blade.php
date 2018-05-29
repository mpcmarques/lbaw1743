@extends('dashboard.dashboard-layout')

@section('title', 'My Projects')

@section('card-header')
<div class="row">
  <div class="col-md-4">
    <h5 class="panel-title">My Projects</h5>
  </div>
  <div class="col md-4">
    {{-- search input --}}
    @include('layouts.search-input', ['name' => 'my_projects_search_input', 'search' => 'search-my-projects', 'url' => '/dashboard/projects'])
  </div>
</div>
@endsection

@section('card-body')
<a class="create-new-project btn btn-outline-light btn-block create-new-project-button" href="{{ url('dashboard/new-project')}}">
  + create new project
</a>
{{-- projects card --}}

@foreach($projects as $project)
@include('layouts.project_card', ['project' => $project])
@endforeach

@endsection
