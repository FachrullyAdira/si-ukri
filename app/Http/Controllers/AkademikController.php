<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\KelompokKeahlian;
use App\Models\KalenderAkademik;

class AkademikController extends Controller
{
    public function strukturKurikulum(Request $request)
    {
        $selectedKelompok = $request->query('kelompok');
        $query = MataKuliah::with('kelompokKeahlian')->orderBy('semester', 'asc')->orderBy('kode', 'asc');

        if ($selectedKelompok) {
            $query->whereHas('kelompokKeahlian', function ($q) use ($selectedKelompok) {
                $q->where('id', $selectedKelompok)->orWhere('nama', 'LIKE', "%{$selectedKelompok}%");
            });
        }

        $mataKuliahs = $query->get()->groupBy('semester');
        $totalSks = MataKuliah::sum('sks');
        $sksWajib = MataKuliah::where('sifat', 'Wajib')->sum('sks');
        $sksPilihan = MataKuliah::where('sifat', '!=', 'Wajib')->sum('sks');

        return view('akademik.struktur-kurikulum', compact('mataKuliahs', 'totalSks', 'sksWajib', 'sksPilihan', 'selectedKelompok'));
    }

    public function kelompokKeahlian()
    {
        $kelompokKeahlians = KelompokKeahlian::with(['dosenStafs', 'mataKuliahs'])->get();
        return view('akademik.kelompok-keahlian', compact('kelompokKeahlians'));
    }

    public function mataKuliah(Request $request)
    {
        $query = MataKuliah::with('kelompokKeahlian');

        if ($request->has('semester') && $request->semester) {
            $query->where('semester', $request->semester);
        }

        if ($request->has('sifat') && $request->sifat) {
            $query->where('sifat', $request->sifat);
        }

        $mataKuliahs = $query->orderBy('semester', 'asc')->orderBy('kode', 'asc')->get();
        return view('akademik.mata-kuliah', compact('mataKuliahs'));
    }

    public function kalender()
    {
        $kalenders = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->get();
        $tahunAkademikAktif = KalenderAkademik::latest('id')->value('tahun_akademik') ?? '2026/2027 Ganjil';
        return view('akademik.kalender', compact('kalenders', 'tahunAkademikAktif'));
    }
}
