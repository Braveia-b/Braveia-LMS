<?php
$page_title = 'Dashboard';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Dashboard'],
];
$this->load->view('admin/layout/_page_header');

$range = (int)($range ?? 30);
$kpis = $kpis ?? [];
$format_rp = function ($amount) {
    return 'Rp ' . number_format((float)$amount, 0, ',', '.');
};

$badge_for_payment_status = function ($status) {
    if ($status === 'Success') return '<span class="badge bg-success">Success</span>';
    if ($status === 'Pending') return '<span class="badge bg-warning text-dark">Pending</span>';
    if ($status === 'Failed') return '<span class="badge bg-danger">Failed</span>';
    if ($status === 'Expired') return '<span class="badge bg-secondary">Expired</span>';
    return '<span class="badge bg-light text-dark border">' . html_escape($status) . '</span>';
};

$spark_values = array_map(function ($r) { return (int)($r['count'] ?? 0); }, $ts_payments ?? []);
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

$range_url = function ($days) use ($range) {
    return base_url('admin/dashboard?range=' . $days);
};
?>

<!-- Filter periode + quick actions -->
<div class="admin-panel mb-4">
    <div class="admin-panel-body py-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="text-muted small me-1">Periode:</span>
                <div class="btn-group btn-group-sm" role="group">
                    <a href="<?= $range_url(7) ?>" class="btn <?= $range === 7 ? 'btn-primary' : 'btn-outline-secondary' ?>">7 hari</a>
                    <a href="<?= $range_url(30) ?>" class="btn <?= $range === 30 ? 'btn-primary' : 'btn-outline-secondary' ?>">30 hari</a>
                    <a href="<?= $range_url(90) ?>" class="btn <?= $range === 90 ? 'btn-primary' : 'btn-outline-secondary' ?>">90 hari</a>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 admin-quick-actions">
                <a href="<?= base_url('admin/training/add') ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Program</a>
                <a href="<?= base_url('admin/webinar/add') ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-video me-1"></i> Webinar</a>
                <a href="<?= base_url('admin/mentor/add') ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-user-plus me-1"></i> Mentor</a>
                <a href="<?= base_url('admin/certification') ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-certificate me-1"></i> Sertifikat</a>
                <a href="<?= base_url('admin/transaction') ?>" class="btn btn-sm btn-outline-secondary"><i class="fas fa-receipt me-1"></i> Transaksi</a>
            </div>
        </div>
    </div>
</div>

