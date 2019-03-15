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

          <button class="btn btn-primary" type="button"name="button" style="margin-left:92%;margin-top:1%;" data-toggle="modal" data-target="#login">Connecter</button>
         {{-- <img  src="logoV.jpg" alt=""> --}}
          <video class="blur" autoplay  muted plays-inline>
          <source src="{{url('logoVideo.mp4')}}" type="video/mp4">
          </video>
            @yield('content')
            <div class="pull-left">
              <img class="hide" id="logoUSTHB" src="{{asset('logo_usthb.png')}}" alt="">
              <img class="hide" id="logoFECOMIT" src="{{asset('logo_fecomit.png')}}" alt="">
            </div>
            <div class="pull-right">
              <img class="hide" id="logoLINKEDIN" src="{{asset('logo_linkedin.png')}}" alt="">
            </div>

        @include('../layouts/modals/auth/login')
    </div>


</body>
</html>
