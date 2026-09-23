<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

config(['filesystems.disks.public.url' => '/storage']);
$b = App\Models\Berita::find(4);
echo "Cover URL with /storage: " . $b->getFirstMediaUrl('cover') . "\n";
