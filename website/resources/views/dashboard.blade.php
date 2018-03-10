@extends ('layouts.app')

@section('title')
@yield('title')
@endsection

@section('content')

{{-- dashboard --}}
<div id="dashboard">
  <div class="row">
    <div class="col-md-2">
      @include('dashboard.menu')
    </div>
    <div class="col-md-10">
      @yield('card')
    </div>
  </div>
</div>

@endsection
