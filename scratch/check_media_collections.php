<?php
$modelFiles = [
    'Sejarah.php',
    'Prestasi.php',
    'Mahasiswa.php',
    'KerjaSama.php',
    'HimaKegiatan.php',
    'DosenStaf.php',
    'Alumni.php',
    'Berita.php',
    'Akreditasi.php',
];

foreach ($modelFiles as $mf) {
    $content = file_get_contents(__DIR__ . '/../app/Models/' . $mf);
    echo "=== $mf ===\n";
    if (preg_match('/registerMediaCollections\(\): void\s*\{(.*?)\}/s', $content, $m)) {
        echo trim($m[1]) . "\n";
    }
}
