@extends ('layouts.app')

@section('title', 'username\'s Profile')

@section('content')

<div class="container-fluid page-container">
  <div class="container-fluid" style="padding-bottom: 30px;">
    {{-- header card - on a later stage pass it some stuff so it knows if it's his own profile or someone else and what projects to get--}}
    @include('profile.header_card')
  </div>
  <div class="container-fluid">
    {{-- projects card--}}
    @include('profile.projects_card')
  </div>
</div>

@endsection
