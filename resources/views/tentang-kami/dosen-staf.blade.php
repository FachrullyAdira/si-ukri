@extends('layouts.app')

@section('title', 'Dosen & Staf Pengajar - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Dosen & Staf Pengajar" subtitle="Profil tim pengajar profesional, peneliti, dan praktisi Sistem Informasi Universitas Kebangsaan Republik Indonesia." category="Tentang Kami" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($dosenStafs as $dosen)
                    <div class="bg-brand-lightbg rounded-2xl border border-slate-200/80 p-6 shadow-sm hover:shadow-md transition-all space-y-4 hover:border-brand-green">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden bg-gradient-to-tr from-brand-green to-emerald-700 text-white flex items-center justify-center font-poppins font-bold text-xl shadow-md flex-shrink-0 relative">
                                @if($dosen->foto_url)
                                    <img src="{{ $dosen->foto_url }}" alt="{{ $dosen->nama }}" class="w-full h-full object-cover" loading="lazy" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                    <span class="hidden font-poppins font-bold text-xl">{{ substr($dosen->nama, 0, 2) }}</span>
                                @else
                                    <span>{{ substr($dosen->nama, 0, 2) }}</span>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-poppins font-bold text-base text-slate-900 leading-snug">{{ $dosen->nama }}</h3>
                                <p class="text-xs font-semibold text-brand-green mt-0.5">{{ $dosen->jabatan_struktural ?? $dosen->jabatan }}</p>
                                <p class="text-[11px] text-slate-500">NIDN: {{ $dosen->nidn ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-200/80 space-y-2 text-xs">
                            <div>
                                <span class="text-slate-500 block font-medium">Bidang Keahlian:</span>
                                <span class="font-semibold text-slate-800">{{ $dosen->bidang_keahlian ?? '-' }}</span>
                            </div>
                            @if($dosen->kelompokKeahlian)
                                <div>
                                    <span class="text-slate-500 block font-medium">Kelompok Keahlian (KBK):</span>
                                    <span class="inline-block bg-brand-green/10 text-brand-green px-2 py-0.5 rounded font-semibold mt-0.5">{{ $dosen->kelompokKeahlian->nama }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-500">
                        Belum ada data dosen pengajar yang ditampilkan.
                    </div>
                @endforelse
            </div>

        </div>
    </section>
@endsection
