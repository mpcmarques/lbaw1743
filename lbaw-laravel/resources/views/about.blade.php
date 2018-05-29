@extends('layouts.app')

@section('title', 'About')

@section('content')

<div id="about-page" class="container about-page">
    <h1 class="text-center">About</h1>
    <div class="container text">
        <h2 class="text-center"> Who are we? </h2>
        <p class="text-center">
          A group of computer engineering students from FEUP.
        </p>
    </div>
        <div class="container developers text-center">

              <div class="card user-card">
                <a href="https://github.com/mpcmarques">
                  <img src="https://avatars3.githubusercontent.com/u/15067361?s=400&v=4" class="card-img-top" alt="Profile Picture">
                </a>
                  <div class="card-body">
                      <h5 class="card-title text-center">Mateus Pedroza</h5>
                  </div>
              </div>

              <div class="card user-card">
                <a href="https://github.com/jotapsa">
                  <img src="https://avatars2.githubusercontent.com/u/8916652?s=460&v=4" class="card-img-top" alt="Profile Picture">
                </a>
                  <div class="card-body">
                      <h5 class="card-title text-center">João Sá</h5>
                  </div>
              </div>

              <div class="card user-card">
                <a href="https://github.com/bernardomcbarbosa">
                  <img src="https://avatars2.githubusercontent.com/u/25747760?s=460&v=4" class="card-img-top" alt="Profile Picture">
                </a>
                  <div class="card-body">
                      <h5 class="card-title text-center">Bernardo Barbosa</h5>
                  </div>
              </div>

              <div class="card user-card">
                <a href="https://github.com/mariosantosprivate">
                  <img src="https://avatars2.githubusercontent.com/u/25696878?s=460&v=4" class="card-img-top" alt="Profile Picture">
                </a>
                  <div class="card-body">
                      <h5 class="card-title text-center">Mário Santos</h5>
                  </div>
              </div>
        </div>

        <div class="container text">
            <h2 class="text-center"> Our Goal </h2>
            <p class="text-center">
             To achieve a good mark on the curricular unit of LBAW.
            </p>
        </div>

    </div>

@endsection
