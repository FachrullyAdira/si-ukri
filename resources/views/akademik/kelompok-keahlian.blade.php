@extends('layouts.app')

@section('title', 'Kelompok Keahlian (KBK) - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Kelompok Keahlian (KBK)" subtitle="Peminatan konsentrasi keahlian spesifik yang disesuaikan dengan tren kebutuhan industri teknologi terkini." category="Akademik" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @forelse($kelompokKeahlians as $kbk)
                    <div class="bg-brand-lightbg p-8 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all space-y-6 flex flex-col justify-between hover:border-brand-green">
                        <div class="space-y-4">
                            <div class="w-14 h-14 bg-brand-green text-white rounded-2xl flex items-center justify-center font-poppins font-bold text-xl shadow-md">
                                {{ substr($kbk->nama, 0, 2) }}
                            </div>
                            <h3 class="font-poppins font-bold text-2xl text-slate-900">{{ $kbk->nama }}</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">{{ $kbk->deskripsi }}</p>

                            @if($kbk->capaian_pembelajaran)
                                <div class="pt-4 border-t border-slate-200/80 space-y-2">
                                    <span class="text-xs font-bold text-brand-green uppercase tracking-wider block">Capaian Keahlian:</span>
                                    <p class="text-xs text-slate-600 leading-relaxed">{{ $kbk->capaian_pembelajaran }}</p>
                                </div>
                            @endif

                            @if($kbk->prospek_karier)
                                <div class="pt-2 space-y-2">
                                    <span class="text-xs font-bold text-amber-600 uppercase tracking-wider block">Prospek Karier:</span>
                                    <p class="text-xs font-semibold text-slate-800">{{ $kbk->prospek_karier }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-slate-200/80">
                            <a href="{{ route('akademik.kurikulum', ['kelompok' => $kbk->id]) }}" class="block w-full bg-brand-green hover:bg-brand-darkgreen text-white text-center font-poppins font-semibold py-3 rounded-xl shadow-md transition-colors text-sm">
                                Lihat Mata Kuliah &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-500">
                        Belum ada kelompok keahlian yang ditampilkan.
                    </div>
                @endforelse
            </div>

        </div>
    </section>
@endsection
