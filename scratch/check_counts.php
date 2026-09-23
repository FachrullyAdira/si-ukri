<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$models = [
    \App\Models\User::class,
    \App\Models\KelompokKeahlian::class,
    \App\Models\DosenStaf::class,
    \App\Models\MataKuliah::class,
    \App\Models\KalenderAkademik::class,
    \App\Models\Prestasi::class,
    \App\Models\Alumni::class,
    \App\Models\Berita::class,
    \App\Models\KerjaSama::class,
    \App\Models\Akreditasi::class,
    \App\Models\Sejarah::class,
    \App\Models\HimaPengurus::class,
    \App\Models\HimaKegiatan::class,
    \App\Models\PengaturanSitus::class,
    \App\Models\PesanKontak::class,
    \App\Models\Kelas::class,
    \App\Models\Mahasiswa::class,
];

foreach ($models as $m) {
    echo class_basename($m) . ": " . $m::count() . " rows\n";
}
