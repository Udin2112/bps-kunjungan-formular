<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BPS</title>
    <!-- ✅ Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-sm 
                bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900
                rounded-2xl shadow-2xl p-6 border border-blue-800/30 text-white">

        <!-- 🔹 Logo -->
        <div class="flex justify-center mb-5">
            <div class="w-14 h-14 bg-white/20 
                        rounded-full flex items-center justify-center shadow-lg">
                <span class="text-white font-bold text-sm">BPS</span>
            </div>
        </div>

        <!-- 🔹 Judul -->
        <div class="text-center mb-5">
            <h2 class="text-xl font-bold text-white">Selamat Datang 👋</h2>
            <p class="text-xs text-blue-200">Silakan login untuk melanjutkan</p>
        </div>

        <!-- 🔹 Form Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-3">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-medium text-blue-100">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                    required autofocus autocomplete="username"
                    placeholder="Masukkan alamat email Anda"
                    class="w-full px-3 py-2 rounded-lg border border-blue-300/40 
                           focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 
                           bg-white/90 text-gray-900 placeholder-gray-500 shadow-inner">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-medium text-blue-100">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Masukkan password Anda"
                    class="w-full px-3 py-2 rounded-lg border border-blue-300/40 
                           focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 
                           bg-white/90 text-gray-900 placeholder-gray-500 shadow-inner">
            </div>

            <!-- Remember Me & Lupa Password -->
            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center space-x-2 text-blue-100">
                    <input type="checkbox" name="remember" 
                           class="rounded border-blue-400/40 text-yellow-400 focus:ring-yellow-400">
                    <span>Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-yellow-300 hover:text-yellow-400">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Tombol Login -->
            <button type="submit" 
                class="w-full py-2.5 px-4 rounded-lg text-gray-900 font-semibold 
                       bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 
                       hover:from-yellow-300 hover:to-yellow-500 
                       transition duration-200 shadow-lg hover:shadow-yellow-500/50">
                🚀 Login
            </button>
        </form>

        <!-- 🔹 Footer -->
        <div class="mt-5 text-center text-[11px] text-blue-200">
            © 2025 <span class="font-semibold text-white">BPS</span>. All rights reserved.
        </div>
    </div>

</body>
</html>