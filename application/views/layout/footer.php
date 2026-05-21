<footer class="site-footer">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-md-4 mb-4">
                <a href="<?= base_url() ?>" class="d-inline-block mb-3">
                    <?php $logo_class = 'braveia-logo-footer'; $this->load->view('layout/_logo'); ?>
                </a>
                <p class="text-secondary small">Brave International Academy — platform e-learning dan sertifikasi profesional. Menggabungkan AI dan metodologi pembelajaran terbaik untuk karir Anda.</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-secondary"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>
            <div class="col-md-2 mb-4">
                <h5 class="text-white font-serif mb-3" style="font-size: 1rem;">Perusahaan</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Tentang Kami</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Karir</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Kontak</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5 class="text-white font-serif mb-3" style="font-size: 1rem;">Layanan</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Program Pelatihan</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Sertifikasi</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Webinar</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Mentoring</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5 class="text-white font-serif mb-3" style="font-size: 1rem;">Bantuan</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">FAQ</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Syarat & Ketentuan</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="text-center text-secondary small">
            <p class="mb-0">&copy; <?= date('Y') ?> Brave International Academy. Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>
