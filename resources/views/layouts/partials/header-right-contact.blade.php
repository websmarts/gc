<div x-data="{ dropdownOpen: false }" class="relative">

    <button @click="dropdownOpen = !dropdownOpen" class="bg-gray-300 hover:bg-gray-400 focus:outline-none text-gray-700 py-2 px-4 rounded-lg">
        {{ Auth::user()->name }}
    </button>

    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

    <div x-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-80  bg-white rounded-md shadow-xl z-20">
        <a href="/user/profile" class="block border-gray-400  border-t-0 border-b-2 px-4 py-2 text-sm text-white bg-indigo-700 hover:bg-indigo-600 ">Change Password</a>




        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a class="block px-4 py-2 text-sm text-white bg-indigo-700 hover:bg-indigo-600 " href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
        </form>

        

        @impersonating
        <a class="block px-4 py-2 text-sm text-white bg-red-700 hover:bg-indigo-600 " href="{{ route('impersonate.stop') }}">Stop Impersonating</a>
        @endImpersonating

    </div>
</div>