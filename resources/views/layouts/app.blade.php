<!DOCTYPE html class="h-100">
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.cs')}}s">
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="http://cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">





</head>
<body class="h-100">
    <div id="app">
    <b-navbar toggleable="sm" type="dark" style="background-color:#7367f0; color:#fff">
        <b-navbar-toggle target="nav-text-collapse"></b-navbar-toggle>

        <b-navbar-brand href="{{ route('inicio') }}"> 
        {{ config('app.name', 'Ichapp') }}
        </b-navbar-brand>

        <b-collapse id="nav-text-collapse" is-nav>
            <b-navbar-nav class="ml-auto">
            @guest
                <b-nav-item href="{{ route('login') }}">Iniciar sesion</b-nav-item>
              <!--   <b-nav-item href="{{ route('register') }}">Registrarse</b-nav-item> -->
            @else
  

                <b-nav-item-dropdown text="{{ Auth::user()->name }} " right>
                  @if(Auth::user()->rol_id==2 || Auth::user()->rol_id==1)
                      <b-dropdown-item href="/dashboard">Dashboard</b-dropdown-item>
                  @endif
                  <b-dropdown-item href="#" @click="logout">Cerrar sesion</b-dropdown-item>
                </b-nav-item-dropdown>
                @endguest
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
    </form>

      
        @yield('content')
   </div>

    <!-- Scripts -->
    <script  type="application/javascript" src="{{ asset('js/app.js') }}"></script>


   <!--  BOOOTSTRAP -->


<!-- Bootstrap -->
<script type="application/javascript" src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script type="application/javascript" src="{{ asset('dist/js/adminlte.js')}}"></script>
<script type="application/javascript" src="{{ asset('dist/js/demo.js')}}"></script>
<script type="application/javascript" src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script type="application/javascript" src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="application/javascript" src="{{ asset('plugins/moment/moment.min.js')}}"></script>
<script type="application/javascript" src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script type="application/javascript" src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>

<script type="application/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

 
    

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>

</body>
</html>
