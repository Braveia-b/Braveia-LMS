<section id="testimonials" class="section-padding relative">
    <div class="container-narrow mx-auto">
        <x-ui.section-heading
            badge="Testimonials"
            title='Loved by <span class="text-gradient">educators worldwide</span>'
            subtitle="See what leaders in education and corporate training say about BraveIA."
        />

        <div class="swiper testimonials-swiper mt-16 !pb-12">
            <div class="swiper-wrapper">
                @foreach($testimonials as $item)
                    <div class="swiper-slide h-auto">
                        <blockquote class="glass-strong rounded-2xl p-8 h-full flex flex-col transition-all duration-500 hover:border-primary-500/30">
                            <div class="flex gap-1 text-amber-400 mb-4">
                                @for($i = 0; $i < $item['rating']; $i++)
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <p class="text-slate-300 leading-relaxed flex-1">"{{ $item['content'] }}"</p>
                            <footer class="mt-6 flex items-center gap-4 pt-6 border-t border-white/10">
                                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-primary-600 to-accent-gold flex items-center justify-center font-display font-bold text-surface-900">{{ $item['avatar'] }}</div>
                                <div>
                                    <cite class="not-italic font-display font-semibold text-white">{{ $item['name'] }}</cite>
                                    <p class="text-sm text-slate-500">{{ $item['role'] }}</p>
                                </div>
                            </footer>
                        </blockquote>
                    </div>
                @endforeach
            </div>
            <div class="testimonials-pagination flex justify-center gap-2"></div>
        </div>
    </div>
</section>
