<?php

$srcPath = 'd:/laragon/www/si-ukri/public/images/logo-si-ukri.png';
$dstPath = 'd:/laragon/www/si-ukri/public/images/logo.png';

if (!file_exists($srcPath)) {
    die("File not found\n");
}

$img = imagecreatefromstring(file_get_contents($srcPath));
if (!$img) {
    die("Failed to create image\n");
}

$width = imagesx($img);
$height = imagesy($img);

$transparentImg = imagecreatetruecolor($width, $height);
imagealphablending($transparentImg, false);
imagesavealpha($transparentImg, true);

$transparentColor = imagecolorallocatealpha($transparentImg, 0, 0, 0, 127);
imagefill($transparentImg, 0, 0, $transparentColor);

for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $rgba = imagecolorat($img, $x, $y);
        $r = ($rgba >> 16) & 0xFF;
        $g = ($rgba >> 8) & 0xFF;
        $b = $rgba & 0xFF;
        $a = ($rgba >> 24) & 0x7F;

        // If pixel is near-white (background), turn it transparent
        if ($r > 235 && $g > 235 && $b > 235) {
            imagesetpixel($transparentImg, $x, $y, $transparentColor);
        } else {
            $color = imagecolorallocatealpha($transparentImg, $r, $g, $b, $a);
            imagesetpixel($transparentImg, $x, $y, $color);
        }
    }
}

imagepng($transparentImg, $dstPath);
imagedestroy($img);
imagedestroy($transparentImg);

echo "Transparent logo generated successfully at $dstPath\n";
