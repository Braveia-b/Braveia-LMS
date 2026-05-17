<section id="features" class="section-padding relative">
    <div class="container-narrow mx-auto">
        <x-ui.section-heading
            badge="Features"
            title='Everything you need to <span class="text-gradient">teach at scale</span>'
            subtitle="A complete learning ecosystem with AI-powered tools, built for modern educators and ambitious institutions."
        />

        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 auto-rows-fr">
            @foreach($features as $index => $feature)
                @php
                    $colSpan = match($feature['size']) {
                        'large' => 'md:col-span-2 md:row-span-2',
                        'medium' => 'md:col-span-2',
                        default => '',
                    };
                @endphp
                <article
                    class="glow-border group relative rounded-2xl glass p-6 transition-all duration-500 hover:bg-white/10 hover:-translate-y-1 {{ $colSpan }} reveal-up"
                    data-aos="fade-up"
                    data-aos-delay="{{ $index * 50 }}"
                >
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-primary-600/30 to-accent-indigo/30 text-primary-400 group-hover:shadow-lg group-hover:shadow-primary-600/20 transition-shadow">
                        @include('components.landing.partials.feature-icon', ['icon' => $feature['icon']])
                    </div>
                    <h3 class="font-display text-lg font-semibold text-white mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">{{ $feature['description'] }}</p>
                    @if($feature['size'] === 'large')
                        <div class="mt-6 rounded-xl border border-white/5 bg-surface-900/50 p-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="h-8 w-8 rounded-full bg-primary-500/30 animate-pulse"></div>
                                <div class="flex-1 space-y-1">
                                    <div class="h-2 w-3/4 rounded bg-white/10"></div>
                                    <div class="h-2 w-1/2 rounded bg-white/5"></div>
                                </div>
                            </div>
                            <p class="text-xs text-primary-400">AI: "Based on your progress, I recommend reviewing Module 3..."</p>
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
