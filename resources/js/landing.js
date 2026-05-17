import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';
import AOS from 'aos';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';

gsap.registerPlugin(ScrollTrigger);

/* ─── Lenis Smooth Scroll ─── */
const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    smoothWheel: true,
});

lenis.on('scroll', ScrollTrigger.update);

gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
});
gsap.ticker.lagSmoothing(0);

/* ─── Page Loader ─── */
window.addEventListener('load', () => {
    const loader = document.getElementById('page-loader');
    if (loader) {
        gsap.to(loader, {
            opacity: 0,
            duration: 0.6,
            ease: 'power2.inOut',
            onComplete: () => loader.classList.add('loaded'),
        });
    }

    initHeroAnimations();
    initScrollReveals();
    initCounters();
    initMagneticButtons();
    initParallax();
});

/* ─── AOS ─── */
AOS.init({
    duration: 800,
    easing: 'ease-out-cubic',
    once: true,
    offset: 80,
    disable: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
});

/* ─── Hero Entrance ─── */
function initHeroAnimations() {
    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    tl.from('.hero-badge', { y: 20, opacity: 0, duration: 0.6 })
        .from('.hero-title .line', { y: 60, opacity: 0, stagger: 0.12, duration: 0.8 }, '-=0.3')
        .from('.hero-subtitle', { y: 30, opacity: 0, duration: 0.7 }, '-=0.4')
        .from('.hero-cta', { y: 20, opacity: 0, duration: 0.6 }, '-=0.3')
        .from('.hero-stats .stat-item', { y: 30, opacity: 0, stagger: 0.1, duration: 0.6 }, '-=0.2')
        .from('.hero-mockup', { y: 80, opacity: 0, scale: 0.95, duration: 1 }, '-=0.5')
        .from('.hero-float-card', { y: 40, opacity: 0, stagger: 0.15, duration: 0.7 }, '-=0.6');
}

/* ─── Scroll Reveals ─── */
function initScrollReveals() {
    gsap.utils.toArray('.reveal-up').forEach((el) => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none reverse',
            },
            y: 50,
            opacity: 0,
            duration: 0.8,
            ease: 'power3.out',
        });
    });

    gsap.utils.toArray('.reveal-scale').forEach((el) => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
            },
            scale: 0.9,
            opacity: 0,
            duration: 0.8,
            ease: 'back.out(1.2)',
        });
    });
}

/* ─── Stats Counter ─── */
function initCounters() {
    document.querySelectorAll('[data-counter]').forEach((el) => {
        const target = el.dataset.counter;
        const suffix = el.dataset.suffix || '';
        const isPercent = target.includes('%');
        const numericTarget = parseFloat(target.replace(/[^0-9.]/g, ''));
        const hasK = target.includes('K');
        const hasPlus = target.includes('+');

        ScrollTrigger.create({
            trigger: el,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                const obj = { val: 0 };
                gsap.to(obj, {
                    val: numericTarget,
                    duration: 2,
                    ease: 'power2.out',
                    onUpdate: () => {
                        let display = Math.round(obj.val);
                        if (hasK) display = (obj.val / 1).toFixed(1).replace(/\.0$/, '') + 'K';
                        if (isPercent) display = Math.round(obj.val) + '%';
                        else if (!hasK) display = Math.round(obj.val).toLocaleString();
                        if (hasPlus && !isPercent) display += '+';
                        el.textContent = hasK && !isPercent ? display + (hasPlus ? '+' : '') : display + suffix;
                    },
                });
            },
        });
    });
}

/* ─── Magnetic Buttons ─── */
function initMagneticButtons() {
    document.querySelectorAll('.magnetic-btn').forEach((btn) => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            gsap.to(btn, { x: x * 0.2, y: y * 0.2, duration: 0.3, ease: 'power2.out' });
        });
        btn.addEventListener('mouseleave', () => {
            gsap.to(btn, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1, 0.5)' });
        });
    });
}

/* ─── Mouse Parallax (Hero) ─── */
function initParallax() {
    const hero = document.querySelector('.hero-section');
    if (!hero) return;

    hero.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        const { innerWidth, innerHeight } = window;
        const x = (clientX / innerWidth - 0.5) * 2;
        const y = (clientY / innerHeight - 0.5) * 2;

        gsap.to('.hero-orb-1', { x: x * 30, y: y * 20, duration: 1, ease: 'power2.out' });
        gsap.to('.hero-orb-2', { x: x * -20, y: y * -15, duration: 1, ease: 'power2.out' });
        gsap.to('.hero-mockup', { x: x * 10, y: y * 8, duration: 1, ease: 'power2.out' });
        gsap.to('.hero-float-card', { x: x * 15, y: y * 10, duration: 1.2, ease: 'power2.out' });
    });
}

/* ─── Swiper: Courses ─── */
const coursesSwiper = document.querySelector('.courses-swiper');
if (coursesSwiper) {
    new Swiper('.courses-swiper', {
        modules: [Navigation, Pagination, Autoplay],
        slidesPerView: 1.15,
        spaceBetween: 20,
        centeredSlides: false,
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        pagination: { el: '.courses-pagination', clickable: true },
        navigation: {
            nextEl: '.courses-next',
            prevEl: '.courses-prev',
        },
        breakpoints: {
            640: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 3.5 },
        },
    });
}

/* ─── Swiper: Testimonials ─── */
const testimonialsSwiper = document.querySelector('.testimonials-swiper');
if (testimonialsSwiper) {
    new Swiper('.testimonials-swiper', {
        modules: [Pagination, Autoplay, EffectFade],
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: { delay: 5000, disableOnInteraction: false },
        pagination: { el: '.testimonials-pagination', clickable: true },
        breakpoints: {
            768: { slidesPerView: 2, effect: 'slide' },
            1024: { slidesPerView: 3, effect: 'slide' },
        },
    });
}

/* ─── Navbar scroll state ─── */
const navbar = document.getElementById('navbar');
if (navbar) {
    ScrollTrigger.create({
        start: 'top -80',
        onUpdate: (self) => {
            navbar.classList.toggle('nav-scrolled', self.scroll() > 50);
        },
    });
}

/* ─── Dashboard chart bars animation ─── */
ScrollTrigger.create({
    trigger: '.dashboard-preview',
    start: 'top 70%',
    once: true,
    onEnter: () => {
        gsap.from('.chart-bar', {
            scaleY: 0,
            transformOrigin: 'bottom',
            stagger: 0.08,
            duration: 0.8,
            ease: 'power3.out',
        });
    },
});
