@props(['settings', 'mitras'])

<section class="py-20 bg-slate-100 border-t border-b border-slate-200 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-800">
            {{ $settings->mitra_heading ?? 'Dipercaya oleh berbagai perusahaan dan institusi pendidikan' }}
        </h2>
    </div>

    <!-- Marquee Carousel Container -->
    <div class="relative w-full overflow-hidden [mask-image:linear-gradient(to_right,transparent,white_20%,white_80%,transparent)]">
        <div class="flex gap-8 w-max animate-marquee hover:[animation-play-state:paused]">
            <!-- Render original logos -->
            @foreach($mitras as $mitra)
                <div class="flex-shrink-0 flex items-center justify-center h-20 px-6 py-3 bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                    @if($mitra->url)
                        <a href="{{ $mitra->url }}" target="_blank" rel="noopener noreferrer" title="{{ $mitra->name }}">
                            <img src="{{ $mitra->logo }}" alt="{{ $mitra->name }}" class="h-10 w-auto object-contain max-w-[160px] grayscale hover:grayscale-0 transition-all">
                        </a>
                    @else
                        <img src="{{ $mitra->logo }}" alt="{{ $mitra->name }}" class="h-10 w-auto object-contain max-w-[160px] grayscale hover:grayscale-0 transition-all">
                    @endif
                </div>
            @endforeach

            <!-- Duplicate for infinite seamless loop -->
            @foreach($mitras as $mitra)
                <div class="flex-shrink-0 flex items-center justify-center h-20 px-6 py-3 bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow" aria-hidden="true">
                    @if($mitra->url)
                        <a href="{{ $mitra->url }}" target="_blank" rel="noopener noreferrer" title="{{ $mitra->name }}">
                            <img src="{{ $mitra->logo }}" alt="{{ $mitra->name }}" class="h-10 w-auto object-contain max-w-[160px] grayscale hover:grayscale-0 transition-all">
                        </a>
                    @else
                        <img src="{{ $mitra->logo }}" alt="{{ $mitra->name }}" class="h-10 w-auto object-contain max-w-[160px] grayscale hover:grayscale-0 transition-all">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    @keyframes marquee {
        0% { transform: translateX(0%); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 25s linear infinite;
    }
</style>

