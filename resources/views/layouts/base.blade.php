<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')

        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-white">
<div class="preloader-background" style="display: flex;">
    <div class="flex items-center font-extrabold text-yellow-200 text-4xl md:text-6xl">
        <div class="flex flex-col items-center">
            <h2 class="text-gray-700">{{ config('app.name', 'Laravel') }}</h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" overflow="visible" fill="#ffa70d" stroke="none">
                <defs>
                    <circle id="loader" cx="20" cy="50" r="6"/>
                </defs>
                <use xlink:href="#loader" transform="rotate(36 50 50)">
                    <animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.10s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="skewX" additive="sum" dur="1s" begin="0.10s" repeatCount="indefinite" from="0" to="1.2"></animateTransform>
                </use>
                <use xlink:href="#loader" transform="rotate(72 50 50)">
                    <animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.20s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="skewX" additive="sum" dur="1s" begin="0.20s" repeatCount="indefinite" from="0" to="1.2"></animateTransform>
                </use>
                <use xlink:href="#loader" transform="rotate(108 50 50)">
                    <animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.30s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="skewX" additive="sum" dur="1s" begin="0.30s" repeatCount="indefinite" from="0" to="1.2"></animateTransform>
                </use>
                <use xlink:href="#loader" transform="rotate(144 50 50)">
                    <animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.40s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="skewX" additive="sum" dur="1s" begin="0.40s" repeatCount="indefinite" from="0" to="1.2"></animateTransform>
                </use>
                <use xlink:href="#loader" transform="rotate(180 50 50)">
                    <animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.50s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="skewX" additive="sum" dur="1s" begin="0.50s" repeatCount="indefinite" from="0" to="1.2"></animateTransform>
                </use>
                <use xlink:href="#loader" transform="rotate(216 50 50)">
                    <animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.60s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="skewX" additive="sum" dur="1s" begin="0.60s" repeatCount="indefinite" from="0" to="1.2"></animateTransform>
                </use>
                <use xlink:href="#loader" transform="rotate(252 50 50)">
                    <animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.70s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="skewX" additive="sum" dur="1s" begin="0.70s" repeatCount="indefinite" from="0" to="1.2"></animateTransform>
                </use>
                <use xlink:href="#loader" transform="rotate(288 50 50)">
                    <animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.80s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="skewX" additive="sum" dur="1s" begin="0.80s" repeatCount="indefinite" from="0" to="1.2"></animateTransform>
                </use>
                <use xlink:href="#loader" transform="rotate(324 50 50)">
                    <animate attributeName="opacity" values="0;1;0" dur="1s" begin="0.90s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="skewX" additive="sum" dur="1s" begin="0.90s" repeatCount="indefinite" from="0" to="1.2"></animateTransform>
                </use>
                <use xlink:href="#loader" transform="rotate(360 50 50)">
                    <animate attributeName="opacity" values="0;1;0" dur="1s" begin="1.00s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="skewX" additive="sum" dur="1s" begin="1.00s" repeatCount="indefinite" from="0" to="1.2"></animateTransform>
                </use>
            </svg>
        </div>
    </div>
</div>
@yield('body')

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        $('.preloader-background').delay(1000).fadeOut('slow');
    });
</script>

@stack('scripts')
</body>
</html>
