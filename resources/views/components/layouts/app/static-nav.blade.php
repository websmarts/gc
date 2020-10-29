<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex flex-col flex-grow bg-teal-800 pb-1 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4 bg-teal-900 pt-2 pb-1">
                <img class="h-12 w-auto" src="/images/brand_logo.svg" alt="GroupCare">
                <span class="block px-2 text-white text-3xl">GroupCare</span>
            </div>
            <div class="mt-10 flex-1 flex flex-col">

                <nav class="flex-1   space-y-1">

                    <x-layouts.app.nav-link  color="teal" to="{{ route('dashboard') }}">Dashboard</x-layouts.app.nav-link>
                    <x-nav.spacer></x-nav.spacer>

                    @if(Auth::user()->selectedOrganisation())
                        <x-layouts.app.nav-link  color="teal" to="{{ route('organisation.profile.edit',['organisation'=>Auth::user()->selectedOrganisation()]) }}">Organisation profile</x-layouts.app.nav-link>
                    
                        <x-layouts.app.nav-link  color="teal" to="{{ route('membershiptypes') }}">Membership options</x-layouts.app.nav-link>
                        <x-layouts.app.nav-link  color="teal" to="{{ route('members.register') }}">Membership register</x-layouts.app.nav-link>
                        <x-layouts.app.nav-link  color="teal" to="#">Contacts</x-layouts.app.nav-link>
                        <x-layouts.app.nav-link  color="teal" to="#">Communications</x-layouts.app.nav-link>
                        <x-layouts.app.nav-link  color="teal" to="#">Settings</x-layouts.app.nav-link>

                    @endif
    
                </nav>
            </div>
        </div>
    </div>
</div>