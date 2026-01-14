<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen relative overflow-hidden">

    <!-- BACKGROUND IMAGE -->
    <img
        src="{{ asset('images/poto1.jpg') }}"
        alt="Background"
        class="absolute inset-0 w-full h-full object-cover"
    >

    <!-- BLUR OVERLAY -->
    <div class="absolute inset-0 backdrop-blur-md bg-white/30"></div>

    <!-- CONTENT -->
    <div class="relative min-h-screen flex items-center justify-center">

        <!-- CARD -->
        <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden
                    grid grid-cols-1 md:grid-cols-2 min-h-[560px]">

            <!-- LEFT IMAGE -->
            <div class="hidden md:block relative">
                <img
                    src="https://educ.gramedia.com/wp-content/uploads/2022/12/istockphoto-1154341677-170667a.jpg"
                    alt="Register Image"
                    class="absolute inset-0 w-full h-full object-cover"
                >
            </div>

            <!-- RIGHT FORM -->
            <div class="p-12 flex flex-col justify-center">
                <h2 class="text-2xl font-semibold mb-6 text-center">Register</h2>

                <form method="POST"
                      action="{{ route('register') }}"
                      autocomplete="off"
                      class="space-y-5">
                    @csrf

                    <!-- NAME -->
                    <div>
                        <input
                            type="text"
                            name="name"
                            placeholder="Nama Lengkap"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            class="w-full rounded-full px-5 py-3 bg-blue-50
                                   border border-blue-200
                                   focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                        @error('name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <input
                            type="email"
                            name="email"
                            placeholder="Email"
                            value="{{ old('email') }}"
                            required
                            class="w-full rounded-full px-5 py-3 bg-blue-50
                                   border border-blue-200
                                   focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                        @error('email')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            required
                            class="w-full rounded-full px-5 py-3 bg-blue-50
                                   border border-blue-200
                                   focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                        @error('password')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div>
                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Konfirmasi Password"
                            required
                            class="w-full rounded-full px-5 py-3 bg-blue-50
                                   border border-blue-200
                                   focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full bg-red-500 hover:bg-red-600
                               text-white py-3 rounded-full font-semibold"
                    >
                        Register
                    </button>

                    <!-- LINK LOGIN -->
                    <p class="text-sm text-center text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"
                           class="text-red-500 hover:underline font-semibold">
                            Login
                        </a>
                    </p>

                </form>
            </div>

        </div>
    </div>

</body>
</html>
