<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataRPP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Vinkla\Hashids\Facades\Hashids;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Language;

use function Pest\Laravel\json;

class DokumenController extends Controller
{

    /**
     * Data style dokumen word
     */

    const COLOR_HEADER      = '2d3748';
    const COLOR_SUBHEADER   = '4a5568';
    const COLOR_STRIPE      = 'edf2f7';
    const COLOR_WHITE       = 'FFFFFF';
    const COLOR_BORDER      = 'cbd5e0';
    const COLOR_TEXT_LIGHT  = 'e2e8f0';
    const COLOR_TEXT_BODY   = '000000';
    const COLOR_ACCENT      = '2c5282';
    const COLOR_TEXT_MUTED  = '718096';

    const FONT_FAMILY  = 'Times New Roman';
    const FONT_SIZE    = 12;
    const FONT_SIZE_HP = 24;
    const PAGE_WIDTH   = 8788;



    public function edit($id)
    {
        $decrypt_id = Hashids::decode($id);
        //dd($decrypt_id);
        $data = $this->getDataRPP($decrypt_id);
        //dd($data);
        return view('editor-dokumen', compact('data'));
    }

    protected function getDataRPP($decrypt_id){
        $data = DataRPP::where('id', $decrypt_id)->first();

        if ($data->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($data->status !== 'done') {
            return redirect()->route('riwayat')
                        ->with('error', 'Dokumen belum siap untuk diedit');
        }
            // Parse field yang berisi string JSON
            $dataArray = $data->toArray();
            $dataArray['input_data'] = json_decode($data->input_data, true);
            $dataArray['hasil_ai'] = json_decode($data->hasil_ai, true);
            $dataArray['hashid'] = Hashids::encode($decrypt_id);

            // Encode ulang dengan pretty print
            //return response()->json($dataArray, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return $dataArray;
    }


    public function update(Request $request, $id){
        $decrypt_id = Hashids::decode($id);

        $data = DataRPP::where('id', $decrypt_id)->first();
        $currentData = $this->getDataRPP($decrypt_id);
        //dd($request);
        if ($currentData['core_type'] == 'merdeka') {
            $data->satuan_pendidikan = $request->institusi;
            $data->tahun_pelajaran = $request->tahun_pelajaran;
            $data->kelas_semester = $request->kelas;
            $data->fase = $request->fase;
            $data->alokasi_waktu = $request->alokasi_waktu;
            $data->profil_lulusan = $request->profil_pelajar;
            $data->mata_pelajaran = $request->kompetensi_keahlian;
            //dd($data);
            $konfigurasi = $data->konfigurasi;
            $konfigurasi['target_peserta'] = $request->target_peserta;
            $konfigurasi['sarana_prasarana'] = $request->sarana_prasarana;
            $konfigurasi['model_pembelajaran'] = $request->model_pembelajaran;
            $data->konfigurasi = $konfigurasi;
            //dd($data->konfigurasi);

            $pembelajaran = $data->pembelajaran;
            $pembelajaran['elemen'] = $request->elemen;
            $pembelajaran['capaian'] = $request->capaian_pembelajaran;
            $data->pembelajaran = $pembelajaran;
            $input_data = json_decode($data->input_data, true);
            $input_data['identitas']['nama_penyusun'] = $request->nama_penyusun;
            $input_data['identitas']['satuan_pendidikan'] = $request->institusi;
            $input_data['identitas']['tahun_pelajaran'] = $request->tahun_pelajaran;
            $input_data['identitas']['fase'] = $request->fase;
            $input_data['identitas']['alokasi_waktu'] = $request->alokasi_waktu;
            $data->input_data = json_encode($input_data);

            $hasil_ai = json_decode($data->hasil_ai, true);
            //dd($hasil_ai);
            $hasil_ai['tujuan_pembelajaran'] = $request->input('tujuan_pembelajaran');
            $hasil_ai['kompetensi_awal']     = $request->input('kompetensi_awal', []);
            $hasil_ai['pemahaman_bermakna']  = $request->input('pemahaman_bermakna', "");
            $hasil_ai['pertanyaan_pemantik'] = $request->input('pertanyaan_pemantik', []);

            $kegiatan_raw = $request->input('kegiatan', []);
            $hasil_ai['kegiatan_pembelajaran'] = [];
            foreach ($kegiatan_raw as $pertemuan => $detail) {
                $hasil_ai['kegiatan_pembelajaran'][$pertemuan] = [
                    "kegiatan_pembuka" => [
                        "alokasi_waktu" => $detail['pembuka']['waktu'] ?? "",
                        "guru"          => $detail['pembuka']['guru'] ?? "",
                        "siswa"         => $detail['pembuka']['siswa'] ?? "",
                    ],
                    "kegiatan_inti" => [
                        "alokasi_waktu" => $detail['inti']['waktu'] ?? "",
                        "guru"          => $detail['inti']['guru'] ?? "",
                        "siswa"         => $detail['inti']['siswa'] ?? "",
                    ],
                    "kegiatan_penutup" => [
                        "alokasi_waktu" => $detail['penutup']['waktu'] ?? "",
                        "guru"          => $detail['penutup']['guru'] ?? "",
                        "siswa"         => $detail['penutup']['siswa'] ?? "",
                    ],
                ];
            }

            $profil_pelajar = $request->input('profil_pelajar', []);
            $sikap_raw = $request->input('assessment_sikap', []);
            $asesmen_sikap = [];
            foreach ($profil_pelajar as $index => $dimensi) {
                $asesmen_sikap[] = [
                    "dimensi"    => $dimensi,
                    "deskriptor" => $sikap_raw[$index]['deskriptor'] ?? []
                ];
            }

            $soal_raw = $request->input('assessment', []);
            $soal_list = [];

            foreach ($soal_raw as $index => $s) {
                $soal_list[] = [
                    "nomor"          => $index + 1,
                    "pertanyaan"     => $s['pertanyaan'] ?? "",
                    "opsi"           => $s['opsi'] ?? [],
                    "jawaban"        => (int)($s['jawaban'] ?? 0),
                    "level_kognitif" => $s['level'] ?? ""
                ];
            }

            $asesmen_pengetahuan = [
                "jumlah_soal" => count($soal_list),
                "soal"        => $soal_list
            ];

            $pengayaan = $request->input('pengayaan', "");
            $remedial  = $request->input('remedial', "");

            $hasil_ai['asesmen'] = [
                "sikap"       => $asesmen_sikap,
                "pengetahuan" => $asesmen_pengetahuan
            ];
            $data->hasil_ai = json_encode($hasil_ai);

            $data->save();

            return redirect()->route('rpp.view', ['id' => Hashids::encode($data->id)])->with('success', 'Data berhasil diperbarui!');


        }else{

            $data->satuan_pendidikan = $request->satuan_pendidikan;
            $data->mata_pelajaran = $request->mata_pelajaran;
            $data->materi_pokok = $request->materi_pokok;
            $data->sub_materi = $request->sub_materi;
            $data->fase = $request->fase;
            $data->kelas_semester = $request->kelas_semester;
            $data->alokasi_waktu = $request->alokasi_waktu;
            $data->tahun_pelajaran = $request->tahun_pelajaran;

            $konfigurasi = [
                'lingkungan' => $request->lingkungan,
                'target_peserta' => $request->target_peserta,
                'sarana_prasarana' => $request->sarana_prasarana,
                'deskripsi_industri' => $request->deskripsi_industri ?? "Standart Terbaru di Industri",
                'model_pembelajaran' => $request->model_pembelajaran,
                'pemanfaatan_digital' => $request->pemanfaatan_digital,
            ];
            //dd($data->konfigurasi, $konfigurasi); //OK
            $data->konfigurasi = json_encode($konfigurasi);


            $pembelajaran = [
                'elemen' => $request->elemen,
                'capaian' => $request->capaian,
                'level_kognitif' => $request->level_kognitif ?? [
                    'c1' => "0", 'c2' => "0", 'c3' => "5", 'c4' => "5", 'c5' => "5", 'c6' => "0"
                ],
                'dimensi_lulusan' => $request->dimensi_lulusan,
                'jumlah_pertemuan' => count($request->tujuan_pembelajaran ?? []),
            ];
            //dd($data->pembelajaran, $pembelajaran); //OK
            $data->pembelajaran = json_encode($pembelajaran);


            $input_data = [
                'identitas' => [
                    'nama_penyusun' => Auth::user()->name,
                    'satuan_pendidikan' => $request->satuan_pendidikan,
                    'tahun_pelajaran' => $request->tahun_pelajaran,
                    'jenjang' => "SMK",
                    'kelas' => $request->kelas_semester,
                    'mata_pelajaran' => $request->mata_pelajaran,
                    'fase' => $request->fase,
                    'alokasi_waktu' => $request->alokasi_waktu,
                ],
                'materi' => [
                    'materi_pokok' => $request->materi_pokok,
                    'sub_materi' => $request->sub_materi,
                ],
                'konfigurasi' => $konfigurasi,
                'pembelajaran' => $pembelajaran,
            ];
            //dd(json_decode($data->input_data, true), $input_data); //OK
            $data->input_data = json_encode($input_data);

            $soal_formatted = [];
                if ($request->has('assessment')) {
                    foreach ($request->assessment as $index => $item) {
                        $soal_formatted[] = [
                            'nomor' => (int)$index + 1, // Memberikan nomor urut mulai dari 1
                            'pertanyaan' => $item['pertanyaan'],
                            'opsi' => $item['opsi'],
                            'jawaban' => (int)$item['jawaban'],
                            'level_kognitif' => $item['level'] ?? "C3",
                        ];
                    }
                }

            $hasil_ai = [
                'profil_lulusan' => array_map('trim', explode(',', $request->dimensi_lulusan)),
                'pembelajaran' => [
                    'elemen' => $request->elemen,
                    'capaian' => $request->capaian,
                    'jumlah_pertemuan' => count($request->tujuan_pembelajaran ?? []),
                    'dimensi_lulusan' => array_map('trim', explode(',', $request->dimensi_lulusan)),
                    'tujuan_pembelajaran' => array_map(function($pertemuan, $tujuan) {
                        return ['pertemuan' => $pertemuan, 'tujuan' => $tujuan];
                    }, array_keys($request->tujuan_pembelajaran), $request->tujuan_pembelajaran),
                    'pertemuan' => $request->kegiatan,
                ],
                'assessment_sumatif' => [
                    'jumlah_soal' => count($request->assessment ?? []),
                    'soal' => $soal_formatted,
                ]
            ];

            //dd(json_decode($data->hasil_ai, true), $hasil_ai); //OK
            $data->hasil_ai = json_encode($hasil_ai);

            $data->status = "done";
            $data->core_type = "deep_learning";

            $data->save();

            return redirect()->route('rpp.view', ['id' => Hashids::encode($data->id)])->with('success', 'Data berhasil diperbarui!');
        }

    }

    public function dataMapperMerdeka($id){
        $decrypt_id = Hashids::decode($id);

        $data = $this->getDataRPP($decrypt_id);
        //dd($data);

        $data_mapper = [
            'hashid' => $data['hashid'],
            'type' => $data['core_type'],
            "nama_user" => $data['input_data']['identitas']['nama_penyusun'],
            "instansi" => $data['satuan_pendidikan'],
            "tahun_penyusunan" => $data['tahun_pelajaran'],
            "jenjang" => "SMK",
            "kelas" => $data['kelas_semester'],
            "fase" => $data['fase'],
            "alokasi_waktu" => $data['alokasi_waktu'],
            "kompetensi_keahian" => $data['mata_pelajaran'],
            "elemen" => $data['pembelajaran']['elemen'],
            "capaian_pembelajaran" => $data['pembelajaran']['capaian'],
            "kompetensi_awal" => $data['hasil_ai']['kompetensi_awal'],
            "profil_pelajar" => $data['profil_lulusan'],
            "sarana_prasarana" => $data['hasil_ai']['sarana_prasarana'],
            "target_peserta" => $data['konfigurasi']['target_peserta'],
            "model_pembelajaran" => $data['konfigurasi']['model_pembelajaran'],
            "tujuan_pembelajaran" => $data['hasil_ai']['tujuan_pembelajaran'],
            "pemahaman_bermakna" => $data['hasil_ai']['pemahaman_bermakna'],
            "pertanyaan_pemantik" => $data['hasil_ai']['pertanyaan_pemantik'],
            "kegiatan_pembelajaran" => $data['hasil_ai']['kegiatan_pembelajaran'],
            "asesmen_sikap" => $data['hasil_ai']['asesmen']['sikap'],
            "asesmen_pengetahuan" => $data['hasil_ai']['asesmen']['pengetahuan']['soal'],
            "pengayaan" => $data['hasil_ai']['pengayaan'],
            "remedial" => $data['hasil_ai']['remedial'],

        ];
        //dd($data_mapper);

        return $data_mapper;
    }

    public function dataMapperDeeplearning($id){
        $decrypt_id = Hashids::decode($id);

        $data = $this->getDataRPP($decrypt_id);
        //dd($data);

        $data_mapper = [
            'hashid' => $data['hashid'],
            'type' => $data['core_type'],
            "nama_user" => $data['input_data']['identitas']['nama_penyusun'],
            "mata_pelajaran" => $data['mata_pelajaran'],
            "materi_pokok" => $data['materi_pokok'],
            "sub_materi" => $data['input_data']['materi']['sub_materi'],
            "fase" => $data['fase'],
            "kelas" => $data['kelas_semester'],
            "alokasi_waktu" => $data['alokasi_waktu'],
            "tahun_ajaran" => $data['tahun_pelajaran'],
            "dimensi_lulusan" => $data['hasil_ai']['profil_lulusan'],
            "sarana_prasarana" => $data['input_data']['konfigurasi']['sarana_prasarana'],
            "target_peserta" => $data['input_data']['konfigurasi']['target_peserta'],
            "model_pembelajaran" => $data['input_data']['konfigurasi']['model_pembelajaran'],
            "lingkungan_pembelajaran" => $data['input_data']['konfigurasi']['lingkungan'],
            "pemanfaatan_digital" => $data['input_data']['konfigurasi']['pemanfaatan_digital'],
            "elemen" => $data['input_data']['pembelajaran']['elemen'],
            "capaian_pembelajaran" => $data['input_data']['pembelajaran']['capaian'],
            "tujuan_pembelajaran" => $data['hasil_ai']['pembelajaran']['tujuan_pembelajaran'],
            "kegiatan_pembelajaran" => $data['hasil_ai']['pembelajaran']['pertemuan'],
            "asesmen_pengetahuan" => $data['hasil_ai']['assessment_sumatif']['soal'],
        ];

        return $data_mapper;
    }




    public function requestGenerateDocx($id){
        $type = DataRPP::where('id', Hashids::decode($id))->value('core_type');
        if($type == 'merdeka'){
            $file = $this->generateDocxMerdeka($id);
            return response()->download($file)->deleteFileAfterSend();
        }else if($type == 'deep_learning'){
            $file = $this->generateDocxDeeplearning($id);
            return response()->download($file)->deleteFileAfterSend();
        }else{

        }

    }

    public function generateDocxMerdeka($id)
    {
        $data = $this->dataMapperMerdeka($id);

        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName(self::FONT_FAMILY);
        $phpWord->setDefaultFontSize(self::FONT_SIZE);
        $phpWord->setDefaultParagraphStyle([
            'lineHeight'  => 1.5,
            'spaceBefore' => 0,
            'spaceAfter'  => Converter::pointToTwip(4),
        ]);

        $this->registerTableStyles($phpWord);

        // --- SECTION 1: COVER ---
        $coverSection = $phpWord->addSection([
            'marginTop'    => Converter::cmToTwip(3),
            'marginBottom' => Converter::cmToTwip(3),
            'marginLeft'   => Converter::cmToTwip(3),
            'marginRight'  => Converter::cmToTwip(2.5),
            'breakType'    => 'nextPage',
        ]);
        $this->addCoverPage($coverSection, $data);

        // --- SECTION 2: ISI ---
        $section = $phpWord->addSection([
            'marginTop'    => Converter::cmToTwip(2.5),
            'marginBottom' => Converter::cmToTwip(2.5),
            'marginLeft'   => Converter::cmToTwip(3),
            'marginRight'  => Converter::cmToTwip(2.5),
        ]);

        $this->addSectionHeading($section, 'Identitas Modul');
        $this->addIdentitasTable($section, $data);
        $section->addTextBreak(1);

        $this->addBulletSection($section, 'Kompetensi Awal',          $data['kompetensi_awal']     ?? []);
        $this->addBulletSection($section, 'Profil Pelajar Pancasila',  $data['profil_pelajar']      ?? []);
        $this->addBulletSection($section, 'Tujuan Pembelajaran',       $data['tujuan_pembelajaran'] ?? []);
        $this->addBulletSection($section, 'Pertanyaan Pemantik',       $data['pertanyaan_pemantik'] ?? []);

        if (!empty($data['sarana_prasarana'])) {
            $this->addSaranaSection($section, $data['sarana_prasarana']);
        }

        if (!empty($data['pemahaman_bermakna'])) {
            $this->addSectionHeading($section, 'Pemahaman Bermakna');
            $section->addText($data['pemahaman_bermakna'], $this->bodyFont(), $this->bodyParagraph());
            $section->addTextBreak(1);
        }

        if (!empty($data['kegiatan_pembelajaran'])) {
            $this->addSectionHeading($section, 'Kegiatan Pembelajaran');
            $this->addKegiatanTable($section, $data['kegiatan_pembelajaran']);
            $section->addTextBreak(1);
        }

        if (!empty($data['asesmen_sikap'])) {
            $this->addSectionHeading($section, 'Asesmen Sikap');
            $this->addAsesmenSikapTable($section, $data['asesmen_sikap']);
            $section->addTextBreak(1);
        }

        if (!empty($data['asesmen_pengetahuan'])) {
            $this->addSectionHeading($section, 'Asesmen Pengetahuan');
            $this->addAsesmenPengetahuan($section, $data['asesmen_pengetahuan']);
        }

        if (!empty($data['pengayaan'])) {
            $this->addSectionHeading($section, 'Pengayaan');
            $section->addText($data['pengayaan'], $this->bodyFont(), $this->bodyParagraph());
            $section->addTextBreak(1);
        }

        if (!empty($data['remedial'])) {
            $this->addSectionHeading($section, 'Remedial');
            $section->addText($data['remedial'], $this->bodyFont(), $this->bodyParagraph());
        }

        $file = storage_path('app/public/modul.docx');
        IOFactory::createWriter($phpWord, 'Word2007')->save($file);

        return $file;
        //return response()->download($file)->deleteFileAfterSend();
    }

    public function generateDocxDeeplearning($id)
    {
        $data = $this->dataMapperDeeplearning($id);

        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName(self::FONT_FAMILY);
        $phpWord->setDefaultFontSize(self::FONT_SIZE);
        $phpWord->setDefaultParagraphStyle([
            'lineHeight'  => 1.5,
            'spaceBefore' => 0,
            'spaceAfter'  => Converter::pointToTwip(4),
        ]);

        $this->registerTableStyles($phpWord);

        // --- SECTION 1: COVER ---
        $coverSection = $phpWord->addSection([
            'marginTop'    => Converter::cmToTwip(3),
            'marginBottom' => Converter::cmToTwip(3),
            'marginLeft'   => Converter::cmToTwip(3),
            'marginRight'  => Converter::cmToTwip(2.5),
            'breakType'    => 'nextPage',
        ]);
        $this->addCoverPage($coverSection, $data);

        // --- SECTION 2: ISI ---
        $section = $phpWord->addSection([
            'marginTop'    => Converter::cmToTwip(2.5),
            'marginBottom' => Converter::cmToTwip(2.5),
            'marginLeft'   => Converter::cmToTwip(3),
            'marginRight'  => Converter::cmToTwip(2.5),
        ]);

        // Identitas Modul — field khusus deep learning
        $this->addSectionHeading($section, 'Identitas Modul');
        $this->addIdentitasTableDeeplearning($section, $data);
        $section->addTextBreak(1);

        // Dimensi Lulusan (array of strings)
        $this->addBulletSection($section, 'Dimensi Lulusan', $data['dimensi_lulusan'] ?? []);

        // Tujuan Pembelajaran — per pertemuan
        if (!empty($data['tujuan_pembelajaran'])) {
            $this->addSectionHeading($section, 'Tujuan Pembelajaran');
            $this->addTujuanPembelajaranDeeplearning($section, $data['tujuan_pembelajaran']);
            $section->addTextBreak(1);
        }

        // Kegiatan Pembelajaran — dengan sub-kegiatan bernama
        if (!empty($data['kegiatan_pembelajaran'])) {
            $this->addSectionHeading($section, 'Kegiatan Pembelajaran');
            $this->addKegiatanTableDeeplearning($section, $data['kegiatan_pembelajaran']);
            $section->addTextBreak(1);
        }

        // Asesmen Pengetahuan
        if (!empty($data['asesmen_pengetahuan'])) {
            $this->addSectionHeading($section, 'Asesmen Pengetahuan');
            $this->addAsesmenPengetahuan($section, $data['asesmen_pengetahuan']);
        }

        $file = storage_path('app/public/modul_deeplearning.docx');
        IOFactory::createWriter($phpWord, 'Word2007')->save($file);

        return $file;
    }


    // =========================================
    // COVER PAGE
    // =========================================

    private function addCoverPage($section, array $data)
    {
        $type     = strtolower($data['type'] ?? '');
        $jenisDoc = match(true) {
            str_contains($type, 'deep')    => 'Deep Learning',
            str_contains($type, 'merdeka') => 'Kurikulum Merdeka',
            default                         => ucwords(str_replace('_', ' ', $type)),
        };

        $mapel      = $data['kompetensi_keahian'] ?? ($data['mata_pelajaran'] ?? '-');
        $instansi   = $data['instansi']           ?? '-';
        $namaUser   = $data['nama_user']          ?? '-';
        $bulanTahun = !empty($data['created_at'])
            ? $this->formatBulanTahun($data['created_at'])
            : $this->formatBulanTahun(now()->toDateString());

        for ($i = 0; $i < 5; $i++) {
            $section->addTextBreak(1);
        }

        $section->addText(
            'RANCANGAN PEMBELAJARAN',
            ['name' => self::FONT_FAMILY, 'size' => 20, 'bold' => true, 'color' => self::COLOR_HEADER, 'allCaps' => true],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 80]
        );

        $section->addText(
            $jenisDoc,
            ['name' => self::FONT_FAMILY, 'size' => 14, 'bold' => true, 'color' => self::COLOR_ACCENT],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 140]
        );

