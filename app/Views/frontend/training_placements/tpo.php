<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('uploads/' . $hero['image']) ?>') no-repeat center center/cover;
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="display-4 fw-bold" data-aos="zoom-in"><?= esc($hero['title']) ?></h1>
        <p class="lead mt-3" data-aos="fade-up"><?= esc($hero['subtitle']) ?></p>
        <?php if (!empty($hero['button_text'])): ?>
            <a href="#about-tpo-section" class="btn btn-light btn-lg mt-4 px-5 py-2" data-aos="fade-up"><?= esc($hero['button_text']) ?></a>
        <?php endif; ?>
    </div>
</section>


<section class="container-fluid py-5" id="about-tpo-section">
    <!-- Team Members -->
    <div class="container mb-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" data-aos="fade-up" data-aos-delay="200"
            data-aos-duration="1000">
            <?php foreach ($members as $member): ?>
                <div class="col">
                    <div class="card shadow-lg border-0 hover-card text-center" style="border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: #9933CC; font-family: 'Poppins', sans-serif;">
                                <?= esc($member['name']) ?>
                            </h5>
                            <p class="card-text text-muted"><?= esc($member['department']) ?></p>
                            <p class="card-text fw-bold text-primary"><?= esc($member['designation']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Image Carousel -->
    <div class="container">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div id="tpoTeamCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-inner">
                                <?php foreach ($carousel as $index => $slide): ?>
                                    <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                                        <img src="<?= base_url('uploads/' . $slide['image']) ?>" class="d-block w-100" style="height: 300px; object-fit: contain;" alt="Slide <?= $index + 1 ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
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
                        <p class="card-text text-muted">Discover the vibrant events and initiatives led by our TPO
                            team.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>