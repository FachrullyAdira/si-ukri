@extends('layouts.app')

@section('title', 'Visi & Misi - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Visi & Misi Program Studi" subtitle="Landasan filosofis, arah strategis, dan komitmen penyelenggaraan pendidikan Sistem Informasi UKRI." category="Tentang Kami" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Visi Card -->
            <div class="bg-gradient-to-r from-brand-green to-emerald-800 text-white p-8 sm:p-12 rounded-3xl shadow-xl relative overflow-hidden">
                <div class="absolute right-0 top-0 w-80 h-80 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10 space-y-4 max-w-4xl">
                    <span class="inline-block bg-amber-400/20 text-amber-300 border border-amber-400/40 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Visi Program Studi 2030</span>
                    <h2 class="font-poppins font-extrabold text-2xl sm:text-4xl text-white leading-tight">
                        "{{ $visi }}"
                    </h2>
                </div>
            </div>

            <!-- Misi List -->
            <div class="space-y-6">
                <div class="text-center max-w-2xl mx-auto">
                    <span class="text-xs font-bold text-brand-green uppercase tracking-widest bg-brand-green/10 px-3.5 py-1 rounded-full">Komitmen Kami</span>
                    <h3 class="font-poppins font-bold text-2xl sm:text-3xl text-slate-900 mt-2">Misi Program Studi</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-4">
                    <div class="bg-brand-lightbg p-8 rounded-2xl border border-slate-200/80 shadow-sm hover:border-brand-green transition-all space-y-4">
                        <div class="w-12 h-12 bg-brand-green text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-sm">01</div>
                        <h4 class="font-poppins font-bold text-lg text-slate-900">Pendidikan & Pengajaran</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">Menyelenggarakan pendidikan berkualitas tinggi berbasis Outcome-Based Education (OBE) dalam bidang Enterprise Systems dan Data Analytics.</p>
                    </div>

                    <div class="bg-brand-lightbg p-8 rounded-2xl border border-slate-200/80 shadow-sm hover:border-brand-green transition-all space-y-4">
                        <div class="w-12 h-12 bg-brand-red text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-sm">02</div>
                        <h4 class="font-poppins font-bold text-lg text-slate-900">Riset & Inovasi Digital</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">Melakukan penelitian terapan dan publikasi ilmiah berkelas nasional-internasional yang memberikan kontribusi nyata bagi masyarakat.</p>
                    </div>

                    <div class="bg-brand-lightbg p-8 rounded-2xl border border-slate-200/80 shadow-sm hover:border-brand-green transition-all space-y-4">
                        <div class="w-12 h-12 bg-amber-500 text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-sm">03</div>
                        <h4 class="font-poppins font-bold text-lg text-slate-900">Pengabdian & Kemitraan</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">Menerapkan teknologi informasi untuk pemberdayaan UMKM, industri nasional, serta instansi pemerintah berbasis nilai kebangsaan.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
