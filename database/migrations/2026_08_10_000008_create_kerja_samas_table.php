<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kerja_samas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra');
            $table->string('logo')->nullable();
            $table->string('bentuk_kerja_sama');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerja_samas');
    }
};
