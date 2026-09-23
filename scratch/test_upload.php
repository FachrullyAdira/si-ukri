<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\DosenStaf;
use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\KelompokKeahlian;
use Illuminate\Http\UploadedFile;

echo "Testing upload to DosenStaf...\n";
$dosen = DosenStaf::first();
if ($dosen) {
    try {
        // create dummy image file
        $tempFile = tempnam(sys_get_temp_dir(), 'test_img') . '.jpg';
        $im = imagecreatetruecolor(100, 100);
        $green = imagecolorallocate($im, 10, 107, 57);
        imagefill($im, 0, 0, $green);
        imagejpeg($im, $tempFile);
        imagedestroy($im);

        $uploaded = new UploadedFile($tempFile, 'test_avatar.jpg', 'image/jpeg', null, true);
        
        $media = $dosen->addMedia($uploaded)
            ->toMediaCollection('foto_profil');

        echo "SUCCESS: Added media ID {$media->id}, URL: " . $dosen->getFirstMediaUrl('foto_profil') . "\n";
    } catch (\Throwable $e) {
        echo "ERROR: " . $e->getMessage() . "\n";
        echo $e->getTraceAsString() . "\n";
    }
}
