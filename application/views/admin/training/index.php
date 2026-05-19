  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manajemen Pelatihan</h1>
          </div>
          <div class="col-sm-6 text-right">
              <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Program Baru</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Program</th>
                            <th>Kategori</th>
                            <th>Mentor</th>
                            <th>Level</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($trainings)): ?>
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data pelatihan.</td>
                        </tr>
                        <?php else: ?>
                            <?php $no=1; foreach($trainings as $t): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $t->title ?></td>
                                <td><?= $t->category_name ?></td>
                                <td><?= $t->mentor_name ?></td>
                                <td><?= $t->level ?></td>
                                <td>Rp <?= number_format($t->price, 0, ',', '.') ?></td>
                                <td>
                                    <?php if($t->is_published): ?>
                                        <span class="badge badge-success">Published</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </section>
  </div>
