<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Menunggu Persetujuan Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center max-w-md w-full">

            <div class="mb-4">
                <svg class="mx-auto w-12 h-12 text-yellow-500"
                    fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                </svg>
            </div>

            <h1 class="text-xl font-semibold text-slate-800 mb-2">
                Menunggu Persetujuan Admin
            </h1>

            <p class="text-sm text-slate-500 mb-6">
                Akun kamu sudah berhasil terdaftar, namun belum aktif.
                Silakan tunggu admin memberikan akses.
            </p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="px-6 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                    Kembali ke Login
                </button>
            </form>

        </div>
    </div>

</body>

</html>