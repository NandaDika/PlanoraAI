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

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center pt-24 px-6 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-48 h-48 bg-indigo-400/20 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center relative z-10">
            <div class="space-y-6">
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-bold leading-tight">
                    RANCANGAN PEMBELAJARAN
                    <span class="block text-indigo-300">OTOMATIS & MUDAH</span>
                </h1>
                <p class="text-lg sm:text-xl text-indigo-200">
                    PlanoraAI membantu guru SMK membuat rancangan pembelajaran berkualitas dalam hitungan menit menggunakan AI terdepan. Hemat waktu, tingkatkan kualitas pembelajaran.
                </p>
                <div class="flex flex-wrap gap-4">
                    <button class="px-6 sm:px-8 py-3 sm:py-4 bg-white text-indigo-900 rounded-full font-bold text-base sm:text-lg hover:scale-105 transition transform shadow-xl">
                        Mulai Gratis
                    </button>
                    <button class="px-6 sm:px-8 py-3 sm:py-4 bg-indigo-700 rounded-full font-bold text-base sm:text-lg hover:bg-indigo-600 transition">
                        Lihat Demo
                    </button>
                </div>
            </div>
            <div class="relative">
                <div class="card-3d bg-indigo-800 p-6 sm:p-8 rounded-3xl shadow-2xl">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 sm:p-6 space-y-4">
                        <img src="{{asset('MAIN.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature 1 -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-indigo-900/50 rounded-3xl p-8 sm:p-12 grid md:grid-cols-2 gap-8 sm:gap-12 items-center backdrop-blur-sm">
                <div class="order-2 md:order-1">
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 sm:p-8 card-3d">
                        <div class="space-y-4">
                            <img src="{{asset('FORM.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2 space-y-4">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold">
                        BUAT RANCANGAN PEMBELAJARAN LEBIH CEPAT
                    </h2>
                    <p class="text-base sm:text-lg text-indigo-200">
                        Cukup masukkan mata pelajaran, kompetensi dasar, dan durasi pembelajaran. AI kami akan menghasilkan rancangan pembelajaran lengkap dengan tujuan pembelajaran, kegiatan, dan penilaian yang sesuai kurikulum SMK dan kebutuhan Industri.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature 2 -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-indigo-800/50 rounded-3xl p-8 sm:p-12 grid md:grid-cols-2 gap-8 sm:gap-12 items-center backdrop-blur-sm">
                <div class="space-y-4">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold">
                        SESUAIKAN DENGAN KEBUTUHAN ANDA
                    </h2>
                    <p class="text-base sm:text-lg text-indigo-200">
                        Edit dan personalisasi setiap bagian rancangan pembelajaran. Tambahkan kebutuhan industri, sesuaikan metode pembelajaran, dan modifikasi indikator penilaian sesuai karakteristik siswa Anda.
                    </p>
                </div>
                <div>
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 sm:p-8 card-3d float">
                        <img src="{{asset('FORM2.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature 3 -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-indigo-900/50 rounded-3xl p-8 sm:p-12 grid md:grid-cols-2 gap-8 sm:gap-12 items-center backdrop-blur-sm">
                <div class="order-2 md:order-1">
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-4 sm:p-6 card-3d">
                        <img src="{{asset('COVER.png')}}" alt="">
                    </div>
                </div>
                <div class="order-1 md:order-2 space-y-4">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold">
                        AKSES DARI MANA SAJA
                    </h2>
                    <p class="text-base sm:text-lg text-indigo-200">
                        Platform berbasis web yang bisa diakses kapan saja, di mana saja. Semua rancangan pembelajaran tersimpan aman di cloud dan dapat diakses dari berbagai perangkat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 px-6">
        <div class="max-w-4xl mx-auto text-center space-y-8">
            <h2 class="text-5xl md:text-6xl font-bold leading-tight">
                Siap Membuat Pembelajaran
                <br/>
                <span class="text-indigo-300">Lebih Efektif & Efisien?</span>
            </h2>
            <p class="text-xl text-indigo-200 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan guru SMK yang telah mempercayai PlanoraAI untuk menyusun rancangan pembelajaran berkualitas
            </p>
            <button class="px-10 py-5 bg-white text-indigo-900 rounded-full font-bold text-xl hover:scale-105 transition transform shadow-2xl">
                Mulai Gratis Sekarang
            </button>
        </div>
    </section>

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
