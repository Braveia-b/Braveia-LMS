<?php
$page_title = 'Pengaturan';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Pengaturan'],
];
$this->load->view('admin/layout/_page_header');
?>

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Pengaturan Sistem</h3>
    </div>
    <div class="admin-panel-body">
        <div class="alert alert-warning rounded-3 mb-0">
            Halaman ini sudah aktif. Berikutnya kita bisa isi konfigurasi: profil instansi, pembayaran, notifikasi, dan keamanan.
        </div>
    </div>
</div>

