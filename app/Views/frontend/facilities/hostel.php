<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= base_url('uploads/banner/' . ($hero['image'] ?? 'banner.jpg')) ?>') no-repeat center center/cover;
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
            <?= esc($hero['title'] ?? 'Hostel Facility') ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($hero['subtitle'] ?? 'Safe, hygienic, and comfortable accommodation fostering a homely environment for students.') ?>
        </p>
        <?php if (!empty($hero['button_text'])): ?>
            <a href="#hostel" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up" data-aos-delay="400">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- Hostel Facility Section -->
<section class="container py-5" id="hostel">
    <div class="bg-white rounded-4 shadow p-4 p-md-5" data-aos="fade-up" data-aos-duration="1000">
        <h3 class="text-danger mb-4 text-decoration-underline">Hostel Facility :</h3>

        <p style="font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 1.8; text-align: justify;">
            <?= nl2br(esc($content['description'] ?? 'Well-furnished, ventilated hostels are provided separately for girls and boys within the campus...')) ?>
        </p>

        <!-- Girls Hostel -->
        <div class="mt-4">
            <h5 class="fw-bold">Girls Hostel</h5>
            <ul class="mb-3" style="font-family: 'Poppins', sans-serif; font-size: 15px;">
                <li>Capacity - 400 Girls</li>
            </ul>
            <div class="row g-4">
                <?php if (!empty($images_girls)): ?>
                    <?php foreach ($images_girls as $img): ?>
                        <div class="col-md-6">
                            <img src="<?= base_url('uploads/hostel/' . $img['image']) ?>" class="img-fluid rounded shadow-sm" alt="Girls Hostel Image">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Boys Hostel -->
        <div class="mt-5">
            <h5 class="fw-bold">Boys Hostel</h5>
            <ul class="mb-3" style="font-family: 'Poppins', sans-serif; font-size: 15px;">
                <li>Capacity - 600 Boys</li>
            </ul>
            <div class="row g-4">
                <?php if (!empty($images_boys)): ?>
                    <?php foreach ($images_boys as $img): ?>
                        <div class="col-md-6">
                            <img src="<?= base_url('uploads/hostel/' . $img['image']) ?>" class="img-fluid rounded shadow-sm" alt="Boys Hostel Image">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<!-- You can add page-specific JS here -->
<?= $this->endSection() ?>