@extends ('layouts.app')

@section('title')
  @yield('title')
@endsection

@section('content')

{{-- dashboard --}}
<div class="dashboard">
  <div class="row">
    <div class="col-md-3">
      @yield('menu')
    </div>
    <div class="col-md-9">
      @yield('panel')
    </div>
  </div>
</div>

@endsection