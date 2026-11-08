@props(['settings'])

<section class="py-20 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Kolom Pertama: Video Player -->
            <div class="lg:col-span-7">
                <div class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl bg-black border border-slate-200 group">
                    @if($settings->video_url)
                        <iframe
                            src="{{ $settings->video_url }}"
                            title="Video Profil LSP TIK Global"
                            class="w-full h-full border-0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    @else
                        <div class="flex items-center justify-center w-full h-full text-slate-400">
                            <span>Video belum diatur</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kolom Kedua: Teks Penjelasan -->
            <div class="lg:col-span-5 space-y-6">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-blue-100 text-blue-800 text-xs font-semibold uppercase tracking-wider">
                    Tentang Sertifikasi
                </div>

                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 leading-tight">
                    {{ $settings->video_heading ?? 'Buktikan Kompetensimu dengan Sertifikasi LSP TIK Global!' }}
                </h2>

                <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                    {{ $settings->video_description ?? 'Sertifikasi kompetensi kerja adalah proses pemberian sertifikat kompetensi yang dilakukan secara sistematis dan obyektif melalui uji kompetensi yang mengacu pada standar kompetensi kerja nasional, standar internasional, dan/atau standar khusus.' }}
                </p>

                <div class="pt-2 flex flex-wrap gap-4">
                    <a href="#skema" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition-colors shadow-sm">
                        Lihat Daftar Skema
                    </a>
                    <a href="https://wa.me/6285195533360" target="_blank" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-white hover:bg-slate-100 text-slate-800 font-semibold border border-slate-300 transition-colors">
                        Konsultasi Gratis
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

