@extends('layouts.app')

@section('title', 'Himpunan Mahasiswa (HIMASI) - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Himpunan Mahasiswa Sistem Informasi (HMSI-UKRI)" subtitle="Wadah organisasi eksekutif mahasiswa Sistem Informasi UKRI untuk pengembangan leadership dan softskill." category="Kemahasiswaan" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Cabinet Header Card -->
            <div class="bg-brand-lightbg p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
                <span class="text-xs font-bold text-brand-green uppercase tracking-widest bg-brand-green/10 px-3.5 py-1 rounded-full">Kepengurusan Himpunan</span>
                <h2 class="font-poppins font-bold text-2xl text-slate-900">Kabinet "Inovasi Kebangsaan" 2026/2027</h2>
                <p class="text-sm text-slate-600 leading-relaxed max-w-3xl">HIMASI UKRI berfokus pada 4 bidang utama: Riset & Teknologi, Pengabdian Masyarakat, Seni & Olahraga, serta Hubungan Luar Himpunan.</p>
            </div>

            <!-- Board Members Grid -->
            <div class="space-y-6">
                <h3 class="font-poppins font-bold text-xl text-slate-900">Pengurus Inti Himpunan</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($pengurus as $p)
                        <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center space-x-4 hover:border-brand-green transition-all">
                            <div class="w-14 h-14 bg-gradient-to-tr from-brand-green to-emerald-700 text-white rounded-2xl flex items-center justify-center font-bold text-lg shadow-sm">
                                {{ substr($p->nama, 0, 2) }}
                            </div>
                            <div>
                                <h4 class="font-poppins font-bold text-base text-slate-900">{{ $p->nama }}</h4>
                                <p class="text-xs font-semibold text-brand-green mt-0.5">{{ $p->jabatan }}</p>
                                <span class="text-[10px] text-slate-500 block">Periode {{ $p->periode }}</span>
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
                    <h3 class="font-poppins font-bold text-xl text-slate-900">Agenda & Kegiatan HIMASI</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($kegiatans as $keg)
                            <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-2 hover:border-brand-green transition-all">
                                <span class="text-xs font-bold text-amber-700 bg-amber-100 border border-amber-300 px-2.5 py-0.5 rounded-full">{{ \Carbon\Carbon::parse($keg->tanggal)->translatedFormat('d F Y') }}</span>
                                <h4 class="font-poppins font-bold text-lg text-slate-900 mt-2">{{ $keg->judul }}</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">{{ $keg->deskripsi }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
