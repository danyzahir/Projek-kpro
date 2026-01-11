<div
    x-cloak
    x-show="sidebarOpen"
    style="display:none"
    class="fixed inset-y-0 left-0 w-64 bg-white shadow z-40
           transform transition-transform duration-300"
>
    <!-- LOGO -->
    <div class="h-16 flex items-center justify-center
                font-bold text-xl border-b">
        Monitoring Proyek
    </div>

    <nav class="p-4 space-y-2">

        <!-- ================= DASHBOARD ================= -->
        <a href="{{ route('dashboard') }}"
           @click="sidebarOpen = false"
           class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium
           {{ request()->routeIs('dashboard')
                ? 'bg-red-50 text-red-600 shadow-sm'
                : 'hover:bg-gray-100 text-gray-700' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5" />
            </svg>

            <span>Dashboard</span>
        </a>

        <!-- ================= B2B ================= -->
        <div
            x-data="{ open: {{ request()->routeIs('deployment.*') ? 'true' : 'false' }} }"
        >
            <button
                @click="open = !open"
                class="flex items-center justify-between w-full
                       px-4 py-2 rounded-lg font-medium
                {{ request()->routeIs('deployment.*')
                    ? 'bg-red-50 text-red-600 shadow-sm'
                    : 'hover:bg-gray-100 text-gray-700' }}">

                <span class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 7a2 2 0 012-2h5l2 2h7a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                    </svg>
                    <span>B2B</span>
                </span>

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-4 h-4 transform transition"
                     :class="open ? 'rotate-180' : ''"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- ================= SUBMENU ================= -->
            <div x-show="open" x-cloak class="ml-8 mt-2 space-y-1">

                <!-- UPLOAD -->
                <a href="{{ route('deployment.upload') }}"
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg
                   {{ request()->routeIs('deployment.upload')
                        ? 'bg-red-100 text-red-600 font-medium shadow'
                        : 'hover:bg-gray-100 text-gray-700' }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 16V4m0 0l-4 4m4-4l4 4M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                    </svg>

                    <span>Upload</span>
                </a>

                <!-- INPUT -->
                <a href="{{ route('deployment.input') }}"
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg
                   {{ request()->routeIs('deployment.input')
                        ? 'bg-red-100 text-red-600 font-medium shadow'
                        : 'hover:bg-gray-100 text-gray-700' }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16.862 3.487a2.121 2.121 0 013 3L7.5 18.85l-4 1 1-4L16.862 3.487z" />
                    </svg>

                    <span>Input</span>
                </a>
                <a href="#"
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg
                   {{ request()->routeIs('#')
                        ? 'bg-red-100 text-red-600 font-medium shadow'
                        : 'hover:bg-gray-100 text-gray-700' }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16.862 3.487a2.121 2.121 0 013 3L7.5 18.85l-4 1 1-4L16.862 3.487z" />
                    </svg>

                    <span>Update</span>
                </a>

                <!-- REKAP -->
                <a href="{{ route('deployment.rekap') }}"
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg
                   {{ request()->routeIs('deployment.rekap')
                        ? 'bg-red-100 text-red-600 font-medium shadow'
                        : 'hover:bg-gray-100 text-gray-700' }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h18M3 8h18M3 13h6m4 4h8M3 18h8" />
                    </svg>

                    <span>Rekap</span>
                </a>

            </div>
        </div>

    </nav>
</div>
