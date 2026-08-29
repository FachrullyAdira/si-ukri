<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\Alumni;
use App\Models\Akreditasi;
use App\Models\KelompokKeahlian;
use App\Models\DosenStaf;
use App\Models\PengaturanSitus;

class BerandaController extends Controller
{
    public function __invoke()
    {
        $beritas = Berita::where('tanggal_publikasi', '<=', now())
            ->orderBy('is_penting', 'desc')
            ->orderBy('tanggal_publikasi', 'desc')
            ->take(3)
            ->get();

        $prestasis = Prestasi::orderBy('tahun', 'desc')->take(3)->get();
        $alumnis = Alumni::latest()->take(3)->get();
        $akreditasi = Akreditasi::orderBy('tahun', 'desc')->first();
        $kelompokKeahlians = KelompokKeahlian::all();
        $dosenStafs = DosenStaf::orderBy('urutan_struktural', 'asc')->get();

        return view('beranda', compact('beritas', 'prestasis', 'alumnis', 'akreditasi', 'kelompokKeahlians', 'dosenStafs'));
    }
}
