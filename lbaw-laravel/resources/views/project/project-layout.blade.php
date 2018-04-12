@extends ('layouts.app-page-with-menu')

{{-- project page --}}
@section('id', 'project-page')

@section('content-top')
  @include('project.project_container')
@endsection

@section('menu')
  @include('project.menu')
@endsection
