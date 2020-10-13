  <!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="referrer" content="always">
      <link rel="canonical" href="{{ Request::url() }}">



      <meta name="description" content="page description">

      <title>Groupcare - @yield('title') </title>

      <link rel="stylesheet" href="{{ asset('css/app.css') }}">

      @livewireStyles

      <script src="https://kit.fontawesome.com/a824341b0f.js" crossorigin="anonymous"></script>

      <!-- <script src="{{ asset('js/app.js') }}"></script> -->

      <!-- Scripts -->
      <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>


  </head>

  <body>
      <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">

          @include('layouts.partials.sidebar')

          <div class="flex-1 flex flex-col overflow-hidden">

              @include('layouts.partials.header')

              <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                  <x-flash-messages />

                  <div class="container mx-auto px-6 py-8">
                      
                      @yield('content')
                      
                  </div>
                  @yield('modals')
              </main>
          </div>
      </div>
      <!-- layout from https://dashboard-tailwindcomponents.netlify.app/tables/ -->
      @livewireScripts
  </body>

  </html>