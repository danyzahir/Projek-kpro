<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200">

    <!-- HEADER -->
    <header class="w-full bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-gray-800">
                    Sistem Monitoring 
                </h1>
                <p class="text-sm text-gray-500">
                    Unit Optima – PT Telkom 
                </p>
            </div>
        </div>
    </header>

    <!-- CONTENT -->
    <main class="max-w-6xl mx-auto px-6 py-12">

        <h2 class="text-lg font-semibold text-gray-700 mb-8">
            Dashboard Menu
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- CARD QE -->
            <div
                class="relative h-56
                       bg-gradient-to-br from-green-500 to-green-700
                       rounded-3xl shadow-lg
                       p-6 flex flex-col justify-between
                       overflow-hidden
                       transform transition-all duration-300
                       hover:scale-105 hover:shadow-2xl cursor-pointer">

                <!-- Watermark -->
                <svg class="absolute -right-8 -bottom-8 w-44 h-44 text-white opacity-10"
                    xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2a4 4 0 014-4h4" />
                </svg>

                <!-- Icon -->
                <div class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-10 h-10"
                        fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2a4 4 0 014-4h4" />
                    </svg>
                </div>

                <!-- Text -->
                <div>
                    <h3 class="text-xl font-semibold text-white">QE</h3>
                    <p class="text-sm text-white/80 mt-1">
                        Quality Evaluation
                    </p>
                </div>
            </div>

            <!-- CARD DEPLOYMENT -->
            <a href="{{ route('deployment.b2b') }}"
                class="relative h-56
                       bg-gradient-to-br from-orange-400 to-orange-600
                       rounded-3xl shadow-lg
                       p-6 flex flex-col justify-between
                       overflow-hidden
                       transform transition-all duration-300
                       hover:scale-105 hover:shadow-2xl">

                <!-- Watermark -->
                <svg class="absolute -right-8 -bottom-8 w-44 h-44 text-white opacity-10"
                    xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7h18M3 12h18M3 17h18" />
                </svg>

                <!-- Icon -->
                <div class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-10 h-10"
                        fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>

                <!-- Text -->
                <div>
                    <h3 class="text-xl font-semibold text-white">Deployment</h3>
                    <p class="text-sm text-white/80 mt-1">
                        Monitoring & Manajemen Data
                    </p>
                </div>
            </a>

        </div>
    </main>

</body>
</html>
