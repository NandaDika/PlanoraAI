<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informasi Akun') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil akun dan alamat email Anda.") }}
        </p>
    </x-slot>

    <div class="py-12">

        @if (is_null(auth()->user()->password))
    <div class="bg-yellow-100 text-yellow-800 p-3 rounded">
        Akun ini telah terkoneksi dengan akun Google.
        <a href="{{ route('profile.edit') }}" class="underline font-medium">
            Buat password baru
        </a>
        agar dapat login menggunakan email.
    </div>
@endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            @if (Auth::user()->has_password == 1)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            @else
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Update Password') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Anda masuk menggunakan akun Google. Jika ingin mengatur ulang kata sandi, silakan gunakan fitur ') }}
                            <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-indigo-900 underline font-semibold">
                                Lupa Password
                            </a>.
                        </p>
                    </div>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
