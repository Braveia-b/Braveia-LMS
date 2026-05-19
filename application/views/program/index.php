<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold">Semua Program</h2>
            <p class="text-muted">Pilih program pelatihan yang ingin Anda ikuti.</p>
        </div>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php if (!empty($trainings)): ?>
            <?php foreach ($trainings as $training): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Thumbnail -->
                        <?php if(!empty($training->thumbnail)): ?>
                            <img src="<?= base_url('uploads/trainings/' . $training->thumbnail) ?>" class="card-img-top" alt="<?= html_escape($training->title) ?>" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary text-white mb-2 align-self-start"><?= html_escape($training->category_name) ?></span>
                            <h5 class="card-title font-weight-bold"><?= html_escape($training->title) ?></h5>
                            <p class="card-text text-muted small flex-grow-1">
                                <?= word_limiter(strip_tags($training->description), 15) ?>
                            </p>
                            
                            <div class="mt-auto">
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="small text-muted"><i class="fas fa-user-tie"></i> <?= html_escape($training->mentor_name) ?></span>
                                    <span class="font-weight-bold text-success">
                                        <?= ($training->price > 0) ? 'Rp ' . number_format($training->price, 0, ',', '.') : 'Gratis' ?>
                                    </span>
                                </div>
                                
                                <?php if (in_array($training->id, $enrolled_ids)): ?>
                                    <button class="btn btn-secondary btn-block w-100" disabled>Sudah Dipilih</button>
                                <?php else: ?>
                                    <a href="<?= base_url('program/enroll/' . $training->id) ?>" class="btn btn-primary btn-block w-100" onclick="return confirm('Apakah Anda yakin ingin memilih program ini?');">Pilih Program</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada program yang tersedia saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
