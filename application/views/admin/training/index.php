<?php
$page_title = 'Manajemen Pelatihan';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Program Pelatihan'],
];
$page_actions = '<a href="#" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i> Tambah Program</a>';
$this->load->view('admin/layout/_page_header');
?>

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Daftar Program</h3>
    </div>
    <div class="admin-panel-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Program</th>
                        <th>Kategori</th>
                        <th>Mentor</th>
                        <th>Level</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($trainings)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data pelatihan.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($trainings as $t): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-semibold"><?= html_escape($t->title) ?></td>
                                <td><?= html_escape($t->category_name) ?></td>
                                <td><?= html_escape($t->mentor_name) ?></td>
                                <td><span class="badge bg-light text-dark border"><?= html_escape($t->level) ?></span></td>
                                <td>Rp <?= number_format($t->price, 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($t->is_published): ?>
                                        <span class="badge bg-success">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
