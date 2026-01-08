<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">

        <!-- CARD QE -->
        <div
            class="relative w-60 h-60
                   bg-gradient-to-br from-green-500 to-green-700
                   rounded-3xl shadow-lg
                   p-6 flex flex-col justify-between
                   overflow-hidden
                   transform transition-all duration-300
                   hover:-translate-y-2 hover:shadow-2xl cursor-pointer">

            <!-- Background Logo / Watermark -->
            <svg class="absolute -right-6 -bottom-6 w-40 h-40 text-white opacity-10"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-2a4 4 0 014-4h4" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 9V7a4 4 0 00-4-4H9" />
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

            <!-- Title -->
            <span class="text-white text-xl font-semibold tracking-wide">
                QE
            </span>
        </div>

        <!-- CARD DEPLOYMENT -->
        <a href="{{ route('deployment.b2b') }}"
            class="relative w-60 h-60
                   bg-gradient-to-br from-orange-400 to-orange-600
                   rounded-3xl shadow-lg
                   p-6 flex flex-col justify-between
                   overflow-hidden
                   transform transition-all duration-300
                   hover:-translate-y-2 hover:shadow-2xl">

            <!-- Background Logo / Watermark -->
            <svg class="absolute -right-6 -bottom-6 w-40 h-40 text-white opacity-10"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
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

            <!-- Title -->
            <span class="text-white text-xl font-semibold tracking-wide">
                Deployment
            </span>
        </a>

    </div>

</body>

</html>
