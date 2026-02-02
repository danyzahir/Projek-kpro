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
    <style>
    [x-cloak] {
        display: none !important;
    }
</style>

</head>
<script>
    function searchableSelect(options) {
        return {
            open: false,
            search: '',
            selected: '',
            options: options,

            filtered() {
                if (this.search === '') return this.options
                return this.options.filter(o =>
                    o.toLowerCase().includes(this.search.toLowerCase())
                )
            },

            select(option) {
                this.selected = option
                this.search = option
                this.open = false
            }
        }
    }
</script>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 h-screen overflow-hidden">

    <!-- FLASH MESSAGE -->
    <x-flash-success />
    <x-flash-error />

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @stack('scripts')
</body>
</html>
