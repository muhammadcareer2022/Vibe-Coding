<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->hero_title ?? 'LSP TIK Global' }} - {{ $settings->hero_subtitle ?? 'Berlisensi BNSP' }}</title>
    <meta name="description" content="{{ $settings->footer_description ?? 'Lembaga Sertifikasi Profesi bidang Teknologi Informasi & Komunikasi berlisensi BNSP' }}">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased text-slate-800 bg-white selection:bg-blue-600 selection:text-white">

    <!-- Top Navbar -->
    <header class="sticky top-0 z-50 bg-slate-900/90 backdrop-blur-md border-b border-slate-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center font-black text-white text-lg shadow-md shadow-blue-500/30">
                    LSP
                </div>
                <div>
                    <span class="text-white font-extrabold text-lg tracking-tight block leading-none">LSP TIK GLOBAL</span>
                    <span class="text-[10px] text-blue-400 font-semibold tracking-wider">BERLISENSI BNSP</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-300">
                <a href="/" class="text-white hover:text-blue-400 transition-colors">Beranda</a>
                <a href="#profil" class="hover:text-blue-400 transition-colors">Profil</a>
                <a href="#skema" class="hover:text-blue-400 transition-colors">Skema</a>
                <a href="#tuk" class="hover:text-blue-400 transition-colors">TUK</a>
                <a href="#lisensi" class="hover:text-blue-400 transition-colors">Lisensi</a>
                <a href="#kontak" class="hover:text-blue-400 transition-colors">Kontak</a>
            </nav>

            <!-- Admin Panel Button -->
            <div class="flex items-center gap-3">
                <a href="/admin" class="text-xs font-semibold px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white transition-all shadow-sm flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    <span>Admin Panel</span>
                </a>
            </div>
        </div>
    </header>

    <main>
        <!-- 1. Hero Section -->
        <x-hero-section :settings="$settings" />

        <!-- 2. Video Section -->
        <x-video-section :settings="$settings" />

        <!-- 3. Benefit Section -->
        <x-benefit-section :settings="$settings" />

        <!-- 4. Mitra Section (Logos Carousel) -->
        <x-mitra-section :settings="$settings" :mitras="$mitras" />
    </main>

    <!-- 5. Footer -->
    <x-footer :settings="$settings" />

</body>
</html>

