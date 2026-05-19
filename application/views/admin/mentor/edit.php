<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Mentor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/mentor') ?>">Mentor</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Mentor</h3>
                        </div>
                        <!-- form start -->
                        <form action="<?= base_url('admin/mentor/update/' . $mentor->id) ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" name="name" required value="<?= set_value('name', $mentor->name) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Alamat Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="<?= set_value('email', $mentor->email) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password (Biarkan kosong jika tidak diubah)</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password baru">
                                </div>
                                <div class="form-group">
                                    <label for="expertise">Keahlian (Expertise)</label>
                                    <input type="text" class="form-control" id="expertise" name="expertise" value="<?= set_value('expertise', $mentor->expertise) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="hourly_rate">Tarif per Jam (Rp)</label>
                                    <input type="number" class="form-control" id="hourly_rate" name="hourly_rate" value="<?= set_value('hourly_rate', $mentor->hourly_rate) ?>">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" <?= $mentor->is_active ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="is_active">Status Akun Aktif</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Mentor</button>
                                <a href="<?= base_url('admin/mentor') ?>" class="btn btn-default">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</div>
