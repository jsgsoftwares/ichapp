@extends('layouts.app')

@section('content')



<link href="{{ asset('assets/plugins/slick/slick.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/slick/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/flag-icon.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
<!-- End css -->

<!-- Start Chat Layout -->
<router-view :user_id="{{auth()->id() }}" url_app="{{env('APP_URL')}}"/>
     
<script type="application/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('assets/js/modernizr.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('assets/js/detect.js') }}"></script>
<script type="application/javascript" src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script type="application/javascript" src="{{ asset('assets/js/vertical-menu.js') }}"></script>

<script type="application/javascript" src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>
<!-- Core js -->
<script type="application/javascript" src="{{ asset('assets/js/core.js') }}"></script>




@endsection
