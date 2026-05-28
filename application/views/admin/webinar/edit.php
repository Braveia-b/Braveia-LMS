<?php
$page_title = 'Edit Webinar';
$breadcrumbs = [
    ['label' => 'Beranda', 'url' => base_url('admin/dashboard')],
    ['label' => 'Webinar', 'url' => base_url('admin/webinar')],
    ['label' => 'Edit'],
];
$this->load->view('admin/layout/_page_header');

$w = $webinar ?? null;
?>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger rounded-3"><?= validation_errors() ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <div class="admin-panel admin-form-panel">
            <div class="card-header-dark">
                <h3>Form Edit Webinar</h3>
            </div>
            <form action="<?= base_url('admin/webinar/update/' . ($w->id ?? 0)) ?>" method="POST">
                <div class="admin-panel-body">
                    <div class="mb-3">
                        <label class="form-label" for="title">Judul</label>
                        <input class="form-control" id="title" name="title" value="<?= set_value('title', $w->title ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="speaker_id">Speaker</label>
                        <select class="form-select" id="speaker_id" name="speaker_id" required>
                            <option value="">Pilih speaker</option>
                            <?php foreach (($speakers ?? []) as $s): ?>
                                <?php $selected = set_value('speaker_id', $w->speaker_id ?? '') == $s->id; ?>
                                <option value="<?= (int)$s->id ?>" <?= $selected ? 'selected' : '' ?>><?= html_escape($s->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="schedule_datetime">Jadwal</label>
                        <?php
                        $dt = $w->schedule_datetime ?? '';
                        $dt_value = $dt ? date('Y-m-d\\TH:i', strtotime($dt)) : '';
                        ?>
                        <input type="datetime-local" class="form-control" id="schedule_datetime" name="schedule_datetime" value="<?= set_value('schedule_datetime', $dt_value) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="zoom_link">Zoom Link</label>
                        <input class="form-control" id="zoom_link" name="zoom_link" value="<?= set_value('zoom_link', $w->zoom_link ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="thumbnail">Thumbnail (URL / path)</label>
                        <input class="form-control" id="thumbnail" name="thumbnail" value="<?= set_value('thumbnail', $w->thumbnail ?? '') ?>">
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="price">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?= set_value('price', $w->price ?? 0) ?>" min="0" step="1">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="quota">Kuota</label>
                            <input type="number" class="form-control" id="quota" name="quota" value="<?= set_value('quota', $w->quota ?? 100) ?>" min="1" step="1">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label" for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="4"><?= set_value('description', $w->description ?? '') ?></textarea>
                    </div>
                </div>
                <div class="admin-panel-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('admin/webinar') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

