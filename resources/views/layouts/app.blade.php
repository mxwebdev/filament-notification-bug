<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite('resources/css/app.css')

    @livewireStyles

    <!-- Scripts -->
    @vite('resources/js/app.js')
</head>

<body class="h-full">

    <div>
        @livewire('navigation-menu')

        <div class="md:pl-64 flex flex-col">

            <x-jet-banner />

            @livewire('sticky-header')

            <main class="flex-1">
                <div class="py-8">

                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Page Header -->
                        @if (isset($header))
                        {{ $header }}
                        @endif
                    </div>
                    <div class="mt-10 max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Page Content -->
                        {{ $slot }}
                    </div>
                </div>
            </main>

        </div>
    </div>

    @stack('modals')

    @livewireScripts
    @stack('scripts')

</body>

</html>
