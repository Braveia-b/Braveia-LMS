<section id="faq" class="section-padding relative">
    <div class="container-narrow mx-auto max-w-3xl">
        <x-ui.section-heading
            badge="FAQ"
            title='Frequently asked <span class="text-gradient">questions</span>'
            subtitle="Everything you need to know about BraveIA."
        />

        <div class="mt-12 space-y-3" x-data="{ open: null }">
            @foreach($faqs as $index => $faq)
                <div
                    class="rounded-2xl glass overflow-hidden transition-all duration-300"
                    :class="open === {{ $index }} ? 'border-primary-500/30 bg-white/10' : ''"
                    data-aos="fade-up"
                    data-aos-delay="{{ $index * 50 }}"
                >
                    <button
                        @click="open = open === {{ $index }} ? null : {{ $index }}"
                        class="flex w-full items-center justify-between gap-4 p-6 text-left"
                        :aria-expanded="open === {{ $index }}"
                    >
                        <span class="font-display font-medium text-white pr-4">{{ $faq['question'] }}</span>
                        <span class="shrink-0 flex h-8 w-8 items-center justify-center rounded-lg bg-white/5 transition-transform duration-300" :class="open === {{ $index }} ? 'rotate-45 bg-primary-500/20' : ''">
                            <svg class="h-5 w-5 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </span>
                    </button>
                    <div
                        x-show="open === {{ $index }}"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        x-cloak
                        class="px-6 pb-6"
                    >
                        <p class="text-slate-400 leading-relaxed">{{ $faq['answer'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
