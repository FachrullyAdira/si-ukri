<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use App\Models\Akreditasi;
use App\Models\DosenStaf;
use App\Models\KerjaSama;
use App\Models\PengaturanSitus;

class TentangKamiController extends Controller
{
    public function sejarah()
    {
        $sejarahs = Sejarah::orderBy('tahun', 'desc')->get();
        return view('tentang-kami.sejarah', compact('sejarahs'));
    }

    public function visiMisi()
    {
        $visi = PengaturanSitus::getValue('visi', 'Menjadi Program Studi Sistem Informasi yang Unggul di Tingkat Nasional dalam Pengembangan Sistem Informasi Enterprise dan Analytics Berwawasan Kebangsaan pada Tahun 2030.');
        $misi = PengaturanSitus::where('group', 'misi')->get();
        return view('tentang-kami.visi-misi', compact('visi', 'misi'));
    }

    public function akreditasi()
    {
        $akreditasis = Akreditasi::orderBy('tahun', 'desc')->get();
        $akreditasiAktif = Akreditasi::orderBy('tahun', 'desc')->first();
        return view('tentang-kami.akreditasi', compact('akreditasis', 'akreditasiAktif'));
    }

    public function dosenStaf()
    {
        $dosenStafs = DosenStaf::with('kelompokKeahlian')
            ->orderBy('urutan_struktural', 'asc')
            ->get();

        return view('tentang-kami.dosen-staf', compact('dosenStafs'));
    }

    public function kerjaSama()
    {
        $kerjaSamas = KerjaSama::all();
        return view('tentang-kami.kerja-sama', compact('kerjaSamas'));
    }
}
