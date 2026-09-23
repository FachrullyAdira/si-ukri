<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\PengaturanSitus;
use App\Models\DosenStaf;
use App\Models\Akreditasi;
use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\Alumni;
use App\Models\KelompokKeahlian;

echo "=== PENGATURAN SITUS ===\n";
foreach (PengaturanSitus::all() as $s) {
    echo "  [" . $s->key . "] => " . mb_substr($s->value, 0, 45) . "...\n";
}

echo "\n=== AKREDITASI ===\n";
$akr = Akreditasi::orderBy('tahun', 'desc')->first();
if ($akr) {
    echo "  Peringkat: {$akr->peringkat}, Tahun: {$akr->tahun}, No SK: {$akr->no_sk}, Lembaga: {$akr->lembaga}, Masa: {$akr->masa_berlaku}\n";
    echo "  File: {$akr->file_sertifikat}\n";
} else {
    echo "  Tidak ada data akreditasi!\n";
}

echo "\n=== DOSEN & KAPRODI ===\n";
$kaprodi = DosenStaf::where('jabatan_struktural', 'LIKE', '%Ketua%')
    ->orWhere('jabatan', 'LIKE', '%Ketua%')
    ->first();
if ($kaprodi) {
    echo "  Kaprodi: {$kaprodi->nama} | NIDN: {$kaprodi->nidn} | Jabatan: {$kaprodi->jabatan_struktural} | Foto: {$kaprodi->foto}\n";
} else {
    echo "  Kaprodi tidak ditemukan secara spesifik.\n";
}

echo "\n=== BERITA DENGAN COVER ===\n";
foreach (Berita::latest()->take(3)->get() as $b) {
    $media = $b->getFirstMediaUrl('cover');
    echo "  ID {$b->id}: {$b->judul} | Media: {$media} | Status: {$b->kategori} | Tgl: {$b->tanggal_publikasi}\n";
}
