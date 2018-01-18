
<!-- meta section -->
<title>@yield('title')</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta http-equiv="X-UA-Compatible" content="IE=edge" >
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" >
<!-- ./meta section -->

<!-- css styles -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/blue-white.css') }}" id="dev-css">
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