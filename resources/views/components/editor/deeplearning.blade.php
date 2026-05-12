{{-- DEEP LEARNING EDITOR --}}

<!-- Informasi Dasar -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Informasi Dasar
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Satuan Pendidikan</label>
            <input type="text" name="satuan_pendidikan" value="{{ $data['satuan_pendidikan'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
            <input type="text" name="mata_pelajaran" value="{{ $data['mata_pelajaran'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Materi Pokok</label>
            <input type="text" name="materi_pokok" value="{{ $data['materi_pokok'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Submateri</label>
            <input type="text" name="sub_materi" value="{{ $data['sub_materi'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Fase</label>
            <input type="text" name="fase" value="{{ $data['fase'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kelas / Semester</label>
            <input type="text" name="kelas_semester" value="{{ $data['kelas_semester'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Alokasi Waktu/Pertemuan</label>
            <input type="text" name="alokasi_waktu" value="{{ $data['alokasi_waktu'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Pelajaran</label>
            <input type="text" name="tahun_pelajaran" value="{{ $data['tahun_pelajaran'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
    </div>
</div>

<!-- Konfigurasi Pembelajaran -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Konfigurasi Pembelajaran</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Dimensi Lulusan Profil</label>
            <input type="text" name="dimensi_lulusan" value="{{ $data['pembelajaran']['dimensi_lulusan'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Model / Metode Pembelajaran</label>
            <input type="text" name="model_pembelajaran" value="{{ $data['konfigurasi']['model_pembelajaran'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sarana dan Prasarana</label>
            <textarea name="sarana_prasarana" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition resize-none">{{ $data['konfigurasi']['sarana_prasarana'] ?? '' }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Target Peserta Didik</label>
            <textarea name="target_peserta" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition resize-none">{{ $data['konfigurasi']['target_peserta'] ?? '' }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Lingkungan Pembelajaran</label>
            <input type="text" name="lingkungan" value="{{ $data['konfigurasi']['lingkungan'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Pemanfaatan Digital</label>
            <input type="text" name="pemanfaatan_digital" value="{{ $data['konfigurasi']['pemanfaatan_digital'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
    </div>
</div>

<!-- Elemen & Capaian -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Elemen & Capaian Pembelajaran</h3>
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Elemen Pembelajaran</label>
            <input type="text" name="elemen" value="{{ $data['pembelajaran']['elemen'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Capaian Pembelajaran</label>
            <textarea name="capaian" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition resize-none">{{ $data['pembelajaran']['capaian'] ?? '' }}</textarea>
        </div>
    </div>
</div>

<!-- Tujuan Pembelajaran -->
@if(isset($data['hasil_ai']['pembelajaran']['tujuan_pembelajaran']))
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tujuan Pembelajaran</h3>

    @foreach($data['hasil_ai']['pembelajaran']['tujuan_pembelajaran'] as $tujuanPertemuan)
    <div class="mb-6 last:mb-0">
        <div class="flex items-center gap-2 mb-3">
            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-semibold rounded-lg">Pertemuan {{ $tujuanPertemuan['pertemuan'] }}</span>
        </div>
        <div class="space-y-2">
            @foreach($tujuanPertemuan['tujuan'] as $index => $tujuan)
            <div class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold flex items-center justify-center">{{ $index + 1 }}</span>
                <textarea name="tujuan_pembelajaran[{{ $tujuanPertemuan['pertemuan'] }}][]" rows="2" class="flex-1 px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none">{{ $tujuan }}</textarea>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endif

<!-- Kegiatan Pembelajaran (Horizontal Layout) -->
@if(isset($data['hasil_ai']['pembelajaran']['pertemuan']))
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Kegiatan Pembelajaran</h3>

    <div class="space-y-8">
        @foreach($data['hasil_ai']['pembelajaran']['pertemuan'] as $pertemuanKey => $pertemuan)
        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="px-3 py-1 bg-purple-600 text-white text-sm font-semibold rounded-lg">Pertemuan {{ $pertemuanKey }}</span>
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
                    <span class="w-2 h-2 rounded-full bg-purple-600"></span>
                    Kegiatan Inti
                </h4>

                @foreach(['memahami', 'mengaplikasikan', 'merefleksi'] as $fase)
                @if(isset($pertemuan['kegiatan_inti'][$fase]))
                <div class="mb-3">
                    <div class="bg-purple-100 px-3 py-1 rounded-t-lg">
                        <span class="text-xs font-semibold text-purple-700 uppercase">{{ ucfirst($fase) }}</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 bg-purple-50 border border-purple-200 p-4 rounded-b-lg">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-gray-700 mb-2">Waktu</label>
                            <input type="text" name="kegiatan[{{ $pertemuanKey }}][inti][{{ $fase }}][waktu]" value="{{ $pertemuan['kegiatan_inti'][$fase]['alokasi_waktu'] ?? '' }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div class="md:col-span-5">
                            <label class="block text-xs font-medium text-gray-700 mb-2">Kegiatan Guru</label>
                            <textarea name="kegiatan[{{ $pertemuanKey }}][inti][{{ $fase }}][guru]" rows="4" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none">{{ $pertemuan['kegiatan_inti'][$fase]['guru'] ?? '' }}</textarea>
                        </div>
                        <div class="md:col-span-5">
                            <label class="block text-xs font-medium text-gray-700 mb-2">Kegiatan Siswa</label>
                            <textarea name="kegiatan[{{ $pertemuanKey }}][inti][{{ $fase }}][siswa]" rows="4" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none">{{ $pertemuan['kegiatan_inti'][$fase]['siswa'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
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

<!-- Assessment Sumatif -->
@if(isset($data['hasil_ai']['assessment_sumatif']))
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Assessment Sumatif</h3>

    @foreach($data['hasil_ai']['assessment_sumatif']['soal'] ?? [] as $index => $soal)
    <div class="mb-6 pb-6 border-b border-gray-200 last:border-0">
        <div class="flex items-start gap-4">
            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-purple-100 text-purple-700 text-sm font-bold flex items-center justify-center">{{ $soal['nomor'] }}</span>
            <div class="flex-1 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-2">Pertanyaan</label>
                    <textarea name="assessment[{{ $index }}][pertanyaan]" rows="2" class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none">{{ $soal['pertanyaan'] }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-2">
                    @foreach($soal['opsi'] ?? [] as $opsiIndex => $opsi)
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Opsi {{ chr(65 + $opsiIndex) }}</label>
                        <textarea name="assessment[{{ $index }}][opsi][]" rows="3" class="w-full px-3 py-2 text-xs border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none">{{ $opsi }}</textarea>
                    </div>
                    @endforeach
                </div>
                <div class="flex gap-4">
                    <div class="w-32">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Kunci Jawaban</label>
                        <input type="number" name="assessment[{{ $index }}][jawaban]" value="{{ $soal['jawaban'] }}" min="1" max="5" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>
                    <div class="w-24">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Level</label>
                        <input type="text" name="assessment[{{ $index }}][level]" value="{{ $soal['level_kognitif'] }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
