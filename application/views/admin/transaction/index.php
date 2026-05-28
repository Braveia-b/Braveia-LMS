<?php
$page_title = 'Transaksi';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Transaksi'],
];
$this->load->view('admin/layout/_page_header');
?>

<?php
$filters = $filters ?? [];
$payments = $payments ?? [];
$page = (int)($page ?? 1);
$per_page = (int)($per_page ?? 15);
$total = (int)($total ?? 0);
$pages = max(1, (int)ceil($total / max(1, $per_page)));

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

$query_base = $filters;
unset($query_base['page']);
$build_url = function ($page_num) use ($query_base) {
    return base_url('admin/transaction') . '?' . http_build_query(array_merge($query_base, ['page' => $page_num]));
};
?>

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Manajemen Transaksi</h3>
    </div>
    <div class="admin-panel-body">
        <form class="row g-3 align-items-end mb-3" method="get" action="<?= base_url('admin/transaction') ?>">
            <div class="col-md-4">
                <label class="form-label">Cari</label>
                <input type="text" class="form-control" name="q" placeholder="Order ID / nama / email" value="<?= html_escape($filters['q'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="">Semua</option>
                    <?php foreach (['Pending','Success','Failed','Expired'] as $s): ?>
                        <option value="<?= $s ?>" <?= (($filters['status'] ?? '') === $s) ? 'selected' : '' ?>><?= $s ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Item</label>
                <select class="form-select" name="item_type">
                    <option value="">Semua</option>
                    <?php foreach (['Training','Webinar','Mentoring'] as $t): ?>
                        <option value="<?= $t ?>" <?= (($filters['item_type'] ?? '') === $t) ? 'selected' : '' ?>><?= $t ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Dari</label>
                <input type="date" class="form-control" name="date_from" value="<?= html_escape($filters['date_from'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">Sampai</label>
                <input type="date" class="form-control" name="date_to" value="<?= html_escape($filters['date_to'] ?? '') ?>">
            </div>
            <div class="col-12 d-flex gap-2">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search me-1"></i> Filter</button>
                <a class="btn btn-outline-secondary" href="<?= base_url('admin/transaction') ?>">Reset</a>
            </div>
        </form>

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
                    <?php if (!empty($payments)): ?>
                        <?php foreach ($payments as $p): ?>
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
                        <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada transaksi.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3">
            <div class="text-muted small">
                Menampilkan <?= number_format(min($total, (($page - 1) * $per_page) + count($payments)), 0, ',', '.') ?>
                dari <?= number_format($total, 0, ',', '.') ?> data
            </div>

            <?php if ($pages > 1): ?>
                <nav aria-label="Pagination">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= $build_url(max(1, $page - 1)) ?>">Prev</a>
                        </li>
                        <?php
                        $start = max(1, $page - 2);
                        $end = min($pages, $page + 2);
                        for ($i = $start; $i <= $end; $i++):
                        ?>
                            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                <a class="page-link" href="<?= $build_url($i) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= $build_url(min($pages, $page + 1)) ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

