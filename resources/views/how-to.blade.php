<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlanoraAI - Automatisasi Rancangan Pembelajaran SMK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .card-3d {
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform 0.3s ease;
        }

        .card-3d:hover {
            transform: perspective(1000px) rotateY(0deg) scale(1.05);
        }

        /* Mobile Menu Toggle */
        .mobile-menu {
            display: none;
        }

        .mobile-menu.active {
            display: block;
        }
    </style>
    <link rel="shortcut icon" href="{{asset('icon.ico')}}" type="image/x-icon">
</head>
<body class="bg-gradient-to-br from-indigo-950 via-indigo-900 to-indigo-950 text-white overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-indigo-950/80 backdrop-blur-lg border-b border-indigo-800/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <div class="text-xl sm:text-2xl font-bold text-white flex items-center gap-2">
                        <img src="{{asset('Logo_w.png')}}" alt="Logo" class="w-10 h-10 object-contain">
                        <span>PlanoraAI</span>
                    </div>
                    <div class="hidden lg:flex space-x-6">
                        <a href="#home" class="text-indigo-200 hover:text-white transition">Manual Book</a>
                        <a href="#faq" class="text-indigo-200 hover:text-white transition">FAQ</a>
                        <a href="#about" class="text-indigo-200 hover:text-white transition">About</a>
                        <a href="#support" class="text-indigo-200 hover:text-white transition">Support</a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <button onclick="window.location.href='{{ route('login') }}'" class="hidden sm:block px-4 sm:px-6 py-2 rounded-full bg-white text-indigo-900 font-semibold hover:bg-indigo-100 transition text-sm sm:text-base">
                        Login
                    </button>
                    <button onclick="window.location.href='{{ route('register') }}'" class="px-4 sm:px-6 py-2 rounded-full bg-indigo-600 hover:bg-indigo-500 font-semibold transition text-sm sm:text-base">
                        Register
                    </button>
                    <button class="lg:hidden text-white p-2" onclick="toggleMobileMenu()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="mobile-menu lg:hidden mt-4 pb-4 space-y-3">
                <a href="#home" class="block text-indigo-200 hover:text-white transition py-2">Manual Book</a>
                <a href="#faq" class="block text-indigo-200 hover:text-white transition py-2">FAQ</a>
                <a href="#about" class="block text-indigo-200 hover:text-white transition py-2">About</a>
                <a href="#support" class="block text-indigo-200 hover:text-white transition py-2">Support</a>
                <button class="sm:hidden w-full px-4 py-2 rounded-full bg-white text-indigo-900 font-semibold hover:bg-indigo-100 transition text-sm">
                    Login
                </button>
            </div>
        </div>
    </nav>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('active');
        }
    </script>

    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Introduction -->
        <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-2xl p-8 text-white shadow-xl">
            <div class="flex items-start gap-6">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-bold mb-3">Selamat Datang di PlanoraAI! 👋</h3>
                    <p class="text-indigo-100 leading-relaxed">Panduan ini akan membantu Anda memahami cara menggunakan PlanoraAI untuk membuat Rencana Pelaksanaan Pembelajaran (RPP) dengan mudah dan cepat menggunakan teknologi AI.</p>
                </div>
            </div>
        </div>

        <!-- Step 1: Landing Page -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <span class="text-indigo-600 font-bold text-lg">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">Landing Page & Pendaftaran</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 mb-6 leading-relaxed">
                    Halaman pertama yang akan Anda lihat adalah <strong>Landing Page</strong> dengan beberapa menu navigasi:
                </p>

                <!-- Screenshot Placeholder -->
                <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-8 mb-6 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-sm text-gray-500 font-medium">Screenshot: Landing Page</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                        <h4 class="font-semibold text-indigo-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                            </svg>
                            Daftar
                        </h4>
                        <p class="text-sm text-indigo-800">Menu untuk membuat akun baru dengan 2 opsi:</p>
                        <ul class="mt-2 space-y-1 text-sm text-indigo-700">
                            <li>• Daftar Manual (Nama, Email, Password)</li>
                            <li>• Login dengan Google</li>
                        </ul>
                    </div>

                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <h4 class="font-semibold text-purple-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            Login
                        </h4>
                        <p class="text-sm text-purple-800">Menu untuk masuk ke akun dengan 2 opsi:</p>
                        <ul class="mt-2 space-y-1 text-sm text-purple-700">
                            <li>• Login Manual (Email & Password)</li>
                            <li>• Login dengan Google</li>
                        </ul>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg>
                            FAQ
                        </h4>
                        <p class="text-sm text-blue-800">Pertanyaan yang sering diajukan pengguna</p>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h4 class="font-semibold text-green-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            Kontak & Support
                        </h4>
                        <p class="text-sm text-green-800">Hubungi tim kami untuk bantuan</p>
                    </div>
                </div>

                <!-- Screenshot Placeholder -->
                <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-8 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-sm text-gray-500 font-medium">Screenshot: Form Pendaftaran</p>
                </div>
            </div>
        </div>

        <!-- Step 2: Dashboard -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-purple-500 to-pink-600 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <span class="text-purple-600 font-bold text-lg">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">Dashboard Utama</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 mb-6 leading-relaxed">
                    Setelah login, Anda akan diarahkan ke <strong>Dashboard</strong> yang menampilkan:
                </p>

                <!-- Screenshot Placeholder -->
                <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-8 mb-6 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-sm text-gray-500 font-medium">Screenshot: Dashboard</p>
                </div>

                <div class="space-y-4">
                    <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 border-2 border-indigo-200 rounded-xl p-5">
                        <h4 class="font-bold text-indigo-900 mb-3 text-lg">🎯 3 Card Aksi Utama</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <p class="font-semibold text-gray-900 text-sm mb-1">Buat Dokumen</p>
                                <p class="text-xs text-gray-600">Generate RPP baru dengan AI</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <p class="font-semibold text-gray-900 text-sm mb-1">Lihat Riwayat</p>
                                <p class="text-xs text-gray-600">Akses semua dokumen</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <p class="font-semibold text-gray-900 text-sm mb-1">Pengaturan Akun</p>
                                <p class="text-xs text-gray-600">Kelola profil Anda</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-xl p-5">
                        <h4 class="font-bold text-blue-900 mb-3 text-lg">📊 Statistik Dokumen</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <div class="bg-white rounded-lg p-3 text-center">
                                <p class="text-2xl font-bold text-indigo-600">24</p>
                                <p class="text-xs text-gray-600 mt-1">Total Dokumen</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 text-center">
                                <p class="text-2xl font-bold text-blue-600">3</p>
                                <p class="text-xs text-gray-600 mt-1">Dalam Proses</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 text-center">
                                <p class="text-2xl font-bold text-green-600">20</p>
                                <p class="text-xs text-gray-600 mt-1">Berhasil</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 text-center">
                                <p class="text-2xl font-bold text-red-600">1</p>
                                <p class="text-xs text-gray-600 mt-1">Gagal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Create Document -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <span class="text-green-600 font-bold text-lg">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">Membuat Dokumen RPP</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 mb-6 leading-relaxed">
                    Akses halaman pembuatan dokumen melalui <strong>Dashboard</strong> atau <strong>Navbar</strong> di sebelah kiri.
                </p>

                <!-- Screenshot Placeholder -->
                <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-8 mb-6 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-sm text-gray-500 font-medium">Screenshot: Form Pembuatan Dokumen</p>
                </div>

                <div class="bg-amber-50 border-l-4 border-amber-500 p-5 rounded-lg mb-6">
                    <h4 class="font-bold text-amber-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        Pilih Template Kurikulum
                    </h4>
                    <p class="text-sm text-amber-800 mb-3">Tersedia 2 template form utama:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="bg-white rounded-lg p-4 border-2 border-indigo-200">
                            <h5 class="font-semibold text-indigo-900 mb-2">📘 Kurikulum Merdeka</h5>
                            <p class="text-xs text-gray-600">Template untuk RPP Kurikulum Merdeka dengan format standar Kemendikbud</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 border-2 border-purple-200">
                            <h5 class="font-semibold text-purple-900 mb-2">🧠 Deep Learning</h5>
                            <p class="text-xs text-gray-600">Template untuk RPP Deep Learning dengan pendekatan pembelajaran mendalam</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-green-700 font-bold text-sm">1</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Pilih Template</h5>
                            <p class="text-sm text-gray-600">Klik tab Kurikulum Merdeka atau Deep Learning</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-green-700 font-bold text-sm">2</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Isi Data Form</h5>
                            <p class="text-sm text-gray-600">Lengkapi semua field yang disediakan (Mata Pelajaran, Fase, Elemen, dll)</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-green-700 font-bold text-sm">3</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Klik Generate</h5>
                            <p class="text-sm text-gray-600">Tekan tombol "Generate RPP" untuk mengirim request ke backend</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-green-700 font-bold text-sm">4</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Redirect ke Riwayat</h5>
                            <p class="text-sm text-gray-600">Setelah submit, Anda akan diarahkan ke halaman Riwayat dengan modal sukses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4: History Page -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-blue-500 to-cyan-600 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <span class="text-blue-600 font-bold text-lg">4</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">Halaman Riwayat</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 mb-6 leading-relaxed">
                    Di halaman <strong>Riwayat</strong>, Anda dapat melihat semua dokumen yang pernah dibuat:
                </p>

                <!-- Screenshot Placeholder -->
                <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-8 mb-6 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-sm text-gray-500 font-medium">Screenshot: Halaman Riwayat</p>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-5 rounded-lg mb-6">
                    <h4 class="font-bold text-blue-900 mb-3">📋 Informasi yang Ditampilkan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-blue-800">Judul Dokumen</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-blue-800">Status (Pending/Processing/Done/Failed)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-blue-800">Tanggal Submit</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-blue-800">Opsi Aksi (Download/Edit/Delete/Retry)</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="border-2 border-green-200 bg-green-50 rounded-lg p-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h5 class="font-bold text-green-900">Status: Selesai (Done)</h5>
                        </div>
                        <p class="text-sm text-green-800 mb-2">Tombol yang tersedia:</p>
                        <div class="flex gap-2 flex-wrap">
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg text-xs font-medium">📥 Download</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium">✏️ Edit</span>
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium">🗑️ Delete</span>
                        </div>
                    </div>

                    <div class="border-2 border-blue-200 bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <h5 class="font-bold text-blue-900">Status: Processing</h5>
                        </div>
                        <p class="text-sm text-blue-800 mb-2">Tombol yang tersedia:</p>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg text-xs font-medium">🚫 Tidak ada aksi (menunggu selesai)</span>
                        </div>
                    </div>

                    <div class="border-2 border-red-200 bg-red-50 rounded-lg p-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h5 class="font-bold text-red-900">Status: Gagal (Failed)</h5>
                        </div>
                        <p class="text-sm text-red-800 mb-2">Tombol yang tersedia:</p>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs font-medium">🔄 Retry</span>
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium">🗑️ Delete</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 bg-purple-50 border-l-4 border-purple-500 p-5 rounded-lg">
                    <h4 class="font-bold text-purple-900 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        Notifikasi Modal
                    </h4>
                    <p class="text-sm text-purple-800">Setiap aksi (Submit, Delete, Retry) akan menampilkan modal notifikasi konfirmasi untuk memastikan tindakan yang dilakukan.</p>
                </div>
            </div>
        </div>

        <!-- Step 5: Edit Document -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-orange-500 to-red-600 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <span class="text-orange-600 font-bold text-lg">5</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">Edit Dokumen</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 mb-6 leading-relaxed">
                    Setelah dokumen selesai di-generate, Anda dapat mengedit isinya:
                </p>

                <!-- Screenshot Placeholder -->
                <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-8 mb-6 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-sm text-gray-500 font-medium">Screenshot: Editor Dokumen</p>
                </div>

                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-orange-700 font-bold text-sm">1</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Klik Tombol Edit</h5>
                            <p class="text-sm text-gray-600">Pada dokumen dengan status "Done", klik tombol Edit</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-orange-700 font-bold text-sm">2</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Halaman Editor Terbuka</h5>
                            <p class="text-sm text-gray-600">Anda akan diarahkan ke halaman baru dengan semua konten dokumen yang dapat diubah</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-orange-700 font-bold text-sm">3</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Ubah Konten</h5>
                            <p class="text-sm text-gray-600">Edit teks, ubah tujuan pembelajaran, modifikasi kegiatan, perbaiki assessment, dll</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-orange-700 font-bold text-sm">4</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Simpan Perubahan</h5>
                            <p class="text-sm text-gray-600">Klik tombol "Simpan" untuk menyimpan perubahan ke database</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 bg-indigo-50 border-l-4 border-indigo-500 p-5 rounded-lg">
                    <p class="text-sm text-indigo-800">
                        <strong>💡 Tips:</strong> Perubahan yang Anda lakukan akan langsung tersimpan dan dapat didownload dengan versi terbaru.
                    </p>
                </div>
            </div>
        </div>

        <!-- Step 6: Account Settings -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-gray-700 to-gray-900 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <span class="text-gray-700 font-bold text-lg">6</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">Pengaturan Akun</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 mb-6 leading-relaxed">
                    Kelola informasi akun Anda di halaman <strong>Pengaturan</strong>:
                </p>

                <!-- Screenshot Placeholder -->
                <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-8 mb-6 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-sm text-gray-500 font-medium">Screenshot: Pengaturan Akun</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h5 class="font-semibold text-blue-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            Ubah Nama
                        </h5>
                        <p class="text-sm text-blue-700">Update nama lengkap Anda</p>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h5 class="font-semibold text-green-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            Ubah Email
                        </h5>
                        <p class="text-sm text-green-700">Ganti alamat email Anda</p>
                    </div>

                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <h5 class="font-semibold text-purple-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            Ubah Password
                        </h5>
                        <p class="text-sm text-purple-700">Reset password untuk keamanan</p>
                    </div>

                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h5 class="font-semibold text-red-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Hapus Akun
                        </h5>
                        <p class="text-sm text-red-700">Permanen menghapus akun Anda</p>
                    </div>
                </div>

                <div class="mt-6 bg-red-50 border-l-4 border-red-500 p-5 rounded-lg">
                    <p class="text-sm text-red-800">
                        <strong>⚠️ Peringatan:</strong> Menghapus akun bersifat permanen dan tidak dapat dibatalkan. Semua data dan dokumen Anda akan dihapus.
                    </p>
                </div>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border-2 border-amber-200 p-8">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-amber-900 text-xl mb-3">💡 Tips Penggunaan</h4>
                    <ul class="space-y-2 text-amber-800">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Pastikan semua data form terisi dengan lengkap untuk hasil RPP yang optimal</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Proses generate membutuhkan waktu beberapa menit, mohon bersabar</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Anda dapat mengedit hasil generate sesuai kebutuhan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Jika generate gagal, gunakan tombol "Retry" untuk mencoba lagi</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Hubungi support jika mengalami kendala atau butuh bantuan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Need Help -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 text-center">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Butuh Bantuan?</h3>
            <p class="text-gray-600 mb-6">Tim kami siap membantu Anda!</p>
            <div class="flex gap-4 justify-center">
                <a href="" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                    </svg>
                    Lihat FAQ
                </a>
                <a href="" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                    </svg>
                    Hubungi Support
                </a>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-indigo-950/80 backdrop-blur-sm py-12 sm:py-16 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 mb-12">
                <div>
                    <h3 class="font-bold text-lg sm:text-xl mb-4 text-white">FITUR</h3>
                    <ul class="space-y-2 text-sm sm:text-base text-indigo-300">
                        <li><a href="#" class="hover:text-white transition">Rancangan Otomatis</a></li>
                        <li><a href="#" class="hover:text-white transition">Kurikulum Terbaru</a></li>
                        <li><a href="#" class="hover:text-white transition">Export Document</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg sm:text-xl mb-4 text-white">INFO</h3>
                    <ul class="space-y-2 text-sm sm:text-base text-indigo-300">
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg sm:text-xl mb-4 text-white">SUPPORT</h3>
                    <ul class="space-y-2 text-sm sm:text-base text-indigo-300">
                        <li><a href="#" class="hover:text-white transition">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg sm:text-xl mb-4 text-white">LEGAL</h3>
                    <ul class="space-y-2 text-sm sm:text-base text-indigo-300">
                        <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Syarat Layanan</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-indigo-800/50 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="text-xl sm:text-2xl font-bold text-white">PlanoraAI</div>
                    <div class="flex space-x-4 sm:space-x-6">
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
