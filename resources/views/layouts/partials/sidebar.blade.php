<div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-gray-700 opacity-50 transition-opacity lg:hidden"></div>

<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" 
class="{{ Auth::user()->is_admin ? 'bg-gray-700 ': 'bg-teal-700 ' }} fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 pt-20">
    
<nav class="mt-10  border-gray-400 border-t-2">
    @hasrole('system-administrator')

        @include('layouts.partials.sidebar-admin-nav')

    @endhasrole
    
    @hasrole('account-manager')

        @include('layouts.partials.sidebar-manager-nav')

    @endhasrole

    @hasrole('membership-manager')

        @include('layouts.partials.sidebar-membership-manager-nav')

    @endhasrole

    @hasrole('member')

        @include('layouts.partials.sidebar-member-nav')

    @endhasrole

    @hasrole('contact')

        @include('layouts.partials.sidebar-contact-nav')

    @endhasrole
</nav>

</div>