<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\DosenStaf;
use App\Models\MataKuliah;
use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\Alumni;
use App\Models\Akreditasi;
use App\Models\PesanKontak;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $akreditasi = Akreditasi::orderBy('tahun', 'desc')->first();
        $totalDosen = DosenStaf::count();
        $totalSks = MataKuliah::sum('sks');
        $totalBerita = Berita::count();
        $totalPrestasi = Prestasi::count();
        $pesanBaru = PesanKontak::count();

        return [
            Stat::make('Akreditasi Program Studi', $akreditasi->peringkat ?? 'A / Unggul')
                ->description('SK BAN-PT Resmi (' . ($akreditasi->masa_berlaku ?? '2023 - 2028') . ')')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),

            Stat::make('Dosen & Staf Pengajar', $totalDosen . ' Orang')
                ->description('Tenaga Pengajar Aktif SI UKRI')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Total SKS Kurikulum', $totalSks . ' SKS')
                ->description('Mata Kuliah Wajib & Pilihan KBK')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('warning'),

            Stat::make('Berita & Artikel', $totalBerita . ' Publikasi')
                ->description('Pengumuman & Kegiatan Akademik')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('info'),

            Stat::make('Prestasi Mahasiswa', $totalPrestasi . ' Penghargaan')
                ->description('Kompetisi Nasional & Internasional')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('amber'),

            Stat::make('Pesan Kontak Masuk', $pesanBaru . ' Pesan')
                ->description('Pertanyaan PMB & Publik')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
        ];
    }
}
