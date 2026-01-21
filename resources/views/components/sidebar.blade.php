<div x-cloak x-show="sidebarOpen" style="display:none"
    class="fixed inset-y-0 left-0 w-64 bg-white
           shadow-xl z-40
           transform transition-transform duration-300">

    <!-- LOGO -->
    <div class="h-16 flex flex-col justify-center px-6 border-b">
        <span class="font-bold text-lg text-gray-800">
            Monitoring Proyek
        </span>
        <span class="text-xs text-gray-500">
            Unit Optima · PT Telkom Indonesia
        </span>
    </div>

    <nav class="p-4 space-y-2 text-sm">

        <!-- ================= DASHBOARD ================= -->
        <a href="#" @click="sidebarOpen = false"
            class="flex items-center gap-3 px-4 py-2 rounded-xl font-medium transition
           {{ request()->routeIs('#') ? 'bg-red-50 text-red-600 shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5" />
            </svg>

            <span>dashboard</span>
        </a>

        <a href="{{ route('dashboard') }}" @click="sidebarOpen = false"
            class="flex items-center gap-3 px-4 py-2 rounded-xl font-medium transition
             {{ request()->routeIs('dashboard') ? 'bg-red-50 text-red-600 shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h6v6H4V4zm10 0h6v6h-6V4z
                 M4 14h6v6H4v-6zm10 0h6v6h-6v-6z" />
            </svg>

            <span>Menu</span>
        </a>

        <!-- ================= B2B ================= -->
        <div x-data="{ open: {{ request()->routeIs('deployment.*') ? 'true' : 'false' }} }" class="space-y-1">

            <button @click="open = !open"
                class="flex items-center justify-between w-full
                       px-4 py-2 rounded-xl font-medium transition
                {{ request()->routeIs('deployment.*') ? 'bg-red-50 text-red-600 shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">

                <span class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7a2 2 0 012-2h5l2 2h7a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                    </svg>
                    <span>B2B Deployment</span>
                </span>

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform transition"
                    :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- ================= SUBMENU ================= -->
            <div x-show="open" x-cloak class="ml-6 mt-2 space-y-1 border-l pl-4">

                <!-- UPLOAD -->
                <a href="{{ route('deployment.upload') }}" @click="sidebarOpen = false"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                   {{ request()->routeIs('deployment.upload')
                       ? 'bg-red-100 text-red-600 font-medium shadow'
                       : 'hover:bg-gray-100 text-gray-700' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 16V4m0 0l-4 4m4-4l4 4M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                    </svg>

                    <span>Upload Data</span>
                </a>

                <!-- INPUT -->
                <a href="{{ route('deployment.input') }}" @click="sidebarOpen = false"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                    {{ request()->routeIs('deployment.input')
                        ? 'bg-red-100 text-red-600 font-medium shadow'
                        : 'hover:bg-gray-100 text-gray-700' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>

                    <span>Input Data</span>
                </a>

                <!-- UPDATE -->
                <a href="{{ route('deployment.update') }}" @click="sidebarOpen = false"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                   {{ request()->routeIs('deployment.update')
                       ? 'bg-red-100 text-red-600 font-medium shadow'
                       : 'hover:bg-gray-100 text-gray-700' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.121 2.121 0 013 3
                               L7.5 18.85l-4 1 1-4
                               L16.862 3.487z" />
                    </svg>

                    <span>Update Data</span>
                </a>

                <!-- REKAP -->
                <a href="{{ route('deployment.rekap') }}" @click="sidebarOpen = false"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                   {{ request()->routeIs('deployment.rekap')
                       ? 'bg-red-100 text-red-600 font-medium shadow'
                       : 'hover:bg-gray-100 text-gray-700' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h18M3 8h18M3 13h6m4 4h8M3 18h8" />
                    </svg>

                    <span>Rekap Data</span>
                </a>

            </div>
        </div>

    </nav>
</div>
