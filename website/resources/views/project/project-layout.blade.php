@extends ('layouts.app-page-with-menu')

{{-- project page --}}
@section('id', 'project-page')

@section('content-top')
  @include('project.project_media')
@endsection

@section('menu')
  @include('project.menu')
@endsection
