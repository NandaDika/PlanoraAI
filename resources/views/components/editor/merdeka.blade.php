{{-- KURIKULUM MERDEKA EDITOR --}}

<!-- Identitas Penyusun -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        Identitas Penyusun
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penyusun</label>
            <input type="text" name="nama_penyusun" value="{{ $data['input_data']['identitas']['nama_penyusun'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Institusi</label>
            <input type="text" name="institusi" value="{{ $data['input_data']['identitas']['institusi'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Pelajaran</label>
            <input type="text" name="tahun_pelajaran" value="{{ $data['input_data']['identitas']['tahun_pelajaran'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jenjang Sekolah</label>
            <input type="text" name="jenjang" value="{{ $data['input_data']['identitas']['jenjang'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
            <input type="text" name="kelas" value="{{ $data['input_data']['identitas']['kelas'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Fase</label>
            <input type="text" name="fase" value="{{ $data['input_data']['identitas']['fase'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Alokasi Waktu</label>
            <input type="text" name="alokasi_waktu" value="{{ $data['input_data']['identitas']['alokasi_waktu'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kompetensi Keahlian</label>
            <input type="text" name="kompetensi_keahlian" value="{{ $data['input_data']['identitas']['kompetensi_keahlian'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Elemen</label>
            <input type="text" name="elemen" value="{{ $data['pembelajaran']['elemen'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Capaian Pembelajaran</label>
            <textarea name="capaian_pembelajaran" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none">{{ $data['pembelajaran']['capaian'] ?? '' }}</textarea>
        </div>
    </div>
</div>

<!-- Kompetensi Awal -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Kompetensi Awal</h3>
    <div class="space-y-3">
        @foreach($data['hasil_ai']['kompetensi_awal'] ?? [] as $index => $kompetensi)
        <div class="flex gap-3">
            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold flex items-center justify-center">{{ $index + 1 }}</span>
            <textarea name="kompetensi_awal[]" rows="2" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none">{{ $kompetensi }}</textarea>
        </div>
        @endforeach
    </div>
</div>

<!-- Profil Pelajar Pancasila -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Profil Pelajar Pancasila</h3>
    <div class="flex flex-wrap gap-3">
        @foreach($data['profil_lulusan'] ?? [] as $index => $profil)
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 border border-indigo-200 rounded-lg">
            <input type="text" name="profil_pelajar[]" value="{{ $profil }}" class="bg-transparent border-0 focus:ring-0 p-0 text-sm font-medium text-indigo-900 w-auto min-w-[120px]">
        </div>
        @endforeach
    </div>
</div>

<!-- Sarana Prasarana & Target -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Konfigurasi Pembelajaran</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sarana dan Prasarana</label>
            <textarea name="sarana_prasarana" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none">{{ $data['konfigurasi']['sarana_prasarana'] ?? '' }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Target Peserta Didik</label>
            <textarea name="target_peserta" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none">{{ $data['konfigurasi']['target_peserta'] ?? '' }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Model Pembelajaran</label>
            <input type="text" name="model_pembelajaran" value="{{ $data['konfigurasi']['model_pembelajaran'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
    </div>
</div>

<!-- Tujuan Pembelajaran -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tujuan Pembelajaran</h3>
    <div class="space-y-3">
        @foreach($data['hasil_ai']['tujuan_pembelajaran'] ?? [] as $index => $tujuan)
        <div class="flex gap-3">
            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-green-700 text-xs font-semibold flex items-center justify-center">{{ $index + 1 }}</span>
            <textarea name="tujuan_pembelajaran[]" rows="2" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none">{{ $tujuan }}</textarea>
        </div>
        @endforeach
    </div>
</div>

<!-- Pemahaman Bermakna -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pemahaman Bermakna</h3>
    <textarea name="pemahaman_bermakna" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none">{{ $data['hasil_ai']['pemahaman_bermakna'] ?? '' }}</textarea>
</div>

<!-- Pertanyaan Pemantik -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pertanyaan Pemantik</h3>
    <div class="space-y-3">
        @foreach($data['hasil_ai']['pertanyaan_pemantik'] ?? [] as $index => $pertanyaan)
        <div class="flex gap-3">
            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold flex items-center justify-center">{{ $index + 1 }}</span>
            <textarea name="pertanyaan_pemantik[]" rows="2" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none">{{ $pertanyaan }}</textarea>
        </div>
        @endforeach
    </div>
</div>

