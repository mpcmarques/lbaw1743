@extends ('layouts.page-layout')

@section('css')
  "{{ asset('css/admin.css') }}"
@endsection

@section('header')
  @include('layouts.navbar_admin')
@endsection