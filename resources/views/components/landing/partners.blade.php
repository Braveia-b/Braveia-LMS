<section class="section-padding border-y border-white/5 overflow-hidden" aria-label="Trusted by">
    <p class="text-center text-sm font-medium text-slate-500 uppercase tracking-widest mb-10" data-aos="fade-up">Trusted by industry leaders</p>
    <div class="relative">
        <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r from-surface-900 to-transparent z-10"></div>
        <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l from-surface-900 to-transparent z-10"></div>
        <div class="flex overflow-hidden">
            <div class="marquee-track flex shrink-0 items-center gap-16 px-8">
                @foreach(array_merge($partners, $partners) as $partner)
                    <span class="flex shrink-0 items-center gap-3 text-2xl font-display font-bold text-slate-600 grayscale opacity-60 hover:opacity-100 hover:grayscale-0 transition-all duration-500">
                        @include('components.landing.partials.brand-icon', ['brand' => $partner])
                        {{ $partner }}
                    </span>
                @endforeach
            </div>
            <div class="marquee-track flex shrink-0 items-center gap-16 px-8" aria-hidden="true">
                @foreach(array_merge($partners, $partners) as $partner)
                    <span class="flex shrink-0 items-center gap-3 text-2xl font-display font-bold text-slate-600 grayscale opacity-60">
                        @include('components.landing.partials.brand-icon', ['brand' => $partner])
                        {{ $partner }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</section>
