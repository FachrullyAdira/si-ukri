@extends('layouts.app')

@section('title', 'Sejarah Program Studi - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Sejarah Program Studi" subtitle="Perjalanan rekam jejak pendirian dan transformasi Sistem Informasi UKRI dalam mencetak SDM unggul berwawasan kebangsaan." category="Tentang Kami" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Main Narrative -->
                <div class="lg:col-span-8 space-y-6 text-slate-700 font-inter leading-relaxed">
                    <h2 class="font-poppins font-bold text-2xl lg:text-3xl text-slate-900">Latar Belakang Pendirian</h2>

                    <p>
                        Program Studi Sistem Informasi Universitas Kebangsaan Republik Indonesia (UKRI) didirikan sebagai respon atas pesatnya transformasi digital dan kebutuhan nasional akan ahli teknologi informasi yang berwawasan kebangsaan, berintegritas, serta berdaya saing global.
                    </p>

                    <p>
                        Sejak awal berdirinya, Program Studi Sistem Informasi memadukan tiga pilar utama kurikulum: <strong class="text-slate-900">Teknologi Enterprise</strong>, <strong class="text-slate-900">Tata Kelola Data</strong>, dan <strong class="text-slate-900">Jiwa Entrepreneurship</strong>. Pendekatan integratif ini memastikan setiap lulusan memiliki kemampuan akademis teknis sekaligus pemahaman strategis bisnis.
                    </p>

                    <!-- Milestone Timeline -->
                    <div class="pt-8 space-y-8">
                        <h3 class="font-poppins font-bold text-xl text-slate-900">Milestone Perjalanan</h3>

                        <div class="relative border-l-2 border-brand-green/30 pl-6 ml-4 space-y-8">
                            @forelse($sejarahs as $s)
                                <div class="relative">
                                    <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-brand-green border-4 border-white shadow-sm"></span>
                                    <span class="text-xs font-semibold text-brand-green bg-brand-lightgreen px-3 py-1 rounded-full border border-brand-green/20">Tahun {{ $s->tahun }}</span>
                                    <h4 class="font-poppins font-bold text-lg text-slate-900 mt-2">{{ $s->judul_peristiwa }}</h4>
                                    <p class="text-sm text-slate-600 mt-1 leading-relaxed">{{ $s->deskripsi }}</p>
                                </div>
                            @empty
                                <div class="relative">
                                    <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-brand-green border-4 border-white shadow-sm"></span>
                                    <span class="text-xs font-semibold text-brand-green bg-brand-lightgreen px-3 py-1 rounded-full border border-brand-green/20">Tahun 2017</span>
                                    <h4 class="font-poppins font-bold text-lg text-slate-900 mt-2">Izin Operasional & Pendirian</h4>
                                    <p class="text-sm text-slate-600 mt-1">Resmi memperoleh izin penyelenggaraan Kementerian Pendidikan dan Kebudayaan dengan fokus awal pada Enterprise Systems.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar Summary Card -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-brand-lightbg p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="font-poppins font-bold text-lg text-slate-900 border-b border-slate-200/80 pb-3">Ringkasan Prodi</h3>
                        <dl class="space-y-3 text-sm">
                            <div class="flex justify-between py-1 border-b border-slate-200/60">
                                <dt class="text-slate-500">Tahun Berdiri</dt>
                                <dd class="font-semibold text-slate-900">2017</dd>
                            </div>
                            <div class="flex justify-between py-1 border-b border-slate-200/60">
                                <dt class="text-slate-500">Akreditasi</dt>
                                <dd class="font-semibold text-brand-green bg-brand-green/10 px-2 py-0.5 rounded">A / Unggul</dd>
                            </div>
                            <div class="flex justify-between py-1 border-b border-slate-200/60">
                                <dt class="text-slate-500">Gelar Lulusan</dt>
                                <dd class="font-semibold text-slate-900">S.Kom.</dd>
                            </div>
                            <div class="flex justify-between py-1 border-b border-slate-200/60">
                                <dt class="text-slate-500">Total SKS</dt>
                                <dd class="font-semibold text-slate-900">144 SKS</dd>
                            </div>
                        </dl>
                        <a href="https://pmb.ukri.ac.id/" target="_blank" rel="noopener noreferrer" class="block w-full bg-gradient-to-r from-brand-red to-rose-600 hover:from-red-600 hover:to-brand-red text-white text-center font-poppins font-bold py-3 rounded-xl shadow-md transition-all text-sm">
                            Pendaftaran PMB Online &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
