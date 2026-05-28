<?php $w = $webinar; ?>
<section class="py-5 bg-white">
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('webinar') ?>">Webinar</a></li>
                <li class="breadcrumb-item active"><?= html_escape($w->title) ?></li>
            </ol>
        </nav>

        <h1 class="fw-bold font-serif mb-3"><?= html_escape($w->title) ?></h1>
        <p class="text-muted mb-4">
            <i class="far fa-calendar me-2"></i><?= date('l, d F Y — H:i', strtotime($w->schedule_datetime)) ?> WIB
            <?php if (!empty($w->speaker_name)): ?>
            <span class="ms-3"><i class="fas fa-user me-1"></i><?= html_escape($w->speaker_name) ?></span>
            <?php endif; ?>
        </p>

        <?php if (!empty($w->meeting_link) && strtotime($w->schedule_datetime) >= time()): ?>
        <a href="<?= html_escape($w->meeting_link) ?>" target="_blank" rel="noopener" class="btn btn-primary mb-4">
            <i class="fas fa-video me-2"></i>Join Meeting
        </a>
        <?php endif; ?>

        <div class="text-muted"><?= nl2br(html_escape($w->description ?? 'Tidak ada deskripsi.')) ?></div>

        <?php if (!$this->session->userdata('is_logged_in')): ?>
        <div class="alert alert-light border mt-4">
            <a href="<?= base_url('auth/register') ?>">Daftar akun</a> untuk mendapatkan notifikasi webinar terbaru.
        </div>
        <?php endif; ?>
    </div>
</section>
