<x-app-layout>


    <x-slot name="pagetitle">Dashboard</x-slot>



<div>
  <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
    <div class="bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
            <!-- Heroicon name: cursor-click -->
            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
            </svg>
            
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                Select Organisation.
              </dt>
              <dd class="flex items-baseline">
                <div class="text-md leading-8 font-semibold text-gray-900">
                 
            
                
                <livewire:organisation-selector />

            
                </div>
                
              </dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-4 sm:px-6">
        <div class="text-sm leading-5">
          <a href="{{ route('organisation.register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
            Register a new Organisation
          </a>
        </div>
      </div>
    </div>
    <div class="bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
            <!-- Heroicon name: mail-open -->
            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
            </svg>
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                Membership options
              </dt>
              <dd class="flex items-baseline">
                <div class=" leading-8 font-semibold text-gray-900">
                  @foreach(auth()->user()->selectedOrganisation()->membershipTypes()->get() as $mt)
                   <p>{{ $mt->name }}</p>
                  @endforeach
                </div>
                
              </dd>
            </dl>
          </div>
        </div>
      </div>
      
    </div>
    <div class="bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
            <!-- Heroicon name: users -->
            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                Member count
              </dt>
              <dd class="flex items-baseline">
                <div class="text-2xl leading-8 font-semibold text-gray-900">
                  {{ auth()->user()->selectedOrganisation()->members()->count() }}
                </div>
                
              </dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


</x-app-layout>