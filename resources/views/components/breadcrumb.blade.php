@props([
    'title' => 'Halaman',
    'subtitle' => null,
    'category' => null,
])

<div class="relative bg-gradient-to-r from-brand-darkgreen via-emerald-900 to-slate-950 text-white py-12 lg:py-16 overflow-hidden border-b-2 border-brand-green/40 shadow-xl">
    <!-- Ambient Glowing Orbs -->
    <div class="absolute -right-16 -top-16 w-96 h-96 bg-gradient-to-tr from-brand-green via-emerald-400 to-teal-300 rounded-full blur-3xl opacity-20 animate-pulse pointer-events-none"></div>
    <div class="absolute left-1/3 -bottom-20 w-80 h-80 bg-gradient-to-tr from-brand-red via-rose-500 to-amber-400 rounded-full blur-3xl opacity-15 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
        <!-- Breadcrumb Links -->
        <nav class="flex items-center space-x-2 text-xs font-inter text-emerald-100/90">
            <a href="/" class="hover:text-amber-300 transition-colors font-medium">Beranda</a>
            <span class="text-emerald-400">&rsaquo;</span>
            @if($category)
                <span class="text-emerald-200">{{ $category }}</span>
                <span class="text-emerald-400">&rsaquo;</span>
            @endif
            <span class="text-amber-300 font-bold truncate max-w-xs sm:max-w-md bg-amber-400/10 border border-amber-400/30 px-2.5 py-0.5 rounded-full">{{ $title }}</span>
        </nav>

        <!-- Title & Subtitle -->
        <div class="space-y-2">
            <h1 class="font-poppins font-extrabold text-2xl sm:text-4xl lg:text-5xl text-white tracking-tight leading-tight">
                {{ $title }}
            </h1>
            @if($subtitle)
                <p class="font-inter text-emerald-100/90 text-sm sm:text-base max-w-3xl leading-relaxed">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
    </div>
</div>
