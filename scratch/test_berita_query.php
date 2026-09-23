<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$beritas = \App\Models\Berita::where('tanggal_publikasi', '<=', now())
    ->orderBy('is_penting', 'desc')
    ->orderBy('tanggal_publikasi', 'desc')
    ->take(3)
    ->get();

echo "Query returned IDs: " . $beritas->pluck('id')->implode(', ') . "\n";
echo "now() is: " . now()->toDateTimeString() . "\n";
