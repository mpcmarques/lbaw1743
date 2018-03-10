@extends('layouts.app')

@section('content')

    @include('layouts.page-with-menu')

    @push('foo')
        @yield('foo')
    @endpush

    @push('id')
        @yield('id')
    @endpush

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
