  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
      <span class="brand-text font-weight-light pl-3 fw-bold">Braveia Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?= $this->session->userdata('name') ?></a>
          <small class="text-success"><?= $this->session->userdata('role_name') ?></small>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="<?= base_url('admin/dashboard') ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <li class="nav-header">MANAJEMEN KELAS</li>
          <li class="nav-item">
            <a href="<?= base_url('admin/training') ?>" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Program Pelatihan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/category') ?>" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>Kategori Program</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-certificate"></i>
              <p>Sertifikasi</p>
            </a>
          </li>

          <li class="nav-header">MANAJEMEN WEBINAR</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-video"></i>
              <p>Event & Webinar</p>
            </a>
          </li>

          <li class="nav-header">PENGGUNA</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Peserta</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/mentor') ?>" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>Mentor</p>
            </a>
          </li>

          <li class="nav-header">SISTEM</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>Transaksi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Pengaturan</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
