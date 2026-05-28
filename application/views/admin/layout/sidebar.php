<?php
$uri = $this->uri->uri_string();
$nav_active = function ($segment) use ($uri) {
    if ($uri === 'admin/' . $segment) return 'active';
    if (strpos($uri, 'admin/' . $segment . '/') === 0) return 'active';
    return '';
};
?>
<aside class="admin-sidebar" id="adminSidebar">
    <div class="admin-sidebar-brand">
        <a href="<?= base_url('admin/dashboard') ?>">
            <?php $logo_class = 'braveia-logo-admin'; $this->load->view('layout/_logo'); ?>
        </a>
    </div>

    <div class="admin-sidebar-user">
        <div class="user-name"><?= html_escape($this->session->userdata('name')) ?></div>
        <div class="user-role"><?= html_escape($this->session->userdata('role_name')) ?></div>
    </div>

    <nav class="admin-nav">
        <div class="admin-nav-section">Utama</div>
        <a href="<?= base_url('admin/dashboard') ?>" class="admin-nav-link <?= $nav_active('dashboard') ?>">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <div class="admin-nav-section">Manajemen Kelas</div>
        <a href="<?= base_url('admin/training') ?>" class="admin-nav-link <?= $nav_active('training') ?>">
            <i class="fas fa-graduation-cap"></i>
            <span>Program Pelatihan</span>
        </a>
        <a href="<?= base_url('admin/category') ?>" class="admin-nav-link <?= $nav_active('category') ?>">
            <i class="fas fa-tags"></i>
            <span>Kategori Program</span>
        </a>
        <a href="<?= base_url('admin/certification') ?>" class="admin-nav-link <?= $nav_active('certification') ?>">
            <i class="fas fa-certificate"></i>
            <span>Sertifikasi</span>
        </a>

        <div class="admin-nav-section">Webinar</div>
        <a href="<?= base_url('admin/webinar') ?>" class="admin-nav-link <?= $nav_active('webinar') ?>">
            <i class="fas fa-video"></i>
            <span>Event & Webinar</span>
        </a>

        <div class="admin-nav-section">Pengguna</div>
        <a href="<?= base_url('admin/participant') ?>" class="admin-nav-link <?= $nav_active('participant') ?>">
            <i class="fas fa-users"></i>
            <span>Peserta</span>
        </a>
        <a href="<?= base_url('admin/mentor') ?>" class="admin-nav-link <?= $nav_active('mentor') ?>">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Mentor</span>
        </a>

        <div class="admin-nav-section">Sistem</div>
        <a href="<?= base_url('admin/transaction') ?>" class="admin-nav-link <?= $nav_active('transaction') ?>">
            <i class="fas fa-receipt"></i>
            <span>Transaksi</span>
        </a>
        <a href="<?= base_url('admin/settings') ?>" class="admin-nav-link <?= $nav_active('settings') ?>">
            <i class="fas fa-cog"></i>
            <span>Pengaturan</span>
        </a>
    </nav>

    <div class="admin-sidebar-footer">
        <a href="<?= base_url() ?>"><i class="fas fa-arrow-left me-1"></i> Kembali ke situs</a>
    </div>
</aside>
