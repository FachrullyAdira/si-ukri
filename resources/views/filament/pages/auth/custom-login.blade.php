@php
    use App\Models\PengaturanSitus;

    // Ambil daftar background yang diset oleh Super Admin
    $rawBackgrounds = PengaturanSitus::getValue('login_backgrounds', '[]');
    $backgroundList = json_decode($rawBackgrounds, true) ?: [];

    // Format seluruh URL gambar background
    $slides = [];
    if (!empty($backgroundList)) {
        foreach ($backgroundList as $bg) {
            $slides[] = str_starts_with($bg, 'http') ? $bg : asset('storage/' . $bg);
        }
    } else {
        $slides[] = asset('images/bg-login.png');
    }

    // Ambil preferensi gradasi, blur, dan kecepatan carousel dari pengaturan Super Admin
    $overlayType = PengaturanSitus::getValue('login_overlay', 'left_to_right');
    $blurIntensity = PengaturanSitus::getValue('login_blur', '0');
    $carouselSpeed = (int) PengaturanSitus::getValue('login_carousel_speed', '6000');

    // Gradasi lembut (soft) agar foto tetap terlihat jelas dan berkelas
    $gradientCss = match ($overlayType) {
        'left_to_right' => 'linear-gradient(to right, rgba(15, 23, 42, 0.52) 0%, rgba(10, 107, 57, 0.28) 50%, rgba(15, 23, 42, 0.18) 100%)',
        'diagonal' => 'linear-gradient(135deg, rgba(6, 78, 39, 0.42) 0%, rgba(15, 23, 42, 0.32) 100%)',
        'top_to_bottom' => 'linear-gradient(to bottom, rgba(15, 23, 42, 0.48) 0%, rgba(10, 107, 57, 0.25) 100%)',
        'soft_emerald' => 'linear-gradient(135deg, rgba(10, 107, 57, 0.32) 0%, rgba(15, 23, 42, 0.25) 100%)',
        'dark_clean' => 'rgba(15, 23, 42, 0.32)',
        default => 'linear-gradient(to right, rgba(15, 23, 42, 0.52) 0%, rgba(10, 107, 57, 0.28) 50%, rgba(15, 23, 42, 0.18) 100%)',
    };
@endphp

<div
    x-data="{
        slides: {{ json_encode($slides) }},
        currentSlide: 0,
        speed: {{ $carouselSpeed }},
        timer: null,
        init() {
            if (this.slides.length > 1) {
                this.timer = setInterval(() => {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                }, this.speed);
            }
        },
        goTo(index) {
            this.currentSlide = index;
            if (this.timer) clearInterval(this.timer);
            if (this.slides.length > 1) {
                this.timer = setInterval(() => {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                }, this.speed);
            }
        }
    }"
    class="login-wrapper"
