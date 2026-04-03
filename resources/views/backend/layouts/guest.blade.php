<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="description"
        content="globalnewtech, global new tech, globalnewtech.com, globalnewtechbd, global new tech bd, globalnewtech.com.bd, global new tech com bd,">
    <meta name="keywords"
        content="rahatul rabbi, rahatul, rabbi, rahatul-rabbi, rahatul_rabbi, md rahatul rabbi, web developer, full stack developer, laravel developer, php developer, javascript developer, front end developer,">
    <meta name="author" content="Rahatul Rabbi, Rahatul, Rabbi, Rahatul-Rabbi, Rahatul_Rabbi, MD RAHATUL RABBI">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset($systemSetting->favicon ?? 'backend/assets/images/logo-minimize.svg') }}">
    <title>{{ $systemSetting->system_name }}@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @include('backend.partials._style')
    <style>
        label,
        p {
            color: white;
        }

        .form-control {
            background-color: transparent !important;
            color: #59595A !important;


        }
    </style>
</head>

<body onload="preloaderFunction()" style="overflow-x: hidden; background: #F6F8FA;">
    @include('modal._preloader')
    <div class="font-sans text-gray-900 antialiased vh-100">
        {{ $slot }}
    </div>

    @livewireScripts
    @include('backend.partials._script')
</body>

</html>
