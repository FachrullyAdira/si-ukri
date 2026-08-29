@extends('layouts.app')

@section('title', 'Daftar Berita & Pengumuman - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Berita & Informasi Akademik" subtitle="Arsip berita, pengumuman resmi, artikel populer, dan agenda kegiatan Program Studi SI UKRI." category="Berita" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Filter & Search Bar -->
            <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
                <form action="{{ route('berita.index') }}" method="GET" class="w-full flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita atau pengumuman..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-green bg-white text-sm">
                    </div>
                    <div class="w-full md:w-48">
                        <select name="kategori" onchange="this.form.submit()" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-green bg-white text-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($kategories as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-brand-green hover:bg-brand-darkgreen text-white text-sm font-semibold px-6 py-2.5 rounded-xl shadow-sm transition-colors">Cari</button>
                </form>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($beritas as $berita)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200/80 flex flex-col hover:border-brand-green transition-all">
                        <div class="h-48 bg-gradient-to-tr from-brand-green to-emerald-900 text-white p-6 font-poppins font-bold flex items-center justify-center text-center shadow-inner">
                            {{ $berita->judul }}
                        </div>
                        <div class="p-6 space-y-3 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-semibold text-brand-green bg-brand-green/10 px-2.5 py-1 rounded-full">{{ $berita->kategori }}</span>
                                <h3 class="font-poppins font-bold text-lg text-slate-800 mt-3 leading-snug">
                                    <a href="{{ route('berita.show', $berita->slug) }}" class="hover:text-brand-green transition-colors">{{ $berita->judul }}</a>
                                </h3>
                                <p class="text-xs text-slate-500 mt-2">{{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }} &bull; Oleh {{ $berita->penulis ?? 'Humas SI UKRI' }}</p>
                            </div>
                            <a href="{{ route('berita.show', $berita->slug) }}" class="text-xs font-semibold text-brand-green hover:underline flex items-center">Baca Selengkapnya &rarr;</a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-500">
                        Belum ada berita yang ditemukan.
                    </div>
                @endforelse
            </div>

            <!-- Pagination Links -->
            <div class="pt-6">
                {{ $beritas->links() }}
            </div>
        </div>
    </section>
@endsection
