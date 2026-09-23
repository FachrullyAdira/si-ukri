<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== MEDIA TABLE ===\n";
foreach (\DB::table('media')->get() as $m) {
    echo "ID: {$m->id} | {$m->model_type} #{$m->model_id} | {$m->collection_name} | {$m->file_name}\n";
}

echo "\n=== STORAGE FOLDERS ===\n";
for ($i = 1; $i <= 10; $i++) {
    $dir = storage_path('app/public/' . $i);
    if (is_dir($dir)) {
        $files = scandir($dir);
        echo "Dir $i: " . implode(', ', array_diff($files, ['.', '..'])) . "\n";
    }
}
