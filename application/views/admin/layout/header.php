<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? html_escape($title) : 'Panel Admin — Brave International Academy' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/braveia-theme.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/braveia-admin.css') ?>">
</head>
<body class="admin-body">

<div class="admin-sidebar-overlay" id="adminSidebarOverlay" aria-hidden="true"></div>

<div class="admin-app" id="adminApp">
    <?php $this->load->view('admin/layout/sidebar'); ?>

    <div class="admin-shell">
        <header class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button type="button" class="admin-sidebar-toggle" id="adminSidebarToggle" aria-label="Buka menu">
                    <i class="fas fa-bars"></i>
                </button>
                <p class="admin-topbar-title mb-0 d-none d-sm-block">Panel Administrasi</p>
            </div>
            <div class="admin-topbar-actions">
                <a href="<?= base_url() ?>" class="btn-link-site d-none d-md-inline">
                    <i class="fas fa-external-link-alt me-1"></i> Lihat Website
                </a>
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-sign-out-alt me-1"></i> Keluar
                </a>
            </div>
        </header>

        <main class="admin-main">
