
<!-- meta section -->
<title>@yield('title')</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta http-equiv="X-UA-Compatible" content="IE=edge" >
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" >
<!-- ./meta section -->

<!-- css styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
<link rel="stylesheet" type="text/css" href="{{ asset('css/blue-white.css') }}" id="dev-css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<!-- ./css styles -->                                     
@yield('styles')
<!--[if lte IE 9]>
<link rel="stylesheet" type="text/css" href="css/dev-other/dev-ie-fix.css">
<![endif]-->

<!-- javascripts -->
<script type="text/javascript" src="{{ asset('js/plugins/modernizr/modernizr.js') }}"></script>
<!-- ./javascripts -->
@yield('header-scripts')
<style>
    .dev-page{visibility: hidden;}            
</style>