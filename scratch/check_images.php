<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== KELOMPOK KEAHLIAN ===\n";
foreach (\App\Models\KelompokKeahlian::all() as $k) {
    echo "ID {$k->id}: {$k->nama} | ikon: {$k->ikon}\n";
}

echo "\n=== DOSEN STAF ===\n";
foreach (\App\Models\DosenStaf::all() as $d) {
    $media = $d->getFirstMediaUrl('foto_profil');
    echo "ID {$d->id}: {$d->nama} | foto col: {$d->foto} | mediaUrl: {$media} | hasMedia: " . ($d->hasMedia('foto_profil') ? 'YES' : 'NO') . "\n";
}

echo "\n=== BERITA ===\n";
foreach (\App\Models\Berita::all() as $b) {
    $media = $b->getFirstMediaUrl('cover');
    echo "ID {$b->id}: {$b->judul} | foto/cover: " . ($b->foto ?? 'none') . " | mediaUrl: {$media} | hasMedia: " . ($b->hasMedia('cover') ? 'YES' : 'NO') . "\n";
}

echo "\n=== PRESTASI ===\n";
foreach (\App\Models\Prestasi::all() as $p) {
    $media = $p->getFirstMediaUrl('foto');
    echo "ID {$p->id}: {$p->judul} | foto col: {$p->foto} | mediaUrl: {$media} | hasMedia: " . ($p->hasMedia('foto') ? 'YES' : 'NO') . "\n";
}

echo "\n=== MEDIA TABLE TOTAL ===\n";
echo "Total in media table: " . \DB::table('media')->count() . "\n";
foreach (\DB::table('media')->get() as $m) {
    echo "Media ID: {$m->id} | model: {$m->model_type} #{$m->model_id} | coll: {$m->collection_name} | file: {$m->file_name}\n";
}
