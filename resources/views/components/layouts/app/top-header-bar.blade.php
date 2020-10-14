<div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
    <button @click="showSidebar = true" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600 md:hidden" aria-label="Open sidebar">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
        </svg>
    </button>
    <div class="flex-1 px-4 flex justify-between">
        <div class="flex-1 flex">
            <div class="flex items-center flex-shrink-0 px-4 md:hidden">
                <svg class="h-12 w-auto" version="1.1" viewBox="0 0 .81444 1.1537" xmlns="http://www.w3.org/2000/svg">
                    <g transform="translate(-6.9426 -13.633)">
                        <text fill="#000000" font-family="sans-serif" font-size="10.583px" style="line-height:1.25;shape-inside:url(#rect957);white-space:pre" xml:space="preserve" />
                        <path d="m7.3499 13.635c-0.13455 0.34027-0.40651 0.44762-0.40651 0.44762s0.047047 0.35858 0.40651 0.70336c0.36398-0.34478 0.40647-0.70336 0.40647-0.70336s-0.27353-0.10735-0.40647-0.44762zm0.011167 0.34924a0.15645 0.23187 0 0 1 0.15645 0.23185 0.15645 0.23187 0 0 1-0.15645 0.23185 0.15645 0.23187 0 0 1-0.15645-0.23185 0.15645 0.23187 0 0 1 0.15645-0.23185z" fill="#014451" stroke="#000" stroke-width=".0013435px" />
                        <g transform="matrix(.0016122 .0036509 -.0023005 .0036925 8.1482 16.957)" fill="#014451">
                            <rect transform="matrix(.99936 -.035646 .0043443 .99999 0 0)" x="-661.52" y="-116.76" width="20.383" height="10.476" ry=".28243" />
                            <rect transform="rotate(269.84)" x="85.224" y="-640.95" width="58.372" height="10.477" ry=".28245" />
                        </g>
                    </g>
                </svg>
                <span class="block px-2 text-teal-900 text-3xl">GroupCare</span>
            </div>
        </div>
        <div class="ml-4 flex items-center md:ml-6">
            <button class="p-1 text-gray-400 rounded-full hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:shadow-outline focus:text-gray-500" aria-label="Notifications">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>

            <!-- Profile dropdown -->
            <div x-data="{showProfileDropdown:false}" class="ml-3 relative">
                <div>
                    <button @click="showProfileDropdown= !showProfileDropdown" class="max-w-xs flex items-center text-sm focus:outline-none" id="user-menu" aria-label="User menu" aria-haspopup="true">
                        {{ Auth::user()->name }}
                    </button>
                </div>
                <!-- Profile dropdown panel, show/hide based on dropdown state. -->
                <div @click.away="showProfileDropdown = false" x-show="showProfileDropdown" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                    <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150" role="menuitem">Your Profile</a>

                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150" role="menuitem">Settings</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="block px-4 py-2 text-sm text-gray-700  hover:bg-gray-100 " href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>