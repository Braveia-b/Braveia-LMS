<?php
$page_title = 'Edit Program';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Program Pelatihan', 'url' => base_url('admin/training')],
    ['label' => 'Edit'],
];
$this->load->view('admin/layout/_page_header');

$t = $training ?? null;
?>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger rounded-3"><?= validation_errors() ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <div class="admin-panel admin-form-panel">
            <div class="card-header-dark">
                <h3>Form Edit Program</h3>
            </div>
            <form action="<?= base_url('admin/training/update/' . ($t->id ?? 0)) ?>" method="POST">
                <div class="admin-panel-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Program</label>
                        <input class="form-control" name="title" value="<?= set_value('title', $t->title ?? '') ?>" required>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="category_id" required>
                                <option value="">Pilih kategori</option>
                                <?php foreach (($categories ?? []) as $c): ?>
                                    <?php $selected = set_value('category_id', $t->category_id ?? '') == $c->id; ?>
                                    <option value="<?= (int)$c->id ?>" <?= $selected ? 'selected' : '' ?>><?= html_escape($c->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mentor</label>
                            <select class="form-select" name="mentor_id" required>
                                <option value="">Pilih mentor</option>
                                <?php foreach (($mentors ?? []) as $m): ?>
                                    <?php $selected = set_value('mentor_id', $t->mentor_id ?? '') == $m->id; ?>
                                    <option value="<?= (int)$m->id ?>" <?= $selected ? 'selected' : '' ?>><?= html_escape($m->name) ?> (<?= html_escape($m->email) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-6">
                            <label class="form-label">Level</label>
                            <select class="form-select" name="level" required>
                                <?php foreach (['Beginner','Intermediate','Advanced','All Levels'] as $lv): ?>
                                    <?php $selected = set_value('level', $t->level ?? '') === $lv; ?>
                                    <option value="<?= $lv ?>" <?= $selected ? 'selected' : '' ?>><?= $lv ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" name="price" value="<?= set_value('price', $t->price ?? 0) ?>" min="0" step="1">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Thumbnail (URL/path)</label>
                        <input class="form-control" name="thumbnail" value="<?= set_value('thumbnail', $t->thumbnail ?? '') ?>" placeholder="uploads/trainings/xxx.jpg">
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" rows="5"><?= set_value('description', $t->description ?? '') ?></textarea>
                    </div>

                    <?php $published = (int)set_value('is_published', (int)($t->is_published ?? 0)) === 1; ?>
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" <?= $published ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>
                <div class="admin-panel-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('admin/training') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

