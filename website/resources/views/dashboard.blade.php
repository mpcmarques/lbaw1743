@extends ('layouts.app')

@section('title')
@yield('title')
@endsection

@section('content')

{{-- dashboard --}}
<div class="dashboard">
  <div class="row">
    <div class="col-md-3">
      @include('dashboard.menu')
    </div>
    <div class="col-md-9">
      @yield('card')
    </div>
  </div>
</div>

@endsection
