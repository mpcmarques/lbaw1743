<!-- stylesheet 
<link rel="stylesheet" type="text/css" href="templates/home/home.css"/>
-->
@extends ('layouts.app')

@section('title', 'Home')

@section('content')
<!-- home page -->
<div class="container home-page text-center">
      <img class="logo" src="img/logo.png" alt="Plenum">
      <hr/>
      <div class="home-content">
        <h1>Plenum</h1>
        <p>
          Welcome to your go to online project manager. Build your dream team, split your tasks and get to work!
        </p>
      </div>
</div>
@endsection