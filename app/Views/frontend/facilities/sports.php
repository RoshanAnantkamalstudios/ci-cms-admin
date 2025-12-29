<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('uploads/banner/' . ($hero['image'] ?? 'banner.jpg')) ?>') no-repeat center center/cover;
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
<section class="hero-section py-5 text-center text-white">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold" data-aos="zoom-in" data-aos-duration="1000">
            <?= esc($hero['title'] ?? 'Sports Facility') ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($hero['subtitle'] ?? 'A perfect blend of indoor and outdoor games to promote physical fitness, teamwork, and sportsmanship.') ?>
        </p>
        <?php if (!empty($hero['button_text'])): ?>
            <a href="#sports" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up" data-aos-delay="400">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- Sports Facility Section -->
<section class="container py-5" id="sports">
    <div class="bg-white rounded-4 shadow p-4 p-md-5" data-aos="fade-up" data-aos-duration="1000">
        <h3 class="text-danger mb-4 text-decoration-underline">
            Sports Facility :
        </h3>

        <p class="mb-4"
            style="font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 1.8; text-align: justify;">
            <?= nl2br(esc($content['description'] ?? 'Students are encouraged to participate in various sports events...')) ?>
        </p>

        <?php if (!empty($images)): ?>
            <div class="row g-4">
                <?php foreach ($images as $img): ?>
                    <div class="col-md-6">
                        <img src="<?= base_url('uploads/sports/' . $img['image']) ?>" class="img-fluid rounded shadow-sm" alt="Sports Facility Image">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<!-- Add custom JS here if needed -->
<?= $this->endSection() ?>