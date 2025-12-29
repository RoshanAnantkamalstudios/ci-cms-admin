<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.47), rgba(63, 59, 59, 0.46)), url('<?= base_url('uploads/' . $hero['image']) ?>') no-repeat center center/cover;
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
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200"
            style="font-family: 'Poppins', sans-serif;">
            <?= esc($hero['subtitle']) ?>
        </p>
        <?php if (!empty($hero['button_text'])): ?>
            <a href="#about-tpo-section" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up"
                data-aos-delay="400" style="font-family: 'Poppins', sans-serif;">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- About TPO Section -->
<section class="container-fluid py-5" id="about-tpo-section">
    <div class="container">
        <div class="row">
            <!-- Left Column: Profile + Description -->
            <div class="col-lg-8 col-md-12 mb-4">
                <!-- TPO Profile Card -->
                <div class="card shadow-lg text-center border-0 hover-card mb-5"
                    style="border-radius: 15px; overflow: hidden;" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card-header bg-gradient"
                        style="background: linear-gradient(90deg, #ea1f28, #9933CC);">
                        <img src="<?= base_url('uploads/' . $profile['image']) ?>" alt="<?= esc($profile['title']) ?>"
                            class="rounded-circle mt-3" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid white;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #9933CC; font-size: 1.2rem; font-family: 'Poppins', sans-serif;">
                            <?= esc($profile['title']) ?>
                        </h5>
                        <p class="card-text text-muted" style="font-size: 0.9rem; font-family: 'Poppins', sans-serif;">
                            <?= esc($profile['subtitle']) ?>
                        </p>
                    </div>
                </div>

                <!-- Accordion: About + Procedure -->
                <div class="accordion" id="tpoAccordion" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <!-- About Section -->
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="headingAbout">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseAbout" aria-expanded="true" aria-controls="collapseAbout"
                                style="background-color: #fff; color: #9933CC;">
                                <i class="bi bi-info-circle-fill me-2 section-icon"></i>About Our TPO
                            </button>
                        </h2>
                        <div id="collapseAbout" class="accordion-collapse collapse show"
                            aria-labelledby="headingAbout" data-bs-parent="#tpoAccordion">
                            <div class="accordion-body">
                                <div class="text-muted text-justify">
                                    <?= $about['description'] ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Placement Procedure -->
                    <div class="accordion-item border-0 shadow-sm">
                        <h2 class="accordion-header" id="headingProcedure">
                            <button class="accordion-button collapsed fw-bold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseProcedure" aria-expanded="false"
                                aria-controls="collapseProcedure" style="background-color: #fff; color: #9933CC;">
                                <i class="bi bi-list-check me-2 section-icon"></i>Placement Procedure
                            </button>
                        </h2>
                        <div id="collapseProcedure" class="accordion-collapse collapse"
                            aria-labelledby="headingProcedure" data-bs-parent="#tpoAccordion">
                            <div class="accordion-body">
                                <div class="text-muted">
                                    <?= $procedure['extra'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Carousel -->
            <div class="col-lg-4 col-md-12">
                <div class="card shadow-lg border-0" data-aos="fade-left" data-aos-duration="1000">
                    <div id="tpoCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($carousel as $index => $item): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="<?= base_url('uploads/' . $item['image']) ?>" class="d-block w-100" alt="TPO Event <?= $index + 1 ?>"
                                        style="height: 200px; object-fit: contain;">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#tpoCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#tpoCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold" style="color: #9933CC;">TPO Events & Activities</h5>
                        <p class="card-text text-muted">Discover our vibrant placement events and industry interactions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<!-- AOS or other custom scripts here -->
<?= $this->endSection() ?>