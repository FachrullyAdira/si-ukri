<?php
$resources = [
    'Sejarah' => ['model' => 'Sejarah', 'collection' => 'foto', 'views' => ['tentang-kami/sejarah.blade.php']],
    'Prestasi' => ['model' => 'Prestasi', 'collection' => 'foto', 'views' => ['kemahasiswaan/prestasi.blade.php', 'beranda.blade.php']],
    'Mahasiswa' => ['model' => 'Mahasiswa', 'collection' => 'foto_mahasiswa', 'views' => []],
    'KerjaSama' => ['model' => 'KerjaSama', 'collection' => 'logo', 'views' => ['tentang-kami/kerja-sama.blade.php']],
    'HimaKegiatan' => ['model' => 'HimaKegiatan', 'collection' => 'foto', 'views' => ['kemahasiswaan/hima.blade.php']],
    'DosenStaf' => ['model' => 'DosenStaf', 'collection' => 'foto_profil', 'views' => ['tentang-kami/dosen-staf.blade.php', 'beranda.blade.php']],
    'Alumni' => ['model' => 'Alumni', 'collection' => 'foto_profil', 'views' => ['kemahasiswaan/alumni.blade.php', 'beranda.blade.php']],
    'Berita' => ['model' => 'Berita', 'collection' => 'cover', 'views' => ['berita/index.blade.php', 'berita/show.blade.php', 'beranda.blade.php']],
    'Akreditasi' => ['model' => 'Akreditasi', 'collection' => 'dokumen_pdf', 'views' => ['tentang-kami/akreditasi.blade.php', 'beranda.blade.php']],
];

foreach ($resources as $name => $info) {
    echo "==================== $name ====================\n";
    $rf = __DIR__ . '/../app/Filament/Resources/' . $name . 'Resource.php';
    if (file_exists($rf)) {
        $rc = file_get_contents($rf);
        preg_match_all('/SpatieMediaLibrary\w+::make\([^\)]*\)->collection\([^\)]*\)/', $rc, $matches);
        echo "Filament Resource Collections: " . implode(', ', $matches[0] ?? []) . "\n";
    }
    foreach ($info['views'] as $v) {
        $vf = __DIR__ . '/../resources/views/' . $v;
        if (file_exists($vf)) {
            $vc = file_get_contents($vf);
            $hasGetMedia = str_contains($vc, 'getFirstMediaUrl');
            echo "View $v uses getFirstMediaUrl: " . ($hasGetMedia ? 'YES' : 'NO') . "\n";
        }
    }
}
