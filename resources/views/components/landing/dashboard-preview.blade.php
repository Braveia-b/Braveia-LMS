<section class="section-padding dashboard-preview relative overflow-hidden">
    <div class="container-narrow mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="reveal-up" data-aos="fade-right">
                <x-ui.section-heading
                    align="left"
                    badge="Dashboard"
                    title='Powerful analytics at <span class="text-gradient">your fingertips</span>'
                    subtitle="Monitor student engagement, course performance, and learning outcomes with a beautiful admin panel designed for clarity."
                />
                <ul class="mt-8 space-y-4">
                    @foreach(['Real-time student activity tracking', 'Course completion analytics', 'Revenue & enrollment insights', 'Exportable reports & dashboards'] as $item)
                        <li class="flex items-center gap-3 text-slate-300">
                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary-500/20 text-primary-400">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="relative reveal-scale floating" data-aos="fade-left">
                <div class="absolute -inset-4 rounded-3xl bg-gradient-to-r from-primary-600/20 to-primary-500/10 blur-2xl"></div>
                <div class="relative rounded-2xl border border-white/10 bg-surface-800/90 p-6 shadow-2xl backdrop-blur-xl">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-display font-semibold text-white">Analytics Overview</h3>
                        <span class="text-xs text-emerald-400 flex items-center gap-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Live
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="rounded-xl glass p-4">
                            <p class="text-xs text-slate-500">Enrollments</p>
                            <p class="font-display text-2xl font-bold text-white mt-1">+24%</p>
                        </div>
                        <div class="rounded-xl glass p-4">
                            <p class="text-xs text-slate-500">Avg. Score</p>
                            <p class="font-display text-2xl font-bold text-white mt-1">87.3</p>
                        </div>
                    </div>
                    <div class="rounded-xl glass p-4 mb-4">
                        <p class="text-xs text-slate-500 mb-3">Weekly Activity</p>
                        <div class="flex items-end gap-1.5 h-24">
                            @foreach([30, 55, 40, 75, 50, 90, 65, 80, 45, 95, 70, 85] as $h)
                                <div class="chart-bar flex-1 rounded-t bg-gradient-to-t from-primary-700/90 to-primary-400/80" style="height: {{ $h }}%"></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="space-y-3">
                        <p class="text-xs text-slate-500">Recent Activity</p>
                        @foreach([['Sarah M.', 'Completed ML Module 4', '2m'], ['Alex R.', 'Started Live Class', '15m'], ['Maya P.', 'Earned Certificate', '1h']] as [$name, $action, $time])
                            <div class="flex items-center gap-3 rounded-lg bg-white/5 p-3">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-primary-600 to-primary-400 flex items-center justify-center text-xs font-bold text-surface-900">{{ substr($name, 0, 1) }}</div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-white truncate">{{ $name }}</p>
                                    <p class="text-xs text-slate-500 truncate">{{ $action }}</p>
                                </div>
                                <span class="text-xs text-slate-600">{{ $time }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
