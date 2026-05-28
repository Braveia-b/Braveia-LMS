<?php
$page_title = 'Pengaturan';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Pengaturan'],
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

<?php
$m = $settings_map ?? [];
$val = function ($k, $default = '') use ($m) {
    $v = $m[$k] ?? null;
    return ($v === null || $v === '') ? $default : $v;
};
?>

<div class="row g-4">
    <div class="col-xl-5">
        <div class="admin-panel admin-form-panel">
            <div class="card-header-dark">
                <h3>Pengaturan </h3>
            </div>
            <form action="<?= base_url('admin/settings/save_structured') ?>" method="POST">
                <div class="admin-panel-body">
                    <div class="accordion" id="settingsAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingProfile">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
                                    Profil Instansi
                                </button>
                            </h2>
                            <div id="collapseProfile" class="accordion-collapse collapse show" aria-labelledby="headingProfile" data-bs-parent="#settingsAccordion">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Instansi</label>
                                        <input class="form-control" name="site_name" value="<?= html_escape($val('site_name', 'Brave International Academy')) ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tagline</label>
                                        <input class="form-control" name="site_tagline" value="<?= html_escape($val('site_tagline')) ?>" placeholder="Contoh: Upgrade skill, bangun karir.">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Kontak</label>
                                        <input type="email" class="form-control" name="contact_email" value="<?= html_escape($val('contact_email')) ?>" placeholder="info@braveia.com">
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Telepon</label>
                                            <input class="form-control" name="contact_phone" value="<?= html_escape($val('contact_phone')) ?>" placeholder="08xxxx">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">WhatsApp</label>
                                            <input class="form-control" name="contact_whatsapp" value="<?= html_escape($val('contact_whatsapp')) ?>" placeholder="628xxxx">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" name="contact_address" rows="3" placeholder="Alamat lengkap..."><?= html_escape($val('contact_address')) ?></textarea>
                                    </div>
                                    <hr class="my-4">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Instagram</label>
                                            <input class="form-control" name="social_instagram" value="<?= html_escape($val('social_instagram')) ?>" placeholder="https://instagram.com/...">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">LinkedIn</label>
                                            <input class="form-control" name="social_linkedin" value="<?= html_escape($val('social_linkedin')) ?>" placeholder="https://linkedin.com/...">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">YouTube</label>
                                            <input class="form-control" name="social_youtube" value="<?= html_escape($val('social_youtube')) ?>" placeholder="https://youtube.com/...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPayment">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayment" aria-expanded="false" aria-controls="collapsePayment">
                                    Pembayaran
                                </button>
                            </h2>
                            <div id="collapsePayment" class="accordion-collapse collapse" aria-labelledby="headingPayment" data-bs-parent="#settingsAccordion">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Gateway</label>
                                            <select class="form-select" name="payment_gateway">
                                                <?php $pg = $val('payment_gateway', 'midtrans'); ?>
                                                <option value="midtrans" <?= $pg === 'midtrans' ? 'selected' : '' ?>>Midtrans</option>
                                                <option value="manual" <?= $pg === 'manual' ? 'selected' : '' ?>>Manual</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Mode</label>
                                            <?php $pm = $val('payment_mode', 'sandbox'); ?>
                                            <select class="form-select" name="payment_mode">
                                                <option value="sandbox" <?= $pm === 'sandbox' ? 'selected' : '' ?>>Sandbox</option>
                                                <option value="production" <?= $pm === 'production' ? 'selected' : '' ?>>Production</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label class="form-label">Midtrans Server Key</label>
                                        <input class="form-control" name="midtrans_server_key" type="password" placeholder="Kosongkan jika tidak diubah">
                                        <div class="form-text">Demi keamanan, value tidak ditampilkan. Kosongkan jika tidak ingin mengganti.</div>
                                    </div>
                                    <div class="mt-3">
                                        <label class="form-label">Midtrans Client Key</label>
                                        <input class="form-control" name="midtrans_client_key" type="password" placeholder="Kosongkan jika tidak diubah">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEmail">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEmail" aria-expanded="false" aria-controls="collapseEmail">
                                    Email (SMTP)
                                </button>
                            </h2>
                            <div id="collapseEmail" class="accordion-collapse collapse" aria-labelledby="headingEmail" data-bs-parent="#settingsAccordion">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <div class="col-md-8">
                                            <label class="form-label">SMTP Host</label>
                                            <input class="form-control" name="smtp_host" value="<?= html_escape($val('smtp_host')) ?>" placeholder="smtp.gmail.com">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">SMTP Port</label>
                                            <input class="form-control" name="smtp_port" value="<?= html_escape($val('smtp_port', '587')) ?>" placeholder="587">
                                        </div>
                                    </div>
                                    <div class="row g-3 mt-0">
                                        <div class="col-md-6">
                                            <label class="form-label">SMTP User</label>
                                            <input class="form-control" name="smtp_user" value="<?= html_escape($val('smtp_user')) ?>" placeholder="email@domain.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">SMTP Password</label>
                                            <input class="form-control" name="smtp_pass" type="password" placeholder="Kosongkan jika tidak diubah">
                                        </div>
                                    </div>
                                    <div class="row g-3 mt-0">
                                        <div class="col-md-6">
                                            <label class="form-label">From Name</label>
                                            <input class="form-control" name="smtp_from_name" value="<?= html_escape($val('smtp_from_name', 'Brave International Academy')) ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">From Email</label>
                                            <input class="form-control" name="smtp_from_email" value="<?= html_escape($val('smtp_from_email')) ?>" placeholder="noreply@domain.com">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-panel-footer">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <a class="btn btn-outline-secondary" href="<?= base_url('admin/settings') ?>">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-xl-7">
        <div class="admin-panel">
            <div class="admin-panel-header">
                <h3>Daftar Pengaturan (Internal)</h3>
            </div>
            <div class="admin-panel-body p-0">
                <div class="table-responsive">
                    <table class="table admin-table mb-0">
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Update</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($settings_all)): ?>
                                <?php foreach ($settings_all as $s): ?>
                                    <tr>
                                        <td class="fw-semibold"><code><?= html_escape($s->key_name) ?></code></td>
                                        <td class="text-muted small" style="max-width: 420px;">
                                            <?= html_escape(mb_strimwidth((string)$s->value, 0, 180, '…')) ?>
                                        </td>
                                        <td class="text-muted small"><?= html_escape(date('d M Y H:i', strtotime($s->updated_at))) ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-danger"
                                               href="<?= base_url('admin/settings/delete/' . $s->id) ?>"
                                               onclick="return confirm('Hapus pengaturan ini?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center text-muted py-4">Belum ada pengaturan.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

