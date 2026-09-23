<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\HimaPengurus;
use App\Models\HimaKegiatan;
use App\Models\Alumni;
use App\Models\PengaturanSitus;

class KemahasiswaanController extends Controller
{
    public function prestasi()
    {
        $prestasis = Prestasi::with('media')->orderBy('tahun', 'desc')->get();
        return view('kemahasiswaan.prestasi', compact('prestasis'));
    }

    public function hima()
    {
        $pengurus = HimaPengurus::with('media')->orderBy('periode', 'desc')->get();
        $kegiatans = HimaKegiatan::with('media')->orderBy('tanggal', 'desc')->get();

        $himaNama = PengaturanSitus::getValue('hima_nama', 'Himpunan Mahasiswa Sistem Informasi (HMSI-UKRI)');
        $himaSingkatan = PengaturanSitus::getValue('hima_singkatan', 'HMSI-UKRI');
        $himaSubtitle = PengaturanSitus::getValue('hima_subtitle', 'Wadah organisasi eksekutif mahasiswa Sistem Informasi UKRI untuk pengembangan leadership dan softskill.');

        $logoSetting = PengaturanSitus::getValue('hima_logo');
        $himaLogoUrl = $logoSetting 
            ? asset('storage/' . ltrim($logoSetting, '/')) 
            : asset('images/logo-himasi.svg');

        $himaNamaKabinet = PengaturanSitus::getValue('hima_nama_kabinet', 'Kabinet "Inovasi Kebangsaan"');
        $himaPeriode = PengaturanSitus::getValue('hima_periode', '2026/2027');
        $himaDeskripsi = PengaturanSitus::getValue(
            'hima_deskripsi', 
            'HIMASI UKRI berfokus pada 4 bidang utama: Riset & Teknologi, Pengabdian Masyarakat, Seni & Olahraga, serta Hubungan Luar Himpunan.'
        );
        $himaInstagram = PengaturanSitus::getValue('hima_instagram', '@himasi_ukri');
        $himaEmail = PengaturanSitus::getValue('hima_email', 'himasi@ukri.ac.id');
        $himaLinkedin = PengaturanSitus::getValue('hima_linkedin');

        return view('kemahasiswaan.hima', compact(
            'pengurus', 
            'kegiatans', 
            'himaNama',
            'himaSingkatan',
            'himaSubtitle',
            'himaLogoUrl', 
            'himaNamaKabinet', 
            'himaPeriode', 
            'himaDeskripsi', 
            'himaInstagram', 
            'himaEmail', 
            'himaLinkedin'
        ));
    }

    public function alumni()
    {
        $alumnis = Alumni::orderBy('angkatan', 'desc')->get();
        return view('kemahasiswaan.alumni', compact('alumnis'));
    }
}
