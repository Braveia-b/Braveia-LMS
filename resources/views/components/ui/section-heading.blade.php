@props(['badge' => null, 'title', 'subtitle' => null, 'align' => 'center'])

<div class="{{ $align === 'center' ? 'text-center mx-auto max-w-3xl' : 'max-w-2xl' }}" data-aos="fade-up">
    @if($badge)
        <span class="inline-flex items-center gap-2 rounded-full border border-primary-500/30 bg-primary-500/10 px-4 py-1.5 text-xs font-medium tracking-wide text-primary-400 uppercase mb-6">
            <span class="h-1.5 w-1.5 rounded-full bg-primary-400 animate-pulse"></span>
            {{ $badge }}
        </span>
    @endif
    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-white leading-[1.1]">
        {!! $title !!}
    </h2>
    @if($subtitle)
        <p class="mt-5 text-lg text-slate-400 leading-relaxed">{{ $subtitle }}</p>
    @endif
</div>
