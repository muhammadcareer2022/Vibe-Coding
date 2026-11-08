@props(['settings'])

<footer class="bg-slate-900 text-slate-300 pt-16 pb-12 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 mb-12">
            <!-- Kolom 1: Profil LSP & Lisensi -->
            <div class="lg:col-span-5 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center font-black text-white text-lg">
                        LSP
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg leading-tight">LSP TIK GLOBAL</h3>
                        <p class="text-xs text-blue-400 font-medium tracking-wide">LEMBAGA SERTIFIKASI PROFESI</p>
                    </div>
                </div>

                <p class="text-slate-400 text-sm leading-relaxed pr-6">
                    {{ $settings->footer_description ?? 'LSP TIK Global – Lembaga Sertifikasi Profesi bidang Teknologi Informasi & Komunikasi berlisensi BNSP, siap mencetak SDM TIK unggul dan kompeten.' }}
                </p>

                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-800 border border-slate-700 text-xs font-semibold text-emerald-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $settings->footer_license ?? 'Lisensi BNSP: BNSP-LSP-2150-ID' }}</span>
                </div>
            </div>

            <!-- Kolom 2: Navigasi Menu -->
            <div class="lg:col-span-3 space-y-4">
                <h4 class="text-white font-semibold text-base">Menu Navigasi</h4>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    <li><a href="/" class="hover:text-blue-400 transition-colors">Beranda</a></li>
                    <li><a href="#profil" class="hover:text-blue-400 transition-colors">Profil</a></li>
                    <li><a href="#skema" class="hover:text-blue-400 transition-colors">Skema Sertifikasi</a></li>
                    <li><a href="#tuk" class="hover:text-blue-400 transition-colors">Tempat Uji Kompetensi</a></li>
                    <li><a href="#lisensi" class="hover:text-blue-400 transition-colors">Lisensi BNSP</a></li>
                    <li><a href="#kontak" class="hover:text-blue-400 transition-colors">Kontak Kami</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Hubungi Kami -->
            <div class="lg:col-span-4 space-y-4">
                <h4 class="text-white font-semibold text-base">Hubungi Kami</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>{{ $settings->footer_phone ?? '021-27651353 / +6285195533360' }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ $settings->footer_email ?? 'info@lspglobal.id' }}" class="hover:text-blue-400 transition-colors">
                            {{ $settings->footer_email ?? 'info@lspglobal.id' }}
                        </a>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="leading-relaxed">{{ $settings->footer_address ?? 'Jl. Lebak Bulus Raya Komplek Ruko Victory 88 No. 88 B Cilandak Jakarta Selatan' }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="pt-8 mt-8 border-t border-slate-800 text-center text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>&copy; {{ date('Y') }} LSP TIK Global. Hak Cipta Dilindungi Undang-Undang.</p>
            <p>Terlisensi oleh Badan Nasional Sertifikasi Profesi (BNSP) RI</p>
        </div>
    </div>
</footer>

