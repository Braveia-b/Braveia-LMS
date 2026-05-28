<?php
$t = $training;
$thumb = !empty($t->thumbnail)
    ? base_url('uploads/trainings/' . $t->thumbnail)
    : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=1200&h=500&fit=crop';
$price_label = ($t->price > 0) ? 'Rp ' . number_format($t->price, 0, ',', '.') : 'Gratis';
?>
<section class="py-5 bg-white">
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('courses') ?>">Program</a></li>
                <li class="breadcrumb-item active"><?= html_escape($t->title) ?></li>
            </ol>
        </nav>

        <div class="row g-4">
            <div class="col-lg-7">
                <img src="<?= $thumb ?>" class="img-fluid rounded-4 w-100 shadow-sm" alt="<?= html_escape($t->title) ?>" style="max-height: 400px; object-fit: cover;">
            </div>
            <div class="col-lg-5">
                <span class="badge bg-primary bg-opacity-10 text-primary mb-2"><?= html_escape($t->category_name) ?></span>
                <h1 class="fw-bold font-serif mb-3"><?= html_escape($t->title) ?></h1>
                <p class="text-muted mb-2"><i class="fas fa-user-tie me-2"></i>Mentor: <strong><?= html_escape($t->mentor_name) ?></strong></p>
                <p class="h4 text-primary fw-bold mb-4"><?= $price_label ?></p>

                <?php if ($this->session->userdata('is_logged_in')): ?>
                    <a href="<?= base_url('program') ?>" class="btn btn-primary btn-lg w-100 mb-2">Pilih Program di Dashboard</a>
                <?php else: ?>
                    <a href="<?= base_url('auth/register') ?>" class="btn btn-primary btn-lg w-100 mb-2">Daftar untuk Mengikuti</a>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-primary w-100">Sudah Punya Akun? Masuk</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-8">
                <h3 class="font-serif fw-bold mb-3">Deskripsi Program</h3>
                <div class="text-muted"><?= nl2br(html_escape($t->description)) ?></div>
            </div>
        </div>
    </div>
</section>
