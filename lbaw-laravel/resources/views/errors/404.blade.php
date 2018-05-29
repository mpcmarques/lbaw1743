@extends ('layouts.app')

@section('title', 'Page Not Found')

@section('content')

<div id="error-page" class="container">
  <div class="grid">
    <div class="row">
      <div class="col">
        <h1 class="text-right">4</h1>
      </div>
      <div class="col">
        <a href="/">
          <img src="{{ asset('img/logo.png') }}">
        </a>
      </div>
      <div class="col">
        <h1>4</h1>
      </div>
    </div>
  </div>
  <div class="container">
    <p class="text-center">
      Page not found!
    </p>
  </div>
</div>

@endsection
