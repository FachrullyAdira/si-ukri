<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosen_stafs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nidn')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jabatan_struktural')->nullable();
            $table->string('foto')->nullable();
            $table->string('bidang_keahlian')->nullable();
            $table->text('riwayat_pendidikan')->nullable();
            $table->foreignId('kelompok_keahlian_id')->nullable()->constrained('kelompok_keahlians')->nullOnDelete();
            $table->integer('urutan_struktural')->default(99);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_stafs');
    }
};
