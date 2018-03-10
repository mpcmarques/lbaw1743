@extends ('layouts.app-page-with-menu')

{{-- project page --}}
@section('id', 'project-page')

@section('foo')
  @include('project.foo')
@endsection

@section('menu')
  @include('project.menu')
@endsection
