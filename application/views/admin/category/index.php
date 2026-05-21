<?php
$page_title = 'Kategori Program';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Kategori Program'],
];
$page_actions = '<a href="' . base_url('admin/category/add') . '" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i> Tambah Kategori</a>';
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
        <h3>Daftar Kategori</h3>
    </div>
    <div class="admin-panel-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Ikon</th>
                        <th width="22%">Nama Kategori</th>
                        <th width="18%">Slug</th>
                        <th>Deskripsi</th>
                        <th width="14%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($categories)): ?>
                        <?php $no = 1; foreach ($categories as $cat): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="text-center">
                                    <?php if ($cat->icon): ?>
                                        <i class="<?= html_escape($cat->icon) ?> fa-lg text-primary"></i>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-semibold"><?= html_escape($cat->name) ?></td>
                                <td><code><?= html_escape($cat->slug) ?></code></td>
                                <td class="text-muted"><?= html_escape($cat->description) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/category/edit/' . $cat->id) ?>" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('admin/category/delete/' . $cat->id) ?>" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus kategori ini?');"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data kategori.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
