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
<section class="hero-section">
    <div class="container position-relative">
        <h1 data-aos="zoom-in" data-aos-duration="1000">
            <?= esc($hero['title'] ?? 'Library') ?>
        </h1>
        <p data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($hero['subtitle'] ?? 'A hub for academic excellence with a vast collection of resources to support your studies.') ?>
        </p>
        <?php if (!empty($hero['button_text'])): ?>
            <a href="#facility-details" class="btn btn-light btn-lg mt-4" data-aos="fade-up" data-aos-delay="400">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- Library Section -->
<section class="container py-5" id="facility-details">
    <div class="bg-white rounded-4 shadow p-4 p-md-5" data-aos="fade-up" data-aos-duration="1000">
        <h3 class="text-danger mb-4 text-decoration-underline">
            Well - Equipped Library :
        </h3>

        <?php if (!empty($images)): ?>
            <div class="row g-4 mb-4">
                <?php foreach ($images as $index => $img): ?>
                    <?php if ($index < 2): ?>
                        <div class="col-md-6">
                            <img src="<?= base_url('uploads/library/' . $img['image']) ?>" class="img-fluid rounded shadow-sm" alt="Library Image <?= $index + 1 ?>">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <p style="font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 1.8; text-align: justify;">
            <?= nl2br(esc($content['description'] ?? 'Our well-equipped and spacious library houses an extensive collection...')) ?>
        </p>

        <?php if (!empty($images)): ?>
            <div class="row g-4 mt-4">
                <?php foreach ($images as $index => $img): ?>
                    <?php if ($index >= 2): ?>
                        <div class="col-md-6">
                            <img src="<?= base_url('uploads/library/' . $img['image']) ?>" class="img-fluid rounded shadow-sm" alt="Library Image <?= $index + 1 ?>">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<!-- Add custom JS here if needed -->
<?= $this->endSection() ?>