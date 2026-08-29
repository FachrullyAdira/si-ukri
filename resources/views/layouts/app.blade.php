<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi UKRI - Universitas Kebangsaan Republik Indonesia')</title>

    <!-- Google Fonts: Poppins & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            green: '#0A6B39',       // Official Logo Emerald Green ("INFORMASI" & "S")
                            darkgreen: '#054F2A',   // Deep Forest Green
                            lightgreen: '#E8F5E9',  // Soft Mint Tint
                            red: '#EF3829',         // Official Logo Coral Red ("SISTEM")
                            darkred: '#D32F2F',     // Dark Red Hover
                            gold: '#D97706',        // Academic Gold
                            amber: '#F59E0B',
                            navy: '#0F172A',        // Slate Dark Navy
                            darknavy: '#020617',    // Ultra Slate Dark
                            lightbg: '#F8FAFC',     // Bright Fresh Slate Light BG
                            surface: '#FFFFFF',
                            slate: '#1E293B',
                            muted: '#64748B'
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
    <!-- Alpine JS for mobile menu & interactive toggles -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
            color: #1E293B;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-text-brand {
            background: linear-gradient(135deg, #0A6B39 0%, #EF3829 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gradient-border-top {
            position: relative;
        }
        .gradient-border-top::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #EF3829 0%, #F59E0B 50%, #0A6B39 100%);
            border-top-left-radius: inherit;
            border-top-right-radius: inherit;
        }
    </style>
    @stack('styles')
</head>
<body class="flex flex-col min-h-screen bg-brand-lightbg text-brand-slate antialiased selection:bg-brand-green selection:text-white">

    <!-- Top Accent Line -->
    <div class="h-1.5 w-full bg-gradient-to-r from-brand-red via-brand-amber to-brand-green"></div>

    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Component -->
    <x-footer />

    @stack('scripts')
</body>
</html>
