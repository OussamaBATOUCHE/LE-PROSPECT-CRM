<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Le Prospect') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('adminLTE/myStyle.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">


        <main class="py-4">
          <button class="btn btn-primary" type="button"name="button" style="margin-left:45%" data-toggle="modal" data-target="#login">Connecter</button>
         {{-- <img  src="logoV.jpg" alt=""> --}}
          <video class="blur" autoplay loop  muted plays-inline>
          <source src="{{url('logoVideo.mp4')}}" type="video/mp4">
          </video>
            @yield('content')
        </main>

        @include('../layouts/modals/auth/login')
    </div>
</body>
</html>
