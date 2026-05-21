<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Brave International Academy' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/braveia-theme.css') ?>">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-braveia sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center py-1" href="<?= base_url() ?>">
      <?php $logo_class = 'braveia-logo'; $this->load->view('layout/_logo'); ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
        <?php if($this->session->userdata('is_logged_in')): ?>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('program') ?>">Semua Program</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('courses') ?>">Program</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('webinar') ?>">Webinar</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('mentor') ?>">Mentor</a></li>
        <?php endif; ?>
        
        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
            <?php if($this->session->userdata('is_logged_in')): ?>
                <a class="btn btn-outline-light btn-sm me-2" href="<?= base_url('auth/logout') ?>">Logout</a>
            <?php else: ?>
                <a class="btn btn-outline-primary btn-sm me-2" href="<?= base_url('auth/login') ?>">Masuk</a>
                <a class="btn btn-primary btn-sm" href="<?= base_url('auth/register') ?>">Daftar</a>
            <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
