@extends('layouts.page-layout')

@section('css')
"{{ asset('css/css.css') }}"
@endsection

@section('header')
    @include('layouts.navbar')
@endsection

@section('footer')
    @include('layouts.footer')
@endsection