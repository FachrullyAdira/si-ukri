@extends('layouts.app')

@section('title', 'Kemitraan & Kerja Sama - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Kemitraan & Kerja Sama" subtitle="Jejaring kolaborasi strategis dengan industri teknologi, BUMN, instansi pemerintah, dan lembaga pendidikan internasional." category="Tentang Kami" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($kerjaSamas as $ks)
                    <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all space-y-4 hover:border-brand-green">
                        <div class="w-12 h-12 bg-brand-green text-white rounded-xl flex items-center justify-center font-bold text-lg">
                            {{ substr($ks->nama_mitra, 0, 2) }}
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-brand-green uppercase tracking-wider bg-brand-green/10 px-2.5 py-0.5 rounded-full">{{ $ks->bentuk_kerja_sama }}</span>
                            <h3 class="font-poppins font-bold text-lg text-slate-900 mt-2">{{ $ks->nama_mitra }}</h3>
                            <p class="text-xs text-slate-600 mt-2 leading-relaxed">{{ $ks->deskripsi }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12 text-slate-500">
                        Belum ada data kemitraan yang ditampilkan.
                    </div>
                @endforelse
            </div>

        </div>
    </section>
@endsection
