
    <div class="fixed inset-0 flex z-40">

        <div class="fixed inset-0">
            <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
        </div>
        <!-- Off-canvas menu, show/hide based on off-canvas menu state.-->
        <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-teal-900">
            <div class="absolute top-0 right-0 -mr-14 p-1">
                <button @click="showSidebar=false" class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none  bg-gray-500 focus:bg-gray-600 hover:bg-gray-600" aria-label="Close sidebar">
                    <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex items-center flex-shrink-0 px-4">
                <img class="h-12 w-auto" src="/images/brand_logo.svg" alt="GroupCare">
                <span class="block px-2 text-white text-3xl">GroupCare</span>
            </div>
            <div class="mt-5 flex-1 h-0 overflow-y-auto">
                <nav class="px-2 space-y-1">

                    <x-layouts.app.nav-link color="teal" to="{{ route('dashboard') }}">Dashboard</x-layouts.app.nav-link>

                    
                </nav>
            </div>
        </div>
        <div class="flex-shrink-0 w-14">
            <!-- Dummy element to force sidebar to shrink to fit close icon -->
        </div>
    </div>
