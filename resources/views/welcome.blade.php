{{-- @extends('layouts.app')

@section('content')
<!--<messenger_componente :user_id="{{auth()->id()}}"/>-->
<div>

<home_component/>
</div>
@endsection --}}


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="voixbotweb/img/favicon.png" rel="icon">
  <link href="voixbotweb/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="voixbotweb/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="voixbotweb/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="voixbotweb/lib/animate/animate.min.css" rel="stylesheet">
  <link href="voixbotweb/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="voixbotweb/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="voixbotweb/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="voixbotweb/css/style.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('voixbotweb/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('voixbotweb/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('voixbotweb/css/price.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <a href="#intro" class="scrollto"><img src="voixbotweb/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        @guest
          <ul>
            <li class="active"><a href="#intro">Home</a></li>
          <!--  <li><a href="#about">Quienes somos</a></li> -->
            <li><a href="#services">{{__('Producto')}}</a></li>
            <li><a href="#team">{{__('Canales')}}</a></li>
            <li><a href="#price">{{__('Precios')}}</a></li>
            <li><a href="#contact">{{__('Contactenos')}}</a></li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('LOGIN') }}</a>
          </li>
          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('REGISTER') }}</a>
              </li>
          @endif
          </ul>
   
        @else
          <ul>
            <li>
              @if(Auth::user()->rol_id>3)
              <a href="/chat">{{__('Ir a consola')}}</a>
              @else
              
              <a href="/chat">{{__('Dashboard')}}</a>
              @endif
            </li>
              <li class="drop-down nav-item-dropdown">
                  <a v-pre>
                      @if(Auth::user()->avatar)
                      <img src="{{Auth::user()->avatar}}" 
                      alt="imagen perfil"
                      height="30"
                      >
                      @endif
                      {{ Auth::user()->name }} 
                      <span class="caret"></span>
                  </a>
                  <ul>
                    <li>
                      <div class="dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
      
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                    </li>
                    
                  </ul>

              </li>
          </ul>
    
        @endguest
      </nav><!-- .main-nav -->
      
    </div>
  </header>
    
        <home_component/>
     
  </div>
  <!--==========================
    Intro Section
  ============================-->
  <script src="voixbotweb/lib/jquery/jquery.min.js"></script>
  <script src="voixbotweb/lib/jquery/jquery-migrate.min.js"></script>
  <script src="voixbotweb/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="voixbotweb/lib/easing/easing.min.js"></script>
  <script src="voixbotweb/lib/mobile-nav/mobile-nav.js"></script>
  <script src="voixbotweb/lib/wow/wow.min.js"></script>
  <script src="voixbotweb/lib/waypoints/waypoints.min.js"></script>
  <script src="voixbotweb/lib/counterup/counterup.min.js"></script>
  <script src="voixbotweb/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="voixbotweb/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="voixbotweb/lib/lightbox/js/lightbox.min.js"></script>
 <!--  <script src="contactform/contactform.js"></script> -->
  <script src="voixbotweb/js/main.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>