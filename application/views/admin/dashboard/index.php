<?php
$page_title = 'Dashboard';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Dashboard'],
];
$this->load->view('admin/layout/_page_header');
?>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon gold"><i class="fas fa-users"></i></div>
            <div>
                <div class="admin-stat-value">150</div>
                <p class="admin-stat-label mb-0">Peserta Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon dark"><i class="fas fa-chart-pie"></i></div>
            <div>
                <div class="admin-stat-value">53%</div>
                <p class="admin-stat-label mb-0">Tingkat Kelulusan</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon gold"><i class="fas fa-book-open"></i></div>
            <div>
                <div class="admin-stat-value">44</div>
                <p class="admin-stat-label mb-0">Total Kelas</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon dark"><i class="fas fa-coins"></i></div>
            <div>
                <div class="admin-stat-value" style="font-size: 1.35rem;">Rp 25M</div>
                <p class="admin-stat-label mb-0">Total Pendapatan</p>
            </div>
        </div>
    </div>
</div>

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Transaksi Terbaru</h3>
        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="admin-panel-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Peserta</th>
                        <th>Program</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>TRX-001</code></td>
                        <td>John Doe</td>
                        <td>Fullstack Developer</td>
                        <td>Rp 499.000</td>
                        <td><span class="badge bg-success">Sukses</span></td>
                    </tr>
                    <tr>
                        <td><code>TRX-002</code></td>
                        <td>Jane Smith</td>
                        <td>Data Science for Business</td>
                        <td>Rp 399.000</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
