<?php

$start = microtime(true);

\App\Models\Berita::with('media')
    ->where('tanggal_publikasi', '<=', now())
    ->orderBy('is_penting', 'desc')
    ->orderBy('tanggal_publikasi', 'desc')
    ->take(3)
    ->get();

\App\Models\Prestasi::with('media')->orderBy('tahun', 'desc')->take(3)->get();
\App\Models\Alumni::latest()->take(3)->get();
\App\Models\Akreditasi::orderBy('tahun', 'desc')->first();
\App\Models\KelompokKeahlian::with('media')->get();
\App\Models\DosenStaf::with('media')->orderBy('urutan_struktural', 'asc')->get();
\App\Models\PengaturanSitus::pluck('value', 'key');

$elapsed = round((microtime(true) - $start) * 1000);
echo "Beranda queries total: {$elapsed}ms\n";
