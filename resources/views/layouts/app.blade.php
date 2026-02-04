<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important
        }
    </style>
</head>

<body class="bg-neutral-100 text-neutral-800 antialiased">

    <div
        x-data="{
        sidebarOpen: true,
        userMenu: false
    }"
        class="min-h-screen">

        <!-- ================= SIDEBAR ================= -->
        <aside
            x-cloak
            class="fixed inset-y-0 left-0 z-40
               bg-white border-r border-neutral-200
               transition-all duration-300 ease-in-out
               flex flex-col"
            :class="sidebarOpen ? 'w-64' : 'w-20'">

            <!-- LOGO -->
            <div class="h-16 flex items-center px-6 border-b border-neutral-200"
                :class="!sidebarOpen ? 'justify-center px-0' : ''">

                <div x-show="sidebarOpen" x-transition.opacity class="leading-tight">
                    <div class="font-semibold text-base text-red-600">
                        Monitoring Proyek
                    </div>
                    <div class="text-xs text-slate-500">
                        Unit Optima · PT Telkom Indonesia
                    </div>
                </div>

                <span class="font-bold text-xl text-red-600"
                    x-show="!sidebarOpen">
                    M
                </span>
            </div>


            <!-- MENU -->
            <nav class="p-4 space-y-1 text-sm">
                @if(auth()->user()->role === 'admin')
                <!-- ================= AKUN ================= -->
                <a href="{{ route('admin.users') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium
   transition duration-200
   {{ request()->routeIs('admin.users')
        ? 'bg-red-50 text-red-600 shadow-sm'
        : 'text-gray-700 hover:bg-gray-100' }}"
                    :class="!sidebarOpen ? 'justify-center px-0' : ''">

                    <!-- ICON USER -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 12a4 4 0 100-8 4 4 0 000 8zm0 2
               c-3.314 0-6 1.343-6 3v1h12v-1
               c0-1.657-2.686-3-6-3z" />
                    </svg>

                    <span x-show="sidebarOpen" x-transition.opacity>
                        Akun
                    </span>
                </a>
                @endif


                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.master-input') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium
    transition duration-200
    {{ request()->routeIs('admin.master-input')
        ? 'bg-red-50 text-red-600 shadow-sm'
        : 'text-gray-700 hover:bg-gray-100' }}"
                    :class="!sidebarOpen ? 'justify-center px-0' : ''">

                    <!-- ICON DATABASE -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6c0 1.657 3.582 3 8 3s8-1.343 8-3
               -3.582-3-8-3-8 1.343-8 3zm0 6c0 1.657 3.582 3 8 3s8-1.343 8-3
               m-16 6c0 1.657 3.582 3 8 3s8-1.343 8-3" />
                    </svg>

                    <span x-show="sidebarOpen" x-transition.opacity>
                        Master Input
                    </span>
                </a>
                @endif


                <!-- DASHBOARD -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium transition
               {{ request()->routeIs('dashboard')
                    ? 'bg-red-50 text-red-600'
                    : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5" />
                    </svg>
                    <span x-show="sidebarOpen" x-transition.opacity>Dashboard</span>
                </a>

                <!-- B2B -->
                <div
                    x-data="{
                    open: {{ request()->routeIs('deployment.*') ? 'true' : 'false' }},
                    init(){
                        this.$watch('$root.sidebarOpen', v => {
                            if(!v) this.open = false
                        })
                    }
                }"
                    class="pt-2">

                    <button
                        @click="open = !open"
                        class="flex items-center justify-between w-full
                           px-4 py-2.5 rounded-xl font-medium transition
                    {{ request()->routeIs('deployment.*')
                        ? 'bg-red-50 text-red-600'
                        : 'text-gray-700 hover:bg-gray-100' }}">

                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 7a2 2 0 012-2h5l2 2h7
                                     a2 2 0 012 2v8a2 2 0 01-2 2H5
                                     a2 2 0 01-2-2V7z" />
                            </svg>
                            <span x-show="sidebarOpen" x-transition.opacity>
                                B2B Deployment
                            </span>
                        </span>

                        <svg x-show="sidebarOpen"
                            class="w-4 h-4 transition-transform"
                            :class="open ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- SUBMENU -->
                    <div
                        x-cloak
                        x-show="open && sidebarOpen"
                        x-transition.opacity
                        class="ml-4 mt-2 pl-4 space-y-1 border-l border-gray-200">

                        @php
                        $a = 'bg-red-100 text-red-600 font-medium';
                        $n = 'text-gray-700 hover:bg-gray-100';
                        @endphp

                        <a href="{{ route('deployment.upload') }}"
                            class="block px-3 py-2 rounded-lg {{ request()->routeIs('deployment.upload') ? $a : $n }}">
                            Upload Data
                        </a>

                        <a href="{{ route('deployment.input') }}"
                            class="block px-3 py-2 rounded-lg {{ request()->routeIs('deployment.input') ? $a : $n }}">
                            Input Data
                        </a>

                        <a href="{{ route('deployment.update') }}"
                            class="block px-3 py-2 rounded-lg {{ request()->routeIs('deployment.update') ? $a : $n }}">
                            Update Data
                        </a>

                        <a href="{{ route('deployment.rekap') }}"
                            class="block px-3 py-2 rounded-lg {{ request()->routeIs('deployment.rekap') ? $a : $n }}">
                            Lihat Data
                        </a>
                    </div>
                </div>

            </nav>
        </aside>

        <!-- ================= NAVBAR ================= -->
        <header
            class="fixed top-0 right-0 z-30 h-16 bg-white border-b
               flex items-center justify-between px-6 transition-all duration-300"
            :class="sidebarOpen ? 'left-64' : 'left-20'">

            <button
                @click="sidebarOpen = !sidebarOpen"
                class="p-2 rounded-lg hover:bg-neutral-100">
                <svg class="w-5 h-5 text-neutral-600" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div x-data="{ userMenu: false }" class="relative">

                <!-- Avatar Button -->
                <button
                    @click="userMenu = !userMenu"
                    class="flex items-center focus:outline-none">
                    <img
                        src="https://ui-avatars.com/api/?name=Admin&background=ef4444&color=fff"
                        class="w-9 h-9 rounded-full"
                        alt="User Avatar">
                </button>

                <!-- Dropdown -->
                <div
                    x-show="userMenu"
                    @click.outside="userMenu = false"
                    x-transition
                    class="absolute right-0 mt-2 w-40
               bg-white border border-gray-200
               rounded-lg shadow-lg overflow-hidden z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="block w-full text-left px-4 py-3 text-sm
                       text-gray-700 hover:bg-gray-100 transition">
                            Logout
                        </button>
                    </form>
                </div>

            </div>

        </header>

        <!-- ================= MAIN ================= -->
        <main
            class="pt-20 transition-all duration-300"
            :class="sidebarOpen ? 'ml-64' : 'ml-20'">
            <div class="p-6">
                @yield('content')
            </div>
        </main>

    </div>

</body>

</html>