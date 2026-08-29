@extends('layouts.app')

@section('title', 'Galeri Prestasi Mahasiswa - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Galeri Prestasi Mahasiswa" subtitle="Rekam jejak torehan juara dan penghargaan tingkat nasional & internasional mahasiswa Sistem Informasi UKRI." category="Kemahasiswaan" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($prestasis as $prestasi)
                    <div class="bg-brand-lightbg p-8 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all space-y-4 hover:border-brand-green">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-amber-800 bg-amber-100 border border-amber-300 px-3 py-1 rounded-full uppercase tracking-wider">{{ $prestasi->kategori }}</span>
                            <span class="font-poppins font-bold text-slate-500 text-sm">{{ $prestasi->tahun }}</span>
                        </div>
                        <h3 class="font-poppins font-bold text-xl text-slate-900 leading-snug">{{ $prestasi->judul }}</h3>
                        <p class="text-xs font-semibold text-brand-green">Oleh: {{ $prestasi->nama_mahasiswa }}</p>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $prestasi->deskripsi }}</p>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-500">
                        Belum ada galeri prestasi yang ditampilkan.
                    </div>
                @endforelse
            </div>

        </div>
    </section>
@endsection
