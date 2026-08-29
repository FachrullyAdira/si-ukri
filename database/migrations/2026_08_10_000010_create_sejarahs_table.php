<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sejarahs', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->string('judul_peristiwa');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sejarahs');
    }
};
