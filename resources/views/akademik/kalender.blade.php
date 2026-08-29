@extends('layouts.app')

@section('title', 'Kalender Akademik - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Kalender Akademik" subtitle="Jadwal lengkap agenda akademis, registrasi KRS, masa ujian, dan kegiatan perkuliahan TA {{ $tahunAkademikAktif }}." category="Akademik" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs text-slate-500 font-medium">Tahun Akademik Berjalan:</span>
                    <h3 class="font-poppins font-bold text-xl text-brand-green">{{ $tahunAkademikAktif }}</h3>
                </div>
                <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full border border-amber-300">Aktif</span>
            </div>

            <div class="space-y-4">
                @forelse($kalenders as $agenda)
                    <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4 hover:border-brand-green transition-all">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-brand-green bg-brand-green/10 px-2.5 py-0.5 rounded-full">{{ $agenda->tahun_akademik }}</span>
                            <h4 class="font-poppins font-bold text-lg text-slate-900 mt-1">{{ $agenda->judul_kegiatan }}</h4>
                            <p class="text-xs text-slate-600">{{ $agenda->keterangan ?? 'Agenda akademik resmi SI UKRI.' }}</p>
                        </div>
                        <div class="text-right md:text-left flex-shrink-0 bg-white px-4 py-2.5 rounded-xl border border-slate-200/80">
                            <span class="text-xs text-slate-500 block font-medium">Pelaksanaan:</span>
                            <span class="font-poppins font-bold text-slate-900 text-sm">
                                {{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->translatedFormat('d M Y') }}
                                @if($agenda->tanggal_selesai)
                                    s.d. {{ \Carbon\Carbon::parse($agenda->tanggal_selesai)->translatedFormat('d M Y') }}
                                @endif
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-slate-500">
                        Belum ada kalender akademik yang ditayangkan.
                    </div>
                @endforelse
            </div>

        </div>
    </section>
@endsection
