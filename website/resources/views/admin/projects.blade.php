@extends('layouts.admin-page')

@section('title', 'Administration Projects')

@section('content')

<div class="container page-container admin">
  <div class="row">
    <div class="col-md-3">
      @include('admin.control_panel')
    </div>
    <div class="col-md-9">
      @include('admin.projects_card')
    </div>
  </div>
</div>

@endsection
