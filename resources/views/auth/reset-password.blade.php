<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mb-4">
                    <div class="mx-auto w-20 h-20 bg-indigo-600 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-white mb-2">
                    Reset Password
                </h2>
                <p class="text-indigo-300">
                    Buat password baru untuk akun Anda
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-indigo-900/50 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-indigo-800/30">
                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-white font-semibold mb-2" />
                        <x-text-input
                            id="email"
                            class="block mt-1 w-full bg-indigo-950/50 border-indigo-700 text-white placeholder-indigo-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg px-4 py-3"
                            type="email"
                            name="email"
                            :value="old('email', $request->email)"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password Baru')" class="text-white font-semibold mb-2" />
                        <x-text-input
                            id="password"
                            class="block mt-1 w-full bg-indigo-950/50 border-indigo-700 text-white placeholder-indigo-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg px-4 py-3"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                        <p class="mt-2 text-xs text-indigo-400">
                            Password harus minimal 8 karakter
                        </p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-white font-semibold mb-2" />
                        <x-text-input
                            id="password_confirmation"
                            class="block mt-1 w-full bg-indigo-950/50 border-indigo-700 text-white placeholder-indigo-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg px-4 py-3"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi password baru" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Submit Button -->
                    <div class="space-y-4 pt-2">
                        <x-primary-button class="w-full justify-center bg-white text-indigo-900 hover:bg-indigo-100 font-bold py-3 rounded-lg transition transform hover:scale-105 shadow-xl">
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Back to Login Link -->
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center text-indigo-300 hover:text-white transition text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Security Note -->
            <div class="text-center">
                <p class="text-indigo-400 text-xs">
                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                    Password Anda akan dienkripsi dengan aman
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
