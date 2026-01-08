<!DOCTYPE html>
<html lang="id">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <title>
        @yield('title', 'Dashboard') 
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine JS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">

    <div x-data="{ sidebarOpen: true }" class="flex">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div :class="sidebarOpen ? 'ml-64' : 'ml-0'" class="flex-1 flex flex-col transition-all duration-300">
            <!-- Navbar -->
            <x-navbar />

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>
