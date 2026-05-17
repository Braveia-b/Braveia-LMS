<section id="courses" class="section-padding relative">
    <div class="container-narrow mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-12">
            <x-ui.section-heading
                align="left"
                badge="Courses"
                title='Explore <span class="text-gradient">top-rated</span> courses'
                subtitle="Hand-picked courses from industry experts, designed for interactive learning."
            />
            <div class="flex items-center gap-3 shrink-0">
                <button class="courses-prev h-11 w-11 rounded-xl glass flex items-center justify-center text-slate-400 hover:text-white transition-colors" aria-label="Previous">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="courses-next h-11 w-11 rounded-xl glass flex items-center justify-center text-slate-400 hover:text-white transition-colors" aria-label="Next">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <div class="swiper courses-swiper !overflow-visible">
            <div class="swiper-wrapper">
                @foreach($courses as $course)
                    <div class="swiper-slide">
                        <article class="group rounded-2xl border border-white/10 bg-surface-800/50 overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-xl hover:shadow-primary-600/10 hover:border-primary-500/30">
                            <div class="relative h-44 bg-gradient-to-br {{ $course['color'] }} overflow-hidden">
                                <div class="absolute inset-0 bg-black/20"></div>
                                <span class="absolute top-4 left-4 rounded-full glass px-3 py-1 text-xs font-medium text-white">{{ $course['category'] }}</span>
                                <div class="absolute bottom-4 right-4 flex items-center gap-1 text-amber-400">
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-sm font-medium text-white">{{ $course['rating'] }}</span>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="font-display font-semibold text-white group-hover:text-primary-400 transition-colors line-clamp-2">{{ $course['title'] }}</h3>
                                <p class="mt-2 text-sm text-slate-500">{{ $course['instructor'] }}</p>
                                <div class="mt-4 flex items-center justify-between text-xs text-slate-500">
                                    <span>{{ $course['students'] }} students</span>
                                    <span>{{ $course['progress'] }}% avg. progress</span>
                                </div>
                                <div class="mt-3 h-1.5 rounded-full bg-white/10 overflow-hidden">
                                    <div class="h-full rounded-full bg-gradient-to-r from-primary-700 to-accent-gold transition-all duration-500 group-hover:w-full" style="width: {{ $course['progress'] }}%"></div>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="courses-pagination mt-8 flex justify-center gap-2"></div>
        </div>
    </div>
</section>
