<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite('resources/css/app.css')

    @stack('styles')
    @livewireStyles

    <!-- Scripts -->
    @vite('resources/js/app.js')
</head>

<body class="h-full">

    {{ $slot }}

    @livewireScripts

    @livewire('notifications')
</body>

</html>
