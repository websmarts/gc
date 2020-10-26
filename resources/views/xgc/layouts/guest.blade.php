<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#362f78">
  <meta name="msapplication-TileColor" content="#362778">
  <meta name="theme-color" content="#ffffff">

  <title>{{ config('app.name', 'Groupcare') }}</title>


  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @livewireStyles

  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body class="antialiased font-sans bg-gray-200">
  
    <div style="min-height: 640px;" class="bg-gray-100">

      <div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
        <!-- mobile sidebar -->
        <div x-show="sidebarOpen" class="md:hidden" x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." style="display: none;">
          <div class="fixed inset-0 flex z-40">

            
            <div @click="sidebarOpen = false" x-show="sidebarOpen" x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state." x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0" style="display: none;">
              <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
            </div>

            
            <div x-show="sidebarOpen" x-description="Off-canvas menu, show/hide based on off-canvas menu state." x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full bg-indigo-800" style="display: none;">
              <div class="absolute top-0 right-0 -mr-14 p-1">
                <button x-show="sidebarOpen" @click="sidebarOpen = false" class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600" aria-label="Close sidebar" style="display: none;">
                  <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
                </button>
              </div>
              <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">

              <!-- mobile sidebar brand -->
                <div class="flex-shrink-0 flex items-center px-4">
                  <img class="h-8 w-auto" src="/images/brand_logo.svg" alt="GroupCare"> 
                  <span style="font-family:arial" class="text-white px-2 text-3xl">GroupCare</span>
                </div>

                <!-- mobile sidebar nav -->
                <nav class="mt-5 px-2 space-y-1">
                  <x-gc.nav-guest-links></x-gc.nav-guest-links>
                </nav>

              </div>

              <!-- mobile sidebar user menu -->
              <div class="flex-shrink-0 flex border-t border-indigo-700 p-4">
              <x-gc.nav-link to="{{ route('login') }}">Login</x-gc.nav-link>
              </div>

            </div>
            <div class="flex-shrink-0 w-14">
              <!-- Force sidebar to shrink to fit close icon -->
            </div>
          </div>
        </div><!-- end mobile sidebar -->

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:flex-shrink-0">
          <div class="flex flex-col w-64">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex flex-col h-0 flex-1 bg-indigo-900">
              <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">

                <div class="flex items-center flex-shrink-0 px-4">
                  <img class="h-10 w-auto" src="/images/brand_logo.svg" alt="GroupCare"> <span style="font-family:arial" class="text-white px-2 text-3xl">GroupCare</span>
                </div>

                <nav class="mt-5 flex-1 px-2 bg-indigo-900 space-y-1">
                  <x-gc.nav-guest-links></x-gc.nav-guest-links>
                </nav>

              </div>
              <div class="flex-shrink-0 flex border-t border-indigo-700 p-4">
                   <x-gc.nav-link to="{{ route('login') }}">Login</x-gc.nav-link>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
          <div class="flex justify-between md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-indigo-900">

            <div class="flex align-middle">
              <!-- logo svg -->
              <svg class="h-10 w-auto" version="1.1" viewBox="0 0 .81444 1.1537" xmlns="http://www.w3.org/2000/svg">
                <g transform="translate(-6.9426 -13.633)">
                  <text fill="#000000" font-family="sans-serif" font-size="10.583px" style="line-height:1.25;shape-inside:url(#rect957);white-space:pre" xml:space="preserve" />
                  <path d="m7.3499 13.635c-0.13455 0.34027-0.40651 0.44762-0.40651 0.44762s0.047047 0.35858 0.40651 0.70336c0.36398-0.34478 0.40647-0.70336 0.40647-0.70336s-0.27353-0.10735-0.40647-0.44762zm0.011167 0.34924a0.15645 0.23187 0 0 1 0.15645 0.23185 0.15645 0.23187 0 0 1-0.15645 0.23185 0.15645 0.23187 0 0 1-0.15645-0.23185 0.15645 0.23187 0 0 1 0.15645-0.23185z" fill="#fff" stroke="#000" stroke-width=".0013435px" />
                  <g transform="matrix(.0016122 .0036509 -.0023005 .0036925 8.1482 16.957)" fill="#fff">
                    <rect transform="matrix(.99936 -.035646 .0043443 .99999 0 0)" x="-661.52" y="-116.76" width="20.383" height="10.476" ry=".28243" />
                    <rect transform="rotate(269.84)" x="85.224" y="-640.95" width="58.372" height="10.477" ry=".28245" />
                  </g>
                </g>
              </svg>
              <div class="ml-4 text-white text-2xl">GroupCare</div>
            </div>
            <button @click.stop="sidebarOpen = true" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150" aria-label="Open sidebar">
              <svg class="h-6 w-6" x-description="Heroicon name: menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>


          </div>


          
          <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0" >
            <div class="pt-2 pb-6 md:py-6">
              <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                @hasSection('pagetitle')
                <div class="text-2xl font-semibold text-gray-500 mb-4">
                  @yield('pagetitle')
                </div>
                @endif
              </div>
              <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-24 ">
                <!-- page content -->
                @yield('content')
                <!-- content -->
              </div>
            </div>
          </main>
        </div>
      </div>

    </div>
 
  <div style="clear: both; display: block; height: 0px;"></div>

  @livewireScripts
</body>

</html>