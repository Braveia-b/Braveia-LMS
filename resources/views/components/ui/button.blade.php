@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'magnetic' => false,
])

@php
$base = 'inline-flex items-center justify-center gap-2 font-medium transition-all duration-300 rounded-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 focus-visible:ring-offset-surface-900';
$sizes = [
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-6 py-3 text-sm',
    'lg' => 'px-8 py-4 text-base',
];
$variants = [
    'primary' => 'btn-glow magnetic-btn bg-gradient-to-r from-primary-600 via-primary-500 to-accent-indigo text-white hover:shadow-lg hover:shadow-primary-600/30 hover:scale-[1.02]',
    'secondary' => 'glass magnetic-btn text-slate-200 hover:bg-white/10 hover:border-white/20',
    'ghost' => 'text-slate-300 hover:text-white hover:bg-white/5',
    'outline' => 'border border-white/20 text-slate-200 hover:bg-white/5 hover:border-primary-500/50',
];
$classes = $base . ' ' . $sizes[$size] . ' ' . $variants[$variant];
if ($magnetic) $classes .= ' magnetic-btn';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $attributes->get('type', 'button') }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
