<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>

<body class="font-sans antialiased">

    <!-- page container -->
    <div x-data="{showSidebar: false}" class="h-screen flex overflow-hidden bg-gray-100">

        <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
        <div x-show="showSidebar" class="md:hidden  transition-opacity ease-linear duration-300">
            x-layouts.app.mobile-nav />
        </div>

        <!-- Static sidebar for desktop -->
        x-layouts.app.static-nav />

        <!-- static page container -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <!-- page top header bar -->
            x-layouts.app.top-header-bar />

            <main class="flex-1 relative overflow-y-auto focus:outline-none" tabindex="0">
                <div class="pt-2 pb-6 md:py-6">
                    <!-- display message and/or error-message -->
                    <x-flash-messages />
                    
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $pagetitle }}</h1>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Start content -->

                        

                        <div class="py-4">
                            {{ $slot }}
                        </div>
                        <!-- /End content -->
                    </div>
                </div>
            </main>

        </div><!-- end page  -->

    </div> <!-- end static page container -->

    @livewireScripts
</body>

</html>