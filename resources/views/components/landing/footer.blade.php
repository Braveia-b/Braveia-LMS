<footer class="border-t border-white/5 bg-surface-900/50">
    <div class="container-narrow mx-auto section-padding !py-16">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-10">
            <div class="col-span-2 md:col-span-4 lg:col-span-1">
                <a href="#home" class="flex items-center gap-2.5">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-primary-600 to-indigo-500">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </span>
                    <span class="font-display text-lg font-bold text-white">Nex<span class="text-gradient">Learn</span></span>
                </a>
                <p class="mt-4 text-sm text-slate-500 leading-relaxed max-w-xs">
                    AI-powered learning management for the next generation of educators.
                </p>
                <div class="mt-6 flex gap-3">
                    @foreach(['twitter' => 'M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84', 'github' => 'M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.17 6.839 9.49.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.114 2.504.336 1.909-1.295 2.747-1.026 2.747-1.026.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.167 22 16.418 22 12c0-5.523-4.477-10-10-10z', 'linkedin' => 'M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z'] as $network => $path)
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-xl glass text-slate-400 hover:text-white hover:bg-white/10 transition-all" aria-label="{{ ucfirst($network) }}">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $path }}"/></svg>
                        </a>
                    @endforeach
                </div>
            </div>

            @foreach(['Product' => ['Features' => '#features', 'Courses' => '#courses', 'Pricing' => '#pricing', 'Changelog' => '#'], 'Company' => ['About' => '#', 'Blog' => '#', 'Careers' => '#', 'Contact' => '#contact'], 'Resources' => ['Documentation' => '#', 'Help Center' => '#faq', 'API' => '#', 'Status' => '#']] as $title => $links)
                <div>
                    <h4 class="font-display font-semibold text-white text-sm mb-4">{{ $title }}</h4>
                    <ul class="space-y-3">
                        @foreach($links as $label => $href)
                            <li><a href="{{ $href }}" class="text-sm text-slate-500 hover:text-white transition-colors">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <div>
                <h4 class="font-display font-semibold text-white text-sm mb-4">Newsletter</h4>
                <p class="text-sm text-slate-500 mb-4">Get product updates and learning tips.</p>
                <form class="flex gap-2" action="#" method="POST" @submit.prevent>
                    <input type="email" placeholder="Email" class="flex-1 min-w-0 rounded-lg border border-white/10 bg-surface-800 px-3 py-2 text-sm text-white placeholder:text-slate-600 focus:outline-none focus:border-primary-500/50" />
                    <button type="submit" class="shrink-0 rounded-lg bg-primary-600 px-3 py-2 text-sm font-medium text-white hover:bg-primary-500 transition-colors">Join</button>
                </form>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-600">
            <p>&copy; {{ date('Y') }} NexLearn. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition-colors">Privacy</a>
                <a href="#" class="hover:text-white transition-colors">Terms</a>
                <a href="#" class="hover:text-white transition-colors">Cookies</a>
            </div>
        </div>
    </div>
</footer>
