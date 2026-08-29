@extends('layouts.app')

@section('title', 'Sertifikat & Riwayat Akreditasi - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Akreditasi Program Studi" subtitle="Legalitas resmi dan sertifikasi kualifikasi penjaminan mutu pendidikan Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT)." category="Tentang Kami" />

    <section class="py-16 bg-white" x-data="{ openModal: false, selectedAkred: null }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Main Timeline Narrative (Line Chart / Timeline Layout) -->
                <div class="lg:col-span-8 space-y-6 text-slate-700 font-inter leading-relaxed">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-brand-green uppercase tracking-widest bg-emerald-100/80 px-3.5 py-1 rounded-full border border-emerald-300">Rekam Jejak Mutu</span>
                        <h2 class="font-poppins font-bold text-2xl lg:text-3xl text-slate-900">Riwayat & Perkembangan Akreditasi</h2>
                    </div>

                    <p>
                        Program Studi Sistem Informasi Universitas Kebangsaan Republik Indonesia (UKRI) secara berkesinambungan terus meningkatkan kualifikasi penjaminan mutu mutu akademik sesuai dengan standar nasional Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT).
                    </p>

                    <!-- Milestone Timeline Line Chart -->
                    <div class="pt-6 space-y-8">
                        <h3 class="font-poppins font-bold text-xl text-slate-900">Milestone Akreditasi BAN-PT</h3>

                        <div class="relative border-l-2 border-brand-green/40 pl-6 ml-4 space-y-10">
                            @forelse($akreditasis as $akred)
                                <div class="relative group">
                                    <!-- Node Circle -->
                                    <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-brand-green border-4 border-white shadow-md group-hover:scale-125 transition-transform"></span>

                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="text-xs font-bold text-brand-green bg-brand-lightgreen px-3 py-1 rounded-full border border-brand-green/20">
                                            Tahun {{ $akred->tahun }}
                                        </span>
                                        <span class="text-xs font-bold text-amber-800 bg-amber-100 border border-amber-300 px-3 py-1 rounded-full">
                                            Predikat: {{ $akred->peringkat }}
                                        </span>
                                        @if($akred->id == optional($akreditasiAktif)->id)
                                            <span class="text-[10px] font-bold text-white bg-gradient-to-r from-brand-red to-rose-600 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                                                Status Aktif Saat Ini
                                            </span>
                                        @endif
                                    </div>

                                    <h4 class="font-poppins font-bold text-lg text-slate-900 mt-2 leading-snug">
                                        {{ $akred->jenis }} — {{ $akred->peringkat }}
                                    </h4>

                                    @if($akred->no_sk)
                                        <p class="text-xs font-mono text-slate-500 mt-1">
                                            {{ $akred->no_sk }} &bull; Masa Berlaku: {{ $akred->masa_berlaku }}
                                        </p>
                                    @endif

                                    <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                                        {{ $akred->deskripsi ?? 'Merupakan bagian dari komitmen penjaminan mutu berkelanjutan Program Studi Sistem Informasi UKRI.' }}
                                    </p>

                                    <!-- Button Lihat Akreditasi -->
                                    <div class="pt-3">
                                        <button @click="openModal = true; selectedAkred = {
                                            tahun: '{{ $akred->tahun }}',
                                            peringkat: '{{ $akred->peringkat }}',
                                            jenis: '{{ $akred->jenis }}',
                                            no_sk: '{{ $akred->no_sk }}',
                                            masa_berlaku: '{{ $akred->masa_berlaku }}',
                                            file: '{{ asset('images/sertifikat-akreditasi.png') }}'
                                        }" class="inline-flex items-center text-xs font-bold text-white bg-gradient-to-r from-brand-green to-emerald-700 hover:from-brand-darkgreen hover:to-brand-green px-4 py-2 rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat Akreditasi &rarr;
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="relative">
                                    <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-brand-green border-4 border-white shadow-sm"></span>
                                    <span class="text-xs font-bold text-brand-green bg-brand-lightgreen px-3 py-1 rounded-full border border-brand-green/20">Tahun 2023</span>
                                    <h4 class="font-poppins font-bold text-lg text-slate-900 mt-2">Raihan Akreditasi A (Unggul) BAN-PT</h4>
                                    <p class="text-sm text-slate-600 mt-1">Mencapai kualifikasi mutakhir akreditasi tingkat nasional dengan predikat Unggul.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar Summary Card (Akreditasi Terbaru) -->
                <div class="lg:col-span-4 space-y-6">
                    @if($akreditasiAktif)
                        <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-200/80 pb-3">
                                <h3 class="font-poppins font-bold text-lg text-slate-900">Status Akreditasi Terbaru</h3>
                                <span class="bg-amber-400/20 text-amber-800 border border-amber-400/40 text-[10px] font-bold px-2 py-0.5 rounded-full">RESMI</span>
                            </div>

                            <dl class="space-y-3 text-sm">
                                <div class="flex justify-between py-1.5 border-b border-slate-200/60">
                                    <dt class="text-slate-500">Peringkat</dt>
                                    <dd class="font-poppins font-extrabold text-brand-green bg-brand-green/10 px-2.5 py-0.5 rounded">{{ $akreditasiAktif->peringkat }}</dd>
                                </div>
                                <div class="flex justify-between py-1.5 border-b border-slate-200/60">
                                    <dt class="text-slate-500">Lembaga</dt>
                                    <dd class="font-semibold text-slate-900">{{ $akreditasiAktif->lembaga }}</dd>
                                </div>
                                <div class="flex justify-between py-1.5 border-b border-slate-200/60">
                                    <dt class="text-slate-500">Tahun Penetapan</dt>
                                    <dd class="font-semibold text-slate-900">{{ $akreditasiAktif->tahun }}</dd>
                                </div>
                                <div class="flex justify-between py-1.5 border-b border-slate-200/60">
                                    <dt class="text-slate-500">Masa Berlaku</dt>
                                    <dd class="font-semibold text-slate-900">{{ $akreditasiAktif->masa_berlaku }}</dd>
                                </div>
                            </dl>

                            <div class="pt-2">
                                <button @click="openModal = true; selectedAkred = {
                                    tahun: '{{ $akreditasiAktif->tahun }}',
                                    peringkat: '{{ $akreditasiAktif->peringkat }}',
                                    jenis: '{{ $akreditasiAktif->jenis }}',
                                    no_sk: '{{ $akreditasiAktif->no_sk }}',
                                    masa_berlaku: '{{ $akreditasiAktif->masa_berlaku }}',
                                    file: '{{ asset('images/sertifikat-akreditasi.png') }}'
                                }" class="block w-full bg-brand-green hover:bg-brand-darkgreen text-white text-center font-poppins font-bold py-3 rounded-xl shadow-md transition-colors text-sm">
                                    Lihat Sertifikat &rarr;
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- Interactive Popup Modal (Alpine.js) -->
        <div x-show="openModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6"
             style="display: none;">

            <div @click.away="openModal = false" 
                 class="bg-white rounded-3xl border border-slate-200/90 shadow-2xl max-w-2xl w-full overflow-hidden relative transform transition-all">

                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-brand-darkgreen via-emerald-950 to-slate-900 text-white p-6 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-amber-300 uppercase tracking-widest bg-amber-400/20 px-2.5 py-0.5 rounded-full border border-amber-400/30">Dokumen Akreditasi Resmi BAN-PT</span>
                        <h3 class="font-poppins font-bold text-lg sm:text-xl text-white mt-1" x-text="selectedAkred ? 'Sertifikat Akreditasi Tahun ' + selectedAkred.tahun : ''"></h3>
                        <p class="text-xs text-emerald-200" x-text="selectedAkred ? selectedAkred.jenis + ' — Predikat ' + selectedAkred.peringkat : ''"></p>
                    </div>
                    <button @click="openModal = false" class="text-slate-400 hover:text-white p-2 rounded-full hover:bg-white/10 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Modal Body / Document Image Preview -->
                <div class="p-6 space-y-4 max-h-[65vh] overflow-y-auto bg-brand-lightbg">
                    <div class="bg-white p-2 rounded-2xl border border-slate-200 shadow-md">
                        <img :src="selectedAkred ? selectedAkred.file : ''" alt="Dokumen Sertifikat Akreditasi" class="w-full h-auto rounded-xl object-contain border border-slate-100 shadow-sm">
                    </div>
                    
                    <div class="bg-white p-4 rounded-xl border border-slate-200 text-xs space-y-1.5">
                        <div class="flex justify-between border-b border-slate-100 pb-1">
                            <span class="text-slate-500">Nomor SK Resmi:</span>
                            <span class="font-mono font-bold text-slate-800" x-text="selectedAkred ? selectedAkred.no_sk : ''"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Masa Berlaku SK:</span>
                            <span class="font-semibold text-slate-800" x-text="selectedAkred ? selectedAkred.masa_berlaku : ''"></span>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer / Unduh Sertifikat Button -->
                <div class="p-4 bg-white border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <button @click="openModal = false" class="w-full sm:w-auto px-5 py-2.5 text-xs font-semibold text-slate-600 hover:text-slate-900 border border-slate-300 rounded-xl hover:bg-slate-100 transition-colors">
                        Tutup
                    </button>
                    <a :href="selectedAkred ? selectedAkred.file : '#'" download class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 bg-gradient-to-r from-brand-red via-rose-600 to-red-600 hover:from-red-600 hover:to-brand-red text-white font-bold text-xs px-6 py-3 rounded-xl shadow-lg hover:shadow-red-500/25 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Unduh Sertifikat</span>
                    </a>
                </div>

            </div>
        </div>
    </section>
@endsection
