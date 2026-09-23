@extends('layouts.app')

@section('title', 'Galeri Prestasi Mahasiswa - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Galeri Prestasi Mahasiswa" subtitle="Rekam jejak torehan juara dan penghargaan tingkat nasional & internasional mahasiswa Sistem Informasi UKRI." category="Kemahasiswaan" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($prestasis as $prestasi)
                    <div class="bg-brand-lightbg rounded-3xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl transition-all hover:border-brand-green flex flex-col justify-between group">
                        <div>
                            @if($prestasi->foto_url)
                                <div class="h-52 w-full overflow-hidden relative bg-slate-900">
                                    <img src="{{ $prestasi->foto_url }}" alt="{{ $prestasi->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                                    <div class="absolute top-4 left-4 flex items-center gap-2">
                                        <span class="text-xs font-bold text-amber-900 bg-amber-200/90 backdrop-blur-sm border border-amber-300 px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">{{ $prestasi->kategori }}</span>
                                        <span class="text-xs font-bold text-white bg-slate-950/70 backdrop-blur-sm px-2.5 py-1 rounded-full">{{ $prestasi->tahun }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="p-6 pb-0 flex items-center justify-between">
                                    <span class="text-xs font-bold text-amber-800 bg-amber-100 border border-amber-300 px-3 py-1 rounded-full uppercase tracking-wider">{{ $prestasi->kategori }}</span>
                                    <span class="font-poppins font-bold text-slate-500 text-sm">{{ $prestasi->tahun }}</span>
                                </div>
                            @endif

                            <div class="p-6 space-y-3">
                                <h3 class="font-poppins font-bold text-xl text-slate-900 leading-snug group-hover:text-brand-green transition-colors">{{ $prestasi->judul }}</h3>
                                <p class="text-xs font-semibold text-brand-green">Oleh: {{ $prestasi->nama_mahasiswa }}</p>
                                <p class="text-sm text-slate-600 leading-relaxed">{{ $prestasi->deskripsi }}</p>
                            </div>
                        </div>
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
