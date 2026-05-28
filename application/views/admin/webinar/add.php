<?php
$page_title = 'Buat Webinar';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Webinar', 'url' => base_url('admin/webinar')],
    ['label' => 'Buat'],
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
                <h3>Form Webinar</h3>
            </div>
            <form action="<?= base_url('admin/webinar/store') ?>" method="POST">
                <div class="admin-panel-body">
                    <div class="mb-3">
                        <label class="form-label" for="title">Judul</label>
                        <input class="form-control" id="title" name="title" value="<?= set_value('title') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="speaker_id">Speaker</label>
                        <select class="form-select" id="speaker_id" name="speaker_id" required>
                            <option value="">Pilih speaker</option>
                            <?php foreach (($speakers ?? []) as $s): ?>
                                <option value="<?= (int)$s->id ?>" <?= set_select('speaker_id', $s->id) ?>><?= html_escape($s->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="schedule_datetime">Jadwal</label>
                        <input type="datetime-local" class="form-control" id="schedule_datetime" name="schedule_datetime" value="<?= set_value('schedule_datetime') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="zoom_link">Zoom Link</label>
                        <input class="form-control" id="zoom_link" name="zoom_link" value="<?= set_value('zoom_link') ?>" placeholder="https://...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="thumbnail">Thumbnail (URL / path)</label>
                        <input class="form-control" id="thumbnail" name="thumbnail" value="<?= set_value('thumbnail') ?>" placeholder="uploads/webinars/xxx.jpg">
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="price">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?= set_value('price') ?>" min="0" step="1">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="quota">Kuota</label>
                            <input type="number" class="form-control" id="quota" name="quota" value="<?= set_value('quota') ?: 100 ?>" min="1" step="1">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label" for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="4"><?= set_value('description') ?></textarea>
                    </div>
                </div>
                <div class="admin-panel-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('admin/webinar') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

