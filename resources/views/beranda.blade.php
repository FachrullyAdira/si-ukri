@extends('layouts.app')

@section('title', 'Beranda Utama - Sistem Informasi UKRI')

@push('styles')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .dosen-swiper {
            cursor: grab;
            user-select: none;
            -webkit-user-select: none;
        }
        .dosen-swiper:active {
            cursor: grabbing;
        }
        .dosen-swiper .swiper-slide {
            height: auto;
            display: flex;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section (Rich Gradient Ambient & Glassmorphism) -->
    <section class="relative bg-gradient-to-br from-brand-darkgreen via-emerald-950 to-slate-950 text-white overflow-hidden py-16 lg:py-24 shadow-2xl border-b border-brand-green/30">
        <!-- Glowing Gradient Background Orbs -->
        <div class="absolute -right-20 -top-20 w-[30rem] h-[30rem] bg-gradient-to-tr from-brand-green via-teal-400 to-emerald-300 rounded-full blur-3xl opacity-25 animate-pulse pointer-events-none"></div>
        <div class="absolute left-10 bottom-0 w-96 h-96 bg-gradient-to-tr from-brand-red via-rose-500 to-amber-400 rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <a href="{{ $settings['pmb_link'] ?? 'https://pmb.ukri.ac.id/' }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-2 bg-gradient-to-r from-brand-red/20 to-amber-500/20 border border-brand-red/40 text-amber-300 px-4 py-1.5 rounded-full text-xs font-bold tracking-wide shadow-md hover:border-brand-red transition-all">
                        <span class="w-2.5 h-2.5 rounded-full bg-brand-red animate-ping"></span>
                        <span>{{ $settings['pmb_text'] ?? 'PENDAFTARAN MAHASISWA BARU DIBUKA' }} &rarr;</span>
                    </a>

                    <h1 class="font-poppins font-extrabold text-3xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-tight">
                        {{ $settings['hero_title'] ?? 'Membangun Talenta Digital Berkarakter Kebangsaan' }}
                    </h1>

                    <p class="font-inter text-emerald-100 text-base sm:text-lg leading-relaxed max-w-2xl">
                        {{ $settings['hero_subtitle'] ?? 'Program Studi Sistem Informasi Universitas Kebangsaan Republik Indonesia membekali mahasiswa dengan keahlian teknologi terkini.' }}
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="{{ $settings['pmb_link'] ?? 'https://pmb.ukri.ac.id/' }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto bg-gradient-to-r from-brand-red via-rose-600 to-red-600 hover:from-red-600 hover:to-brand-red text-white font-bold px-8 py-4 rounded-xl shadow-xl hover:shadow-red-500/30 transition-all transform hover:-translate-y-0.5 text-center">
                            Daftar PMB Online &rarr;
                        </a>
                        <a href="{{ route('akademik.kurikulum') }}" class="w-full sm:w-auto border-2 border-white/60 hover:border-white text-white font-semibold px-8 py-4 rounded-xl transition-all text-center hover:bg-white/10 backdrop-blur-sm">
                            Lihat Kurikulum
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-8 border-t border-emerald-800/80 text-center lg:text-left">
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/10 backdrop-blur-sm">
                            <span class="font-poppins font-extrabold text-2xl lg:text-3xl text-amber-300 block">{{ $akreditasi->peringkat ?? 'A' }}</span>
                            <span class="text-xs text-emerald-200 font-medium">Akreditasi BAN-PT</span>
                        </div>
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/10 backdrop-blur-sm">
                            <span class="font-poppins font-extrabold text-2xl lg:text-3xl text-white block">94%</span>
                            <span class="text-xs text-emerald-200 font-medium">Serapan Kerja Alumni</span>
                        </div>
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/10 backdrop-blur-sm">
                            <span class="font-poppins font-extrabold text-2xl lg:text-3xl text-emerald-300 block">144</span>
                            <span class="text-xs text-emerald-200 font-medium">Total SKS Kelulusan</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Image / Visual Glassmorphism Card -->
                <div class="lg:col-span-5 relative">
                    <div class="bg-gradient-to-b from-white/15 to-white/5 backdrop-blur-2xl p-3.5 rounded-3xl border border-white/20 shadow-2xl">
                        <div class="bg-slate-950/90 rounded-2xl p-6 space-y-6 text-white shadow-xl">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-amber-400 uppercase tracking-wider bg-amber-400/10 px-3 py-1 rounded-full border border-amber-400/30">Fasilitas Unggulan</span>
                                <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                            </div>
                            <div class="space-y-4">
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 flex items-center space-x-4 hover:border-brand-green transition-all">
                                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-brand-green to-emerald-500 text-white flex items-center justify-center font-bold shadow-md">01</div>
                                    <div>
                                        <h4 class="font-poppins font-semibold text-white text-sm">Lab Enterprise Resource Planning</h4>
                                        <p class="text-xs text-slate-400">Sertifikasi SAP & Oracle Academy</p>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 flex items-center space-x-4 hover:border-brand-amber transition-all">
                                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-amber-500 to-yellow-600 text-white flex items-center justify-center font-bold shadow-md">02</div>
                                    <div>
                                        <h4 class="font-poppins font-semibold text-white text-sm">Lab Software & Data Analytics</h4>
                                        <p class="text-xs text-slate-400">High Performance Computing & AI Studio</p>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 flex items-center space-x-4 hover:border-brand-red transition-all">
                                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-brand-red to-rose-600 text-white flex items-center justify-center font-bold shadow-md">03</div>
                                    <div>
                                        <h4 class="font-poppins font-semibold text-white text-sm">Incubator Startup & Digital Lab</h4>
                                        <p class="text-xs text-slate-400">Mentorship Industri & Seed Funding</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Sertifikat Akreditasi Program Studi (Di Bawah Hero Section) -->
    <section class="py-16 bg-white relative overflow-hidden border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-gradient-to-br from-brand-lightbg via-white to-emerald-50/50 p-8 sm:p-12 rounded-3xl border border-slate-200/90 shadow-xl grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                <!-- Left Column: Certificate Document Display Card -->
                <div class="lg:col-span-5 relative group">
                    <div class="p-2 rounded-3xl bg-gradient-to-tr from-amber-400 via-amber-300 to-amber-500 shadow-2xl transform group-hover:scale-[1.02] transition-all">
                        <div class="overflow-hidden rounded-[1.25rem] bg-white border border-amber-200 shadow-md relative aspect-[3/4]">
                            <img src="{{ asset('images/sertifikat-akreditasi.png') }}" alt="Dokumen Sertifikat Akreditasi BAN-PT Sistem Informasi UKRI" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                                <a href="{{ route('tentang.akreditasi') }}" class="w-full bg-amber-400 hover:bg-amber-500 text-slate-950 font-poppins font-bold text-xs py-3 rounded-xl text-center shadow-lg transition-colors">
                                    Lihat Salinan SK Lengkap &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Accreditation Details & Specifications -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="space-y-3">
                        <span class="text-xs font-bold text-brand-green uppercase tracking-widest bg-emerald-100/80 px-4 py-1.5 rounded-full border border-emerald-300 inline-block">
                            Akreditasi & Penjaminan Mutu Akademik
                        </span>
                        <h2 class="font-poppins font-extrabold text-3xl sm:text-4xl text-slate-900 leading-tight">
                            Sertifikat Akreditasi Program Studi BAN-PT
                        </h2>
                        <p class="font-inter text-slate-600 text-sm sm:text-base leading-relaxed">
                            Program Studi Sistem Informasi Universitas Kebangsaan Republik Indonesia telah resmi memenuhi standar kualifikasi mutakhir penjaminan mutu tinggi dengan predikat <strong class="font-bold text-slate-900">Terakreditasi "A" / Unggul</strong> oleh Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT).
                        </p>
                    </div>

                    <!-- Specs Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 bg-white rounded-2xl border border-slate-200/90 shadow-sm space-y-1">
                            <span class="text-xs text-slate-500 font-medium block">Peringkat Akreditasi</span>
                            <span class="font-poppins font-extrabold text-xl text-brand-green block">A / UNGGUL</span>
                        </div>
                        <div class="p-4 bg-white rounded-2xl border border-slate-200/90 shadow-sm space-y-1">
                            <span class="text-xs text-slate-500 font-medium block">Lembaga Penilai</span>
                            <span class="font-poppins font-bold text-slate-900 text-sm block">BAN-PT Kemendikbudristek RI</span>
                        </div>
                        <div class="p-4 bg-white rounded-2xl border border-slate-200/90 shadow-sm space-y-1">
                            <span class="text-xs text-slate-500 font-medium block">Nomor SK Resmi</span>
                            <span class="font-mono font-semibold text-slate-800 text-xs block">SK BAN-PT No. 4281/SK/BAN-PT/2023</span>
                        </div>
                        <div class="p-4 bg-white rounded-2xl border border-slate-200/90 shadow-sm space-y-1">
                            <span class="text-xs text-slate-500 font-medium block">Masa Berlaku</span>
                            <span class="font-poppins font-semibold text-slate-900 text-xs block">2023 s.d. 2028</span>
                        </div>
                    </div>

                    <!-- CTA Action -->
                    <div class="pt-4 flex flex-col sm:flex-row items-center gap-4">
                        <a href="{{ route('tentang.akreditasi') }}" class="w-full sm:w-auto bg-gradient-to-r from-brand-green to-emerald-700 hover:from-brand-darkgreen hover:to-brand-green text-white font-poppins font-bold text-xs px-6 py-3.5 rounded-xl shadow-lg transition-all text-center">
                            Detail Akreditasi & Download PDF &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Sambutan Ketua Program Studi -->
    <section class="py-16 lg:py-24 bg-gradient-to-b from-brand-lightbg via-white to-brand-lightbg relative overflow-hidden border-b border-slate-200/80">
        <!-- Decorative Ambient Blur -->
        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-80 h-80 bg-brand-green/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-0 top-1/3 w-72 h-72 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                <!-- Left Column: Portrait Photo & Credentials Badge -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Gradient Outer Ring -->
                        <div class="p-2 rounded-3xl bg-gradient-to-tr from-brand-green via-amber-400 to-brand-red shadow-2xl transform hover:scale-[1.01] transition-transform">
                            <div class="overflow-hidden rounded-[1.25rem] bg-slate-900 aspect-[4/5] relative">
                                <img src="{{ asset('images/kaprodi.png') }}" alt="Foto Ketua Program Studi Sistem Informasi UKRI" class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>

                                <!-- Overlay Caption on Image -->
                                <div class="absolute bottom-4 left-4 right-4 text-white space-y-0.5">
                                    <span class="text-[10px] font-bold text-amber-300 uppercase tracking-widest bg-amber-400/20 border border-amber-400/40 px-2.5 py-0.5 rounded-full">Ketua Program Studi</span>
                                    <h4 class="font-poppins font-bold text-lg leading-tight text-white pt-1">Dr. Ir. Hendra Prasetya, M.T.</h4>
                                    <p class="text-xs text-emerald-200">NIDN. 0418058201</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Speech & Narrative Text -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="space-y-3">
                        <span class="text-xs font-bold text-brand-green uppercase tracking-widest bg-emerald-100/80 px-4 py-1.5 rounded-full border border-emerald-300">Sambutan Ketua Program Studi</span>
                        <h2 class="font-poppins font-extrabold text-3xl sm:text-4xl text-slate-900 leading-tight">
                            {{ $settings['sambutan_judul'] ?? 'Mempersiapkan Generasi Unggul di Era Transformasi Digital' }}
                        </h2>
                    </div>

                    <!-- Highlight Quote Card -->
                    <div class="p-5 bg-gradient-to-r from-emerald-50 via-teal-50/50 to-white rounded-2xl border-l-4 border-brand-green shadow-sm space-y-2">
                        <p class="font-poppins font-semibold text-brand-green text-sm sm:text-base italic leading-relaxed">
                            "Selamat datang di Portal Resmi Program Studi Sistem Informasi Universitas Kebangsaan Republik Indonesia (UKRI)."
                        </p>
                    </div>

                    <!-- Speech Body Paragraphs -->
                    <div class="space-y-4 font-inter text-slate-700 text-sm sm:text-base leading-relaxed whitespace-pre-wrap">
                        {{ $settings['sambutan_teks'] ?? 'Perkembangan teknologi informasi...' }}
                    </div>

                    <!-- Signature & CTA Actions -->
                    <div class="pt-4 border-t border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <h4 class="font-poppins font-bold text-slate-900 text-base">Dr. Ir. Hendra Prasetya, M.T.</h4>
                            <p class="text-xs font-semibold text-brand-green">Ketua Program Studi Sistem Informasi UKRI</p>
                        </div>
                        <a href="{{ route('tentang.visi-misi') }}" class="inline-flex items-center text-xs font-bold text-brand-green hover:text-brand-darkgreen bg-brand-lightgreen border border-brand-green/20 px-4 py-2.5 rounded-xl hover:bg-emerald-100 transition-all">
                            Lihat Visi Misi Prodi &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Jajaran Dosen & Staf Program Studi (Seamless Infinite Marquee Slider) -->
    <section class="py-16 bg-white overflow-hidden border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-brand-green uppercase tracking-widest bg-emerald-100/80 px-4 py-1.5 rounded-full border border-emerald-300">Tim Pengajar Professional</span>
                    <h2 class="font-poppins font-extrabold text-3xl sm:text-4xl text-slate-900">Jajaran Dosen & Staf Program Studi</h2>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Navigation Buttons -->
                    <div class="flex items-center gap-2">
                        <button type="button" class="dosen-prev p-2.5 rounded-xl border border-slate-200 bg-white hover:bg-emerald-50 text-slate-700 hover:text-brand-green hover:border-brand-green/40 shadow-xs transition-all flex items-center justify-center cursor-pointer active:scale-95" aria-label="Slide Sebelumnya" title="Sebelumnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button type="button" class="dosen-next p-2.5 rounded-xl border border-slate-200 bg-white hover:bg-emerald-50 text-slate-700 hover:text-brand-green hover:border-brand-green/40 shadow-xs transition-all flex items-center justify-center cursor-pointer active:scale-95" aria-label="Slide Berikutnya" title="Berikutnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                    <a href="{{ route('tentang.dosen-staf') }}" class="inline-flex items-center text-xs font-bold text-brand-green hover:text-brand-darkgreen bg-emerald-50 border border-brand-green/20 px-4 py-2.5 rounded-xl hover:bg-emerald-100 transition-all shadow-xs">
                        Lihat Semua Dosen &rarr;
                    </a>
                </div>
            </div>

            <!-- Swiper Carousel Container -->
            <div class="swiper dosen-swiper py-4">
                <div class="swiper-wrapper">
                    @php
                        // Duplicate items if collection is small to guarantee a 100% seamless infinite loop without jump/rewind
                        $carouselItems = $dosenStafs->count() > 0 ? $dosenStafs : collect();
                        if ($carouselItems->count() > 0 && $carouselItems->count() < 12) {
                            $carouselItems = $carouselItems->concat($carouselItems)->concat($carouselItems);
                        }
                    @endphp

                    @forelse($carouselItems as $dosen)
                        <div class="swiper-slide h-auto">
                            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl transition-all p-6 flex flex-col items-center text-center space-y-4 hover:border-brand-green group h-full">
                                <!-- Rounded Profile Photo / Avatar -->
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full p-1 bg-gradient-to-tr from-brand-green via-amber-400 to-brand-red shadow-md group-hover:scale-105 transition-transform">
                                    <div class="w-full h-full rounded-full overflow-hidden bg-gradient-to-tr from-brand-green to-emerald-700 flex items-center justify-center text-white font-poppins font-bold text-2xl shadow-inner relative">
                                        @if($dosen->foto_url)
                                            <img src="{{ $dosen->foto_url }}" alt="{{ $dosen->nama }}" class="w-full h-full object-cover" loading="lazy" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                            <span class="hidden font-poppins font-bold text-2xl">{{ substr($dosen->nama, 0, 2) }}</span>
                                        @else
                                            <span>{{ substr($dosen->nama, 0, 2) }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Name & Credentials -->
                                <div class="space-y-2 flex-grow flex flex-col justify-center">
                                    <h4 class="font-poppins font-bold text-base text-slate-900 leading-snug group-hover:text-brand-green transition-colors">
                                        {{ $dosen->nama }}
                                    </h4>
                                    <div class="pt-1">
                                        <span class="inline-block text-[11px] font-semibold text-brand-green bg-brand-green/10 border border-brand-green/20 px-3 py-1 rounded-full">
                                            {{ $dosen->jabatan_struktural ?? $dosen->jabatan }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide text-center py-8 text-slate-500">
                            Belum ada data dosen pengajar.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </section>

    <!-- Keunggulan Program Studi -->
    <section class="py-16 bg-brand-lightbg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-12">
                <span class="text-xs font-bold text-brand-green uppercase tracking-widest bg-emerald-100/80 px-4 py-1.5 rounded-full border border-emerald-300">Mengapa SI UKRI</span>
                <h2 class="font-poppins font-extrabold text-3xl sm:text-4xl text-slate-900">Keunggulan & Fokus Pembelajaran</h2>
                <p class="text-slate-600 text-sm sm:text-base">Kurikulum berbasis standar internasional yang disesuaikan dengan kebutuhan industri teknologi nasional.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($kelompokKeahlians as $kbk)
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl transition-all group hover:border-brand-green overflow-hidden flex flex-col justify-between">
                        <!-- Top Gradient Line -->
                        <div class="h-1.5 w-full bg-gradient-to-r from-brand-red via-brand-amber to-brand-green"></div>

                        <div class="p-8 space-y-4">
                            <div class="w-14 h-14 bg-gradient-to-tr from-brand-green to-emerald-700 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform font-poppins font-bold text-lg shadow-lg overflow-hidden p-2.5">
                                @if($kbk->ikon_url)
                                    <img src="{{ $kbk->ikon_url }}" alt="{{ $kbk->nama }}" class="w-full h-full object-contain" loading="lazy">
                                @else
                                    {{ substr($kbk->nama, 0, 2) }}
                                @endif
                            </div>
                            <h3 class="font-poppins font-bold text-xl text-slate-900 group-hover:text-brand-green transition-colors">{{ $kbk->nama }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ Str::limit($kbk->deskripsi, 120) }}</p>
                        </div>

                        <div class="p-8 pt-0">
                            <a href="{{ route('akademik.kurikulum', ['kelompok' => $kbk->id]) }}" class="inline-flex items-center text-xs font-bold text-brand-green hover:text-brand-darkgreen group-hover:translate-x-1 transition-all">
                                Lihat Kurikulum {{ $kbk->nama }} &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section Prestasi Mahasiswa Terkini -->
    <section class="py-16 bg-white border-t border-slate-200/80 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-brand-green uppercase tracking-widest bg-emerald-100/80 px-4 py-1.5 rounded-full border border-emerald-300">Torehan Prestasi Mahasiswa</span>
                    <h2 class="font-poppins font-extrabold text-3xl sm:text-4xl text-slate-900">Rekam Jejak Prestasi & Kejuaraan</h2>
                </div>
                <a href="{{ route('kemahasiswaan.prestasi') }}" class="inline-flex items-center text-xs font-bold text-brand-green hover:text-brand-darkgreen bg-emerald-50 border border-brand-green/20 px-5 py-2.5 rounded-xl hover:bg-emerald-100 transition-all">
                    Lihat Semua Prestasi &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($prestasis as $prestasi)
                    <div class="bg-brand-lightbg rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-xl transition-all group hover:border-brand-green flex flex-col justify-between">
                        <div>
                            @if($prestasi->foto_url)
                                <div class="h-48 w-full overflow-hidden relative bg-slate-900">
                                    <img src="{{ $prestasi->foto_url }}" alt="{{ $prestasi->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                                    <div class="absolute top-4 left-4 flex items-center gap-2">
                                        <span class="text-[10px] font-bold text-amber-900 bg-amber-200/90 backdrop-blur-sm border border-amber-300 px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-sm">{{ $prestasi->kategori }}</span>
                                        <span class="text-[10px] font-bold text-white bg-slate-950/70 backdrop-blur-sm px-2.5 py-0.5 rounded-full">{{ $prestasi->tahun }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="h-44 bg-gradient-to-tr from-amber-500 via-amber-600 to-amber-700 text-white p-6 flex flex-col justify-between relative overflow-hidden">
                                    <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                                    <div class="flex items-center justify-between relative z-10">
                                        <span class="text-[10px] font-bold text-amber-900 bg-amber-100 px-2.5 py-0.5 rounded-full uppercase">{{ $prestasi->kategori }}</span>
                                        <span class="text-xs font-bold text-amber-100">{{ $prestasi->tahun }}</span>
                                    </div>
                                    <svg class="w-10 h-10 text-white/30 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.496m5.511 0a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25h-6a2.25 2.25 0 00-2.25 2.25v6.5a2.25 2.25 0 002.25 2.25"/></svg>
                                </div>
                            @endif

                            <div class="p-6 space-y-3">
                                <h3 class="font-poppins font-bold text-lg text-slate-900 group-hover:text-brand-green transition-colors leading-snug">
                                    {{ $prestasi->judul }}
                                </h3>
                                <p class="text-xs font-semibold text-brand-green">Oleh: {{ $prestasi->nama_mahasiswa }}</p>
                                <p class="text-xs text-slate-600 leading-relaxed">{{ Str::limit($prestasi->deskripsi, 120) }}</p>
                            </div>
                        </div>

                        <div class="p-6 pt-0 border-t border-slate-200/80 mt-2">
                            <a href="{{ route('kemahasiswaan.prestasi') }}" class="text-xs font-bold text-brand-green hover:underline flex items-center pt-3">
                                Lihat Detail Prestasi &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8 text-slate-500">
                        Belum ada galeri prestasi yang ditampilkan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Latest News Teaser Section -->
    <section class="py-16 bg-brand-lightbg border-t border-slate-200/80 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10">
                <div>
                    <span class="text-xs font-bold text-brand-green uppercase tracking-widest bg-emerald-100/80 px-3.5 py-1 rounded-full border border-emerald-300">Kabar & Publikasi</span>
                    <h2 class="font-poppins font-extrabold text-3xl text-slate-900 mt-2">Berita Akademik Terkini</h2>
                </div>
                <a href="{{ route('berita.index') }}" class="mt-4 md:mt-0 bg-white border border-slate-200 hover:border-brand-green text-brand-green hover:text-brand-darkgreen font-bold text-xs px-5 py-2.5 rounded-xl shadow-sm transition-all flex items-center">
                    Lihat Semua Berita &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($beritas as $berita)
                    <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/90 flex flex-col hover:border-brand-green transition-all group">
                        @if($berita->cover_url)
                            <div class="h-48 overflow-hidden relative group-hover:opacity-95 transition-all bg-slate-900">
                                <img src="{{ $berita->cover_url }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/20 to-transparent"></div>
                                <span class="absolute top-3 left-4 text-[10px] font-bold text-white bg-brand-green/90 backdrop-blur-sm border border-brand-green/40 px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-sm">{{ $berita->kategori }}</span>
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-tr from-brand-darkgreen via-brand-green to-emerald-800 text-white p-6 font-poppins font-bold flex items-center justify-center text-center shadow-inner relative overflow-hidden">
                                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                                <span class="relative z-10 leading-snug group-hover:scale-105 transition-transform">{{ $berita->judul }}</span>
                            </div>
                        @endif
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                @if(!$berita->cover_url)
                                    <span class="text-[11px] font-bold text-brand-green bg-gradient-to-r from-emerald-50 to-teal-50 border border-brand-green/20 px-3 py-1 rounded-full">{{ $berita->kategori }}</span>
                                @endif
                                <h3 class="font-poppins font-bold text-lg text-slate-900 mt-2 leading-snug group-hover:text-brand-green transition-colors">
                                    <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                                </h3>
                                <p class="text-xs text-slate-500 mt-2">{{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }} &bull; Oleh {{ $berita->penulis ?? 'Humas SI UKRI' }}</p>
                            </div>
                            <a href="{{ route('berita.show', $berita->slug) }}" class="text-xs font-bold text-brand-green hover:underline flex items-center">Baca Selengkapnya &rarr;</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Swiper JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiperDosen = new Swiper('.dosen-swiper', {
                loop: true,
                grabCursor: true,
                simulateTouch: true,
                allowTouchMove: true,
                touchRatio: 1.2,
                mousewheel: {
                    forceToAxis: true,
                    releaseOnEdges: true,
                    sensitivity: 1,
                },
                navigation: {
                    nextEl: '.dosen-next',
                    prevEl: '.dosen-prev',
                },
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 600,
                slidesPerView: 1.5,
                spaceBetween: 16,
                breakpoints: {
                    640: {
                        slidesPerView: 2.5,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3.5,
                        spaceBetween: 24,
                    },
                    1024: {
                        slidesPerView: 4.5,
                        spaceBetween: 28,
                    },
                },
            });
        });
    </script>
@endpush
