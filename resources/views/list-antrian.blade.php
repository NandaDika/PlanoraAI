<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Antrean Dokumen
                </h2>
                <p class="text-sm text-gray-600 mt-1">Daftar antrean pembuatan dokumen pembelajaran</p>
            </div>
            <a href="{{ route('rpp.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold flex items-center gap-2 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Baru
            </a>
        </div>
    </x-slot>
<style>
    /* Animasi Tambahan */
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s infinite ease-in-out;
    }

    /* Efek Masuk Modal */
    #success-modal:not(.hidden) .relative.bg-white {
        animation: modal-pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes modal-pop {
        0% { opacity: 0; transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }
</style>
    <div class="max-w-7xl mx-auto">
        <!-- Success Modal -->
        <div id="success-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4">
            <div class="fixed inset-0 transition-opacity bg-gray-900/60 backdrop-blur-sm" id="modal-overlay"></div>

            <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all sm:max-w-md sm:w-full border border-gray-100">

                <div class="h-2 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                <div class="bg-white px-10 pt-12 pb-12">
                    <div class="flex justify-center mb-9">
                        <div class="relative">
                            <div class="absolute inset-0 bg-indigo-100 rounded-full scale-150 blur-2xl opacity-50 animate-pulse"></div>

                            <div id="lottie-animation" class="relative w-40 h-40 flex items-center justify-center bg-indigo-50 rounded-full border-4 border-white shadow-inner">
                                <svg class="w-20 h-20 text-indigo-600 animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-4 tracking-tight">
                            Dokumen Berhasil Dikirim!
                        </h3>
                        <p class="text-gray-500 leading-relaxed mb-10">
                            Permintaan pembuatan dokumen Anda telah masuk ke dalam antrean. Kami akan segera memprosesnya.
                        </p>

                        <button onclick="closeModal('success-modal')"
                            class="group relative mt-2 mb-4 inline-flex items-center justify-center pb-3 px-6 py-3.5 font-bold text-white transition-all duration-200 bg-indigo-600 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-200">
                            <span class="relative">Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="delete-confirm-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4">
            <div class="fixed inset-0 transition-opacity bg-gray-900/60 backdrop-blur-sm" id="modal-overlay"></div>

            <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all sm:max-w-md sm:w-full border border-gray-100">

                <div class="h-2 w-full bg-gradient-to-r from-red-500 via-orange-500 to-red-600"></div>

                <div class="bg-white px-10 pt-12 pb-12">
                    <div class="flex justify-center mb-9">
                        <div class="relative">
                            <div class="absolute inset-0 bg-red-100 rounded-full scale-150 blur-2xl opacity-50 animate-pulse"></div>

                            <div class="relative w-40 h-40 flex items-center justify-center bg-red-50 rounded-full border-4 border-white shadow-inner">
                                <svg class="w-20 h-20 text-red-600 animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-4 tracking-tight">
                            Hapus Dokumen?
                        </h3>
                        <p class="text-gray-500 leading-relaxed mb-10">
                            Data yang dihapus tidak dapat dipulihkan. Apakah Anda yakin ingin menghapus permintaan dokumen ini?
                        </p>

                        <div class="mb-4 flex gap-6">
                            <button onclick="closeDeleteModal()" class="flex-1 px-6 py-3.5 font-bold text-gray-500 bg-green-100 rounded-xl hover:bg-gray-200 transition">
                                Batal
                            </button>
                            <form id="real-delete-form" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-6 py-3.5 font-bold text-white bg-red-600 rounded-xl hover:bg-red-700 shadow-lg shadow-red-200 transition">
                                    Ya, Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Success Modal -->
        <div id="delete-success-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4">
            <div class="fixed inset-0 transition-opacity bg-gray-900/60 backdrop-blur-sm" id="modal-overlay"></div>

            <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all sm:max-w-md sm:w-full border border-gray-100">

                <div class="h-2 w-full bg-gradient-to-r from-pink-500 via-rose-500 to-red-500"></div>

                <div class="bg-white px-10 pt-12 pb-12">
                    <div class="flex justify-center mb-9">
                        <div class="relative">
                            <div class="absolute inset-0 bg-rose-100 rounded-full scale-150 blur-2xl opacity-50 animate-pulse"></div>

                            <div class="relative w-40 h-40 flex items-center justify-center bg-rose-50 rounded-full border-4 border-white shadow-inner">
                                <svg class="w-20 h-20 text-rose-600 animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-4 tracking-tight">
                            Berhasil Dihapus!
                        </h3>
                        <p class="text-gray-500 leading-relaxed mb-10">
                            Dokumen telah berhasil dihapus dari sistem. Daftar antrean Anda telah diperbarui.
                        </p>

                        <button onclick="closeModal('delete-success-modal')"
                            class="group relative mt-2 mb-4 inline-flex items-center justify-center pb-3 px-6 py-3.5 font-bold text-white transition-all duration-200 bg-gray-900 rounded-xl focus:outline-none hover:bg-black shadow-lg shadow-gray-200">
                            <span class="relative">Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Retry Success Modal -->
        <div id="retry-success-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4">
            <div class="fixed inset-0 transition-opacity bg-gray-900/60 backdrop-blur-sm" id="modal-overlay"></div>

            <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all sm:max-w-md sm:w-full border border-gray-100">

                <div class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>

                <div class="bg-white px-10 pt-12 pb-12">
                    <div class="flex justify-center mb-9">
                        <div class="relative">
                            <div class="absolute inset-0 bg-blue-100 rounded-full scale-150 blur-2xl opacity-50 animate-pulse"></div>

                            <div class="relative w-40 h-40 flex items-center justify-center bg-blue-50 rounded-full border-4 border-white shadow-inner">
                                <svg class="w-20 h-20 text-blue-600 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-4 tracking-tight">
                            Permintaan Dikirim Ulang!
                        </h3>
                        <p class="text-gray-500 leading-relaxed mb-10">
                            Dokumen telah dimasukkan kembali ke dalam antrean pemrosesan. Mohon tunggu beberapa saat.
                        </p>

                        <button onclick="closeModal('retry-success-modal')"
                            class="group relative mt-2 mb-4 inline-flex items-center justify-center pb-3 px-6 py-3.5 font-bold text-white transition-all duration-200 bg-indigo-600 rounded-xl focus:outline-none hover:bg-indigo-700 shadow-lg shadow-indigo-200">
                            <span class="relative">Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Modal -->
        <div id="error-modal" class="{{ session('error_modal') ? 'flex' : 'hidden' }} fixed inset-0 z-50 items-center justify-center px-4">
            <div class="fixed inset-0 transition-opacity bg-gray-900/60 backdrop-blur-sm" onclick="closeErrorModal()"></div>

            <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all sm:max-w-md sm:w-full border border-gray-100">
                <div class="h-2 w-full bg-gradient-to-r from-red-500 via-rose-500 to-red-600"></div>

                <div class="bg-white px-10 pt-12 pb-12 text-center">
                    <div class="flex justify-center mb-9">
                        <div class="relative">
                            <div class="absolute inset-0 bg-red-100 rounded-full scale-150 blur-2xl opacity-50"></div>
                            <div class="relative w-40 h-40 flex items-center justify-center bg-red-50 rounded-full border-4 border-white shadow-inner">
                                <svg class="w-20 h-20 text-red-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-2xl font-extrabold text-gray-900 mb-4 tracking-tight">Gagal Memproses!</h3>
                    <p class="text-gray-500 leading-relaxed mb-10">
                        {{ session('error_modal') ?? 'Maaf, terjadi kesalahan sistem saat memproses permintaan Anda.' }}
                    </p>

                    <button onclick="closeErrorModal()"
                        class="w-full py-4 font-bold text-white bg-red-600 rounded-xl hover:bg-red-700 shadow-lg shadow-red-200 transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Sedang Diproses</option>
                        <option value="completed">Selesai</option>
                        <option value="failed">Gagal</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kurikulum</label>
                    <select class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Semua Jenis</option>
                        <option value="merdeka">Kurikulum Merdeka</option>
                        <option value="deeplearning">Deep Learning</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                    <div class="relative">
                        <input type="text" placeholder="Cari berdasarkan nama..." class="w-full px-4 py-2.5 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Antrean List -->
        <livewire:daftar-rpp />
    </div>

    <!-- Lottie Animation Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>

    <script>
        let lottieAnimations = {};

        /**
         * Fungsi Universal untuk Menampilkan Modal Sukses
         * @param {string} modalId - ID elemen modal (success-modal, delete-success-modal, dll)
         * @param {string} lottieId - ID kontainer lottie di dalam modal tersebut
         * @param {string} lottiePath - URL JSON animasi lottie
         * @param {string} paramKey - Nama parameter URL yang ingin dihapus (success, deleted, retried)
         */
        function showModal(modalId, lottieId, lottiePath, paramKey) {
            const modal = document.getElementById(modalId);
            if (!modal) return;

            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Pastikan flex aktif agar centered

            // Initialize atau Play Lottie secara spesifik berdasarkan ID
            if (!lottieAnimations[lottieId]) {
                lottieAnimations[lottieId] = lottie.loadAnimation({
                    container: document.getElementById(lottieId),
                    renderer: 'svg',
                    loop: false,
                    autoplay: true,
                    path: lottiePath
                });
            } else {
                lottieAnimations[lottieId].goToAndPlay(0);
            }

            document.body.style.overflow = 'hidden';

            // Simpan informasi parameter yang harus dihapus saat modal ditutup
            modal.dataset.paramToClear = paramKey;
        }

        /**
         * Fungsi Universal untuk Menutup Modal
         */
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;

            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';

            // Ambil kunci parameter yang harus dihapus (success, deleted, atau retried)
            const paramKey = modal.dataset.paramToClear;

            if (paramKey && window.history.replaceState) {
                const url = new URL(window.location.href);

                // Hanya hapus parameter pemicu modal, biarkan ?page= tetap ada
                if (url.searchParams.has(paramKey)) {
                    url.searchParams.delete(paramKey);

                    // Update URL tanpa reload halaman
                    window.history.replaceState({}, document.title, url.pathname + url.search);
                }
            }
        }

        function closeErrorModal() {
            const modal = document.getElementById('error-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Event Listener saat DOM Siap
        document.addEventListener('DOMContentLoaded', function() {
            // Menggunakan URLSearchParams untuk mendeteksi parameter meskipun ada banyak (?page=2&success=1)
            const urlParams = new URLSearchParams(window.location.search);

            // 1. Cek Sukses Tambah Data
            if (urlParams.get('success') === '1') {
                setTimeout(() => {
                    showModal(
                        'success-modal',
                        'lottie-animation',
                        'https://lottie.host/f0165c6e-6e6d-46f0-b5b0-2b41f8a3d4f1/TautvXQPVO.json',
                        'success'
                    );
                }, 300);
            }

            // 2. Cek Sukses Delete
            if (urlParams.get('deleted') === '1') {
                setTimeout(() => {
                    showModal(
                        'delete-success-modal',
                        'lottie-delete-animation',
                        'https://lottie.host/f0165c6e-6e6d-46f0-b5b0-2b41f8a3d4f1/TautvXQPVO.json',
                        'deleted'
                    );
                }, 300);
            }

            // 3. Cek Sukses Retry
            if (urlParams.get('retried') === '1') {
                setTimeout(() => {
                    showModal(
                        'retry-success-modal',
                        'lottie-retry-animation',
                        'https://lottie.host/path-ke-animasi-retry.json',
                        'retried'
                    );
                }, 300);
            }
        });

        // Close modal dengan ESC key (menutup semua modal yang terbuka)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                ['success-modal', 'delete-success-modal', 'retry-success-modal'].forEach(closeModal);
            }
        });
    </script>
    <script>
        function openDeleteModal(actionUrl) {
            const modal = document.getElementById('delete-confirm-modal');
            const form = document.getElementById('real-delete-form');

            // Set action form di dalam modal sesuai URL tombol yang diklik
            form.setAttribute('action', actionUrl);

            // Tampilkan modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-confirm-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-app-layout>
