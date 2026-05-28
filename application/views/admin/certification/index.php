<?php
$page_title = 'Sertifikasi';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Sertifikasi'],
];
$this->load->view('admin/layout/_page_header');
?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row g-4">
    <div class="col-xl-5">
        <div class="admin-panel admin-form-panel">
            <div class="card-header-dark">
                <h3>Terbitkan Sertifikat</h3>
            </div>
            <form action="<?= base_url('admin/certification/issue') ?>" method="POST">
                <div class="admin-panel-body">
                    <div class="mb-3">
                        <label class="form-label">Peserta</label>
                        <select class="form-select" name="user_id" required>
                            <option value="">Pilih peserta</option>
                            <?php foreach (($participants ?? []) as $u): ?>
                                <option value="<?= (int)$u->id ?>"><?= html_escape($u->name) ?> (<?= html_escape($u->email) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Program</label>
                        <select class="form-select" name="training_id" required>
                            <option value="">Pilih program</option>
                            <?php foreach (($trainings ?? []) as $t): ?>
                                <option value="<?= (int)$t->id ?>"><?= html_escape($t->title) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Sertifikat</label>
                        <input class="form-control" name="certificate_number" placeholder="BRV-2026-0001" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">File Path</label>
                        <input class="form-control" name="file_path" placeholder="uploads/certificates/BRV-2026-0001.pdf" required>
                        <div class="form-text">Saat ini masih manual (next: generate otomatis PDF).</div>
                    </div>
                </div>
                <div class="admin-panel-footer">
                    <button class="btn btn-primary" type="submit">Terbitkan</button>
                    <a class="btn btn-outline-secondary" href="<?= base_url('admin/certification') ?>">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-xl-7">
        <div class="admin-panel">
            <div class="admin-panel-header">
                <h3>Daftar Sertifikat</h3>
            </div>
            <div class="admin-panel-body p-0">
                <div class="table-responsive">
                    <table class="table admin-table mb-0">
                        <thead>
                            <tr>
                                <th>No Sertifikat</th>
                                <th>Peserta</th>
                                <th>Program</th>
                                <th>File</th>
                                <th>Terbit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($certificates)): ?>
                                <?php foreach ($certificates as $c): ?>
                                    <tr>
                                        <td class="fw-semibold"><code><?= html_escape($c->certificate_number) ?></code></td>
                                        <td>
                                            <div class="fw-semibold"><?= html_escape($c->user_name ?: '-') ?></div>
                                            <div class="text-muted small"><?= html_escape($c->user_email ?: '') ?></div>
                                        </td>
                                        <td><?= html_escape($c->training_title ?: '-') ?></td>
                                        <td class="text-muted small"><?= html_escape($c->file_path) ?></td>
                                        <td class="text-muted small"><?= html_escape(date('d M Y H:i', strtotime($c->issued_at))) ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-danger"
                                               href="<?= base_url('admin/certification/delete/' . $c->id) ?>"
                                               onclick="return confirm('Hapus sertifikat ini?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada sertifikat.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Manajemen Sertifikasi</h3>
    </div>
    <div class="admin-panel-body">
        <div class="alert alert-warning rounded-3 mb-0">
            Halaman ini sudah aktif. Berikutnya kita bisa isi fitur: template sertifikat, penerbitan sertifikat, dan validasi.
        </div>
    </div>
</div>

