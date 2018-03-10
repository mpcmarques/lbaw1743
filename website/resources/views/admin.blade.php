@extends ('layouts.page-layout')

@section('title', 'Administration')

@section('header')
  @include('layouts.navbar_admin')
@endsection

@section('content')

   @include('admin.login_admin')

@endsection