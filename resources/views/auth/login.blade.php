<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen relative overflow-hidden font-sans">

    <!-- BACKGROUND -->
    <img
        src="{{ asset('images/poto1.jpg') }}"
        class="absolute inset-0 w-full h-full object-cover"
        alt="Background"
    >

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <!-- CONTENT -->
    <div class="relative min-h-screen flex items-center justify-center px-4">

        <!-- CARD -->
        <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2
                    bg-white/80 backdrop-blur-xl
                    rounded-3xl shadow-2xl overflow-hidden">

            <!-- LEFT IMAGE -->
            <div class="hidden md:block relative">
                <img
                    src="https://educ.gramedia.com/wp-content/uploads/2022/12/istockphoto-1154341677-170667a.jpg"
                    class="absolute inset-0 w-full h-full object-cover"
                    alt="Login Visual"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
            </div>

            <!-- RIGHT FORM -->
            <div class="p-10 md:p-14 flex flex-col justify-center">

                <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">
                    Welcome Back
                </h2>
                <p class="text-gray-600 text-center mb-8">
                    Please login to your account
                </p>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- EMAIL -->
                    <div>
                        <input
                            type="email"
                            name="email"
                            placeholder="Email"
                            required
                            class="w-full px-5 py-3 rounded-full
                                   bg-white border border-gray-300
                                   focus:ring-2 focus:ring-red-400
                                   focus:outline-none"
                        >
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            required
                            class="w-full px-5 py-3 rounded-full
                                   bg-white border border-gray-300
                                   focus:ring-2 focus:ring-red-400
                                   focus:outline-none"
                        >
                    </div>

                    <!-- REMEMBER -->
                    <div class="flex items-center justify-between text-sm text-gray-600">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded text-red-500 focus:ring-red-400"
                            >
                            Remember me
                        </label>
                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full py-3 rounded-full font-semibold
                               bg-red-500 hover:bg-red-600
                               transition text-white shadow-lg"
                    >
                        Login
                    </button>

                    <p class="text-sm text-center text-slate-500 mt-4">
    Belum punya akun?
    <a href="{{ route('register') }}"
       class="text-red-600 font-medium hover:underline">
        Daftar
    </a>
</p>


                </form>

            </div>
        </div>
    </div>

</body>
</html>
