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
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>

<body class="bg-gray-100">


    <div class="container mx-auto">

        <div class="flex justify-between items-center bg-teal-900 ">
            <a href="/" class="flex items-center text-white py-2 pt-4">
                <svg class="h-12 w-12 md:h-16 md:w-16" version="1.1" viewBox="0 0 .81444 1.1537" xmlns="http://www.w3.org/2000/svg">
                    <g transform="translate(-6.9426 -13.633)">
                        <text fill="#000000" font-family="sans-serif" font-size="10.583px" style="line-height:1.25;shape-inside:url(#rect957);white-space:pre" xml:space="preserve" />
                        <path d="m7.3499 13.635c-0.13455 0.34027-0.40651 0.44762-0.40651 0.44762s0.047047 0.35858 0.40651 0.70336c0.36398-0.34478 0.40647-0.70336 0.40647-0.70336s-0.27353-0.10735-0.40647-0.44762zm0.011167 0.34924a0.15645 0.23187 0 0 1 0.15645 0.23185 0.15645 0.23187 0 0 1-0.15645 0.23185 0.15645 0.23187 0 0 1-0.15645-0.23185 0.15645 0.23187 0 0 1 0.15645-0.23185z" fill="#fff" stroke="#000" stroke-width=".0013435px" />
                        <g transform="matrix(.0016122 .0036509 -.0023005 .0036925 8.1482 16.957)" fill="#fff">
                            <rect transform="matrix(.99936 -.035646 .0043443 .99999 0 0)" x="-661.52" y="-116.76" width="20.383" height="10.476" ry=".28243" />
                            <rect transform="rotate(269.84)" x="85.224" y="-640.95" width="58.372" height="10.477" ry=".28245" />
                        </g>
                    </g>
                </svg>
                <span class="block text-2xl md:text-4xl px-2 py-4">GroupCare </span>
            </a>
            <div class="text-white text-2xl">Neerim District Landcare Group</div>
            <div class="text-white text-xl mr-2"> Group Management System</div>


        </div><!-- end static header -->


        <div class="font-sans text-gray-900 antialiased py-4 ">
            <x-flash-messages />

            @if( isSet($pagetitle) && !empty($pagetitle))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $pagetitle ?? '' }}</h1>
            </div>
            @endif
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                {{ $slot }}
            </div>


        </div>



    </div>

    <div class="fixed w-full h-10  bottom-0 text-center">
        <div class="container mx-auto bg-teal-800 ">
            <x-link.text class="text-gray-100 text-sm p-2" to='/privacy'>Privacy statement</x-link.text>
        </div>
    </div>
    @livewireScripts
</body>

</html>