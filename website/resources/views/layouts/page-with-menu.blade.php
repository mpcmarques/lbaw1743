@extends ('layouts.app')

@section('content')

{{-- page with menu --}}
<div id=@yield('id') >
  <div class="row">
    <div class="col-md-2">
      @yield('menu')
    </div>
    <div class="col-md-10">
      @yield('card')
    </div>
  </div>
</div>

@endsection