        $this->addHorizontalRule($section);
        $section->addTextBreak(1);

        $section->addText(
            'Mata Pelajaran / Kompetensi Keahlian',
            ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'color' => self::COLOR_TEXT_MUTED, 'italic' => true],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 40]
        );

        $section->addText(
            $mapel,
            ['name' => self::FONT_FAMILY, 'size' => 13, 'bold' => true, 'color' => self::COLOR_HEADER],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 200]
        );

        for ($i = 0; $i < 4; $i++) {
            $section->addTextBreak(1);
        }

        $this->addHorizontalRule($section);
        $section->addTextBreak(1);

        $section->addText(
            'Disusun oleh',
            ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'color' => self::COLOR_TEXT_MUTED, 'italic' => true],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 40]
        );

        $section->addText(
            $namaUser,
            ['name' => self::FONT_FAMILY, 'size' => 13, 'bold' => true, 'color' => self::COLOR_HEADER],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 60]
        );

        $section->addText(
            $instansi,
            ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'color' => self::COLOR_TEXT_BODY],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 60]
        );

        $section->addText(
            $bulanTahun,
            ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'color' => self::COLOR_TEXT_MUTED],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );
    }


    // =========================================
    // IDENTITAS TABLE
    // =========================================

    private function addIdentitasTable($section, array $data)
    {
        $skipKeys = [
            'kompetensi_awal', 'profil_pelajar', 'sarana_prasarana',
            'tujuan_pembelajaran', 'pertanyaan_pemantik', 'kegiatan_pembelajaran',
            'asesmen_sikap', 'asesmen_pengetahuan', 'pengayaan', 'remedial',
            'pemahaman_bermakna', 'type', 'nama_user', 'instansi',
            'tahun_penyusunan', 'created_at', 'updated_at', 'hashid',
        ];

        $rows = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $skipKeys) || is_array($value)) continue;
            $rows[] = [$this->formatKey($key), (string)$value];
        }

        if (empty($rows)) return;

        $colWidths = [3200, 300, 5288]; // total = 8788

        $table = $section->addTable('identitasTable');

        foreach ($rows as $i => [$label, $value]) {
            $fillColor = ($i % 2 === 0) ? self::COLOR_WHITE : self::COLOR_STRIPE;

            $table->addRow();
            $table->addCell($colWidths[0], $this->cellStyle($fillColor))
                  ->addText($label, $this->bodyFontBold(), $this->tableParagraph());
            $table->addCell($colWidths[1], $this->cellStyle($fillColor))
                  ->addText(':', $this->bodyFont(), $this->tableParagraph());
            $table->addCell($colWidths[2], $this->cellStyle($fillColor))
                  ->addText($value, $this->bodyFont(), $this->tableParagraph());
        }
    }


    // =========================================
    // BULLET LIST SECTION
    // =========================================

    private function addBulletSection($section, string $title, array $items)
    {
        if (empty($items)) return;

        $this->addSectionHeading($section, $title);

        foreach ($items as $item) {
            $section->addListItem(
                $item,
                0,
                $this->bodyFont(),
                ['listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED],
                $this->bodyParagraph()
            );
        }

        $section->addTextBreak(1);
    }


    // =========================================
    // SARANA DAN PRASARANA
    // =========================================

    private function addSaranaSection($section, array $sp)
    {
        $this->addSectionHeading($section, 'Sarana dan Prasarana');

        $colWidths = [2200, 6588]; // total = 8788

        $table = $section->addTable('identitasTable');

        $table->addRow();
        foreach (['Kategori', 'Item'] as $i => $hdr) {
            $table->addCell($colWidths[$i], $this->headerCellStyle())
                  ->addText($hdr, $this->headerFont(), $this->tableParagraph());
        }

        $rowIndex = 0;
        foreach (['sarana' => 'Sarana', 'prasarana' => 'Prasarana'] as $key => $label) {
            if (empty($sp[$key])) continue;

            $allItems = [];
            foreach ($sp[$key] as $subKey => $items) {
                $subLabel = ucwords(str_replace('_', ' ', $subKey));
                foreach ($items as $item) {
                    $allItems[] = "[$subLabel] $item";
                }
            }

            $fillColor = ($rowIndex % 2 === 0) ? self::COLOR_WHITE : self::COLOR_STRIPE;
            $table->addRow();
            $table->addCell($colWidths[0], $this->cellStyle($fillColor))
                  ->addText($label, $this->bodyFontBold(), $this->tableParagraph());

            $itemCell = $table->addCell($colWidths[1], $this->cellStyle($fillColor));
            foreach ($allItems as $item) {
                $itemCell->addListItem(
                    $item, 0, $this->bodyFont(),
                    ['listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED],
                    $this->tableParagraph()
                );
            }

            $rowIndex++;
        }

        $section->addTextBreak(1);
    }


    // =========================================
    // KEGIATAN PEMBELAJARAN
    // =========================================

    private function addKegiatanTable($section, array $kegiatan)
    {
        foreach ($kegiatan as $pertemuanKey => $pertemuan) {
            $no = str_replace('pertemuan_', '', $pertemuanKey);

            $section->addText(
                "Pertemuan $no",
                ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'bold' => true, 'color' => self::COLOR_ACCENT,
                'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE],
                $this->bodyParagraph()
            );

            $colWidths = [1700, 3544, 3544];
            $table = $section->addTable('kegiatanTable');

            $table->addRow();
            foreach (['Alokasi Waktu', 'Kegiatan Guru', 'Kegiatan Siswa'] as $i => $hdr) {
                $table->addCell($colWidths[$i], $this->headerCellStyle())
                    ->addText($hdr, $this->headerFont(), $this->tableParagraph());
            }

            // Gunakan helper yang sama
            $this->addKegiatanBlokRow($table, $colWidths, 'Kegiatan Pembuka', $pertemuan['kegiatan_pembuka'] ?? null);
            $this->addKegiatanBlokRow($table, $colWidths, 'Kegiatan Inti',    $pertemuan['kegiatan_inti']    ?? null);
            $this->addKegiatanBlokRow($table, $colWidths, 'Kegiatan Penutup', $pertemuan['kegiatan_penutup'] ?? null);

            $section->addTextBreak(1);
        }

    }


    // =========================================
    // ASESMEN SIKAP
    // =========================================

    private function addAsesmenSikapTable($section, array $asesmen)
    {
        $numSkor    = 5;
        $labelWidth = 2200;
        $skorWidth  = (int)(($this->pageWidth() - $labelWidth) / $numSkor);
        $colWidths  = array_merge([$labelWidth], array_fill(0, $numSkor, $skorWidth));

        $table = $section->addTable('asesmenTable');

        $table->addRow();
        $table->addCell($colWidths[0], $this->headerCellStyle())
              ->addText('Dimensi', $this->headerFont(), $this->tableParagraph());
        for ($i = 1; $i <= $numSkor; $i++) {
            $table->addCell($colWidths[$i], $this->headerCellStyle())
                  ->addText("Skor $i", $this->headerFont(), $this->tableParagraph());
        }

        foreach ($asesmen as $idx => $row) {
            $fillColor = ($idx % 2 === 0) ? self::COLOR_WHITE : self::COLOR_STRIPE;

            $table->addRow();
            $table->addCell($colWidths[0], $this->cellStyle($fillColor))
                  ->addText($row['dimensi'] ?? '-', $this->bodyFontBold(), $this->tableParagraph());

            $descriptors = $row['deskriptor'] ?? [];
            for ($i = 0; $i < $numSkor; $i++) {
                $table->addCell($colWidths[$i + 1], $this->cellStyle($fillColor))
                      ->addText($descriptors[$i] ?? '-', $this->bodyFont(['size' => 10]), $this->tableParagraph());
            }
        }
    }


    // =========================================
    // ASESMEN PENGETAHUAN
    // =========================================

    private function addAsesmenPengetahuan($section, array $soalList)
    {
        foreach ($soalList as $soal) {
            $section->addText(
                ($soal['nomor'] ?? '') . '. ' . ($soal['pertanyaan'] ?? ''),
                $this->bodyFontBold(),
                $this->bodyParagraph()
            );

            foreach (($soal['opsi'] ?? []) as $i => $opsi) {
                $label = chr(65 + $i);
                $section->addText(
                    "$label. $opsi",
                    $this->bodyFont(),
                    ['indentation' => ['left' => 720], 'lineHeight' => 1.5]
                );
            }

            $jawabanLabel = chr(65 + (($soal['jawaban'] ?? 1) - 1));
            $section->addText(
                "Jawaban: $jawabanLabel   |   Level Kognitif: " . ($soal['level_kognitif'] ?? '-'),
                ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'italic' => true, 'color' => self::COLOR_TEXT_MUTED],
                ['indentation' => ['left' => 720], 'lineHeight' => 1.5, 'spaceAfter' => 100]
            );

            $section->addTextBreak(1);
        }
    }


    // =========================================
    // REGISTRASI STYLE TABEL
    // =========================================

    private function registerTableStyles(PhpWord $phpWord)
    {
        $base = [
            'borderSize'  => 3,
            'borderColor' => self::COLOR_BORDER,
            'cellMargin'  => 100,
        ];

        $phpWord->addTableStyle('identitasTable', $base);
        $phpWord->addTableStyle('kegiatanTable',  $base);
        $phpWord->addTableStyle('asesmenTable',   $base);
    }


    // =========================================
    // FONT & PARAGRAPH HELPERS
    // =========================================

    private function bodyFont(array $override = []): array
    {
        return array_merge([
            'name'  => self::FONT_FAMILY,
            'size'  => self::FONT_SIZE,
            'color' => self::COLOR_TEXT_BODY,
        ], $override);
    }

    private function bodyFontBold(array $override = []): array
    {
        return $this->bodyFont(array_merge(['bold' => true], $override));
    }

    private function headerFont(): array
    {
        return [
            'name'  => self::FONT_FAMILY,
            'size'  => self::FONT_SIZE,
            'bold'  => true,
            'color' => self::COLOR_TEXT_LIGHT,
        ];
    }

    private function bodyParagraph(array $override = []): array
    {
        return array_merge([
            'lineHeight'  => 1.5,
            'spaceBefore' => 0,
            'spaceAfter'  => 60,
        ], $override);
    }

    private function tableParagraph(array $override = []): array
    {
        return array_merge(['lineHeight' => 1.5, 'spaceAfter' => 0], $override);
    }

    private function cellStyle(string $fillColor, array $override = []): array
    {
        return array_merge([
            'bgColor'     => $fillColor,
            'borderSize'  => 3,
            'borderColor' => self::COLOR_BORDER,
            'valign'      => 'top',
        ], $override);
    }

    private function headerCellStyle(): array
    {
        return [
            'bgColor'     => self::COLOR_HEADER,
            'borderSize'  => 3,
            'borderColor' => self::COLOR_HEADER,
            'valign'      => 'center',
        ];
    }

    private function addSectionHeading($section, string $title)
    {
        $section->addText(
            $title,
            ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'bold' => true, 'color' => self::COLOR_HEADER],
            [
                'lineHeight'  => 1.5,
                'spaceBefore' => 120,
                'spaceAfter'  => 80,
                'border'      => ['bottom' => ['size' => 6, 'color' => self::COLOR_BORDER, 'style' => 'single']],
            ]
        );
    }

    private function addHorizontalRule($section)
    {
        $section->addText(
            '',
            [],
            ['border' => ['bottom' => ['size' => 6, 'color' => self::COLOR_BORDER, 'style' => 'single']], 'spaceAfter' => 120]
        );
    }


    // =========================================
    // BULLET TEXT PARSER
    // =========================================

    private function addBulletTextToCell($cell, string $text)
    {

        $parts = preg_split('/\s*•\s*/', $text, -1, PREG_SPLIT_NO_EMPTY);

        if (empty($parts)) {
            $cell->addText('-', $this->bodyFont(), $this->tableParagraph());
            return;
        }

        foreach ($parts as $part) {
            $part = trim($part);
            if ($part === '') continue;

            $cell->addListItem(
                $part, 0,
                $this->bodyFont(),
                ['listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED],
                $this->tableParagraph()
            );
        }
    }


    // =========================================
    // UTILITY
    // =========================================

    private function pageWidth(): int
    {
        return self::PAGE_WIDTH;
    }

    private function formatKey(string $key): string
    {
        $map = [
            'hashid'               => 'ID Modul',
            'type'                 => 'Jenis Kurikulum',
            'nama_user'            => 'Nama Guru',
            'instansi'             => 'Instansi',
            'tahun_penyusunan'     => 'Tahun Penyusunan',
            'jenjang'              => 'Jenjang',
            'kelas'                => 'Kelas',
            'fase'                 => 'Fase',
            'alokasi_waktu'        => 'Alokasi Waktu',
            'kompetensi_keahian'   => 'Kompetensi Keahlian',
            'elemen'               => 'Elemen',
            'capaian_pembelajaran' => 'Capaian Pembelajaran',
            'target_peserta'       => 'Target Peserta Didik',
            'model_pembelajaran'   => 'Model Pembelajaran',
        ];

        return $map[$key] ?? ucwords(str_replace('_', ' ', $key));
    }

    private function formatBulanTahun(string $dateString): string
    {
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        try {
            $date = new \DateTime($dateString);
            return $bulanIndo[(int)$date->format('n')] . ' ' . $date->format('Y');
        } catch (\Exception $e) {
            return date('Y');
        }
    }
    private function addIdentitasTableDeeplearning($section, array $data)
    {
        // Key yang ditampilkan di tabel identitas, urutan eksplisit
        $identitasKeys = [
            'mata_pelajaran'        => 'Mata Pelajaran',
            'materi_pokok'          => 'Materi Pokok',
            'sub_materi'            => 'Sub Materi',
            'fase'                  => 'Fase',
            'kelas'                 => 'Kelas',
            'alokasi_waktu'         => 'Alokasi Waktu',
            'tahun_ajaran'          => 'Tahun Ajaran',
            'target_peserta'        => 'Target Peserta Didik',
            'model_pembelajaran'    => 'Model Pembelajaran',
            'lingkungan_pembelajaran' => 'Lingkungan Pembelajaran',
            'pemanfaatan_digital'   => 'Pemanfaatan Digital',
            'elemen'                => 'Elemen',
            'capaian_pembelajaran'  => 'Capaian Pembelajaran',
        ];

        $rows = [];
        foreach ($identitasKeys as $key => $label) {
            if (!isset($data[$key]) || is_array($data[$key])) continue;
            $rows[] = [$label, (string)$data[$key]];
        }

        if (empty($rows)) return;

        $colWidths = [3200, 300, 5288];
        $table = $section->addTable('identitasTable');

        foreach ($rows as $i => [$label, $value]) {
            $fillColor = ($i % 2 === 0) ? self::COLOR_WHITE : self::COLOR_STRIPE;

            $table->addRow();
            $table->addCell($colWidths[0], $this->cellStyle($fillColor))
                ->addText($label, $this->bodyFontBold(), $this->tableParagraph());
            $table->addCell($colWidths[1], $this->cellStyle($fillColor))
                ->addText(':', $this->bodyFont(), $this->tableParagraph());
            $table->addCell($colWidths[2], $this->cellStyle($fillColor))
                ->addText($value, $this->bodyFont(), $this->tableParagraph());
        }
    }

    private function addTujuanPembelajaranDeeplearning($section, array $tujuanList)
    {
        foreach ($tujuanList as $item) {
            $no = $item['pertemuan'] ?? '-';

            $section->addText(
                "Pertemuan $no",
                ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'bold' => true, 'color' => self::COLOR_ACCENT],
                $this->bodyParagraph(['spaceAfter' => 40])
            );

            foreach (($item['tujuan'] ?? []) as $tujuan) {
                $section->addListItem(
                    $tujuan,
                    0,
                    $this->bodyFont(),
                    ['listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED],
                    $this->bodyParagraph()
                );
            }

            $section->addTextBreak(1);
        }
    }

    private function addKegiatanTableDeeplearning($section, array $kegiatan)
    {
        // Sub-kegiatan inti yang akan di-render sebagai sub-section bernama
        $subKegiatanIntiLabels = [
            'memahami'        => 'Memahami',
            'mengaplikasikan' => 'Mengaplikasikan',
            'merefleksi'      => 'Merefleksi',
            // Tambahkan key lain jika ada, misal 'mengevaluasi', dsb.
        ];

        foreach ($kegiatan as $pertemuanKey => $pertemuan) {
            $no = is_numeric($pertemuanKey)
                ? $pertemuanKey
                : str_replace('pertemuan_', '', $pertemuanKey);

            $section->addText(
                "Pertemuan $no",
                ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'bold' => true, 'color' => self::COLOR_ACCENT,
                'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE],
                $this->bodyParagraph()
            );

            $colWidths = [1700, 3544, 3544];

            $table = $section->addTable('kegiatanTable');

            // Header
            $table->addRow();
            foreach (['Alokasi Waktu', 'Kegiatan Guru', 'Kegiatan Siswa'] as $i => $hdr) {
                $table->addCell($colWidths[$i], $this->headerCellStyle())
                    ->addText($hdr, $this->headerFont(), $this->tableParagraph());
            }

            // --- Kegiatan Pembuka ---
            $this->addKegiatanBlokRow($table, $colWidths, 'Kegiatan Pembuka', $pertemuan['kegiatan_pembuka'] ?? null);

            // --- Kegiatan Inti — dengan sub-kegiatan bernama ---
            $kegiatanInti = $pertemuan['kegiatan_inti'] ?? [];
            if (!empty($kegiatanInti)) {
                // Baris sub-header "Kegiatan Inti" (spanning)
                $table->addRow();
                $subCell = $table->addCell(
                    array_sum($colWidths),
                    array_merge($this->cellStyle('e2e8f0'), ['gridSpan' => 3])
                );
                $subCell->addText(
                    'Kegiatan Inti',
                    ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'bold' => true, 'color' => self::COLOR_HEADER],
                    $this->tableParagraph()
                );

                // Render setiap sub-kegiatan inti
                foreach ($kegiatanInti as $subKey => $subData) {
                    $subLabel = $subKegiatanIntiLabels[$subKey]
                        ?? ucwords(str_replace('_', ' ', $subKey));

                    // Baris sub-sub-header (nama sub-kegiatan) dengan warna lebih terang
                    $table->addRow();
                    $subSubCell = $table->addCell(
                        array_sum($colWidths),
                        array_merge($this->cellStyle('dbeafe'), ['gridSpan' => 3])
                    );
                    $subSubCell->addText(
                        $subLabel,
                        ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE,
                        'bold' => true, 'italic' => true, 'color' => self::COLOR_ACCENT],
                        $this->tableParagraph()
                    );

                    // Baris data sub-kegiatan
                    $table->addRow();
                    $table->addCell($colWidths[0], $this->cellStyle(self::COLOR_WHITE))
                        ->addText($subData['alokasi_waktu'] ?? '-', $this->bodyFont(), $this->tableParagraph());

                    $guruCell = $table->addCell($colWidths[1], $this->cellStyle(self::COLOR_WHITE));
                    $this->addBulletTextToCell($guruCell, $subData['guru'] ?? '');

                    $siswaCell = $table->addCell($colWidths[2], $this->cellStyle(self::COLOR_WHITE));
                    $this->addBulletTextToCell($siswaCell, $subData['siswa'] ?? '');
                }
            }

            // --- Kegiatan Penutup ---
            $this->addKegiatanBlokRow($table, $colWidths, 'Kegiatan Penutup', $pertemuan['kegiatan_penutup'] ?? null);

            $section->addTextBreak(1);
        }
    }

    private function addKegiatanBlokRow($table, array $colWidths, string $namaBlok, ?array $blokData)
    {
        if (empty($blokData)) return;

        // Sub-header blok
        $table->addRow();
        $subCell = $table->addCell(
            array_sum($colWidths),
            array_merge($this->cellStyle('e2e8f0'), ['gridSpan' => 3])
        );
        $subCell->addText(
            $namaBlok,
            ['name' => self::FONT_FAMILY, 'size' => self::FONT_SIZE, 'bold' => true, 'color' => self::COLOR_HEADER],
            $this->tableParagraph()
        );

        // Baris data
        $table->addRow();
        $table->addCell($colWidths[0], $this->cellStyle(self::COLOR_WHITE))
            ->addText($blokData['alokasi_waktu'] ?? '-', $this->bodyFont(), $this->tableParagraph());

        $guruCell = $table->addCell($colWidths[1], $this->cellStyle(self::COLOR_WHITE));
        $this->addBulletTextToCell($guruCell, $blokData['guru'] ?? '');

        $siswaCell = $table->addCell($colWidths[2], $this->cellStyle(self::COLOR_WHITE));
        $this->addBulletTextToCell($siswaCell, $blokData['siswa'] ?? '');
    }
}
