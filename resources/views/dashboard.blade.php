<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Dashboard
                </h2>
                <p class="text-sm text-gray-600 mt-1">Selamat datang kembali, {{ Auth::user()->name }}</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-white rounded-lg border border-gray-200">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm text-gray-600">{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Main Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Buat Dokumen - Primary Card -->
            <a href="{{ route('rpp.create') }}" class="group relative bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>

                <div class="relative z-10">
                    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Buat Dokumen</h3>
                    <p class="text-indigo-100 text-sm">Generate RPP dengan AI secara otomatis</p>

                    <div class="mt-6 flex items-center text-white text-sm font-medium">
                        <span>Mulai Sekarang</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Lihat Riwayat -->
            <a href="{{ route('antrian.list') }}" class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-gray-100 hover:border-indigo-200">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Lihat Riwayat</h3>
                <p class="text-gray-600 text-sm mb-6">Akses semua dokumen yang pernah dibuat</p>

                <div class="flex items-center text-indigo-600 text-sm font-medium group-hover:text-indigo-700">
                    <span>Lihat Semua</span>
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>

            <!-- Edit Profile -->
            <a href="{{ route('profile.edit') }}" class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-gray-100 hover:border-indigo-200">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Edit Profile</h3>
                <p class="text-gray-600 text-sm mb-6">Kelola informasi akun Anda</p>

                <div class="flex items-center text-indigo-600 text-sm font-medium group-hover:text-indigo-700">
                    <span>Pengaturan</span>
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>
        </div>

        <!-- Statistics Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">Statistik Dokumen</h3>
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Overview</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Total Dokumen -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 border-2 border-indigo-200 group-hover:border-indigo-300 transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-indigo-900 mb-1">{{ $totalDokumen ?? 0 }}</p>
                            <p class="text-sm font-medium text-indigo-700">Total Dokumen</p>
                        </div>
                    </div>
                </div>

                <!-- Dalam Proses -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border-2 border-blue-200 group-hover:border-blue-300 transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-blue-900 mb-1">{{ $dalamProses ?? 0 }}</p>
                            <p class="text-sm font-medium text-blue-700">Dalam Proses</p>
                        </div>
                    </div>
                </div>

                <!-- Berhasil -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-green-600 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border-2 border-green-200 group-hover:border-green-300 transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-green-900 mb-1">{{ $berhasil ?? 0 }}</p>
                            <p class="text-sm font-medium text-green-700">Berhasil</p>
                        </div>
                    </div>
                </div>

                <!-- Gagal -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-500 to-red-600 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 border-2 border-red-200 group-hover:border-red-300 transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-red-900 mb-1">{{ $gagal ?? 0 }}</p>
                            <p class="text-sm font-medium text-red-700">Gagal</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Bar (Optional) -->
            @if(($totalDokumen ?? 0) > 0)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium text-gray-700">Success Rate</span>
                    <span class="text-sm font-bold text-indigo-600">{{ round((($berhasil ?? 0) / ($totalDokumen ?? 1)) * 100) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all duration-500 shadow-sm"
                         style="width: {{ round((($berhasil ?? 0) / ($totalDokumen ?? 1)) * 100) }}%"></div>
                </div>
            </div>
            @endif
        </div>

        <!-- Quick Tips (Optional) -->
        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 border-2 border-amber-200">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-amber-900 mb-2">Tips Penggunaan</h4>
                    <p class="text-sm text-amber-800 leading-relaxed">Pastikan data yang Anda masukkan lengkap dan sesuai untuk hasil RPP yang optimal. Anda dapat mengedit dokumen setelah proses generate selesai.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Add custom animation for slow spin -->
    <style>
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow {
            animation: spin-slow 3s linear infinite;
        }
    </style>
</x-app-layout>
