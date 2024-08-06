@php
    $SITE_RTL = env('SITE_RTL');
    if($SITE_RTL == ''){
        $SITE_RTL = 'off';
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{$SITE_RTL == 'on'?'rtl':''}}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') &dash; {{$settings["header_text"]}}</title>

    <!-- Favicon -->
    <!-- <link rel="icon" href="{{asset(Storage::url('logo/favicon.png'))}}" type="image"> -->
    <link rel="icon" href="{{ asset('/storage/logo/favicon.png')}}" type="image">    
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('/assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/ac.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/stylesheet.css') }}">
    @if($SITE_RTL=='on')
        <link rel="stylesheet" href="{{ asset('/css/bootstrap-rtl.css') }}">
    @endif
    @stack('head')
</head>

<body>

<div class="login-contain">
    <div class="login-inner-contain">
        <a class="navbar-brand" href="#">
            <!-- <img src="{{asset(Storage::url('logo/logo-full.png'))}}" alt="{{ config('app.name', 'Federal Ministry of Industry, Trade and Investment') }}" class="navbar-brand-img"> -->
            <img src="{{ asset('/storage/logo/logo-full.png')}}" alt="{{ config('app.name', 'Federal Ministry of Industry, Trade and Investment') }}" class="navbar-brand-img">
        </a>
        @yield('content')
        <h5 class="copyright-text">
            {{ $settings["footer_text"]}}
        </h5>
        @yield('language-bar')
    </div>
</div>
<script src="{{asset('/assets/js/jquery.min.js')}}"></script>
<script>
    var toster_pos="{{$SITE_RTL =='on' ?'left' : 'right'}}";
</script>
<script src="{{asset('/assets/js/new-custom.js')}}"></script>
@stack('script')
</body>
</html>
