<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('uploads/placements/' . ($hero['image'] ?? 'default.jpg')) ?>') no-repeat center center/cover;
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
<?php if (!empty($hero)): ?>
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown" data-aos="zoom-in" data-aos-duration="1000">
                <i class="bi bi-briefcase-fill me-2"></i><?= esc($hero['title']) ?>
            </h1>
            <p class="lead mt-3 animate__animated animate__fadeInUp" data-aos="fade-up" data-aos-delay="200">
                <?= esc($hero['subtitle']) ?>
            </p>
            <a href="#jobs-section" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up"
                data-aos-delay="400">
                <i class="bi bi-search me-2"></i>Explore Jobs
            </a>
        </div>
    </section>
<?php endif; ?>




<!-- About Section -->
<?php if (!empty($about)): ?>
    <section class="container py-5" id="about-section">
        <div class="row align-items-center" data-aos="fade-up" data-aos-duration="1000">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-3 text-primary">
                    <i class="bi <?= esc($about['icon']) ?> me-2"></i><?= esc($about['title']) ?>
                </h2>
                <p class="text-muted"><?= esc($about['description']) ?></p>
                <a href="<?= base_url('vision') ?>" class="btn btn-outline-primary btn-lg mt-3">
                    <i class="bi bi-info-circle me-2"></i>Learn More
                </a>
            </div>
            <div class="col-lg-6">
                <?php if (!empty($about['image'])): ?>
                    <img src="<?= base_url('uploads/placements/' . $about['image']) ?>" alt="About"
                        class="img-fluid rounded shadow-lg" data-aos="zoom-in" data-aos-delay="200">
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Recruiters Section -->
<section class="container py-5" id="recruiters-section">
    <h2 class="text-center fw-bold mb-4 text-purple" style="text-decoration: underline;" data-aos="fade-up">
        <i class="bi bi-building section-icon me-2"></i>Our Esteemed Recruiters
    </h2>
    <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-md-12">
            <div class="card shadow p-4 bg-white recruiter-card">
                <ul class="recruiter-list list-unstyled row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php foreach ($recruiters as $r): ?>
                        <li>
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <?= esc($r['title']) ?>
                            <?php if (!empty($r['image'])): ?>
                                <img src="<?= base_url('uploads/placements/' . $r['image']) ?>" alt="Logo" class="ms-2" style="height: 30px;">
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Application Process Section -->
<section class="container py-5 text-center bg-light" id="apply">
    <h2 class="text-center fw-bold mb-5 text-primary" data-aos="fade-up">
        <i class="bi bi-list-check section-icon me-2"></i>Application Process
    </h2>
    <div class="row">
        <?php foreach ($process as $step): ?>
            <div class="col-md-4 text-center mb-4" data-aos="fade-up" data-aos-delay="200">
                <i class="bi <?= esc($step['icon']) ?> fs-1 text-primary mb-3"></i>
                <h5 class="fw-semibold"><?= esc($step['title']) ?></h5>
                <p class="text-muted"><?= esc($step['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>