<section id="contact" class="section-padding relative overflow-hidden">
    <div class="absolute inset-0 mesh-gradient mesh-animate opacity-80"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-surface-900 via-transparent to-surface-900"></div>

    <div class="container-narrow relative z-10 mx-auto">
        <div class="rounded-3xl border border-white/10 bg-surface-800/50 p-10 sm:p-16 text-center backdrop-blur-xl reveal-scale" data-aos="zoom-in">
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-white max-w-2xl mx-auto leading-tight">
                Ready to transform your <span class="text-gradient">learning platform</span>?
            </h2>
            <p class="mt-6 text-lg text-slate-400 max-w-xl mx-auto">
                Join thousands of educators building the future of digital learning. Start your 14-day free trial today.
            </p>
            <form class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 max-w-md mx-auto" action="#" method="POST" @submit.prevent>
                @csrf
                <label for="email-cta" class="sr-only">Email address</label>
                <input
                    type="email"
                    id="email-cta"
                    name="email"
                    placeholder="Enter your email"
                    required
                    class="w-full sm:flex-1 rounded-xl border border-white/10 bg-surface-900/80 px-5 py-4 text-white placeholder:text-slate-500 focus:outline-none focus:border-primary-500/50 focus:ring-2 focus:ring-primary-500/20 transition-all"
                />
                <x-ui.button type="submit" variant="primary" size="lg" class="w-full sm:w-auto shrink-0 magnetic-btn">
                    Get Early Access
                </x-ui.button>
            </form>
            <p class="mt-4 text-xs text-slate-600">No credit card required · Cancel anytime</p>
        </div>
    </div>
</section>
