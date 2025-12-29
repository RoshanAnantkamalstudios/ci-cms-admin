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
            <?= esc($hero['title'] ?? 'Transportation') ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($hero['subtitle'] ?? 'Safe, reliable, and accessible travel options for students and staff from across the region.') ?>
        </p>
        <?php if (!empty($hero['button_text'])): ?>
            <a href="#transport" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up" data-aos-delay="400">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- Transportation Section -->
<section class="container py-5" id="transport">
    <div class="bg-white rounded-4 shadow p-4 p-md-5" data-aos="fade-up" data-aos-duration="1000">
        <h3 class="text-danger mb-4 text-decoration-underline">
            Transportation :
        </h3>

        <?php if (!empty($content['description'])): ?>
            <div class="mb-4" style="font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 1.8;">
                <?= $content['description'] ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($images)): ?>
            <div class="row g-4">
                <?php foreach ($images as $img): ?>
                    <div class="col-md-6">
                        <img src="<?= base_url('uploads/transport/' . $img['image']) ?>" class="img-fluid rounded shadow-sm" alt="Transportation Image">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<!-- Add any custom scripts if needed -->
<?= $this->endSection() ?>