<!-- KPI cards -->
<div class="row g-3 g-xl-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon gold"><i class="fas fa-users"></i></div>
            <div>
                <div class="admin-stat-value"><?= number_format((int)($kpis['participants_active'] ?? 0), 0, ',', '.') ?></div>
                <p class="admin-stat-label mb-0">Peserta Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon dark"><i class="fas fa-user-graduate"></i></div>
            <div>
                <div class="admin-stat-value"><?= number_format((int)($kpis['enrollments_period'] ?? 0), 0, ',', '.') ?></div>
                <p class="admin-stat-label mb-0">Enrollment (<?= $range ?> hari)</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon gold"><i class="fas fa-book-open"></i></div>
            <div>
                <div class="admin-stat-value"><?= number_format((int)($kpis['trainings_published'] ?? 0), 0, ',', '.') ?></div>
                <p class="admin-stat-label mb-0">Program Published</p>
                <?php if ((int)($kpis['trainings_draft'] ?? 0) > 0): ?>
                    <p class="small text-warning mb-0"><?= (int)$kpis['trainings_draft'] ?> draft</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card">
            <div class="admin-stat-icon dark"><i class="fas fa-coins"></i></div>
            <div>
                <div class="admin-stat-value" style="font-size: 1.2rem;"><?= $format_rp($kpis['revenue_period'] ?? 0) ?></div>
                <p class="admin-stat-label mb-0">Pendapatan (<?= $range ?> hari)</p>
                <p class="small text-muted mb-0">Hari ini: <?= $format_rp($kpis['revenue_today'] ?? 0) ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Secondary KPI row -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="admin-mini-stat">
            <span class="text-muted small">Mentor</span>
            <strong><?= (int)($kpis['mentors_total'] ?? 0) ?></strong>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="admin-mini-stat">
            <span class="text-muted small">Webinar mendatang</span>
            <strong><?= (int)($kpis['webinars_upcoming'] ?? 0) ?></strong>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="admin-mini-stat">
            <span class="text-muted small">Transaksi pending</span>
            <strong class="<?= ((int)($kpis['payments_pending'] ?? 0) > 0) ? 'text-warning' : '' ?>"><?= (int)($kpis['payments_pending'] ?? 0) ?></strong>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="admin-mini-stat">
            <span class="text-muted small">Pendapatan bulan ini</span>
            <strong><?= $format_rp($kpis['revenue_month'] ?? 0) ?></strong>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Perlu tindakan -->
    <div class="col-xl-4">
        <div class="admin-panel h-100">
            <div class="admin-panel-header">
                <h3><i class="fas fa-bell text-warning me-2"></i> Perlu Tindakan</h3>
            </div>
            <div class="admin-panel-body">
                <?php if (!empty($attention_items)): ?>
                    <?php foreach ($attention_items as $block): ?>
                        <div class="admin-attention-block mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <a href="<?= html_escape($block['url']) ?>" class="fw-semibold text-decoration-none">
                                    <i class="fas <?= html_escape($block['icon']) ?> me-1 text-primary"></i>
                                    <?= html_escape($block['title']) ?>
                                </a>
                                <span class="badge bg-warning text-dark"><?= (int)$block['count'] ?></span>
                            </div>
                            <ul class="list-unstyled small mb-0 ps-1">
                                <?php foreach (($block['rows'] ?? []) as $row): ?>
                                    <li class="text-muted py-1 border-bottom border-light">
                                        <?php if ($block['type'] === 'pending_payments'): ?>
                                            <code><?= html_escape($row->order_id ?: 'PAY-' . $row->id) ?></code>
                                            — <?= html_escape($row->user_name ?: '-') ?>
                                            <span class="float-end"><?= $format_rp($row->amount) ?></span>
                                        <?php elseif ($block['type'] === 'draft_trainings'): ?>
                                            <?= html_escape($row->title) ?>
                                        <?php elseif ($block['type'] === 'inactive_mentors'): ?>
                                            <?= html_escape($row->name) ?>
                                        <?php elseif ($block['type'] === 'upcoming_webinars'): ?>
                                            <?= html_escape($row->title) ?>
                                            <span class="float-end"><?= date('d M H:i', strtotime($row->schedule_datetime)) ?></span>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted small mb-0"><i class="fas fa-check-circle text-success me-1"></i> Tidak ada item yang perlu ditindaklanjuti.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Grafik ringkas -->
    <div class="col-xl-4">
        <div class="admin-panel mb-4">
            <div class="admin-panel-header">
                <h3>Tren Pembayaran Sukses</h3>
            </div>
            <div class="admin-panel-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Total transaksi</span>
                    <strong><?= array_sum($spark_values) ?></strong>
                </div>
                <?php if (!empty($spark_polyline)): ?>
                    <svg width="100%" viewBox="0 0 <?= $w ?> <?= $h ?>" preserveAspectRatio="none" class="admin-sparkline">
                        <polyline fill="none" stroke="rgba(197,160,40,0.35)" stroke-width="2" points="<?= $spark_polyline ?>"></polyline>
                        <polyline fill="none" stroke="#c5a028" stroke-width="2.5" stroke-linecap="round" points="<?= $spark_polyline ?>"></polyline>
                    </svg>
                <?php else: ?>
                    <p class="text-muted small">Belum ada data pembayaran sukses.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="admin-panel">
            <div class="admin-panel-header">
                <h3>Program Terpopuler</h3>
                <span class="text-muted small"><?= $range ?> hari</span>
            </div>
            <div class="admin-panel-body">
                <?php if (!empty($top_programs)): ?>
                    <ol class="mb-0 ps-3">
                        <?php foreach ($top_programs as $tp): ?>
                            <li class="mb-2">
                                <span class="fw-semibold"><?= html_escape($tp->title) ?></span>
                                <span class="badge bg-primary ms-1"><?= (int)$tp->enroll_count ?> enroll</span>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                <?php else: ?>
                    <p class="text-muted small mb-0">Belum ada enrollment pada periode ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Peserta baru -->
    <div class="col-xl-4">
        <div class="admin-panel h-100">
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
                                    <div class="text-muted small"><?= date('d M Y', strtotime($u->created_at)) ?></div>
                                    <?= $u->is_active ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Nonaktif</span>' ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted small">Belum ada peserta.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Transaksi terbaru -->
<div class="admin-panel mt-4">
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
                                <td class="text-muted small"><?= date('d M Y H:i', strtotime($p->created_at)) ?></td>
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
