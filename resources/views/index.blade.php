<!doctype html>
<html lang="en">

<head>
    <title>Bitdyn Profiles Plateform</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Material Kit CSS -->
    <link href="assets/css/material-kit.css?v=3.0.0" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="favico.jpg">
    <!-- Template Main CSS File 
    <link href="assets/css/style.css" rel="stylesheet">-->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <App></App>
    </div>
    <!--<script type="text/javascript">
        @ auth
            window.Permissions = { !! json_encode(Auth::user()->getAllPermissionsAttribute(), true) !!};
        @ else
            window.Permissions = [];
        @ endauth
    </script>

    <script type="text/javascript">
        window.Laravel = {
            csrfToken: "{ { csrf_token() }}",
            jsPermissions: { !! auth()->check()?auth()->user()->jsPermissions():null !!}
        }
    </script>-->
    <script src="{{ asset('js/app.js')}}" defer></script>
    <!-- Template Main JS File
    <script src="{ { asset('assets/js/main.js')}}"></script> -->
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/prism.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/highlight.min.js')}}"></script>
    <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
    <script src="{{ asset('assets/js/plugins/parallax.min.js')}}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
    <script src="{{ asset('assets/js/material-kit.min.js?v=3.0.0')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.4/gsap.min.js"></script>
</body>

</html>