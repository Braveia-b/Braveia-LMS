<?php
$page_title = 'Tambah Program';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Program Pelatihan', 'url' => base_url('admin/training')],
    ['label' => 'Tambah'],
];
$this->load->view('admin/layout/_page_header');
?>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger rounded-3"><?= validation_errors() ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <div class="admin-panel admin-form-panel">
            <div class="card-header-dark">
                <h3>Form Program</h3>
            </div>
            <form action="<?= base_url('admin/training/store') ?>" method="POST">
                <div class="admin-panel-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Program</label>
                        <input class="form-control" name="title" value="<?= set_value('title') ?>" required>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="category_id" required>
                                <option value="">Pilih kategori</option>
                                <?php foreach (($categories ?? []) as $c): ?>
                                    <option value="<?= (int)$c->id ?>" <?= set_select('category_id', $c->id) ?>><?= html_escape($c->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mentor</label>
                            <select class="form-select" name="mentor_id" required>
                                <option value="">Pilih mentor</option>
                                <?php foreach (($mentors ?? []) as $m): ?>
                                    <option value="<?= (int)$m->id ?>" <?= set_select('mentor_id', $m->id) ?>><?= html_escape($m->name) ?> (<?= html_escape($m->email) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-6">
                            <label class="form-label">Level</label>
                            <select class="form-select" name="level" required>
                                <?php foreach (['Beginner','Intermediate','Advanced','All Levels'] as $lv): ?>
                                    <option value="<?= $lv ?>" <?= set_select('level', $lv, $lv === 'Beginner') ?>><?= $lv ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" name="price" value="<?= set_value('price') ?>" min="0" step="1">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Thumbnail (URL/path)</label>
                        <input class="form-control" name="thumbnail" value="<?= set_value('thumbnail') ?>" placeholder="uploads/trainings/xxx.jpg">
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" rows="5"><?= set_value('description') ?></textarea>
                    </div>

                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" <?= set_checkbox('is_published', '1') ?>>
                        <label class="form-check-label" for="is_published">Publish sekarang</label>
                    </div>
                </div>
                <div class="admin-panel-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('admin/training') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

