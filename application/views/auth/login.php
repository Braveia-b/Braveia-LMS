<div class="auth-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow auth-card rounded-4 mt-3 overflow-hidden">
                    <div class="auth-card-header text-center">
                        <?php $logo_class = 'braveia-logo-lg'; $this->load->view('layout/_logo'); ?>
                        <p class="text-secondary small mb-0 mt-3">Masuk ke akun Anda</p>
                    </div>
                    <div class="card-body p-4 p-md-5">

                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger rounded-3"><?= $this->session->flashdata('error') ?></div>
                        <?php endif; ?>
                        
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success rounded-3"><?= $this->session->flashdata('success') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/login') ?>" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control rounded-3 py-2" placeholder="Masukkan email" value="<?= set_value('email') ?>">
                                <small class="text-danger"><?= form_error('email') ?></small>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control rounded-3 py-2" placeholder="Masukkan password">
                                <small class="text-danger"><?= form_error('password') ?></small>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label text-muted small" for="remember">Ingat Saya</label>
                                </div>
                                <a href="#" class="text-primary text-decoration-none small">Lupa Password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold">Masuk</button>
                        </form>
                        
                        <div class="text-center mt-4">
                            <p class="text-muted small">Belum punya akun? <a href="<?= base_url('auth/register') ?>" class="text-primary fw-bold text-decoration-none">Daftar Sekarang</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
