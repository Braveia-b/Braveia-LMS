<?php
$logo_class = isset($logo_class) ? $logo_class : 'braveia-logo';
$logo_alt = isset($logo_alt) ? $logo_alt : 'Brave International Academy';
?>
<img src="<?= base_url('assets/img/braveia-logo.png') ?>" alt="<?= html_escape($logo_alt) ?>" class="<?= html_escape($logo_class) ?>">
