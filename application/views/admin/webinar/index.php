<?php
$page_title = 'Event & Webinar';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Event & Webinar'],
];
$page_actions = '<a href="' . base_url('admin/webinar/add') . '" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i> Buat Webinar</a>';
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

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Manajemen Webinar</h3>
    </div>
    <div class="admin-panel-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Speaker</th>
                        <th>Jadwal</th>
                        <th>Harga</th>
                        <th>Kuota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($webinars)): ?>
                        <?php foreach ($webinars as $w): ?>
                            <tr>
                                <td class="fw-semibold"><?= html_escape($w->title) ?></td>
                                <td><?= html_escape($w->speaker_name ?: '-') ?></td>
                                <td class="text-muted small"><?= html_escape(date('d M Y H:i', strtotime($w->schedule_datetime))) ?></td>
                                <td class="fw-semibold">Rp <?= number_format((float)$w->price, 0, ',', '.') ?></td>
                                <td><?= (int)$w->quota ?></td>
                                <td>
                                    <a href="<?= base_url('admin/webinar/edit/' . $w->id) ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('admin/webinar/delete/' . $w->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus webinar ini?');"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada webinar.
                                <div class="mt-3">
                                    <a href="<?= base_url('admin/webinar/add') ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus me-1"></i> Buat Webinar Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

