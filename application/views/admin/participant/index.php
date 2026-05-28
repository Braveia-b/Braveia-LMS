<?php
$page_title = 'Peserta';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Peserta'],
];
$this->load->view('admin/layout/_page_header');
?>

<?php
$filters = $filters ?? [];
$participants = $participants ?? [];
$page = (int)($page ?? 1);
$per_page = (int)($per_page ?? 15);
$total = (int)($total ?? 0);
$pages = max(1, (int)ceil($total / max(1, $per_page)));

$query_base = $filters;
unset($query_base['page']);
$build_url = function ($page_num) use ($query_base) {
    return base_url('admin/participant') . '?' . http_build_query(array_merge($query_base, ['page' => $page_num]));
};
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

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Manajemen Peserta</h3>
    </div>
    <div class="admin-panel-body">
        <form class="row g-3 align-items-end mb-3" method="get" action="<?= base_url('admin/participant') ?>">
            <div class="col-md-6">
                <label class="form-label">Cari</label>
                <input type="text" class="form-control" name="q" placeholder="Nama / email" value="<?= html_escape($filters['q'] ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="">Semua</option>
                    <option value="active" <?= (($filters['status'] ?? '') === 'active') ? 'selected' : '' ?>>Aktif</option>
                    <option value="inactive" <?= (($filters['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Nonaktif</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary w-100" type="submit"><i class="fas fa-search me-1"></i> Filter</button>
                <a class="btn btn-outline-secondary w-100" href="<?= base_url('admin/participant') ?>">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Status</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($participants)): ?>
                        <?php foreach ($participants as $u): ?>
                            <tr>
                                <td><code><?= (int)$u->id ?></code></td>
                                <td class="fw-semibold"><?= html_escape($u->name) ?></td>
                                <td><?= html_escape($u->email) ?></td>
                                <td><?= html_escape($u->phone ?: '-') ?></td>
                                <td>
                                    <?= $u->is_active ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Nonaktif</span>' ?>
                                </td>
                                <td class="text-muted small"><?= html_escape(date('d M Y', strtotime($u->created_at))) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/participant/toggle/' . $u->id) ?>"
                                       class="btn btn-sm <?= $u->is_active ? 'btn-outline-danger' : 'btn-outline-success' ?>"
                                       onclick="return confirm('Yakin ingin mengubah status peserta ini?');">
                                        <?= $u->is_active ? 'Nonaktifkan' : 'Aktifkan' ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada data peserta.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3">
            <div class="text-muted small">
                Menampilkan <?= number_format(min($total, (($page - 1) * $per_page) + count($participants)), 0, ',', '.') ?>
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

