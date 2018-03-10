@extends ('layouts.app')

@section('title')
@yield('title')
@endsection

@section('content')

{{-- search page --}}
<div class="container-fluid page-container">
  <div class="row">
    <div class="col-2">
      @include('search.menu')
    </div>
    <div class="col-10">
      @yield('card')
    </div>
  </div>
</div>


@endsection
