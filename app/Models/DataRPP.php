<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRPP extends Model
{

    protected $table = 'datarpp';
    protected $fillable = [
        // IDENTITAS
        'user_id',
        'satuan_pendidikan',
        'mata_pelajaran',
        'materi_pokok',
        'sub_materi',
        'fase',
        'kelas_semester',
        'alokasi_waktu',
        'tahun_pelajaran',

        // JSON FIELDS
        'profil_lulusan',
        'konfigurasi',
        'pembelajaran',
        'assessment',

        // AI I/O
        'input_data',
        'hasil_ai',
        'pdf',
        'word',

        // STATUS
        'status',
        'core_type',
    ];

    protected $casts = [
        'profil_lulusan' => 'array',
        'konfigurasi' => 'array',
        'pembelajaran' => 'array',
        'assessment_sumatif' => 'array',
    ];
}
