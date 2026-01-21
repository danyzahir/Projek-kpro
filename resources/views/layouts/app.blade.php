<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 h-screen overflow-hidden">

    <!-- FLASH MESSAGE -->
    <x-flash-success />

    <div x-data="{ sidebarOpen: true }" class="flex h-full">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN WRAPPER -->
        <div
            :class="sidebarOpen ? 'ml-64' : 'ml-0'"
            class="flex flex-col flex-1
                   transition-all duration-300 ease-in-out
                   overflow-hidden">

            <!-- HEADER -->
            <header class="sticky top-0 z-40">
                <x-navbar />
            </header>

            <!-- CONTENT -->
            <main
                class="flex-1 overflow-y-auto overflow-x-hidden
                       p-6 lg:p-8">

                @yield('content')

            </main>

        </div>
    </div>
  @stack('scripts')
</body>
</html>
