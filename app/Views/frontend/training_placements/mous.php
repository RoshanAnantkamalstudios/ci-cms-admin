<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url( $hero['image']) ?>') no-repeat center center/cover;
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        position: relative;
        text-align: center;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }
</style>

<!-- Hero Section -->
<section class="hero-section py-5 text-center text-white bg-dark">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold" data-aos="zoom-in" data-aos-duration="1000">
            <?= esc($hero['title']) ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($hero['subtitle']) ?>
        </p>
        <?php if (!empty($hero['button_text'])): ?>
            <a href="#about-tpo-section" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up"
                data-aos-delay="400">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- MOU Table -->
<section class="container-fluid py-5" id="about-tpo-section">
    <div class="container mb-5" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-lg" style="border-radius: 10px; overflow: hidden;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Organization</th>
                        <th scope="col">Branches</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mous as $mou): ?>
                        <tr>
                            <td>
                                <?= esc($mou['title']) ?>
                                <?php if (!empty($mou['status']) && $mou['status'] == 'proposed'): ?>
                                    <span class="badge bg-warning text-dark">Proposed</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($mou['extra']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Image Carousel -->
    <div class="container">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div id="tpoTeamCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($carousel as $index => $item): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="<?= base_url( $item['image']) ?>" class="d-block w-100" alt="Carousel Image"
                                        style="height: 300px; object-fit: contain;">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#tpoTeamCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#tpoTeamCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold" style="color: #9933CC;">Our Placement Activities</h5>
                        <p class="card-text text-muted">Discover the vibrant events and initiatives led by our TPO team.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<!-- Custom JS if needed -->
<?= $this->endSection() ?>