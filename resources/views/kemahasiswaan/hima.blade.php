@extends('layouts.app')

@section('title', $himaNama . ' - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb :title="$himaNama" :subtitle="$himaSubtitle" category="Kemahasiswaan" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Cabinet Header Card with Logo HIMASI -->
            <div class="bg-brand-lightbg p-8 sm:p-10 rounded-3xl border border-slate-200/90 shadow-sm flex flex-col md:flex-row items-center md:items-start gap-8 hover:border-brand-green/40 hover:shadow-md transition-all">
                <!-- Logo HIMASI / Kabinet -->
                <div class="w-32 h-32 sm:w-36 sm:h-36 rounded-3xl bg-white p-3 border border-slate-200 shadow-md flex-shrink-0 flex items-center justify-center relative overflow-hidden group hover:scale-105 transition-transform">
                    <img src="{{ $himaLogoUrl }}" alt="Logo HIMASI UKRI" class="w-full h-full object-contain" onerror="this.src='{{ asset('images/logo-kampus.png') }}';">
                </div>

                <!-- Detail Kabinet -->
                <div class="space-y-4 flex-grow text-center md:text-left">
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-2.5">
                        <span class="text-xs font-bold text-brand-green uppercase tracking-widest bg-emerald-100/90 text-emerald-800 border border-emerald-300 px-3.5 py-1 rounded-full">Kepengurusan Himpunan</span>
                        <span class="text-xs font-bold text-brand-green bg-emerald-50 border border-brand-green/30 px-3 py-1 rounded-full">{{ $himaSingkatan }}</span>
                        <span class="text-xs font-bold text-amber-800 bg-amber-100/90 border border-amber-300 px-3 py-1 rounded-full">Periode {{ $himaPeriode }}</span>
                    </div>

                    <h2 class="font-poppins font-extrabold text-2xl sm:text-3xl text-slate-900 leading-tight">
                        {{ $himaNamaKabinet }}
                    </h2>

                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed max-w-3xl">
                        {{ $himaDeskripsi }}
                    </p>

                    @if(!empty($himaInstagram) || !empty($himaEmail) || !empty($himaLinkedin))
                        <div class="pt-2 flex flex-wrap items-center justify-center md:justify-start gap-3 text-xs">
                            @if(!empty($himaInstagram))
                                <a href="{{ str_starts_with($himaInstagram, 'http') ? $himaInstagram : 'https://instagram.com/' . ltrim($himaInstagram, '@') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-brand-green hover:border-brand-green hover:bg-emerald-50 transition-all font-semibold shadow-sm">
                                    <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    <span>{{ str_starts_with($himaInstagram, '@') ? $himaInstagram : '@' . basename($himaInstagram) }}</span>
                                </a>
                            @endif
                            @if(!empty($himaEmail))
                                <a href="mailto:{{ $himaEmail }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:text-brand-green hover:border-brand-green hover:bg-emerald-50 transition-all font-semibold shadow-sm">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span>{{ $himaEmail }}</span>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Board Members Grid -->
            <div class="space-y-6">
                <h3 class="font-poppins font-bold text-xl text-slate-900">Pengurus Inti {{ $himaSingkatan }}</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($pengurus as $p)
                        <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center space-x-4 hover:border-brand-green transition-all group">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden bg-gradient-to-tr from-brand-green to-emerald-700 text-white flex items-center justify-center font-poppins font-bold text-xl shadow-md flex-shrink-0 relative group-hover:scale-105 transition-transform">
                                @if($p->foto_url)
                                    <img src="{{ $p->foto_url }}" alt="{{ $p->nama }}" class="w-full h-full object-cover" loading="lazy" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                    <span class="hidden font-poppins font-bold text-xl">{{ substr($p->nama, 0, 2) }}</span>
                                @else
                                    <span>{{ substr($p->nama, 0, 2) }}</span>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-poppins font-bold text-base text-slate-900 group-hover:text-brand-green transition-colors">{{ $p->nama }}</h4>
                                <p class="text-xs font-semibold text-brand-green mt-0.5">{{ $p->jabatan }}</p>
                                <span class="text-[10px] text-slate-500 block mt-0.5">Periode {{ $p->periode }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-8 text-slate-500">
                            Belum ada data pengurus himpunan.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- HIMA Activities -->
            @if($kegiatans->count() > 0)
                <div class="space-y-6 pt-6 border-t border-slate-200/80">
                    <h3 class="font-poppins font-bold text-xl text-slate-900">Agenda & Kegiatan {{ $himaSingkatan }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($kegiatans as $keg)
                            <div class="bg-brand-lightbg rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden hover:border-brand-green transition-all flex flex-col sm:flex-row group">
                                @if($keg->foto_url)
                                    <div class="sm:w-48 h-44 sm:h-auto overflow-hidden bg-slate-100 flex-shrink-0 relative">
                                        <img src="{{ $keg->foto_url }}" alt="{{ $keg->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" onerror="this.parentElement.style.display='none';">
                                    </div>
                                @endif
                                <div class="p-6 space-y-2 flex-grow">
                                    <span class="text-xs font-bold text-amber-700 bg-amber-100 border border-amber-300 px-2.5 py-0.5 rounded-full inline-block">{{ $keg->tanggal_rentang }}</span>
                                    <h4 class="font-poppins font-bold text-lg text-slate-900 mt-2 group-hover:text-brand-green transition-colors">{{ $keg->judul }}</h4>
                                    <p class="text-xs text-slate-600 leading-relaxed">{{ $keg->deskripsi }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
