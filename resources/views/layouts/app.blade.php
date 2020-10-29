<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Facturación POS">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="William Guzmán y Davinson Rocha Salzar">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="#">
    <title>@yield("titulo","Bienvenido ".Auth::user()->name)</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar -->
    @include("layouts.nav")
    <!-- /.navbar -->
    <!-- Sidebar menu-->
    @include("layouts.aside")

    <main class="app-content">
      @yield('content')
    </main>
    <!-- Essential javascripts for application to work-->
    
    <!-- Page specific javascripts-->
    <script src="{{asset('js/fontawesome.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
  </body>
</html>
