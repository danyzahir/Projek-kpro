<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login XPRO</title>
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
                    grid grid-cols-1 md:grid-cols-2 min-h-[520px]">

            <!-- LEFT IMAGE (NGIKUT CARD) -->
            <div class="hidden md:block relative">
                <img
                    src="{{ asset('images/poto1.jpg') }}"
                    alt="Login Image"
                    class="absolute inset-0 w-full h-full object-cover"
                >
            </div>

            <!-- RIGHT FORM -->
            <div class="p-12 flex flex-col justify-center">
                <h2 class="text-2xl font-semibold mb-6 text-center">Login</h2>

                <form method="POST"
                      action="{{ route('login') }}"
                      autocomplete="off"
                      class="space-y-5">
                    @csrf

                    <!-- USERNAME -->
                    <input
                        type="email"
                        name="email"
                        placeholder="Username"
                        value=""
                        autocomplete="off"
                        required
                        class="w-full rounded-full px-5 py-3 bg-blue-50
                               border border-blue-200
                               focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >

                    <!-- PASSWORD -->
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        value=""
                        autocomplete="new-password"
                        required
                        class="w-full rounded-full px-5 py-3 bg-blue-50
                               border border-blue-200
                               focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >

                    <!-- REMEMBER ME -->
                    <div class="flex items-center text-sm text-gray-600">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded border-gray-300 text-blue-500
                                       focus:ring-blue-400"
                            >
                            Remember me
                        </label>
                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600
                               text-white py-3 rounded-full font-semibold"
                    >
                        Login
                    </button>

                </form>
            </div>

        </div>
    </div>

</body>
</html>
