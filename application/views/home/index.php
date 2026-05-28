<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container position-relative">
        <div class="mb-4">
            <?php $logo_class = 'braveia-logo-lg'; $this->load->view('layout/_logo'); ?>
        </div>
        <h1 class="mb-4 font-serif">Tingkatkan Karirmu Bersama Brave International Academy</h1>
        <p class="hero-tagline mb-5 mx-auto" style="max-width: 640px;">Platform e-learning bersertifikasi dan bimbingan mentor profesional berbasis AI recommendation.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="<?= base_url('courses') ?>" class="btn btn-hero-primary btn-lg px-4 py-3">Mulai Belajar</a>
            <a href="<?= base_url('courses') ?>" class="btn btn-hero-outline btn-lg px-4 py-3">Jelajahi Program</a>
        </div>
        
        <?php
        $st = isset($stats) ? $stats : ['trainings' => 0, 'mentors' => 0, 'participants' => 0];
        $fmt = function ($n) {
            if ($n >= 1000) return number_format($n / 1000, 0) . 'K+';
            return $n > 0 ? $n . '+' : '—';
        };
        ?>
        <div class="row mt-5 pt-4 hero-divider border-top text-white">
            <div class="col-md-3 col-6 mb-3">
                <h3 class="fw-bold stat-value"><?= $fmt($st['trainings']) ?></h3>
                <p class="small opacity-75">Program Aktif</p>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <h3 class="fw-bold stat-value"><?= $fmt($st['mentors']) ?></h3>
                <p class="small opacity-75">Mentor Ahli</p>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <h3 class="fw-bold stat-value"><?= $fmt($st['participants']) ?></h3>
                <p class="small opacity-75">Peserta Aktif</p>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <h3 class="fw-bold stat-value"><i class="fas fa-award"></i></h3>
                <p class="small opacity-75">Sertifikasi Resmi</p>
            </div>
        </div>
    </div>
</section>

<!-- Program Populer -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold section-title font-serif">Program Populer</h2>
            <p class="text-muted mt-4">Pelajari keahlian yang paling dicari di industri saat ini.</p>
        </div>
        
        <?php if (!empty($popular_trainings)): ?>
        <div class="row g-4">
            <?php foreach ($popular_trainings as $training): ?>
                <?php $this->load->view('courses/_card', ['training' => $training]); ?>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-4 text-muted">
            <p>Program populer akan segera ditampilkan. <a href="<?= base_url('courses') ?>">Lihat katalog program</a>.</p>
        </div>
        <?php endif; ?>
        
        <div class="text-center mt-5">
            <a href="<?= base_url('courses') ?>" class="btn btn-outline-primary px-4">Lihat Semua Program <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- AI Features Section -->
<section class="py-5" style="background: #ebe8e0;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="pe-md-5">
                    <span class="feature-badge">✨ Fitur Baru</span>
                    <h2 class="fw-bold mt-2 mb-4 font-serif">Didukung oleh AI Recommendation</h2>
                    <p class="text-muted mb-4">Sistem Braveia dilengkapi dengan kecerdasan buatan untuk menganalisis perkembangan belajar Anda. Dapatkan rekomendasi kelas, mentor, dan jalur karir yang paling relevan dengan potensi Anda.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Rekomendasi kelas otomatis</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Skill gap analysis</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> Pencocokan mentor yang tepat</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 shadow-sm ai-feature-card text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2043/2043004.png" width="150" class="mb-3 opacity-75" alt="AI Icon">
                    <h4 class="fw-bold font-serif">Career Roadmap Builder</h4>
                    <p class="text-muted small">Cari tahu posisi mana yang sesuai dengan skill Anda saat ini, dan apa saja yang harus dipelajari selanjutnya.</p>
                </div>
            </div>
        </div>
    </div>
</section>
