@extends('layouts.app')

@section('title', 'Hubungi Kami & Pendaftaran PMB - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Hubungi Kami & Lokasi Kampus" subtitle="Informasi kontak Sekretariat Program Studi Sistem Informasi UKRI, pendaftaran PMB, serta lokasi kampus." category="Kontak" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                <!-- Contact Form -->
                <div class="lg:col-span-7 bg-brand-lightbg p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6">
                    <div>
                        <h2 class="font-poppins font-bold text-2xl text-slate-900">Kirim Pesan / Pertanyaan PMB</h2>
                        <p class="text-sm text-slate-600 mt-1">Tim Admisi & Sekretariat SI UKRI akan menjawab pertanyaan Anda dalam 1x24 jam kerja.</p>
                    </div>

                    @if(session('success'))
                        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="p-4 bg-red-100 border border-red-300 text-red-800 rounded-xl text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <div>&bull; {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('kontak.store') }}" method="POST" class="space-y-4 font-inter text-sm">
                        @csrf

                        <!-- Honeypot Spam Trap (hidden from human users) -->
                        <input type="text" name="website_hp" style="display:none;" tabindex="-1" autocomplete="off">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan nama Anda" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-green bg-white">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="contoh@email.com" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-green bg-white">
                            </div>
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-1">Subjek Pertanyaan</label>
                            <input type="text" name="subjek" value="{{ old('subjek') }}" required placeholder="Contoh: Informasi Pendaftaran PMB 2026/2027" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-green bg-white">
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-1">Pesan Anda</label>
                            <textarea name="pesan" rows="4" required placeholder="Tuliskan pesan lengkap di sini..." class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-green bg-white">{{ old('pesan') }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-brand-red hover:bg-brand-darkred text-white font-poppins font-semibold py-3.5 rounded-xl shadow-md transition-colors">
                            Kirim Pesan Sekarang &rarr;
                        </button>
                    </form>
                </div>

                <!-- Office Info & Map -->
                <div class="lg:col-span-5 space-y-8">
                    <div class="bg-gradient-to-br from-brand-green to-emerald-900 text-white p-8 rounded-3xl space-y-6 shadow-xl">
                        <h3 class="font-poppins font-bold text-xl text-amber-300">Sekretariat SI UKRI</h3>
                        <div class="space-y-4 text-sm font-inter text-emerald-100">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ $alamat }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>Telepon: {{ $telepon }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>Email: {{ $email }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Jam Layanan: Senin - Jumat (08.00 - 16.00 WIB)</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
