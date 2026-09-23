@extends('layouts.app')

@section('title', $berita->judul . ' - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb :title="$berita->judul" category="Berita" />

    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="space-y-4">
                <span class="text-xs font-semibold text-brand-green bg-brand-green/10 px-3 py-1 rounded-full">{{ $berita->kategori }}</span>
                <h1 class="font-poppins font-bold text-3xl sm:text-4xl text-slate-900 leading-tight">
                    {{ $berita->judul }}
                </h1>
                <div class="flex items-center space-x-4 text-xs text-slate-500 pb-6 border-b border-slate-200/80">
                    <span>{{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }}</span>
                    <span>&bull;</span>
                    <span>Penulis: {{ $berita->penulis ?? 'Humas SI UKRI' }}</span>
                </div>
            </div>

            @if($berita->cover_url)
                <div class="rounded-3xl overflow-hidden shadow-lg aspect-[16/9] w-full bg-slate-900">
                    <img src="{{ $berita->cover_url }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="prose prose-slate max-w-none text-slate-700 font-inter leading-relaxed space-y-4">
                {!! $berita->isi !!}
            </div>

            @if($relatedBeritas->count() > 0)
                <div class="pt-12 border-t border-slate-200/80 space-y-6">
                    <h3 class="font-poppins font-bold text-xl text-slate-900">Berita Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedBeritas as $rel)
                            <div class="p-4 bg-brand-lightbg rounded-xl border border-slate-200/80 space-y-2 hover:border-brand-green transition-all">
                                <span class="text-[10px] font-semibold text-brand-green bg-brand-green/10 px-2 py-0.5 rounded-full">{{ $rel->kategori }}</span>
                                <h4 class="font-poppins font-bold text-sm text-slate-800 leading-snug">
                                    <a href="{{ route('berita.show', $rel->slug) }}" class="hover:text-brand-green transition-colors">{{ $rel->judul }}</a>
                                </h4>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
