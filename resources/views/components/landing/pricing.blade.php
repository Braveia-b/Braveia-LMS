<section id="pricing" class="section-padding relative" x-data="{ yearly: false }">
    <div class="container-narrow mx-auto">
        <x-ui.section-heading
            badge="Pricing"
            title='Simple, transparent <span class="text-gradient">pricing</span>'
            subtitle="Start free, scale as you grow. No hidden fees."
        />

        <div class="mt-10 flex items-center justify-center gap-4" data-aos="fade-up">
            <span class="text-sm" :class="!yearly ? 'text-white' : 'text-slate-500'">Monthly</span>
            <button
                @click="yearly = !yearly"
                class="relative h-8 w-14 rounded-full bg-surface-700 border border-white/10 transition-colors"
                role="switch"
                :aria-checked="yearly"
            >
                <span class="absolute top-1 left-1 h-6 w-6 rounded-full bg-gradient-to-r from-primary-600 to-accent-gold transition-transform duration-300" :class="yearly ? 'translate-x-6' : ''"></span>
            </button>
            <span class="text-sm" :class="yearly ? 'text-white' : 'text-slate-500'">Yearly</span>
            <x-ui.badge variant="gold">Save 20%</x-ui.badge>
        </div>

        <div class="mt-12 grid md:grid-cols-3 gap-6 lg:gap-8">
            @foreach($pricing as $plan)
                <article
                    class="relative rounded-2xl p-8 transition-all duration-500 hover:-translate-y-1 reveal-up {{ $plan['popular'] ? 'border-2 border-primary-500/50 bg-gradient-to-b from-primary-600/10 to-surface-800/80 shadow-2xl shadow-primary-600/20 scale-[1.02]' : 'glass' }}"
                    data-aos="fade-up"
                    data-aos-delay="{{ $loop->index * 100 }}"
                >
                    @if($plan['popular'])
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-gradient-to-r from-primary-600 to-accent-gold px-4 py-1 text-xs font-semibold text-surface-900 shadow-lg shadow-primary-500/40">Most Popular</span>
                    @endif
                    <h3 class="font-display text-xl font-bold text-white">{{ $plan['name'] }}</h3>
                    <p class="mt-2 text-sm text-slate-500">{{ $plan['description'] }}</p>
                    <div class="mt-6 flex items-baseline gap-1">
                        <span class="font-display text-4xl font-bold text-white">$</span>
                        <span class="font-display text-5xl font-bold text-white" x-text="yearly ? {{ $plan['yearly'] }} : {{ $plan['monthly'] }}">{{ $plan['monthly'] }}</span>
                        <span class="text-slate-500">/mo</span>
                    </div>
                    <ul class="mt-8 space-y-3">
                        @foreach($plan['features'] as $feature)
                            <li class="flex items-center gap-3 text-sm text-slate-300">
                                <svg class="h-5 w-5 shrink-0 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                    @if($plan['popular'])
                        <x-ui.button href="#contact" variant="primary" class="mt-8 w-full justify-center">Get Started</x-ui.button>
                    @else
                        <x-ui.button href="#contact" variant="outline" class="mt-8 w-full justify-center">Choose Plan</x-ui.button>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
