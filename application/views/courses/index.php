<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h1 class="fw-bold section-title font-serif">Program Pelatihan</h1>
            <p class="text-muted mt-3">Jelajahi seluruh program yang tersedia dan temukan jalur belajar yang tepat untuk Anda.</p>
        </div>

        <?php if (!empty($trainings)): ?>
        <div class="row g-4">
            <?php foreach ($trainings as $training): ?>
                <?php $this->load->view('courses/_card', ['training' => $training]); ?>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada program yang dipublikasikan. Silakan cek kembali nanti.</p>
            <a href="<?= base_url() ?>" class="btn btn-outline-primary mt-2">Kembali ke Beranda</a>
        </div>
        <?php endif; ?>
    </div>
</section>
