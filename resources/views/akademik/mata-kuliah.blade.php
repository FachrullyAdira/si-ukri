@extends('layouts.app')

@section('title', 'Daftar Mata Kuliah - Sistem Informasi UKRI')

@section('content')
    <x-breadcrumb title="Daftar Mata Kuliah" subtitle="Katalog lengkap mata kuliah wajib dan pilihan Program Studi Sistem Informasi UKRI." category="Akademik" />

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-x-auto bg-white rounded-2xl border border-slate-200 shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-brand-navy text-white font-poppins text-xs uppercase tracking-wider">
                            <th class="p-4">Kode MK</th>
                            <th class="p-4">Nama Mata Kuliah</th>
                            <th class="p-4 text-center">SKS</th>
                            <th class="p-4 text-center">Semester</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Prasyarat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 font-inter text-sm text-slate-700">
                        <tr class="hover:bg-brand-lightbg">
                            <td class="p-4 font-mono font-semibold text-brand-navy">SI101</td>
                            <td class="p-4 font-medium">Pengantar Sistem Informasi</td>
                            <td class="p-4 text-center font-bold">3</td>
                            <td class="p-4 text-center">1</td>
                            <td class="p-4"><span class="bg-blue-100 text-blue-800 text-xs px-2.5 py-0.5 rounded-full font-medium">Wajib</span></td>
                            <td class="p-4 text-slate-400">-</td>
                        </tr>
                        <tr class="hover:bg-brand-lightbg">
                            <td class="p-4 font-mono font-semibold text-brand-navy">SI102</td>
                            <td class="p-4 font-medium">Algoritma & Pemrograman I</td>
                            <td class="p-4 text-center font-bold">4</td>
                            <td class="p-4 text-center">1</td>
                            <td class="p-4"><span class="bg-blue-100 text-blue-800 text-xs px-2.5 py-0.5 rounded-full font-medium">Wajib</span></td>
                            <td class="p-4 text-slate-400">-</td>
                        </tr>
                        <tr class="hover:bg-brand-lightbg">
                            <td class="p-4 font-mono font-semibold text-brand-navy">SI201</td>
                            <td class="p-4 font-medium">Sistem Basis Data Enterprise</td>
                            <td class="p-4 text-center font-bold">4</td>
                            <td class="p-4 text-center">2</td>
                            <td class="p-4"><span class="bg-blue-100 text-blue-800 text-xs px-2.5 py-0.5 rounded-full font-medium">Wajib</span></td>
                            <td class="p-4 text-slate-600">SI101</td>
                        </tr>
                        <tr class="hover:bg-brand-lightbg">
                            <td class="p-4 font-mono font-semibold text-brand-navy">SI305</td>
                            <td class="p-4 font-medium">Enterprise Resource Planning (ERP)</td>
                            <td class="p-4 text-center font-bold">3</td>
                            <td class="p-4 text-center">5</td>
                            <td class="p-4"><span class="bg-brand-gold/20 text-brand-gold text-xs px-2.5 py-0.5 rounded-full font-medium">Pilihan KBK</span></td>
                            <td class="p-4 text-slate-600">SI201</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
