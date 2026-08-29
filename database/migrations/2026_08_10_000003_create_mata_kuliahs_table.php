<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->integer('sks');
            $table->integer('semester');
            $table->string('sifat')->default('Wajib');
            $table->string('prasyarat')->nullable();
            $table->foreignId('kelompok_keahlian_id')->nullable()->constrained('kelompok_keahlians')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};
