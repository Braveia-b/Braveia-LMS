<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth" x-data="{ dark: true }" :class="{ 'dark': dark, 'light': !dark }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $meta['title'] ?? 'NexLearn LMS' }}</title>
    <meta name="description" content="{{ $meta['description'] ?? '' }}">
    <meta name="keywords" content="{{ $meta['keywords'] ?? '' }}">
    <meta name="author" content="NexLearn">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $meta['title'] ?? 'NexLearn LMS' }}">
    <meta property="og:description" content="{{ $meta['description'] ?? '' }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] ?? 'NexLearn LMS' }}">
    <meta name="twitter:description" content="{{ $meta['description'] ?? '' }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="overflow-x-hidden transition-colors duration-500" :class="dark ? 'bg-surface-900 text-slate-100' : 'bg-slate-50 text-slate-900'">

    <div id="page-loader" class="fixed inset-0 z-[100] flex items-center justify-center bg-surface-900">
        <div class="flex flex-col items-center gap-4">
            <div class="relative h-12 w-12">
                <div class="absolute inset-0 rounded-full border-2 border-primary-500/30"></div>
                <div class="absolute inset-0 rounded-full border-2 border-t-primary-500 animate-spin"></div>
            </div>
            <p class="font-display text-sm font-medium tracking-widest text-slate-400 uppercase">NexLearn</p>
        </div>
    </div>

    <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden" aria-hidden="true">
        <div class="orb hero-orb-1 -top-32 left-1/4 h-96 w-96 bg-primary-600/20"></div>
        <div class="orb -right-32 top-1/3 h-80 w-80 bg-cyan-400/10"></div>
        <div class="orb bottom-0 left-1/3 h-72 w-72 bg-indigo-500/15"></div>
    </div>

    <div class="relative z-10">
        @yield('content')
    </div>

</body>
</html>