<!-- Kegiatan Pembelajaran (Horizontal Layout) -->
@if(isset($data['hasil_ai']['kegiatan_pembelajaran']))
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Data Kegiatan Pembelajaran</h3>

    <div class="space-y-8">
        @foreach($data['hasil_ai']['kegiatan_pembelajaran'] as $pertemuanKey => $pertemuan)
        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="px-3 py-1 bg-indigo-600 text-white text-sm font-semibold rounded-lg">Pertemuan {{ $pertemuanKey }}</span>
            </div>

            <!-- Pembuka -->
            <div class="mb-4">
                <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-600"></span>
                    Kegiatan Pembuka
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 bg-green-50 border border-green-200 p-4 rounded-lg">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Waktu</label>
                        <input type="text" name="kegiatan[{{ $pertemuanKey }}][pembuka][waktu]" value="{{ $pertemuan['kegiatan_pembuka']['alokasi_waktu'] ?? '' }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div class="md:col-span-5">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Kegiatan Guru</label>
                        <textarea name="kegiatan[{{ $pertemuanKey }}][pembuka][guru]" rows="3" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 resize-none">{{ $pertemuan['kegiatan_pembuka']['guru'] ?? '' }}</textarea>
                    </div>
                    <div class="md:col-span-5">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Kegiatan Siswa</label>
                        <textarea name="kegiatan[{{ $pertemuanKey }}][pembuka][siswa]" rows="3" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 resize-none">{{ $pertemuan['kegiatan_pembuka']['siswa'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Inti -->
            @if(isset($pertemuan['kegiatan_inti']))
            <div class="mb-4">
                <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                    Kegiatan Inti
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 bg-blue-50 border border-blue-200 p-4 rounded-lg">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Waktu</label>
                        <input type="text" name="kegiatan[{{ $pertemuanKey }}][inti][waktu]" value="{{ $pertemuan['kegiatan_inti']['alokasi_waktu'] ?? '' }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="md:col-span-5">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Kegiatan Guru</label>
                        <textarea name="kegiatan[{{ $pertemuanKey }}][inti][guru]" rows="5" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none">{{ $pertemuan['kegiatan_inti']['guru'] ?? '' }}</textarea>
                    </div>
                    <div class="md:col-span-5">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Kegiatan Siswa</label>
                        <textarea name="kegiatan[{{ $pertemuanKey }}][inti][siswa]" rows="5" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none">{{ $pertemuan['kegiatan_inti']['siswa'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            @endif

            <!-- Penutup -->
            @if(isset($pertemuan['kegiatan_penutup']))
            <div class="mb-4">
                <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-gray-600"></span>
                    Kegiatan Penutup
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 bg-gray-50 border border-gray-200 p-4 rounded-lg">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Waktu</label>
                        <input type="text" name="kegiatan[{{ $pertemuanKey }}][penutup][waktu]" value="{{ $pertemuan['kegiatan_penutup']['alokasi_waktu'] ?? '' }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500">
                    </div>
                    <div class="md:col-span-5">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Kegiatan Guru</label>
                        <textarea name="kegiatan[{{ $pertemuanKey }}][penutup][guru]" rows="3" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500 resize-none">{{ $pertemuan['kegiatan_penutup']['guru'] ?? '' }}</textarea>
                    </div>
                    <div class="md:col-span-5">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Kegiatan Siswa</label>
                        <textarea name="kegiatan[{{ $pertemuanKey }}][penutup][siswa]" rows="3" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500 resize-none">{{ $pertemuan['kegiatan_penutup']['siswa'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Pengayaan & Remedial -->
@if(isset($data['hasil_ai']['pengayaan']) && isset($data['hasil_ai']['remedial']))
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Pengayaan dan Remedial</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Pengayaan</label>
            <textarea name="pengayaan" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none">{{ $data['hasil_ai']['pengayaan'] ?? '' }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Remedial</label>
            <textarea name="remedial" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none">{{ $data['hasil_ai']['remedial'] ?? '' }}</textarea>
        </div>
    </div>
</div>
@endif

<!-- Assessment Sikap -->
@if(isset($data['hasil_ai']['asesmen']['sikap']))
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Assessment Sikap</h3>

    @foreach($data['hasil_ai']['asesmen']['sikap'] ?? [] as $index => $sikap)
    <div class="mb-6 pb-6 border-b border-gray-200 last:border-0">
        <div class="mb-3">
            <label class="block text-sm font-semibold text-indigo-700 mb-2">Dimensi: {{ $sikap['dimensi'] }}</label>
        </div>
        <div class="space-y-3">
            @foreach($sikap['deskriptor'] ?? [] as $deskIndex => $deskriptor)
            <div class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold flex items-center justify-center">{{ $deskIndex + 1 }}</span>
                <textarea name="assessment_sikap[{{ $index }}][deskriptor][]" rows="2" class="flex-1 px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none">{{ $deskriptor }}</textarea>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endif

<!-- Assessment Pengetahuan (Sumatif) -->
@if(isset($data['hasil_ai']['asesmen']['pengetahuan']))
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Assessment Pengetahuan (Sumatif)</h3>

    @foreach($data['hasil_ai']['asesmen']['pengetahuan']['soal'] ?? [] as $index => $soal)
    <div class="mb-6 pb-6 border-b border-gray-200 last:border-0">
        <div class="flex items-start gap-4">
            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 text-sm font-bold flex items-center justify-center">{{ $soal['nomor'] }}</span>
            <div class="flex-1 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-2">Pertanyaan</label>
                    <textarea name="assessment[{{ $index }}][pertanyaan]" rows="2" class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none">{{ $soal['pertanyaan'] }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-2">
                    @foreach($soal['opsi'] ?? [] as $opsiIndex => $opsi)
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Opsi {{ chr(65 + $opsiIndex) }}</label>
                        <textarea name="assessment[{{ $index }}][opsi][]" rows="3" class="w-full px-3 py-2 text-xs border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none">{{ $opsi }}</textarea>
                    </div>
                    @endforeach
                </div>
                <div class="flex gap-4">
                    <div class="w-32">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Kunci Jawaban</label>
                        <input type="number" name="assessment[{{ $index }}][jawaban]" value="{{ $soal['jawaban'] }}" min="1" max="5" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="w-24">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Level</label>
                        <input type="text" name="assessment[{{ $index }}][level]" value="{{ $soal['level_kognitif'] }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
