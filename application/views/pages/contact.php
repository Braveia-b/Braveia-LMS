<?php
$s = isset($settings) ? $settings : [];
$site = $s['site_name'] ?? 'Brave International Academy';
$email = $s['contact_email'] ?? 'info@braveia.com';
$phone = $s['contact_phone'] ?? '';
$wa = $s['contact_whatsapp'] ?? '';
$address = $s['contact_address'] ?? '';
?>
<section class="py-5 bg-white">
    <div class="container py-4 col-lg-8 mx-auto">
        <h1 class="fw-bold font-serif mb-4"><?= html_escape($page_heading) ?></h1>
        <p class="text-muted">Tim <?= html_escape($site) ?> siap membantu pertanyaan seputar pendaftaran, program, dan kerja sama.</p>
        <div class="card course-card border-0 shadow-sm p-4 mt-4">
            <ul class="list-unstyled mb-0">
                <li class="mb-3"><i class="fas fa-envelope text-primary me-2"></i><a href="mailto:<?= html_escape($email) ?>"><?= html_escape($email) ?></a></li>
                <?php if ($phone): ?>
                <li class="mb-3"><i class="fas fa-phone text-primary me-2"></i><?= html_escape($phone) ?></li>
                <?php endif; ?>
                <?php if ($wa): ?>
                <li class="mb-3"><i class="fab fa-whatsapp text-primary me-2"></i><a href="https://wa.me/<?= preg_replace('/\D/', '', $wa) ?>" target="_blank" rel="noopener">WhatsApp</a></li>
                <?php endif; ?>
                <?php if ($address): ?>
                <li><i class="fas fa-map-marker-alt text-primary me-2"></i><?= nl2br(html_escape($address)) ?></li>
                <?php endif; ?>
            </ul>
        </div>
        <p class="mt-4 small text-muted">Atau daftar langsung untuk mulai belajar: <a href="<?= base_url('auth/register') ?>">Buat akun peserta</a></p>
    </div>
</section>
