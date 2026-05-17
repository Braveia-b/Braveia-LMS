@extends('layouts.landing')

@section('content')
    <x-landing.navbar />
    <main>
        <x-landing.hero :stats="$stats" />
        <x-landing.partners :partners="$partners" />
        <x-landing.features :features="$features" />
        <x-landing.dashboard-preview />
        <x-landing.courses :courses="$courses" />
        <x-landing.testimonials :testimonials="$testimonials" />
        <x-landing.pricing :pricing="$pricing" />
        <x-landing.faq :faqs="$faqs" />
        <x-landing.cta />
    </main>
    <x-landing.footer />
@endsection
