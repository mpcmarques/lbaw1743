@extends('layouts.admin-page')

@section('content')

    @include('layouts.page-with-menu')

    @push('menu')
        @yield('menu')
    @endpush

    @push('card-header')
        @yield('card-header')
    @endpush

    @push('card-body')
        @yield('card-body')
    @endpush

@endsection
