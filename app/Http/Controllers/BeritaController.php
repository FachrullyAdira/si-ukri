<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::where('tanggal_publikasi', '<=', now());

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                  ->orWhere('isi', 'LIKE', "%{$search}%");
            });
        }

        $beritas = $query->orderBy('is_penting', 'desc')
                         ->orderBy('tanggal_publikasi', 'desc')
                         ->paginate(6);

        $kategories = Berita::select('kategori')->distinct()->pluck('kategori');

        return view('berita.index', compact('beritas', 'kategories'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->orWhere('id', $slug)
            ->firstOrFail();

        $relatedBeritas = Berita::where('id', '!=', $berita->id)
            ->where('kategori', $berita->kategori)
            ->take(3)
            ->get();

        return view('berita.show', compact('berita', 'relatedBeritas'));
    }
}
