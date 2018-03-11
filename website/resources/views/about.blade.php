@extends('layouts.app')

@section('title', 'About')

@section('content')

<div id="about-page" class="container about-page">
    <h1 class="text-center">About</h1>
    <div class="container developers text-center">
      @include('layouts.user-card')
      @include('layouts.user-card')
      @include('layouts.user-card')
      @include('layouts.user-card')
    </div>
    <div class="container text">
        <p class="text-center">
            Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum.
        </p>
    </div>
</div>

@endsection
