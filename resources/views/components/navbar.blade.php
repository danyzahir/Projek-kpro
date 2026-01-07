<header class="h-16 bg-red-600 text-white flex items-center px-6 shadow">

    <!-- LEFT -->
    <div class="flex items-center gap-4">
        <!-- Hamburger -->
        <button @click="sidebarOpen = !sidebarOpen">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-6 h-6"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- RIGHT -->
    <div x-data="{ open: false }" class="relative ml-auto">

        <button @click="open = !open"
                class="flex items-center gap-2 text-white
                       hover:text-red-200 transition">

            <!-- USER ICON -->
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-6 h-6"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>

            <span class="text-sm font-medium">
                Admin
            </span>
        </button>

        
        <div
            x-cloak
            x-show="open"
            style="display:none"
            @click.outside="open = false"
            class="absolute right-0 mt-2 w-40
                   bg-white text-gray-700
                   rounded shadow">

            <!-- PROFILE -->
            <a href="#"
               @click="open = false"
               class="block px-4 py-2 hover:bg-gray-100">
                Profile
            </a>

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        @click="open = false"
                        class="block w-full text-left px-4 py-2
                               hover:bg-gray-100">
                    Logout
                </button>
            </form>

        </div>

    </div>

</header>
