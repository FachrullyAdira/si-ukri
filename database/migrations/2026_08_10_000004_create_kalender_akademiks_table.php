<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kalender_akademiks', function (Blueprint $table) {
            $table->id();
            $table->string('judul_kegiatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('tahun_akademik');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kalender_akademiks');
    }
};
