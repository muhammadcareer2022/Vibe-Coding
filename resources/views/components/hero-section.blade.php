@props(['settings'])

<section class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-indigo-900 to-slate-900 text-white py-24 sm:py-32">
    <!-- Background glowing accents -->
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[40rem] h-[40rem] bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 right-10 w-[30rem] h-[30rem] bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-400/30 text-blue-300 text-sm font-medium mb-8">
            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <span>{{ $settings->hero_subtitle ?? 'Bidang TIK Berlisensi BNSP' }}</span>
        </div>

        <!-- Hero Title -->
        <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white mb-6 leading-tight">
            {{ $settings->hero_title ?? 'Lembaga Sertifikasi Profesi' }}
            <span class="block bg-gradient-to-r from-blue-400 to-indigo-300 bg-clip-text text-transparent">
                {{ $settings->hero_subtitle ?? 'Bidang TIK Berlisensi BNSP' }}
            </span>
        </h1>

        <p class="max-w-2xl mx-auto text-lg sm:text-xl text-slate-300 mb-10 leading-relaxed">
            Tingkatkan kredibilitas profesional Anda dengan sertifikasi kompetensi berstandar nasional dan internasional.
        </p>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto">
            <form action="#skema" method="GET" class="relative flex items-center">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="q"
                        placeholder="{{ $settings->hero_search_placeholder ?? 'Cari nama skema...' }}"
                        class="w-full pl-12 pr-32 py-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/15 transition-all text-base shadow-xl"
                    />
                    <button
                        type="submit"
                        class="absolute right-2 top-2 bottom-2 px-6 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-full transition-all flex items-center gap-1.5 shadow-md">
                        <span>Cari</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

