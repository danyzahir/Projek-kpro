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

<!-- ❗ BODY TIDAK BOLEH SCROLL -->
<body class="bg-gray-100 h-screen overflow-hidden">

<div x-data="{ sidebarOpen: true }" class="flex h-full">

    <!-- SIDEBAR (STAY) -->
    <x-sidebar />

    <!-- CONTENT AREA -->
    <div
        :class="sidebarOpen ? 'ml-64' : 'ml-0'"
        class="flex flex-col flex-1 transition-all duration-300 overflow-hidden"
    >

        <!-- 🔒 NAVBAR STAY -->
        <header class="sticky top-0 z-50">
            <x-navbar />
        </header>

        <!-- ✅ MAIN CONTENT SCROLL DI SINI -->
        <main class="flex-1 overflow-y-auto overflow-x-hidden p-6">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>
