<header class="flex justify-between items-center py-4 px-6 bg-white  border-b-2  border-teal-700 ">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

       

        <span class="text-4xl text-gray-700 px-4">Groupcare</span>
    </div>
    
    <div class="flex items-center">

        @hasrole('membership-manager member contact')

            @include('layouts.partials.header-right-contact')
            
        @elsehasrole( 'system-administrator account-manager') 

            @include('layouts.partials.header-right-user')

        @endhasrole
        
       
        
        
    </div>
</header>