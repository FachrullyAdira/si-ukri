<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\DosenStaf;
use App\Models\KelompokKeahlian;
use App\Models\Berita;
use App\Models\Prestasi;

$brainDir = 'C:/Users/AERO_PC/.gemini/antigravity-ide/brain/e2b158fa-117d-4f9c-9a3b-bf29b8c6d21c';

// 1. Dosen & Staf
$dosenMap = [
    1 => 'dosen_ahmad_sudrajat_1790068892210.jpg',
    2 => 'dosen_siti_rahmawati_1790068912335.jpg',
    3 => 'dosen_budi_santoso_1790068931045.jpg',
    4 => 'dosen_dina_fitriani_1790068950040.jpg',
    5 => 'dosen_hendra_setiawan_1790068967024.jpg',
];

echo "=== ATTACHING DOSEN MEDIA ===\n";
foreach ($dosenMap as $id => $filename) {
    $dosen = DosenStaf::find($id);
    $filePath = $brainDir . '/' . $filename;
    if ($dosen && file_exists($filePath)) {
        $dosen->clearMediaCollection('foto_profil');
        $media = $dosen->addMedia($filePath)
            ->preservingOriginal()
            ->toMediaCollection('foto_profil');
        echo "Dosen #{$id} ({$dosen->nama}): attached {$filename} -> Media ID {$media->id} (URL: {$dosen->foto_url})\n";
    } else {
        echo "Dosen #{$id}: file not found or dosen not found!\n";
    }
}

// 2. Kelompok Keahlian
$kbkMap = [
    1 => 'kbk_enterprise_erp_1790068986047.jpg',
    2 => 'kbk_data_science_ai_1790069008787.jpg',
    3 => 'kbk_digital_product_software_1790069157159.jpg',
];

echo "\n=== ATTACHING KELOMPOK KEAHLIAN MEDIA ===\n";
foreach ($kbkMap as $id => $filename) {
    $kbk = KelompokKeahlian::find($id);
    $filePath = $brainDir . '/' . $filename;
    if ($kbk && file_exists($filePath)) {
        $kbk->clearMediaCollection('ikon');
        $media = $kbk->addMedia($filePath)
            ->preservingOriginal()
            ->toMediaCollection('ikon');
        echo "KBK #{$id} ({$kbk->nama}): attached {$filename} -> Media ID {$media->id} (URL: {$kbk->ikon_url})\n";
    } else {
        echo "KBK #{$id}: file not found or kbk not found!\n";
    }
}

// 3. Berita
$beritaMap = [
    1 => 'berita_seminar_ai_1790069198732.jpg',
    2 => 'berita_gemastik_emas_1790069230420.jpg',
    3 => 'berita_mou_telkom_1790069257629.jpg',
];

echo "\n=== ATTACHING BERITA MEDIA ===\n";
foreach ($beritaMap as $id => $filename) {
    $berita = Berita::find($id);
    $filePath = $brainDir . '/' . $filename;
    if ($berita && file_exists($filePath)) {
        $berita->clearMediaCollection('cover');
        $media = $berita->addMedia($filePath)
            ->preservingOriginal()
            ->toMediaCollection('cover');
        echo "Berita #{$id} ({$berita->judul}): attached {$filename} -> Media ID {$media->id} (URL: {$berita->cover_url})\n";
    } else {
        echo "Berita #{$id}: file not found or berita not found!\n";
    }
}

// 4. Prestasi
$prestasiMap = [
    1 => 'berita_gemastik_emas_1790069230420.jpg',
    2 => 'prestasi_hackathon_telkom_1790069608051.jpg',
    3 => 'prestasi_best_paper_1790069843165.jpg',
];

echo "\n=== ATTACHING PRESTASI MEDIA ===\n";
foreach ($prestasiMap as $id => $filename) {
    $prestasi = Prestasi::find($id);
    $filePath = $brainDir . '/' . $filename;
    if ($prestasi && file_exists($filePath)) {
        $prestasi->clearMediaCollection('foto');
        $media = $prestasi->addMedia($filePath)
            ->preservingOriginal()
            ->toMediaCollection('foto');
        echo "Prestasi #{$id} ({$prestasi->judul}): attached {$filename} -> Media ID {$media->id} (URL: {$prestasi->foto_url})\n";
    } else {
        echo "Prestasi #{$id}: file not found or prestasi not found!\n";
    }
}

echo "\nDONE ATTACHING ALL MEDIA!\n";
