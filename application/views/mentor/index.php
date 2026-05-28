<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h1 class="fw-bold section-title font-serif">Mentor Profesional</h1>
            <p class="text-muted mt-3">Belajar langsung dari praktisi berpengalaman di industri.</p>
        </div>

        <?php if (!empty($mentors)): ?>
        <div class="row g-4">
            <?php foreach ($mentors as $m): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card course-card h-100 text-center p-4">
                    <?php if (!empty($m->avatar)): ?>
                        <img src="<?= base_url('uploads/avatars/' . $m->avatar) ?>" class="rounded-circle mx-auto mb-3" width="96" height="96" alt="<?= html_escape($m->name) ?>" style="object-fit: cover;">
                    <?php else: ?>
                        <div class="rounded-circle bg-secondary bg-opacity-25 d-flex align-items-center justify-content-center mx-auto mb-3" style="width:96px;height:96px;">
                            <i class="fas fa-user fa-2x text-muted"></i>
                        </div>
                    <?php endif; ?>
                    <h5 class="fw-bold font-serif mb-1"><?= html_escape($m->name) ?></h5>
                    <p class="text-primary small fw-semibold mb-2"><?= html_escape($m->expertise) ?></p>
                    <?php if (!empty($m->bio)): ?>
                    <p class="text-muted small"><?= word_limiter(strip_tags($m->bio), 25) ?></p>
                    <?php endif; ?>
                    <?php if ($m->rating > 0): ?>
                    <p class="small text-warning mb-0"><i class="fas fa-star"></i> <?= number_format($m->rating, 1) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-5 text-muted">
            <p>Daftar mentor akan segera tersedia.</p>
        </div>
        <?php endif; ?>
    </div>
</section>
