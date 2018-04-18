<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#50514F">
    <link rel="shortcut icon" href="{{ asset('icons/logo32.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href= @yield('css') />
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>

    <title>Plenum - @yield('title')</title>
</head>
<body>
    <div id="container" class="container-fluid">
        <!-- navbar -->
        @yield('header')

        <!-- body -->
        <div id="body" class="container-fluid">
            @yield('content')
        </div>

        <!-- footer -->
        @yield('footer')
    </div>
</body>
</html>
