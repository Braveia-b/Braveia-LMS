<?php
$page_title = 'Tambah Mentor';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Mentor', 'url' => base_url('admin/mentor')],
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
                <h3>Form Data Mentor</h3>
            </div>
            <form action="<?= base_url('admin/mentor/store') ?>" method="POST">
                <div class="admin-panel-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required value="<?= set_value('name') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required value="<?= set_value('email') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="mb-3">
                        <label for="expertise" class="form-label">Keahlian</label>
                        <input type="text" class="form-control" id="expertise" name="expertise" placeholder="Contoh: Web Development" value="<?= set_value('expertise') ?>">
                    </div>
                    <div class="mb-0">
                        <label for="hourly_rate" class="form-label">Tarif per Jam (Rp)</label>
                        <input type="number" class="form-control" id="hourly_rate" name="hourly_rate" placeholder="150000" value="<?= set_value('hourly_rate') ?>">
                    </div>
                </div>
                <div class="admin-panel-footer">
                    <button type="submit" class="btn btn-primary">Simpan Mentor</button>
                    <a href="<?= base_url('admin/mentor') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
