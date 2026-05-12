<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white mb-2">
                    Selamat Datang Kembali
                </h2>
                <p class="text-indigo-300">
                    Masuk ke akun PlanoraAI Anda
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-indigo-900/50 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-indigo-800/30">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-white font-semibold mb-2" />
                        <x-text-input
                            id="email"
                            class="block mt-1 w-full bg-indigo-950/50 border-indigo-700 text-white placeholder-indigo-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg px-4 py-3"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-white font-semibold mb-2" />
                        <x-text-input
                            id="password"
                            class="block mt-1 w-full bg-indigo-950/50 border-indigo-700 text-white placeholder-indigo-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg px-4 py-3"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-indigo-600 bg-indigo-950/50 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-offset-0"
                                name="remember">
                            <span class="ms-2 text-sm text-indigo-200">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-300 hover:text-white transition" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <div class="space-y-3">
                        <x-primary-button class="w-full justify-center bg-white text-indigo-900 hover:bg-indigo-100 font-bold py-3 rounded-lg transition transform hover:scale-105 shadow-xl">
                            {{ __('Log in') }}
                        </x-primary-button>

                        <!-- Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-indigo-700/50"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-indigo-900/50 text-indigo-300">atau</span>
                            </div>
                        </div>

                        <!-- Google Login Button -->
                        <a href="{{ route('google.login') }}"
                            class="w-full flex justify-center items-center gap-3 bg-indigo-800/50 hover:bg-indigo-700/50 border border-indigo-600 text-white font-semibold rounded-lg p-3 transition transform hover:scale-105">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            Login dengan Google
                        </a>
                    </div>
                </form>

                <!-- Register Link -->
                <div class="mt-6 text-center">
                    <p class="text-indigo-300 text-sm">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-white font-semibold hover:text-indigo-200 transition">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
