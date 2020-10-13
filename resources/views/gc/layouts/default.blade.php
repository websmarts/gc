<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Groupcare') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">

            @include('layouts.partials.default_header')

            <div class="p-6 sm:px-20 md:px-24 lg:px-32 xl:px-48 bg-gray-200 bg-opacity-25  ">
                @yield('content')
            </div>
        </div>

        @yield('modals')

         <!-- Scripts -->
         @livewireScripts

        
         
    </body>
</html>
