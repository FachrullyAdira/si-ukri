@extends('layouts.app')

@section('title', 'Struktur Kurikulum & SKS - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Struktur Kurikulum (144 SKS)" subtitle="Sebaran mata kuliah dari Semester 1 hingga 8 yang dirancang sesuai standar internasional OBE dan kompetensi dunia kerja." category="Akademik" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm text-center">
                    <span class="text-slate-500 text-xs font-medium block">Total SKS Kelulusan</span>
                    <span class="font-poppins font-extrabold text-3xl text-brand-green mt-1 block">{{ $totalSks ?? 144 }} SKS</span>
                </div>
                <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm text-center">
                    <span class="text-slate-500 text-xs font-medium block">Mata Kuliah Wajib</span>
                    <span class="font-poppins font-extrabold text-3xl text-slate-900 mt-1 block">{{ $sksWajib ?? 120 }} SKS</span>
                </div>
                <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm text-center">
                    <span class="text-slate-500 text-xs font-medium block">Mata Kuliah Pilihan KBK</span>
                    <span class="font-poppins font-extrabold text-3xl text-amber-600 mt-1 block">{{ $sksPilihan ?? 24 }} SKS</span>
                </div>
            </div>

            <!-- Semester List -->
            @foreach($mataKuliahs as $semester => $courses)
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 border-b-2 border-brand-green/30 pb-2">
                        <span class="w-8 h-8 rounded-lg bg-brand-green text-white font-poppins font-bold text-sm flex items-center justify-center shadow-sm">
                            0{{ $semester }}
                        </span>
                        <h3 class="font-poppins font-bold text-xl text-slate-900">Semester {{ $semester }}</h3>
                    </div>

                    <div class="overflow-x-auto bg-brand-lightbg rounded-2xl border border-slate-200/80 shadow-sm">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-slate-100 text-slate-700 font-poppins text-xs uppercase tracking-wider">
                                    <th class="py-3.5 px-4 font-semibold">Kode</th>
                                    <th class="py-3.5 px-4 font-semibold">Nama Mata Kuliah</th>
                                    <th class="py-3.5 px-4 font-semibold">SKS</th>
                                    <th class="py-3.5 px-4 font-semibold">Sifat</th>
                                    <th class="py-3.5 px-4 font-semibold">Prasyarat</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200/80 font-inter text-slate-800">
                                @foreach($courses as $mk)
                                    <tr class="hover:bg-white transition-colors">
                                        <td class="py-3 px-4 font-mono font-semibold text-brand-green">{{ $mk->kode }}</td>
                                        <td class="py-3 px-4 font-semibold text-slate-900">{{ $mk->nama }}</td>
                                        <td class="py-3 px-4 font-bold text-slate-900">{{ $mk->sks }} SKS</td>
                                        <td class="py-3 px-4">
                                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold {{ $mk->sifat == 'Wajib' ? 'bg-brand-green/10 text-brand-green' : 'bg-amber-100 text-amber-800' }}">
                                                {{ $mk->sifat }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-xs text-slate-500">{{ $mk->prasyarat ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
