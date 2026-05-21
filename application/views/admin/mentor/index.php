<?php
$page_title = 'Daftar Mentor';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Mentor'],
];
$page_actions = '<a href="' . base_url('admin/mentor/add') . '" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i> Tambah Mentor</a>';
$this->load->view('admin/layout/_page_header');
?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Mentor Terdaftar</h3>
    </div>
    <div class="admin-panel-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Keahlian</th>
                        <th>Tarif / Jam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($mentors)): ?>
                        <?php $no = 1; foreach ($mentors as $mentor): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-semibold"><?= html_escape($mentor->name) ?></td>
                                <td><?= html_escape($mentor->email) ?></td>
                                <td><?= html_escape($mentor->expertise) ?></td>
                                <td>Rp <?= number_format($mentor->hourly_rate, 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($mentor->is_active): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/mentor/edit/' . $mentor->id) ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('admin/mentor/delete/' . $mentor->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus mentor ini beserta akunnya?');"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data mentor.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
