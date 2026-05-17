<header
    id="navbar"
    x-data="{ open: false }"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
>
    <nav class="container-narrow mx-auto flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="#home" class="flex items-center gap-2.5 group">
            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-primary-600 to-primary-700 shadow-lg shadow-primary-600/30 ring-1 ring-primary-500/30">
                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </span>
            <span class="font-display text-xl font-bold tracking-tight text-white group-hover:text-primary-400 transition-colors">Brave<span class="text-gradient">IA</span></span>
        </a>

        <div class="hidden lg:flex items-center gap-1 rounded-2xl glass px-2 py-1.5 nav-scrolled:bg-surface-800/80">
            @foreach(['Home' => '#home', 'Features' => '#features', 'Courses' => '#courses', 'Pricing' => '#pricing', 'Testimonials' => '#testimonials', 'FAQ' => '#faq', 'Contact' => '#contact'] as $label => $href)
                <a href="{{ $href }}" class="px-4 py-2 text-sm text-slate-400 hover:text-white rounded-lg hover:bg-white/5 transition-all duration-200">{{ $label }}</a>
            @endforeach
        </div>

        <div class="flex items-center gap-3">
            <button
                @click="dark = !dark"
                class="hidden sm:flex h-10 w-10 items-center justify-center rounded-xl glass text-slate-400 hover:text-white transition-colors"
                aria-label="Toggle theme"
            >
                <svg x-show="dark" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <svg x-show="!dark" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>

            <x-ui.button href="#pricing" variant="primary" size="sm" class="hidden sm:inline-flex">
                Get Started
            </x-ui.button>

            <button
                @click="open = !open"
                class="lg:hidden flex h-10 w-10 items-center justify-center rounded-xl glass"
                aria-label="Menu"
            >
                <svg x-show="!open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </nav>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 -translate-y-4"
        @click.outside="open = false"
        class="lg:hidden glass-strong mx-4 mb-4 rounded-2xl p-4 border border-white/10"
        x-cloak
    >
        @foreach(['Home' => '#home', 'Features' => '#features', 'Courses' => '#courses', 'Pricing' => '#pricing', 'Testimonials' => '#testimonials', 'FAQ' => '#faq', 'Contact' => '#contact'] as $label => $href)
            <a href="{{ $href }}" @click="open = false" class="block px-4 py-3 text-slate-300 hover:text-white rounded-lg hover:bg-white/5">{{ $label }}</a>
        @endforeach
        <div class="mt-3 pt-3 border-t border-white/10">
            <x-ui.button href="#pricing" variant="primary" size="md" class="w-full justify-center">Get Started</x-ui.button>
        </div>
    </div>
</header>
