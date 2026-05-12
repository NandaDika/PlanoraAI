<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mb-4">
                    <div class="mx-auto w-20 h-20 bg-indigo-600 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-white mb-2">
                    Verifikasi Email Anda
                </h2>
                <p class="text-indigo-300">
                    Satu langkah lagi untuk memulai!
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-indigo-900/50 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-indigo-800/30">
                <!-- Description -->
                <div class="mb-6 text-sm text-indigo-200 bg-indigo-800/30 rounded-lg p-4 border border-indigo-700/50">
                    <p>
                        {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan. Jika Anda tidak menerima email, kami dengan senang hati akan mengirim ulang.') }}
                    </p>
                </div>

                <!-- Success Status -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 font-medium text-sm bg-green-900/30 text-green-300 rounded-lg p-4 border border-green-700/50 flex items-start">
                        <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>
                            {{ __('Link verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.') }}
                        </span>
                    </div>
                @endif

                <!-- Actions -->
                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <x-primary-button class="w-full justify-center bg-white text-indigo-900 hover:bg-indigo-100 font-bold py-3 rounded-lg transition transform hover:scale-105 shadow-xl">
                            {{ __('Kirim Ulang Email Verifikasi') }}
                        </x-primary-button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-center text-sm text-indigo-300 hover:text-white transition py-2">
                            {{ __('Log Out') }}
                        </button>
                    </form>
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
