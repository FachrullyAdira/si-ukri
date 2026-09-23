<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$b = \App\Models\Berita::find(4);
if ($b) {
    print_r($b->toArray());
    echo "Media: " . $b->getFirstMediaUrl('cover') . "\n";
}

echo "\n--- All Beritas ---\n";
foreach (\App\Models\Berita::all() as $item) {
    echo "ID {$item->id} | {$item->judul} | Tgl: {$item->tanggal_publikasi} | Penting: {$item->is_penting} | Media: " . $item->getFirstMediaUrl('cover') . "\n";
}
