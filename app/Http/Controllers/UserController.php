<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateReportJob;
use App\Models\DataRPP;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        $totalDokumen = DataRPP::where('user_id', $userId)->count();

        $dalamProses = DataRPP::where('user_id', $userId)
                             ->whereIn('status', ['pending', 'processing'])
                             ->count();

        $berhasil = DataRPP::where('user_id', $userId)
                          ->where('status', 'done')
                          ->count();

        $gagal = DataRPP::where('user_id', $userId)
                       ->where('status', 'failed')
                       ->count();

        return view('dashboard', compact(
            'totalDokumen',
            'dalamProses',
            'berhasil',
            'gagal'
        ));
    }

    public function create()
    {
        return view('buat-dokumen');
    }

    public function submitForm(Request $request){
        $formType = $request->form_type;

        if ($formType === 'merdeka') {
            return $this->handleMerdeka($request);
        }

        if ($formType === 'deeplearning') {
            return $this->handleDeepLearning($request);
        }

        return response()->json([
            'error' => true,
            'message' => 'Form type tidak valid'
        ], 400);
    }

    protected function handleMerdeka(Request $request)
    {
        $data = [
            "identitas" => [
                "nama_penyusun" => $request->nama_penyusun,
                "institusi" => $request->institusi,
                "tahun_pelajaran" => $request->tahun_pelajaran,
                "jenjang" => $request->jenjang,
                "kelas" => $request->kelas,
                "kompetensi_keahlian" => $request->kompetensi_keahlian,
                "fase" => $request->fase,
                "alokasi_waktu" => $request->km_alokasi_waktu,
            ],
            "profil_lulusan" => $request->km_profil_pelajar ?? [],
            "konfigurasi" => [
                "sarana_prasarana" => $request->km_sarana_prasarana,
                "target_peserta" => $request->km_target_peserta,
                "model_pembelajaran" => $request->km_model_pembelajaran,
                "deskripsi_industri" => $request->km_deskripsi_industri,
            ],
            "pembelajaran" => [
                "elemen" => $request->elemen,
                "capaian" => $request->capaian_pembelajaran,
                "jumlah_pertemuan" => (int) $request->km_jumlah_pertemuan,
                "level_kognitif" => [
                    "c1" => $request->km_c1,
                    "c2" => $request->km_c2,
                    "c3" => $request->km_c3,
                    "c4" => $request->km_c4,
                    "c5" => $request->km_c5,
                    "c6" => $request->km_c6,
                ]
            ]
        ];

        $report = DataRPP::create([
            'user_id' => Auth::id(),
            'satuan_pendidikan' => $request->institusi,
            'mata_pelajaran' => $request->kompetensi_keahlian,
            'materi_pokok' => $request->elemen,
            'fase' => $request->fase,
            'kelas_semester' => $request->kelas,
            'tahun_pelajaran' => $request->tahun_pelajaran,
            "alokasi_waktu" => $request->km_alokasi_waktu,
            'profil_lulusan' => $data['profil_lulusan'],
            'konfigurasi' => $data['konfigurasi'],
            'pembelajaran' => $data['pembelajaran'],

            'input_data' => json_encode($data),
            'core_type' => 'merdeka',
            'status' => 'pending'
        ]);

        GenerateReportJob::dispatch($report->id);

        return redirect()->route('antrian.list', ['success' => 1]);
    }

    protected function handleDeepLearning(Request $request)
    {
        $data = [
            "identitas" => [
                "nama_penyusun" => $request->dl_nama_penyusun,
                "satuan_pendidikan" => $request->dl_satuan_pendidikan,
                "tahun_pelajaran" => $request->dl_tahun_pelajaran,
                "jenjang" => $request->dl_jenjang,
                "kelas" => $request->dl_kelas,
                "mata_pelajaran" => $request->dl_mata_pelajaran,
                "fase" => $request->dl_fase,
                "alokasi_waktu" => $request->dl_alokasi_waktu,
            ],
            "materi" => [
                "materi_pokok" => $request->dl_materi_pokok,
                "sub_materi" => $request->dl_sub_materi
            ],
            "konfigurasi" => [
                "sarana_prasarana" => $request->dl_sarana_prasarana,
                "target_peserta" => $request->dl_target_peserta,
                "model_pembelajaran" => $request->dl_model_pembelajaran,
                "lingkungan" => $request->dl_lingkungan_pembelajaran,
                "pemanfaatan_digital" => $request->dl_pemanfaatan_digital,
                "deskripsi_industri" => $request->dl_deskripsi_industri,
            ],
            "pembelajaran" => [
                "elemen" => $request->dl_elemen_pembelajaran,
                "capaian" => $request->dl_capaian_pembelajaran,
                "jumlah_pertemuan" => (int) $request->dl_jumlah_pertemuan,
                "dimensi_lulusan" => $request->dl_dimensi_lulusan,
                "level_kognitif" => [
                    "c1" => $request->dl_c1,
                    "c2" => $request->dl_c2,
                    "c3" => $request->dl_c3,
                    "c4" => $request->dl_c4,
                    "c5" => $request->dl_c5,
                    "c6" => $request->dl_c6,
                ]
            ]
        ];

        $report = DataRPP::create([
            'user_id' => Auth::id(),
            'satuan_pendidikan' => $request->dl_satuan_pendidikan,
            'mata_pelajaran' => $request->dl_mata_pelajaran,
            'materi_pokok' => $request->dl_materi_pokok,
            'fase' => $request->dl_fase,
            'kelas_semester' => $request->dl_kelas,
            'tahun_pelajaran' => $request->dl_tahun_pelajaran,
            'alokasi_waktu' => $request->dl_alokasi_waktu,
            'sub_materi' => $request->dl_submateri,

            'konfigurasi' => $data['konfigurasi'],
            'pembelajaran' => $data['pembelajaran'],

            'input_data' => json_encode($data),
            'core_type' => 'deep_learning',
            'status' => 'pending'
        ]);

        GenerateReportJob::dispatch($report->id);

            return redirect()->route('antrian.list', ['success' => 1]);
    }


    public function getDataAntrian(){
        $list = DataRPP::select('id', 'materi_pokok', 'tahun_pelajaran', 'core_type', 'mata_pelajaran', 'status', 'created_at')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->through(function ($item) {
                $item->hashid = Hashids::encode($item->id);
                unset($item->id);

                return $item;
            });
            // dd($list);

        return view('list-antrian', compact('list'));
    }

    public function deleteRPP($id){

        $decrypted_id = Hashids::decode($id);
        if (empty($decrypted_id)) {
            return redirect()->back()->with('error', 'ID tidak valid.');
        }

        $data = DataRPP::where('id', $decrypted_id[0])->first();

        if ($data) {
            $data->delete();
            $previousUrl = url()->previous();
            $separator = parse_url($previousUrl, PHP_URL_QUERY) ? '&' : '?';
            return redirect()->to($previousUrl . $separator . 'deleted=1');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }


    public function retryRPP($id){
        try {
            $decrypted_id = Hashids::decode($id);

            if (empty($decrypted_id)) {
                return redirect()->back()->with('error', 'ID Dokumen tidak valid.');
            }

            $report = DataRPP::where('id', $decrypted_id[0])
                            ->where('user_id', Auth::id())
                            ->first();

            if (!$report) {
                return redirect()->back()->with('error', 'Data tidak ditemukan atau Anda tidak memiliki akses.');
            }

            $report->update(['status' => 'pending']);

            GenerateReportJob::dispatch($report->id);

            $previousUrl = url()->previous();
            $separator = parse_url($previousUrl, PHP_URL_QUERY) ? '&' : '?';
            return redirect()->to($previousUrl . $separator . 'retried=1');

        } catch (\Exception $e) {
            Log::error('Retry RPP Error ID ' . $id . ': ' . $e->getMessage());
            return redirect()->back()->with('error_modal', 'Gagal mengirim ulang antrean. Silakan coba lagi nanti.');
        }

    }


     public function tempCommand(){
            $data = DataRPP::where('id', 24)->first();

            // Parse field yang berisi string JSON
            $dataArray = $data->toArray();
            $dataArray['input_data'] = json_decode($data->input_data, true);
            $dataArray['hasil_ai'] = json_decode($data->hasil_ai, true);

            // Encode ulang dengan pretty print
            return response()->json($dataArray, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
}
