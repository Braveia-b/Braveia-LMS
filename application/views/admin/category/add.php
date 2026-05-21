<?php
$page_title = 'Tambah Kategori';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Kategori', 'url' => base_url('admin/category')],
    ['label' => 'Tambah'],
];
$this->load->view('admin/layout/_page_header');
?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger rounded-3"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger rounded-3"><?= validation_errors() ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <div class="admin-panel admin-form-panel">
            <div class="card-header-dark">
                <h3>Form Data Kategori</h3>
            </div>
            <form action="<?= base_url('admin/category/store') ?>" method="POST">
                <div class="admin-panel-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Misal: Web Development" required value="<?= set_value('name') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi singkat kategori"><?= set_value('description') ?></textarea>
                    </div>
                    <div class="mb-0">
                        <label for="icon" class="form-label">Class Ikon (FontAwesome)</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Misal: fas fa-laptop-code" value="<?= set_value('icon') ?>">
                        <div class="form-text">Opsional. Gunakan class Font Awesome 6.</div>
                    </div>
                </div>
                <div class="admin-panel-footer">
                    <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                    <a href="<?= base_url('admin/category') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
