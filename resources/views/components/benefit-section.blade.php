@props(['settings'])

@php
    $items = $settings->benefit_items ?? [];
@endphp

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider block mb-2">Keunggulan Kami</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight mb-4">
                {{ $settings->benefit_heading ?? 'Mengapa Memilih Sertifikasi di LSP TIK Global?' }}
            </h2>
            <p class="text-lg text-slate-600 leading-relaxed">
                {{ $settings->benefit_description ?? 'Bukan sekadar dokumen, ini adalah investasi terbaik untuk memvalidasi keahlian Anda, diakui secara resmi oleh negara, dan memenangkan persaingan di industri kerja.' }}
            </p>
        </div>

        <!-- 3 Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            @foreach($items as $index => $item)
                <div class="group relative bg-slate-50 hover:bg-white rounded-2xl p-8 border border-slate-200 hover:border-blue-500 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <!-- Icon Circle -->
                        <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center mb-6 shadow-md shadow-blue-500/20 group-hover:scale-110 transition-transform">
                            @if(($item['icon'] ?? '') === 'heroicon-o-check-badge' || $index === 0)
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            @elseif(($item['icon'] ?? '') === 'heroicon-o-document-text' || $index === 1)
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            @else
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">
                            {{ $item['title'] ?? '' }}
                        </h3>
                        <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                            {{ $item['description'] ?? '' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Closing Text -->
        @if($settings->benefit_closing)
            <div class="max-w-4xl mx-auto rounded-2xl bg-blue-50 border border-blue-200/60 p-6 sm:p-8 text-center">
                <p class="text-slate-800 text-base sm:text-lg font-medium leading-relaxed">
                    🌟 {{ $settings->benefit_closing }}
                </p>
            </div>
        @endif
    </div>
</section>

