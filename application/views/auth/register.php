<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary">Braveia.</h3>
                        <p class="text-muted">Mulai perjalanan karir Anda</p>
                    </div>

                    <form action="<?= base_url('auth/register') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control rounded-3 py-2" placeholder="Masukkan nama lengkap" value="<?= set_value('name') ?>">
                                <small class="text-danger"><?= form_error('name') ?></small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control rounded-3 py-2" placeholder="Masukkan email aktif" value="<?= set_value('email') ?>">
                            <small class="text-danger"><?= form_error('email') ?></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control rounded-3 py-2" placeholder="Minimal 6 karakter">
                            <small class="text-danger"><?= form_error('password') ?></small>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Daftar Sebagai</label>
                            <select name="role" class="form-select rounded-3 py-2">
                                <option value="peserta" <?= set_select('role', 'peserta') ?>>Peserta (Individu)</option>
                                <option value="corporate" <?= set_select('role', 'corporate') ?>>Corporate (Perusahaan)</option>
                            </select>
                            <small class="text-danger"><?= form_error('role') ?></small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold">Daftar Sekarang</button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="text-muted small">Sudah punya akun? <a href="<?= base_url('auth/login') ?>" class="text-primary fw-bold text-decoration-none">Masuk di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
