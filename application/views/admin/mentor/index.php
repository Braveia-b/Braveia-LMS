<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Mentor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Mentor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Mentor Terdaftar</h3>
                    <div class="card-tools">
                        <a href="<?= base_url('admin/mentor/add') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Mentor Baru
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Keahlian</th>
                                <th>Tarif / Jam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($mentors)): ?>
                                <?php $no=1; foreach($mentors as $mentor): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= html_escape($mentor->name) ?></td>
                                        <td><?= html_escape($mentor->email) ?></td>
                                        <td><?= html_escape($mentor->expertise) ?></td>
                                        <td>Rp <?= number_format($mentor->hourly_rate, 0, ',', '.') ?></td>
                                        <td>
                                            <?php if($mentor->is_active): ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Nonaktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/mentor/edit/' . $mentor->id) ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('admin/mentor/delete/' . $mentor->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus mentor ini beserta akunnya?');"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data mentor.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
