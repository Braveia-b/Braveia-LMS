@props(['variant' => 'default'])

@php
$variants = [
    'default' => 'border-white/10 bg-white/5 text-slate-300',
    'primary' => 'border-primary-500/30 bg-primary-500/10 text-primary-400',
    'cyan' => 'border-cyan-500/30 bg-cyan-500/10 text-cyan-400',
];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs font-medium ' . $variants[$variant]]) }}>
    {{ $slot }}
</span>
