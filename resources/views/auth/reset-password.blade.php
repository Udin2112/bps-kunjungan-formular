<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-white p-6">
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
                <h2 class="text-xl sm:text-2xl font-bold text-white">Reset Password 🔒</h2>
                <p class="text-sm sm:text-base text-blue-200 mt-2 leading-relaxed">
                    Masukkan email dan password baru Anda.
                </p>
            </div>

            <!-- 🔹 Form Reset Password -->
            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-medium text-blue-100">Email</label>
                    <input id="email" type="email" name="email" 
                           value="{{ old('email', $request->email) }}" required autofocus
                           placeholder="Masukkan alamat email Anda"
                           class="w-full px-3 py-2 rounded-lg border border-blue-300/40 
                                  focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 
                                  bg-white/90 text-gray-900 placeholder-gray-500 shadow-inner">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-yellow-200" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-medium text-blue-100">Password Baru</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           placeholder="Masukkan password baru Anda"
                           class="w-full px-3 py-2 rounded-lg border border-blue-300/40 
                                  focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 
                                  bg-white/90 text-gray-900 placeholder-gray-500 shadow-inner">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-yellow-200" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-medium text-blue-100">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           placeholder="Ulangi password baru Anda"
                           class="w-full px-3 py-2 rounded-lg border border-blue-300/40 
                                  focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 
                                  bg-white/90 text-gray-900 placeholder-gray-500 shadow-inner">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-yellow-200" />
                </div>

                <!-- Tombol -->
                <div class="flex items-center justify-center">
                    <button type="submit" 
                        class="px-6 py-2 rounded-lg text-gray-900 font-semibold 
                               bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 
                               hover:from-yellow-300 hover:to-yellow-500 
                               transition duration-200 shadow-lg hover:shadow-yellow-500/50">
                        Reset Password
                    </button>
                </div>
            </form>

            <!-- 🔹 Footer -->
            <div class="mt-6 text-center text-[11px] text-blue-200">
                © 2025 <span class="font-semibold text-white">BPS</span>. All rights reserved.
            </div>
        </div>
    </div>
</x-guest-layout>