@extends('layouts.app')

@section('title', 'Testimoni & Tracer Alumni - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Testimoni & Tracer Study Alumni" subtitle="Kisah sukses dan jejak karier lulusan Sistem Informasi UKRI di berbagai perusahaan terkemuka." category="Kemahasiswaan" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($alumnis as $alumni)
                    <div class="bg-brand-lightbg p-8 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all space-y-4 flex flex-col justify-between hover:border-brand-green">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-tr from-brand-green to-emerald-700 text-white rounded-2xl flex items-center justify-center font-poppins font-bold text-lg shadow-sm">
                                    {{ substr($alumni->nama, 0, 2) }}
                                </div>
                                <div>
                                    <h3 class="font-poppins font-bold text-lg text-slate-900 leading-snug">{{ $alumni->nama }}</h3>
                                    <p class="text-xs font-semibold text-brand-green mt-0.5">{{ $alumni->posisi_karier }}</p>
                                    <span class="text-[11px] text-slate-500 block">Angkatan {{ $alumni->angkatan }}</span>
                                </div>
                            </div>
                            <blockquote class="text-xs text-slate-600 italic leading-relaxed pt-2 border-t border-slate-200/80">
                                "{{ $alumni->testimoni }}"
                            </blockquote>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-500">
                        Belum ada data tracer alumni yang ditampilkan.
                    </div>
                @endforelse
            </div>

        </div>
    </section>
@endsection
