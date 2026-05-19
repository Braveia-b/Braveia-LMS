<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Braveia LMS' ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd !important;
            font-size: 1.5rem;
        }
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            color: white;
            padding: 100px 0;
        }
        .hero-section h1 {
            font-weight: 700;
            font-size: 3rem;
        }
        .hero-section p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        .course-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .btn-primary {
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 500;
        }
        footer {
            background: #212529;
            color: #fff;
            padding: 40px 0;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url() ?>">Braveia.</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
        <?php if($this->session->userdata('is_logged_in')): ?>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('program') ?>">Semua Program</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('courses') ?>">Program</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('webinar') ?>">Webinar</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('mentor') ?>">Mentor</a></li>
        <?php endif; ?>
        
        <li class="nav-item ms-lg-3">
            <?php if($this->session->userdata('is_logged_in')): ?>
                <a class="btn btn-outline-danger me-2" href="<?= base_url('auth/logout') ?>">Logout</a>
            <?php else: ?>
                <a class="btn btn-outline-primary me-2" href="<?= base_url('auth/login') ?>">Masuk</a>
                <a class="btn btn-primary" href="<?= base_url('auth/register') ?>">Daftar</a>
            <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
