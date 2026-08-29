<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\HimaPengurus;
use App\Models\HimaKegiatan;
use App\Models\Alumni;

class KemahasiswaanController extends Controller
{
    public function prestasi()
    {
        $prestasis = Prestasi::orderBy('tahun', 'desc')->get();
        return view('kemahasiswaan.prestasi', compact('prestasis'));
    }

    public function hima()
    {
        $pengurus = HimaPengurus::orderBy('periode', 'desc')->get();
        $kegiatans = HimaKegiatan::orderBy('tanggal', 'desc')->get();
        return view('kemahasiswaan.hima', compact('pengurus', 'kegiatans'));
    }

    public function alumni()
    {
        $alumnis = Alumni::orderBy('angkatan', 'desc')->get();
        return view('kemahasiswaan.alumni', compact('alumnis'));
    }
}
