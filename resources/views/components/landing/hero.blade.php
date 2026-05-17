<section id="home" class="hero-section relative min-h-screen flex flex-col justify-center overflow-hidden pt-24 pb-16">
    <div class="absolute inset-0 grid-bg pointer-events-none"></div>
    <div class="absolute inset-0 mesh-gradient mesh-animate pointer-events-none"></div>

    <div class="orb hero-orb-1 top-20 left-[10%] h-[500px] w-[500px] bg-primary-600/25"></div>
    <div class="orb hero-orb-2 top-40 right-[5%] h-[400px] w-[400px] bg-primary-500/15"></div>

    <div class="container-narrow relative z-10 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center text-center">
            <div class="hero-badge mb-8">
                <x-ui.badge variant="primary">
                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Trusted by 50,000+ learners worldwide
                </x-ui.badge>
            </div>

            <h1 class="hero-title font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight max-w-5xl">
                <span class="line block text-white">Transform Learning Into</span>
                <span class="line block text-gradient mt-2">Interactive Digital Experience</span>
            </h1>

            <p class="hero-subtitle mt-8 max-w-2xl text-lg sm:text-xl text-slate-400 leading-relaxed">
                The AI-powered LMS platform that helps educators create immersive courses,
                track progress in real-time, and deliver world-class learning experiences.
            </p>

            <div class="hero-cta mt-10 flex flex-col sm:flex-row items-center gap-4">
                <x-ui.button href="#pricing" variant="primary" size="lg" magnetic>
                    Start Free Trial
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </x-ui.button>
                <x-ui.button href="#features" variant="secondary" size="lg">
                    <svg class="h-5 w-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
                    Watch Demo
                </x-ui.button>
            </div>

            <div class="hero-stats mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-16">
                @foreach($stats as $stat)
                    <div class="stat-item text-center">
                        <p class="font-display text-2xl sm:text-3xl font-bold text-white" data-counter="{{ $stat['value'] }}">{{ $stat['value'] }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="hero-mockup relative mt-20 perspective-1000">
            <div class="hero-float-card absolute -left-4 top-1/4 z-20 hidden lg:block glass rounded-2xl p-4 shadow-2xl floating">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-primary-500 to-accent-gold flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">AI Assistant</p>
                        <p class="text-sm font-medium text-white">Quiz completed! +15 XP</p>
                    </div>
                </div>
            </div>

            <div class="hero-float-card absolute -right-4 top-1/3 z-20 hidden lg:block glass rounded-2xl p-4 shadow-2xl floating-delayed">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-emerald-500/20 flex items-center justify-center">
                        <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Progress</p>
                        <p class="text-sm font-medium text-white">Course 87% complete</p>
                    </div>
                </div>
            </div>

            <div class="relative mx-auto max-w-5xl rounded-2xl border border-white/10 bg-surface-800/80 p-1 shadow-2xl shadow-primary-600/10 backdrop-blur-xl">
                <div class="flex items-center gap-2 rounded-t-xl bg-surface-700/50 px-4 py-3 border-b border-white/5">
                    <span class="h-3 w-3 rounded-full bg-red-500/80"></span>
                    <span class="h-3 w-3 rounded-full bg-amber-500/80"></span>
                    <span class="h-3 w-3 rounded-full bg-emerald-500/80"></span>
                    <span class="ml-4 flex-1 rounded-md bg-surface-900/50 px-3 py-1 text-xs text-slate-500">app.braveia.io/dashboard</span>
                </div>
                <div class="rounded-b-xl bg-gradient-to-br from-surface-800 to-surface-900 p-6">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-3 hidden md:block space-y-3">
                            <div class="h-8 rounded-lg bg-primary-500/20 border border-primary-500/30"></div>
                            @for($i = 0; $i < 5; $i++)
                                <div class="h-6 rounded-lg bg-white/5"></div>
                            @endfor
                        </div>
                        <div class="col-span-12 md:col-span-9 space-y-4">
                            <div class="grid grid-cols-3 gap-3">
                                @foreach(['Active Students', 'Courses', 'Completion'] as $label)
                                    <div class="rounded-xl glass p-4">
                                        <p class="text-xs text-slate-500">{{ $label }}</p>
                                        <p class="mt-1 font-display text-xl font-bold text-white">{{ ['2,847', '48', '94%'][$loop->index] }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="rounded-xl glass p-4 h-40 flex items-end gap-2">
                                @foreach([40, 65, 45, 80, 55, 90, 70, 85, 60, 95, 75, 88] as $h)
                                    <div class="chart-bar flex-1 rounded-t bg-gradient-to-t from-primary-600 to-primary-400" style="height: {{ $h }}%"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
