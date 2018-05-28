@extends ('layouts.app')

@section('title', $profile->username)

@section('content')

<div id="profile" class="container-fluid">
  <div class="container-fluid" style="padding-bottom: 30px;">
    {{-- header card - on a later stage pass it some stuff so it knows if it's his own profile or someone else and what projects to get--}}
    @include('profile.header_card', ['profile' => $profile ])
  </div>
  <div class="container-fluid">
    {{-- projects card--}}
    @include('profile.projects_card', ['projects' => $profile->projects])
  </div>
</div>

@endsection
