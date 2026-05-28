<section class="py-5 bg-white">
    <div class="container py-4 col-lg-8 mx-auto">
        <h1 class="fw-bold font-serif mb-4"><?= html_escape($page_heading) ?></h1>
        <p>Program sertifikasi Braveia dirancang untuk memvalidasi kompetensi Anda setelah menyelesaikan modul, tugas, dan evaluasi yang ditetapkan.</p>
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="card course-card h-100 p-3 text-center">
                    <i class="fas fa-certificate fa-2x text-primary mb-2"></i>
                    <h3 class="h6 font-serif fw-bold">Sertifikat Digital</h3>
                    <p class="small text-muted mb-0">Diterbitkan otomatis setelah kelulusan dengan nomor verifikasi unik.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card course-card h-100 p-3 text-center">
                    <i class="fas fa-check-double fa-2x text-primary mb-2"></i>
                    <h3 class="h6 font-serif fw-bold">Standar Industri</h3>
                    <p class="small text-muted mb-0">Kurikulum diselaraskan dengan kebutuhan kompetensi di lapangan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card course-card h-100 p-3 text-center">
                    <i class="fas fa-share-alt fa-2x text-primary mb-2"></i>
                    <h3 class="h6 font-serif fw-bold">Portofolio Karir</h3>
                    <p class="small text-muted mb-0">Bagikan pencapaian Anda di LinkedIn dan profil profesional.</p>
                </div>
            </div>
        </div>
        <a href="<?= base_url('courses') ?>" class="btn btn-primary mt-4">Mulai Program Bersertifikat</a>
    </div>
</section>
