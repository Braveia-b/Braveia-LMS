<div class="container py-5 mt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h2 class="fw-bold font-serif">Selamat Datang, <?= $this->session->userdata('name') ?>! 👋</h2>
            <p class="text-muted">Lanjutkan progres belajarmu dan capai target karirmu hari ini.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-danger shadow-sm">Keluar</a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- AI Recommendation Card -->
        <div class="col-md-12">
            <div class="card border-0 rounded-4 shadow-sm dashboard-ai-card">
                <div class="card-body p-4 d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                    <div>
                        <span class="badge mb-2">AI Recommendation</span>
                        <h4 class="fw-bold font-serif">Berdasarkan Minat Anda</h4>
                        <p class="mb-0 opacity-75">Kami menyarankan Anda mengambil "Advanced UI/UX dengan AI Tools". Skill ini sangat cocok dengan profil Anda.</p>
                    </div>
                    <div>
                        <a href="#" class="btn btn-primary fw-bold px-4">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="col-md-4">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary bg-opacity-10 text-primary d-inline-flex p-3 rounded-circle mb-3">
                        <i class="fas fa-book-open fa-2x"></i>
                    </div>
                    <h2 class="fw-bold mb-1"><?= isset($enrolled_programs) ? count($enrolled_programs) : 0 ?></h2>
                    <p class="text-muted mb-0">Kelas Aktif</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-success bg-opacity-10 text-success d-inline-flex p-3 rounded-circle mb-3">
                        <i class="fas fa-certificate fa-2x"></i>
                    </div>
                    <h2 class="fw-bold mb-1">1</h2>
                    <p class="text-muted mb-0">Sertifikat Diperoleh</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-warning bg-opacity-10 text-warning d-inline-flex p-3 rounded-circle mb-3">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                    <h2 class="fw-bold mb-1">2</h2>
                    <p class="text-muted mb-0">Jadwal Webinar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enrolled Programs Section -->
    <div class="row mt-5">
        <div class="col-12 mb-4">
            <h3 class="fw-bold">Program Pembelajaran Anda</h3>
            <p class="text-muted">Lanjutkan progres belajar Anda pada program-program di bawah ini.</p>
        </div>
        
        <?php if (!empty($enrolled_programs)): ?>
            <?php foreach ($enrolled_programs as $program): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <?php if(!empty($program->thumbnail)): ?>
                            <img src="<?= base_url('uploads/trainings/' . $program->thumbnail) ?>" class="card-img-top" alt="<?= html_escape($program->title) ?>" style="height: 180px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 180px;">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary text-white mb-2 align-self-start"><?= html_escape($program->category_name) ?></span>
                            <h5 class="card-title font-weight-bold"><?= html_escape($program->title) ?></h5>
                            <p class="small text-muted mb-3"><i class="fas fa-user-tie"></i> Mentor: <?= html_escape($program->mentor_name) ?></p>
                            
                            <div class="mt-auto">
                                <a href="#" class="btn btn-outline-primary btn-block w-100">Mulai Belajar</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info border-0 shadow-sm p-4 text-center">
                    <i class="fas fa-info-circle fa-2x mb-3 text-info"></i>
                    <h5>Anda belum memilih program apapun</h5>
                    <p class="text-muted">Silakan eksplorasi program-program menarik kami dan mulai perjalanan belajar Anda.</p>
                    <a href="<?= base_url('program') ?>" class="btn btn-primary mt-2">Lihat Semua Program</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
