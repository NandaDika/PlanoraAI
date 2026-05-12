<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('datarpp', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('satuan_pendidikan');
            $table->string('mata_pelajaran');
            $table->string('fase');
            $table->string('kelas_semester');
            $table->string('alokasi_waktu');
            $table->string('tahun_pelajaran');

            $table->string('materi_pokok')->nullable();
            $table->string('sub_materi')->nullable();

            $table->json('profil_lulusan')->nullable();
            $table->json('konfigurasi')->nullable();
            $table->json('pembelajaran')->nullable();
            $table->json('assessment_sumatif')->nullable();

            $table->longText('input_data')->nullable();
            $table->longText('hasil_ai')->nullable();
            $table->string('pdf')->nullable(true)->default(NULL);
            $table->string('word')->nullable(true)->default(NULL);

            $table->string('core_type'); // merdeka | deep_learning
            $table->enum('status', ['pending', 'processing', 'done', 'failed'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('datarpp');
    }
};
