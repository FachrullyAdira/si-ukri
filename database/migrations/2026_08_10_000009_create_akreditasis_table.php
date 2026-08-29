<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akreditasis', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('lembaga')->default('BAN-PT');
            $table->string('peringkat');
            $table->integer('tahun');
            $table->string('masa_berlaku');
            $table->string('no_sk')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akreditasis');
    }
};
