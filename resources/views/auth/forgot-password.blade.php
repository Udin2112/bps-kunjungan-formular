<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - BPS</title>
    <!-- ✅ Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-sm 
                bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900
                rounded-2xl shadow-2xl p-8 border border-blue-800/30 text-white">

        <!-- 🔹 Judul -->
        <div class="text-center mb-6">
            <div class="flex justify-center mb-4">
                <!-- Icon Gembok -->
                <svg class="w-14 h-14 text-yellow-400 drop-shadow-lg" 
                     fill="none" stroke="currentColor" stroke-width="1.5" 
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M16.5 10.5V6.75A4.5 4.5 0 0 0 12 2.25a4.5 4.5 0 0 0-4.5 4.5v3.75m9 0h-9
                           m9 0a2.25 2.25 0 0 1 2.25 2.25v6.75a2.25 2.25 0 0 1-2.25 2.25h-9
                           A2.25 2.25 0 0 1 7.5 19.5v-6.75a2.25 2.25 0 0 1 2.25-2.25m9 0h-9"/>
                </svg>
            </div>
            <h2 class="text-xl sm:text-2xl font-bold text-white">Lupa Password 🔐</h2>
            <p class="text-sm sm:text-base text-blue-200 mt-2 leading-relaxed">
                Masukkan email kamu untuk menerima link reset password.
            </p>
        </div>

        <!-- 🔹 Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- 🔹 Form -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-medium text-blue-100">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                    required autofocus
                    placeholder="Masukkan alamat email Anda"
                    class="w-full px-3 py-2 rounded-lg border border-blue-300/40 
                           focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 
                           bg-white/90 text-gray-900 placeholder-gray-500 shadow-inner">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-yellow-200" />
            </div>

            <!-- Tombol -->
            <div>
                <button type="submit" 
                    class="w-full py-2.5 px-4 rounded-lg text-gray-900 font-semibold 
                           bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 
                           hover:from-yellow-300 hover:to-yellow-500 
                           transition duration-200 shadow-lg hover:shadow-yellow-500/50">
                    Kirim Link Reset
                </button>
            </div>
        </form>

        <!-- 🔹 Footer -->
        <div class="mt-6 text-center text-[11px] text-blue-200">
            © 2025 <span class="font-semibold text-white">BPS</span>. All rights reserved.
        </div>
    </div>

</body>
</html>