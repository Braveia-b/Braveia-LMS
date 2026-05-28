<?php
$page_title = 'Dashboard';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Dashboard'],
];
$page_actions =
    '<a href="' . base_url('admin/training') . '" class="btn btn-primary btn-sm me-2"><i class="fas fa-graduation-cap me-1"></i> Kelola Program</a>' .
    '<a href="' . base_url('admin/mentor/add') . '" class="btn btn-outline-primary btn-sm"><i class="fas fa-user-plus me-1"></i> Tambah Mentor</a>';
$this->load->view('admin/layout/_page_header');
?>

<?php
$kpis = $kpis ?? [];
$participants_active = (int)($kpis['participants_active'] ?? 0);
$mentors_total = (int)($kpis['mentors_total'] ?? 0);
$trainings_total = (int)($kpis['trainings_total'] ?? 0);
$enrollments_30d = (int)($kpis['enrollments_30d'] ?? 0);
$payments_pending = (int)($kpis['payments_pending'] ?? 0);
$revenue_30d_success = (float)($kpis['revenue_30d_success'] ?? 0);

$format_rp = function ($amount) {
    return 'Rp ' . number_format((float)$amount, 0, ',', '.');
};

$badge_for_payment_status = function ($status) {
    $s = strtolower((string)$status);
    if ($s === 'success') return '<span class="badge bg-success">Success</span>';
    if ($s === 'pending') return '<span class="badge bg-warning text-dark">Pending</span>';
    if ($s === 'failed') return '<span class="badge bg-danger">Failed</span>';
    if ($s === 'expired') return '<span class="badge bg-secondary">Expired</span>';
    return '<span class="badge bg-light text-dark border">' . html_escape($status) . '</span>';
};

$spark_values = array_map(function ($r) { return (int)($r['count'] ?? 0); }, $ts_payments_success ?? []);
$spark_max = max(1, ...($spark_values ?: [1]));
$spark_points = [];
$n = count($spark_values);
$w = 220;
$h = 44;
if ($n > 1) {
    for ($i = 0; $i < $n; $i++) {
        $x = (int)round(($i / ($n - 1)) * $w);
        $y = (int)round($h - (($spark_values[$i] / $spark_max) * $h));
        $spark_points[] = $x . ',' . $y;
    }
}
$spark_polyline = implode(' ', $spark_points);
?>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon gold"><i class="fas fa-users"></i></div>
            <div>
                <div class="admin-stat-value"><?= number_format($participants_active, 0, ',', '.') ?></div>
                <p class="admin-stat-label mb-0">Peserta Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon dark"><i class="fas fa-chalkboard-teacher"></i></div>
            <div>
                <div class="admin-stat-value"><?= number_format($mentors_total, 0, ',', '.') ?></div>
                <p class="admin-stat-label mb-0">Total Mentor</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon gold"><i class="fas fa-book-open"></i></div>
            <div>
                <div class="admin-stat-value"><?= number_format($trainings_total, 0, ',', '.') ?></div>
                <p class="admin-stat-label mb-0">Total Program</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon dark"><i class="fas fa-coins"></i></div>
            <div>
                <div class="admin-stat-value" style="font-size: 1.35rem;"><?= $format_rp($revenue_30d_success) ?></div>
                <p class="admin-stat-label mb-0">Pendapatan 30 Hari</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="admin-panel">
            <div class="admin-panel-header">
                <h3>Transaksi Terbaru</h3>
                <a href="<?= base_url('admin/transaction') ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="admin-panel-body p-0">
                <div class="table-responsive">
                    <table class="table admin-table mb-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Pengguna</th>
                                <th>Item</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_payments)): ?>
                                <?php foreach ($recent_payments as $p): ?>
                                    <tr>
                                        <td><code><?= html_escape($p->order_id ?: ('PAY-' . $p->id)) ?></code></td>
                                        <td>
                                            <div class="fw-semibold"><?= html_escape($p->user_name ?: '-') ?></div>
                                            <div class="text-muted small"><?= html_escape($p->user_email ?: '') ?></div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold"><?= html_escape($p->item_type) ?></div>
                                            <div class="text-muted small"><?= html_escape($p->item_title ?: ('ID: ' . $p->item_id)) ?></div>
                                        </td>
                                        <td class="fw-semibold"><?= $format_rp($p->amount) ?></td>
                                        <td><?= $badge_for_payment_status($p->status) ?></td>
                                        <td class="text-muted small"><?= html_escape(date('d M Y H:i', strtotime($p->created_at))) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada transaksi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="admin-panel mb-4">
            <div class="admin-panel-header">
                <h3>Ringkasan 30 Hari</h3>
            </div>
            <div class="admin-panel-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <div class="text-muted small">Enrollment (estimasi)</div>
                        <div class="fw-semibold"><?= number_format($enrollments_30d, 0, ',', '.') ?></div>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">Payment Pending</div>
                        <div class="fw-semibold"><?= number_format($payments_pending, 0, ',', '.') ?></div>
                    </div>
                </div>

                <div class="p-3 rounded-4 border" style="background: #fff;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Success Payments (14 hari)</div>
                            <div class="fw-semibold"><?= array_sum($spark_values) ?></div>
                        </div>
                        <div class="text-end">
                            <div class="text-muted small">Puncak harian</div>
                            <div class="fw-semibold"><?= $spark_max ?></div>
                        </div>
                    </div>
                    <div class="mt-2" aria-label="Sparkline">
                        <?php if (!empty($spark_polyline)): ?>
                            <svg width="100%" viewBox="0 0 <?= $w ?> <?= $h ?>" preserveAspectRatio="none" style="height: 44px;">
                                <polyline fill="none" stroke="rgba(197,160,40,0.35)" stroke-width="2" points="<?= $spark_polyline ?>"></polyline>
                                <polyline fill="none" stroke="#c5a028" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" points="<?= $spark_polyline ?>"></polyline>
                            </svg>
                        <?php else: ?>
                            <div class="text-muted small">Belum ada data.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-panel">
            <div class="admin-panel-header">
                <h3>Peserta Baru</h3>
                <a href="<?= base_url('admin/participant') ?>" class="btn btn-sm btn-outline-primary">Kelola</a>
            </div>
            <div class="admin-panel-body">
                <?php if (!empty($recent_participants)): ?>
                    <div class="vstack gap-3">
                        <?php foreach ($recent_participants as $u): ?>
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <div class="fw-semibold"><?= html_escape($u->name) ?></div>
                                    <div class="text-muted small"><?= html_escape($u->email) ?></div>
                                </div>
                                <div class="text-end">
                                    <div class="text-muted small"><?= html_escape(date('d M Y', strtotime($u->created_at))) ?></div>
                                    <?= $u->is_active ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Nonaktif</span>' ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-muted small">Belum ada peserta.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
