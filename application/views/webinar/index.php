<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h1 class="fw-bold section-title font-serif">Webinar & Event</h1>
            <p class="text-muted mt-3">Ikuti sesi live bersama praktisi dan ahli di bidangnya.</p>
        </div>

        <h2 class="h5 font-serif fw-bold mb-4">Akan Datang</h2>
        <?php if (!empty($webinars)): ?>
        <div class="row g-4 mb-5">
            <?php foreach ($webinars as $w): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card course-card h-100">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-success bg-opacity-10 text-success mb-2 align-self-start">Upcoming</span>
                        <h5 class="card-title fw-bold font-serif"><?= html_escape($w->title) ?></h5>
                        <p class="text-muted small mb-1"><i class="far fa-calendar me-1"></i><?= date('d M Y, H:i', strtotime($w->schedule_datetime)) ?> WIB</p>
                        <?php if (!empty($w->speaker_name)): ?>
                        <p class="text-muted small mb-2"><i class="fas fa-microphone me-1"></i><?= html_escape($w->speaker_name) ?></p>
                        <?php endif; ?>
                        <p class="card-text text-muted small flex-grow-1"><?= word_limiter(strip_tags($w->description ?? ''), 18) ?></p>
                        <a href="<?= base_url('webinar/detail/' . $w->id) ?>" class="btn btn-sm btn-outline-primary mt-auto align-self-start">Detail</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p class="text-muted mb-5">Belum ada webinar terjadwal saat ini.</p>
        <?php endif; ?>

        <?php if (!empty($past_webinars)): ?>
        <h2 class="h5 font-serif fw-bold mb-4">Rekaman / Telah Berlalu</h2>
        <div class="row g-4">
            <?php foreach ($past_webinars as $w): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card course-card h-100 opacity-75">
                    <div class="card-body">
                        <h5 class="card-title fw-bold font-serif"><?= html_escape($w->title) ?></h5>
                        <p class="text-muted small"><i class="far fa-calendar me-1"></i><?= date('d M Y', strtotime($w->schedule_datetime)) ?></p>
                        <a href="<?= base_url('webinar/detail/' . $w->id) ?>" class="btn btn-sm btn-outline-secondary">Lihat Info</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
