<?php
$page_title = 'Edit Mentor';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Mentor', 'url' => base_url('admin/mentor')],
    ['label' => 'Edit'],
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
                <h3>Form Edit Mentor</h3>
            </div>
            <form action="<?= base_url('admin/mentor/update/' . $mentor->id) ?>" method="POST">
                <div class="admin-panel-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?= set_value('name', $mentor->name) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?= set_value('email', $mentor->email) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak diubah">
                    </div>
                    <div class="mb-3">
                        <label for="expertise" class="form-label">Keahlian</label>
                        <input type="text" class="form-control" id="expertise" name="expertise" value="<?= set_value('expertise', $mentor->expertise) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="hourly_rate" class="form-label">Tarif per Jam (Rp)</label>
                        <input type="number" class="form-control" id="hourly_rate" name="hourly_rate" value="<?= set_value('hourly_rate', $mentor->hourly_rate) ?>">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?= $mentor->is_active ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active">Status akun aktif</label>
                    </div>
                </div>
                <div class="admin-panel-footer">
                    <button type="submit" class="btn btn-primary">Update Mentor</button>
                    <a href="<?= base_url('admin/mentor') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
