<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Buat Rancangan Pembelajaran
                </h2>
                <p class="text-sm text-gray-600 mt-1">Pilih jenis kurikulum dan lengkapi formulir</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 mb-6">
            <div class="flex border-b border-gray-200">
                <button type="button" id="tab-merdeka"
                        class="flex-1 px-6 py-4 text-center font-semibold transition-all border-b-2 border-indigo-600 text-indigo-600">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Kurikulum Merdeka</span>
                    </div>
                </button>
                <button type="button" id="tab-deeplearning"
                        class="flex-1 px-6 py-4 text-center font-semibold transition-all border-b-2 border-transparent text-gray-600 hover:text-gray-900">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>Deep Learning</span>
                    </div>
                </button>
            </div>
        </div>
        <form action="{{route('form.submit')}}" method="POST" class="space-y-6" id="main-form">
                    @csrf
                    <input type="hidden" name="form_type" id="form_type" value="merdeka">

                    <div id="form-merdeka" class="tab-content space-y-6">

                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Identitas Penyusun</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="nama_penyusun" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Penyusun <span class="text-red-500">*</span>
                                    </label>
                                    <input data-sync="nama_penyusun" type="text" id="nama_penyusun" name="nama_penyusun"
                                        class="shared-field w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Masukkan nama lengkap penyusun">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="institusi" class="block text-sm font-medium text-gray-700 mb-2">
                                        Institusi <span class="text-red-500">*</span>
                                    </label>
                                    <input data-sync="nama_sekolah" type="text" id="institusi" name="institusi"
                                        class="shared-field w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Contoh: SMK Negeri 3 Kediri">
                                </div>

                                <div>
                                    <label for="tahun_pelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tahun Pelajaran <span class="text-red-500">*</span>
                                    </label>
                                    <input data-sync="tahun_ajaran" type="text" id="tahun_pelajaran" name="tahun_pelajaran"
                                        class="shared-field w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="2024/2025">
                                </div>

                                <div>
                                    <label for="jenjang" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenjang Sekolah <span class="text-red-500">*</span>
                                    </label>
                                    <select data-sync="jenjang" id="jenjang" name="jenjang"
                                            class="shared-field w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                        <option value="">Pilih jenjang</option>
                                        <option value="SMK">SMK</option>
                                        <option value="SMA">SMA</option>
                                        <option value="MA">MA</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kelas <span class="text-red-500">*</span>
                                    </label>
                                    <select data-sync="kelas" id="kelas" name="kelas"
                                            class="shared-field w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                        <option value="">Pilih kelas</option>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="km_kompetensi_keahlian" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kompetensi Keahlian (Mata Pelajaran) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="km_kompetensi_keahlian" name="kompetensi_keahlian"
                                            class="shared-mapel w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                            placeholder="Pilih jenjang terlebih dahulu..."
                                            autocomplete="off"
                                            disabled>
                                        <div id="km_kompetensi_dropdown" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="km_fase" class="block text-sm font-medium text-gray-700 mb-2">
                                        Fase <span class="text-red-500">*</span>
                                    </label>
                                    <select id="km_fase" name="fase"
                                            class="shared-fase w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                            disabled>
                                        <option value="">Pilih kompetensi keahlian terlebih dahulu</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="km_elemen" class="block text-sm font-medium text-gray-700 mb-2">
                                        Elemen <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="km_elemen" name="elemen"
                                            class="shared-elemen w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                            placeholder="Pilih fase terlebih dahulu..."
                                            autocomplete="off"
                                            disabled>
                                        <div id="km_elemen_dropdown" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="km_capaian_pembelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Capaian Pembelajaran <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <textarea id="km_capaian_pembelajaran" name="capaian_pembelajaran" rows="4"
                                                class="shared-capaian w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none"
                                                placeholder="Pilih elemen untuk mendapatkan saran capaian pembelajaran, atau ketik manual..."></textarea>
                                        <div id="km_capaian_dropdown" class="hidden absolute z-20 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Klik untuk melihat saran dari elemen yang dipilih, atau modifikasi sesuai kebutuhan</p>
                                </div>

                                <div>
                                    <label for="km_alokasi_waktu" class="block text-sm font-medium text-gray-700 mb-2">
                                        Alokasi Waktu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="km_alokasi_waktu" name="km_alokasi_waktu"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="4 x 45 menit">
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Profil Pelajar Pancasila</h3>
                            <div class="space-y-3">
                                <label class="flex items-start cursor-pointer group">
                                    <input type="checkbox" name="km_profil_pelajar[]" value="Beriman" class="mt-1 w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Beriman, bertakwa kepada Tuhan Yang Maha Esa dan berakhlak mulia</span>
                                </label>
                                <label class="flex items-start cursor-pointer group">
                                    <input type="checkbox" name="km_profil_pelajar[]" value="Berpikir kritis" class="mt-1 w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Berpikir kritis</span>
                                </label>
                                <label class="flex items-start cursor-pointer group">
                                    <input type="checkbox" name="km_profil_pelajar[]" value="Kreatif" class="mt-1 w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Kreatif</span>
                                </label>
                                <label class="flex items-start cursor-pointer group">
                                    <input type="checkbox" name="km_profil_pelajar[]" value="Mandiri" class="mt-1 w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Mandiri</span>
                                </label>
                                <label class="flex items-start cursor-pointer group">
                                    <input type="checkbox" name="km_profil_pelajar[]" value="Gotong royong" class="mt-1 w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Bergotong royong</span>
                                </label>
                                <label class="flex items-start cursor-pointer group">
                                    <input type="checkbox" name="km_profil_pelajar[]" value="Berkebhinekaan global" class="mt-1 w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Berkebhinekaan global</span>
                                </label>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Sarana dan Prasarana</h3>
                            <textarea name="km_sarana_prasarana" rows="4"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none"
                                    placeholder="Deskripsikan sarana dan prasarana yang dibutuhkan..."></textarea>
                        </div>

                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Target & Model Pembelajaran</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="km_target_peserta" class="block text-sm font-medium text-gray-700 mb-2">
                                        Target Peserta Didik
                                    </label>
                                    <input type="text" id="km_target_peserta" name="km_target_peserta"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Contoh: Peserta didik reguler">
                                </div>

                                <div>
                                    <label for="km_model_pembelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Model Pembelajaran
                                    </label>
                                    <input type="text" id="km_model_pembelajaran" name="km_model_pembelajaran"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Contoh: Project Based Learning">
                                </div>

                                <div>
                                    <label for="km_jumlah_pertemuan" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jumlah Pertemuan
                                    </label>
                                    <input type="number" id="km_jumlah_pertemuan" name="km_jumlah_pertemuan"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="4" min="1">
                                </div>


                            </div>

                        </div>
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Kebutuhan Industri</h3>
                                    <textarea name="km_deskripsi_industri" rows="4"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none"
                                    placeholder="Deskripsikan kompetensi siswa yang dibutuhkan oleh industri..."></textarea>
                        </div>

                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Assessment Sumatif</h3>
                                    <p class="text-sm text-gray-600 mt-1">Generate soal evaluasi berdasarkan tingkat kognitif</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="km_enable_assessment" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>

                            <div id="km_assessment_content" class="hidden space-y-4">
                                <p class="text-sm text-gray-600 mb-4">Tentukan jumlah soal untuk setiap tingkat kognitif</p>

                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-2">C1 - Mengingat</label>
                                        <input type="number" name="km_c1" min="0" value="0" class="km-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-2">C2 - Memahami</label>
                                        <input type="number" name="km_c2" min="0" value="0" class="km-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-2">C3 - Menerapkan</label>
                                        <input type="number" name="km_c3" min="0" value="0" class="km-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-2">C4 - Menganalisis</label>
                                        <input type="number" name="km_c4" min="0" value="0" class="km-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-2">C5 - Mengevaluasi</label>
                                        <input type="number" name="km_c5" min="0" value="0" class="km-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-2">C6 - Mencipta</label>
                                        <input type="number" name="km_c6" min="0" value="0" class="km-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                </div>

                                <div class="mt-4 p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-indigo-900">Total Soal:</span>
                                        <span id="km-total-soal" class="text-2xl font-bold text-indigo-600">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="form-deeplearning" class="tab-content hidden space-y-6">

                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Umum</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="dl_nama_penyusun" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Penyusun <span class="text-red-500">*</span>
                                    </label>
                                    <input data-sync="nama_penyusun" type="text" id="dl_nama_penyusun" name="dl_nama_penyusun"
                                        class="shared-field w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Masukkan nama lengkap penyusun">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="dl_institusi" class="block text-sm font-medium text-gray-700 mb-2">
                                        Satuan Pendidikan <span class="text-red-500">*</span>
                                    </label>
                                    <input data-sync="nama_sekolah" type="text" id="dl_institusi" name="dl_satuan_pendidikan"
                                        class="shared-field w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Contoh: SMK Negeri 3 Kediri">
                                </div>

                                <div>
                                    <label for="dl_tahun_pelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tahun Pelajaran <span class="text-red-500">*</span>
                                    </label>
                                    <input data-sync="tahun_ajaran" type="text" id="dl_tahun_pelajaran" name="dl_tahun_pelajaran"
                                        class="shared-field w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="2024/2025">
                                </div>

                                <div>
                                    <label for="dl_jenjang" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenjang Sekolah <span class="text-red-500">*</span>
                                    </label>
                                    <select data-sync="jenjang" id="dl_jenjang" name="dl_jenjang"
                                            class="shared-field w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                        <option value="">Pilih jenjang</option>
                                        <option value="SMK">SMK</option>
                                        <option value="SMA">SMA</option>
                                        <option value="MA">MA</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="dl_kelas" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kelas <span class="text-red-500">*</span>
                                    </label>
                                    <select data-sync="kelas" id="dl_kelas" name="dl_kelas"
                                            class="shared-field w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                        <option value="">Pilih kelas</option>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="dl_mata_pelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Mata Pelajaran <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="dl_mata_pelajaran" name="dl_mata_pelajaran"
                                        required
                                            class="shared-mapel w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                            placeholder="Pilih jenjang terlebih dahulu..."
                                            autocomplete="off"
                                            disabled>
                                        <div id="dl_mapel_dropdown" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="dl_fase" class="block text-sm font-medium text-gray-700 mb-2">
                                        Fase <span class="text-red-500">*</span>
                                    </label>
                                    <select id="dl_fase" name="dl_fase"
                                            class="shared-fase w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                            disabled>
                                        <option value="">Pilih mata pelajaran terlebih dahulu</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="dl_elemen_pembelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Elemen Pembelajaran <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="dl_elemen_pembelajaran" name="dl_elemen_pembelajaran"
                                            class="shared-elemen w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                            placeholder="Pilih fase terlebih dahulu..."
                                            autocomplete="off"
                                            disabled>
                                        <div id="dl_elemen_dropdown" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="dl_capaian_pembelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Capaian Pembelajaran <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <textarea id="dl_capaian_pembelajaran" name="dl_capaian_pembelajaran" rows="4"
                                                class="shared-capaian w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none"
                                                placeholder="Pilih elemen untuk mendapatkan saran capaian pembelajaran, atau ketik manual..."></textarea>
                                        <div id="dl_capaian_dropdown" class="hidden absolute z-20 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Klik untuk melihat saran dari elemen yang dipilih, atau modifikasi sesuai kebutuhan</p>
                                </div>

                                <div>
                                    <label for="dl_materi_pokok" class="block text-sm font-medium text-gray-700 mb-2">
                                        Materi Pokok <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="dl_materi_pokok" name="dl_materi_pokok"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Contoh: Pemrograman Web">
                                </div>

                                <div>
                                    <label for="dl_sub_materi" class="block text-sm font-medium text-gray-700 mb-2">
                                        Sub Materi <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="dl_sub_materi" name="dl_sub_materi"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Contoh: HTML & CSS Dasar">
                                </div>

                                <div>
                                    <label for="dl_alokasi_waktu" class="block text-sm font-medium text-gray-700 mb-2">
                                        Alokasi Waktu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="dl_alokasi_waktu" name="dl_alokasi_waktu"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="4 x 45 menit">
                                </div>

                                <div>
                                    <label for="dl_jumlah_pertemuan" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jumlah Pertemuan
                                    </label>
                                    <input type="number" id="dl_jumlah_pertemuan" name="dl_jumlah_pertemuan"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="4" min="1">
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Dimensi & Model Pembelajaran</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="dl_dimensi_lulusan" class="block text-sm font-medium text-gray-700 mb-2">
                                        Dimensi Lulusan Profil
                                    </label>
                                    <textarea id="dl_dimensi_lulusan" name="dl_dimensi_lulusan" rows="3"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none"
                                            placeholder="Deskripsikan dimensi lulusan profil..."></textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="dl_sarana_prasarana" class="block text-sm font-medium text-gray-700 mb-2">
                                        Sarana Prasarana
                                    </label>
                                    <textarea id="dl_sarana_prasarana" name="dl_sarana_prasarana" rows="3"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none"
                                            placeholder="Deskripsikan sarana dan prasarana..."></textarea>
                                </div>

                                <div>
                                    <label for="dl_target_peserta" class="block text-sm font-medium text-gray-700 mb-2">
                                        Target Peserta Didik
                                    </label>
                                    <input type="text" id="dl_target_peserta" name="dl_target_peserta"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Contoh: Peserta didik reguler">
                                </div>

                                <div>
                                    <label for="dl_model_pembelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Model/Metode Pembelajaran
                                    </label>
                                    <input type="text" id="dl_model_pembelajaran" name="dl_model_pembelajaran"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Contoh: Discovery Learning">
                                </div>

                                <div>
                                    <label for="dl_lingkungan_pembelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Lingkungan Pembelajaran
                                    </label>
                                    <input type="text" id="dl_lingkungan_pembelajaran" name="dl_lingkungan_pembelajaran"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Contoh: Kelas, Lab Komputer">
                                </div>

                                <div>
                                    <label for="dl_pemanfaatan_digital" class="block text-sm font-medium text-gray-700 mb-2">
                                        Pemanfaatan Digital
                                    </label>
                                    <input type="text" id="dl_pemanfaatan_digital" name="dl_pemanfaatan_digital"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        placeholder="Contoh: E-Learning, Video Tutorial">
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Kebutuhan Industri</h3>
                                    <textarea name="dl_deskripsi_industri" rows="4"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none"
                                    placeholder="Deskripsikan kompetensi siswa yang dibutuhkan oleh industri..."></textarea>
                        </div>

                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Assessment</h3>

                            <div class="space-y-6">
                                <div>
                                    <div class="flex items-center justify-between mb-6">
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Assessment Sumatif</h4>
                                            <p class="text-sm text-gray-600 mt-1">Generate soal evaluasi berdasarkan tingkat kognitif</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" id="dl_enable_assessment" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                        </label>
                                    </div>

                                    <div id="dl_assessment_content" class="hidden space-y-4">
                                        <p class="text-sm text-gray-600 mb-4">Tentukan jumlah soal untuk setiap tingkat kognitif</p>

                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-700 mb-2">C1 - Mengingat</label>
                                                <input type="number" name="dl_c1" min="0" value="0" class="dl-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-700 mb-2">C2 - Memahami</label>
                                                <input type="number" name="dl_c2" min="0" value="0" class="dl-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-700 mb-2">C3 - Menerapkan</label>
                                                <input type="number" name="dl_c3" min="0" value="0" class="dl-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-700 mb-2">C4 - Menganalisis</label>
                                                <input type="number" name="dl_c4" min="0" value="0" class="dl-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-700 mb-2">C5 - Mengevaluasi</label>
                                                <input type="number" name="dl_c5" min="0" value="0" class="dl-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-700 mb-2">C6 - Mencipta</label>
                                                <input type="number" name="dl_c6" min="0" value="0" class="dl-kognitif w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                            </div>
                                        </div>

                                        <div class="mt-4 p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm font-medium text-indigo-900">Total Soal:</span>
                                                <span id="dl-total-soal" class="text-2xl font-bold text-indigo-600">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="#" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold flex items-center gap-2 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Generate Dokumen
                        </button>
                    </div>
        </form>
    </div>

    <script src="{{asset('buat-dokumen-min.js')}}">

    </script>
</x-app-layout>
