<?php
$thumb = !empty($training->thumbnail)
    ? base_url('uploads/trainings/' . $training->thumbnail)
    : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop';
$price_label = ($training->price > 0)
    ? 'Rp ' . number_format($training->price, 0, ',', '.')
    : 'Gratis';
?>
<div class="col-md-4">
    <div class="card course-card h-100">
        <img src="<?= $thumb ?>" class="card-img-top" alt="<?= html_escape($training->title) ?>" style="height: 200px; object-fit: cover;">
        <div class="card-body d-flex flex-column">
            <span class="badge bg-primary bg-opacity-10 text-primary mb-2 align-self-start"><?= html_escape($training->category_name) ?></span>
            <h5 class="card-title fw-bold font-serif"><?= html_escape($training->title) ?></h5>
            <p class="card-text text-muted small"><?= word_limiter(strip_tags($training->description), 20) ?></p>
            <div class="mt-auto pt-3 d-flex justify-content-between align-items-center">
                <span class="fw-bold text-primary"><?= $price_label ?></span>
                <a href="<?= base_url('courses/detail/' . $training->id) ?>" class="btn btn-sm btn-outline-primary">Detail</a>
            </div>
        </div>
    </div>
</div>
