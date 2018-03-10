@extends ('layouts.app')

@section('title', 'Administration')

@section('content')

{{-- @if (logged) --}}
  {{-- @include('admin.users') --}}
{{-- @else --}}
   @include('admin.login_admin')
{{-- @endif --}}

@endsection
