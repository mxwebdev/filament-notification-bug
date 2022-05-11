<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="h-full">
    <x-jet-banner />

    <div>
        @livewire('navigation-menu')

        <div class="md:pl-64 flex flex-col">

            @livewire('sticky-header')

            <main class="py-10">

                <!-- Page Heading -->
                @if (isset($header))
                <div
                     class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
                    {{ $header }}
                </div>
                @endif

                {{ $slot }}

            </main>

        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
