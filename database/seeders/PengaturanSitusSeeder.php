<?php

namespace Database\Seeders;

use App\Models\PengaturanSitus;
use Illuminate\Database\Seeder;

class PengaturanSitusSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'hero_title', 'value' => 'Membangun Talenta Digital & Enterprise Solution Berkarakter Kebangsaan', 'group' => 'Beranda'],
            ['key' => 'hero_subtitle', 'value' => 'Program Studi Sistem Informasi Universitas Kebangsaan Republik Indonesia membekali mahasiswa dengan keahlian Data Science, Software Engineering, dan Digital Business Transformation.', 'group' => 'Beranda'],
            ['key' => 'pmb_link', 'value' => 'https://pmb.ukri.ac.id/', 'group' => 'Beranda'],
            ['key' => 'pmb_text', 'value' => 'PENDAFTARAN MAHASISWA BARU TA 2026/2027 DIBUKA', 'group' => 'Beranda'],
            ['key' => 'sambutan_judul', 'value' => 'Mempersiapkan Generasi Unggul di Era Transformasi Digital', 'group' => 'Beranda - Kaprodi'],
            ['key' => 'sambutan_teks', 'value' => 'Perkembangan teknologi informasi, kecerdasan buatan (Artificial Intelligence), serta arsitektur data enterprise telah mengubah secara fundamental lanskap industri global. Program Studi Sistem Informasi UKRI hadir sebagai kawah candradimuka bagi calon praktisi dan inovator digital yang memiliki kapabilitas teknis tinggi sekaligus landasan wawasan kebangsaan yang kokoh.', 'group' => 'Beranda - Kaprodi'],
        ];

        foreach ($settings as $setting) {
            PengaturanSitus::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
