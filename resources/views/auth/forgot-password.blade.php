<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <h2 class="text-4xl font-bold text-white mb-2">
                    Lupa Password?
                </h2>
                <p class="text-indigo-300">
                    Jangan khawatir, kami akan mengirimkan link reset
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-indigo-900/50 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-indigo-800/30">
                <!-- Description -->
                <div class="mb-6 text-sm text-indigo-200 bg-indigo-800/30 rounded-lg p-4 border border-indigo-700/50">
                    <p>
                        {{ __('Masukkan email Anda dan kami akan mengirimkan link untuk reset password. Link tersebut akan memungkinkan Anda untuk membuat password baru.') }}
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                            placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Submit Button -->
                    <div class="space-y-4">
                        <x-primary-button class="w-full justify-center bg-white text-indigo-900 hover:bg-indigo-100 font-bold py-3 rounded-lg transition transform hover:scale-105 shadow-xl">
                            {{ __('Kirim Link Reset Password') }}
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

            <!-- Help Text -->
            <div class="text-center">
                <p class="text-indigo-400 text-xs">
                    Belum menerima email? Periksa folder spam atau
                    <a href="#" class="text-indigo-300 hover:text-white underline">hubungi support</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