>
    {{-- Tailwind CSS CDN for guaranteed utilities --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eefdf4',
                            100: '#d6fbe3',
                            500: '#10b981',
                            600: '#0A6B39',
                            700: '#07532B',
                            800: '#064223'
                        }
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        inter: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap');

        .login-wrapper {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            background-color: #0b1320;
        }

        .login-bg-carousel {
            position: absolute;
            inset: 0;
            overflow: hidden;
            z-index: 0;
        }

        .login-bg-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            opacity: 0;
            transform: scale(1.02);
            filter: brightness(0.94) contrast(0.98);
            transition: opacity 1.5s ease-in-out, transform 8s ease-out;
        }

        .login-bg-slide.active {
            opacity: 1;
            transform: scale(1);
        }

        .login-gradient-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
        }

        .login-card {
            width: 100%;
            max-width: 980px;
            background: #ffffff;
            border-radius: 28px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.45);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 10;
        }

        @media (min-width: 860px) {
            .login-card {
                flex-direction: row;
                align-items: stretch;
                min-height: 540px;
            }
        }

        .login-col-left {
            flex: 1 1 50%;
            padding: 2.75rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            background-color: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            overflow: hidden;
        }

        @media (min-width: 860px) {
            .login-col-left {
                border-bottom: none;
                border-right: 1px solid #f1f5f9;
            }
        }

        .login-col-right {
            flex: 1 1 50%;
            padding: 2.75rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #ffffff;
        }

        .login-input-group {
            display: flex;
            align-items: center;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            background: #ffffff;
            transition: border-color 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }

        .login-input-group:focus-within {
            border-color: #0A6B39 !important;
            box-shadow: 0 0 0 3px rgba(10, 107, 57, 0.15) !important;
        }

        .login-input-group input {
            width: 100%;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            background: transparent !important;
            padding: 0.75rem 0.875rem;
            font-size: 0.875rem;
            color: #0f172a;
        }

        .login-btn-primary {
            width: 100%;
            background-color: #0A6B39 !important;
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.875rem 1.5rem;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 10px 20px -5px rgba(10, 107, 57, 0.35);
            transition: all 0.2s ease;
        }

        .login-btn-primary:hover {
            background-color: #07532B !important;
            box-shadow: 0 12px 24px -5px rgba(10, 107, 57, 0.45);
            transform: translateY(-1px);
        }

        .login-btn-primary:active {
            transform: translateY(0);
        }
    </style>
    {{-- Background Carousel Slides --}}
    <div class="login-bg-carousel" style="filter: blur({{ (int)$blurIntensity }}px); transform: scale(1.04);">
        <template x-for="(slide, index) in slides" :key="'slide-' + index">
            <div
                class="login-bg-slide"
                :style="`background-image: url('${slide}');`"
                :class="{ 'active': currentSlide === index }"
            ></div>
        </template>
    </div>

    {{-- Gradient Overlay --}}
    <div class="login-gradient-overlay" style="background: {{ $gradientCss }};"></div>

    {{-- Floating Back to Homepage Button --}}
    <a href="{{ url('/') }}"
       style="position: absolute; top: 1.5rem; left: 1.5rem; z-index: 50; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.15rem; border-radius: 9999px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); color: #0f172a; font-size: 0.8rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15); transition: all 0.2s ease;"
       onmouseover="this.style.backgroundColor='#ffffff'; this.style.transform='translateX(-3px)'; this.style.color='#0A6B39'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.2)';"
       onmouseout="this.style.backgroundColor='rgba(255, 255, 255, 0.9)'; this.style.transform='translateX(0)'; this.style.color='#0f172a'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.15)';"
       title="Kembali ke Halaman Beranda Utama SI-UKRI"
    >
        <svg style="width: 1rem; height: 1rem; color: #0A6B39;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span>Kembali ke Beranda</span>
    </a>

    {{-- Main Container Card --}}
    <div class="login-card">

        {{-- Left Column: Branding & System Information --}}
        <div class="login-col-left">
            {{-- Ambient Decorative Glow --}}
            <div style="position: absolute; top: -4rem; right: -4rem; width: 16rem; height: 16rem; background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, rgba(204, 251, 241, 0.1) 60%, transparent 80%); border-radius: 9999px; pointer-events: none;"></div>

            {{-- Brand Header: Logo Kampus UKRI & Logo Prodi SI --}}
            <div class="relative z-10 flex items-center space-x-3.5">
                <img src="{{ asset('images/logo-kampus.png') }}" alt="Logo Kampus UKRI" style="height: 3.25rem; width: 3.25rem; object-fit: contain; flex-shrink: 0; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.08));">
                <div style="width: 1.5px; height: 2.25rem; background-color: #cbd5e1; border-radius: 9999px;"></div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo Prodi Sistem Informasi" style="height: 2.75rem; width: auto; max-width: 190px; object-fit: contain;">
            </div>

            {{-- Main Headline & Features --}}
            <div class="relative z-10 my-auto py-6">
                <h1 style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 2.15rem; line-height: 1.15; color: #0f172a; margin: 0 0 0.75rem 0;">
                    Sistem Informasi<br>
                    <span style="color: #0A6B39;">Kampus Terpadu.</span>
                </h1>
                <p style="color: #64748b; font-size: 0.875rem; line-height: 1.6; margin: 0;">
                    Platform layanan akademik, kemahasiswaan, dan Learning Management System (LMS) Universitas Kebangsaan Republik Indonesia, dirancang untuk efisiensi pendidikan tinggi modern.
                </p>
            </div>

            {{-- Footer Copyright --}}
            <div style="padding-top: 1rem; font-size: 0.75rem; color: #94a3b8;">
                © {{ date('Y') }} SI-UKRI Enterprise. All rights reserved.
            </div>
        </div>

        {{-- Right Column: Login Form --}}
        <div class="login-col-right">
            <div style="margin-bottom: 1.5rem;">
                <h2 style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.75rem; color: #0f172a; margin: 0 0 0.35rem 0;">Selamat Datang</h2>
                <p style="color: #64748b; font-size: 0.875rem; margin: 0; line-height: 1.5;">Masuk menggunakan kredensial NIP, NPM atau Email resmi UKRI Anda.</p>
            </div>

            <form wire:submit="authenticate" style="display: flex; flex-direction: column; gap: 1.25rem;">
                {{-- Error Message Display --}}
                @if ($errors->has('data.email') || $errors->has('data.password'))
                    <div style="padding: 0.75rem 1rem; border-radius: 12px; background-color: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; font-size: 0.8rem; display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 1rem; height: 1rem; flex-shrink: 0;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        <span>{{ $errors->first('data.email') ?: $errors->first('data.password') }}</span>
                    </div>
                @endif

                {{-- Field: NIP / NPM / Email --}}
                <div style="display: flex; flex-direction: column; gap: 0.35rem;">
                    <label style="font-size: 0.75rem; font-weight: 600; color: #334155;">
                        NIP / NPM / Email <span style="color: #ef4444;">*</span>
                    </label>
                    <div class="login-input-group">
                        <span style="padding-left: 0.875rem; color: #94a3b8; display: flex; align-items: center;">
                            <svg style="width: 1.15rem; height: 1.15rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        <input type="text"
                               wire:model="data.email"
                               placeholder="10000001 atau admin@ukri.ac.id"
                               required autofocus />
                    </div>
                </div>

                {{-- Field: Kata Sandi --}}
                <div style="display: flex; flex-direction: column; gap: 0.35rem;" x-data="{ show: false }">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <label style="font-size: 0.75rem; font-weight: 600; color: #334155;">
                            Kata Sandi <span style="color: #ef4444;">*</span>
                        </label>
                        <a href="#" style="font-size: 0.75rem; font-weight: 600; color: #0A6B39; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                            Lupa sandi?
                        </a>
                    </div>
                    <div class="login-input-group">
                        <span style="padding-left: 0.875rem; color: #94a3b8; display: flex; align-items: center;">
                            <svg style="width: 1.15rem; height: 1.15rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </span>
                        <input :type="show ? 'text' : 'password'"
                               wire:model="data.password"
                               placeholder="••••••••"
                               required />
                        <button type="button" @click="show = !show" style="padding-right: 0.875rem; color: #94a3b8; background: none; border: none; cursor: pointer; display: flex; align-items: center;">
                            <svg x-show="!show" style="width: 1.15rem; height: 1.15rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" x-cloak style="width: 1.15rem; height: 1.15rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Remember Me Checkbox --}}
                <div style="display: flex; align-items: center;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; user-select: none;">
                        <input type="checkbox"
                               wire:model="data.remember"
                               style="width: 1rem; height: 1rem; border-radius: 4px; border: 1px solid #cbd5e1; accent-color: #0A6B39; cursor: pointer;">
                        <span style="font-size: 0.8rem; color: #475569; font-weight: 500;">Ingat sesi saya pada perangkat ini</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div style="padding-top: 0.25rem;">
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="login-btn-primary">
                        <svg wire:loading.remove style="width: 1.1rem; height: 1.1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        <svg wire:loading style="width: 1.1rem; height: 1.1rem; animation: spin 1s linear infinite;" fill="none" viewBox="0 0 24 24"><circle style="opacity: 0.25;" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path style="opacity: 0.75;" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span>Masuk ke Sistem</span>
                    </button>
                </div>

                {{-- Kembali ke Beranda Utama --}}
                <div style="text-align: center; padding-top: 0.5rem; border-top: 1px solid #f1f5f9; margin-top: 0.25rem;">
                    <a href="{{ url('/') }}"
                       style="display: inline-flex; align-items: center; justify-content: center; gap: 0.375rem; color: #64748b; font-size: 0.8rem; font-weight: 500; text-decoration: none; transition: all 0.2s ease;"
                       onmouseover="this.style.color='#0A6B39';"
                       onmouseout="this.style.color='#64748b';"
                    >
                        <svg style="width: 0.95rem; height: 0.95rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Kembali ke Beranda Utama</span>
                    </a>
                </div>
            </form>
        </div>

    </div>

    {{-- Carousel Indicator Dots (Shows only when > 1 slide) --}}
    <template x-if="slides.length > 1">
        <div style="position: absolute; bottom: 1.5rem; right: 1.5rem; z-index: 20; display: flex; align-items: center; gap: 0.5rem; background: rgba(15, 23, 42, 0.55); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); padding: 0.5rem 0.875rem; border-radius: 9999px; border: 1px solid rgba(255, 255, 255, 0.15); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <template x-for="(slide, index) in slides" :key="'dot-' + index">
                <button
                    type="button"
                    @click="goTo(index)"
                    :style="currentSlide === index ? 'width: 1.5rem; background-color: #ffffff; opacity: 1;' : 'width: 0.5rem; background-color: rgba(255, 255, 255, 0.45);'"
                    style="height: 0.5rem; border-radius: 9999px; transition: all 0.3s ease; border: none; cursor: pointer; padding: 0;"
                    :title="`Slide ${index + 1}`"
                ></button>
            </template>
        </div>
    </template>
</div>
