<header x-data="{ mobileOpen: false, openDropdown: null }" class="sticky top-0 z-50 backdrop-blur-md bg-white/95 shadow-md border-b border-slate-200/80">
    <!-- Topbar Info (Rich Gradient Ambient) -->
    <div class="bg-gradient-to-r from-brand-darkgreen via-emerald-950 to-slate-900 text-white text-xs py-2 px-4 sm:px-8 shadow-inner">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center space-x-6 text-emerald-100">
                <span class="flex items-center"><svg class="w-3.5 h-3.5 mr-1.5 text-amber-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> si@ukri.ac.id</span>
                <span class="hidden md:flex items-center"><svg class="w-3.5 h-3.5 mr-1.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg> (022) 7315175</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="bg-gradient-to-r from-amber-500/20 to-yellow-500/20 text-amber-300 border border-amber-400/40 px-3 py-0.5 rounded-full font-bold text-[10px] shadow-sm">
                    AKREDITASI "A" BAN-PT
                </span>
                <a href="https://pmb.ukri.ac.id/" target="_blank" rel="noopener noreferrer" class="text-amber-300 hover:text-white transition-colors font-semibold flex items-center">
                    PMB SI UKRI <span class="ml-1 text-brand-red font-bold">&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo / Brand -->
            <a href="/" class="flex items-center space-x-3 group py-2">
                <img src="{{ asset('images/logo-si-ukri.png') }}" alt="Logo Sistem Informasi UKRI" class="h-10 sm:h-12 w-auto object-contain transition-transform transform group-hover:scale-105 filter drop-shadow-sm">
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden lg:flex items-center space-x-1 font-inter text-sm font-semibold">
                <a href="/" class="px-3.5 py-2 rounded-xl text-slate-700 hover:text-brand-green hover:bg-emerald-50/80 transition-all">Beranda</a>

                <!-- Dropdown: Tentang Kami -->
                <div class="relative" @mouseenter="openDropdown = 'tentang'" @mouseleave="openDropdown = null">
                    <button class="px-3.5 py-2 rounded-xl text-slate-700 hover:text-brand-green hover:bg-emerald-50/80 flex items-center space-x-1 transition-all">
                        <span>Tentang Kami</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openDropdown === 'tentang'" x-transition class="absolute left-0 mt-1 w-60 bg-white border border-slate-200/90 rounded-2xl shadow-2xl py-2 z-50 backdrop-blur-lg">
                        <a href="/tentang-kami/sejarah" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Sejarah SI UKRI</a>
                        <a href="/tentang-kami/visi-misi" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Visi & Misi</a>
                        <a href="/tentang-kami/akreditasi" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Akreditasi BAN-PT</a>
                        <a href="/tentang-kami/dosen-staf" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Dosen & Staf Pengajar</a>
                        <a href="/tentang-kami/kerja-sama" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Kemitraan & Kolaborasi</a>
                    </div>
                </div>

                <!-- Dropdown: Akademik -->
                <div class="relative" @mouseenter="openDropdown = 'akademik'" @mouseleave="openDropdown = null">
                    <button class="px-3.5 py-2 rounded-xl text-slate-700 hover:text-brand-green hover:bg-emerald-50/80 flex items-center space-x-1 transition-all">
                        <span>Akademik</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openDropdown === 'akademik'" x-transition class="absolute left-0 mt-1 w-60 bg-white border border-slate-200/90 rounded-2xl shadow-2xl py-2 z-50 backdrop-blur-lg">
                        <a href="/akademik/struktur-kurikulum" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Struktur Kurikulum</a>
                        <a href="/akademik/kelompok-keahlian" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Kelompok Keahlian (KBK)</a>
                        <a href="/akademik/mata-kuliah" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Daftar Mata Kuliah</a>
                        <a href="/akademik/kalender" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Kalender Akademik</a>
                    </div>
                </div>

                <!-- Dropdown: Kemahasiswaan -->
                <div class="relative" @mouseenter="openDropdown = 'kemahasiswaan'" @mouseleave="openDropdown = null">
                    <button class="px-3.5 py-2 rounded-xl text-slate-700 hover:text-brand-green hover:bg-emerald-50/80 flex items-center space-x-1 transition-all">
                        <span>Kemahasiswaan</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openDropdown === 'kemahasiswaan'" x-transition class="absolute left-0 mt-1 w-60 bg-white border border-slate-200/90 rounded-2xl shadow-2xl py-2 z-50 backdrop-blur-lg">
                        <a href="/kemahasiswaan/prestasi" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Galeri Prestasi</a>
                        <a href="/kemahasiswaan/hima" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Himpunan Mahasiswa (HIMASI)</a>
                        <a href="/kemahasiswaan/alumni" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-brand-green font-medium transition-colors">Testimoni & Tracer Alumni</a>
                    </div>
                </div>

                <!-- Berita -->
                <a href="/berita" class="px-3.5 py-2 rounded-xl text-slate-700 hover:text-brand-green hover:bg-emerald-50/80 transition-all">Berita</a>

                <!-- Kontak -->
                <a href="/kontak" class="px-3.5 py-2 rounded-xl text-slate-700 hover:text-brand-green hover:bg-emerald-50/80 transition-all">Kontak</a>
            </nav>

            <!-- CTA Button (PMB Direct Link to https://pmb.ukri.ac.id/) -->
            <div class="hidden lg:flex items-center space-x-3">
                <a href="https://pmb.ukri.ac.id/" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-r from-brand-red via-rose-600 to-red-600 hover:from-red-600 hover:to-brand-red text-white font-bold text-sm px-6 py-2.5 rounded-xl shadow-lg hover:shadow-red-500/30 transition-all transform hover:-translate-y-0.5">
                    PMB 2026/2027
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="lg:hidden flex items-center">
                <button @click="mobileOpen = !mobileOpen" class="p-2 rounded-xl text-slate-700 hover:text-brand-green hover:bg-slate-100 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div x-show="mobileOpen" x-transition class="lg:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-6 space-y-3 font-inter text-sm shadow-2xl">
        <a href="/" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-brand-green font-medium">Beranda</a>

        <div class="space-y-1">
            <span class="block px-3 py-1 text-xs font-bold text-brand-green uppercase tracking-wider">Tentang Kami</span>
            <a href="/tentang-kami/sejarah" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Sejarah SI UKRI</a>
            <a href="/tentang-kami/visi-misi" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Visi & Misi</a>
            <a href="/tentang-kami/akreditasi" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Akreditasi BAN-PT</a>
            <a href="/tentang-kami/dosen-staf" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Dosen & Staf Pengajar</a>
            <a href="/tentang-kami/kerja-sama" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Kemitraan & Kolaborasi</a>
        </div>

        <div class="space-y-1">
            <span class="block px-3 py-1 text-xs font-bold text-brand-green uppercase tracking-wider">Akademik</span>
            <a href="/akademik/struktur-kurikulum" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Struktur Kurikulum</a>
            <a href="/akademik/kelompok-keahlian" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Kelompok Keahlian (KBK)</a>
            <a href="/akademik/mata-kuliah" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Daftar Mata Kuliah</a>
            <a href="/akademik/kalender" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Kalender Akademik</a>
        </div>

        <div class="space-y-1">
            <span class="block px-3 py-1 text-xs font-bold text-brand-green uppercase tracking-wider">Kemahasiswaan</span>
            <a href="/kemahasiswaan/prestasi" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Galeri Prestasi</a>
            <a href="/kemahasiswaan/hima" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Himpunan Mahasiswa (HIMASI)</a>
            <a href="/kemahasiswaan/alumni" class="block pl-6 pr-3 py-1.5 text-slate-600 hover:text-brand-green">Testimoni & Tracer Alumni</a>
        </div>

        <a href="/berita" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-brand-green font-medium">Berita</a>
        <a href="/kontak" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-brand-green font-medium">Kontak</a>

        <div class="pt-2">
            <a href="https://pmb.ukri.ac.id/" target="_blank" rel="noopener noreferrer" class="block w-full bg-gradient-to-r from-brand-red to-rose-600 text-white text-center font-bold py-3 rounded-xl shadow-md">
                PMB 2026/2027
            </a>
        </div>
    </div>
</header>
