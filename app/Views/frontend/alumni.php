<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url('<?= base_url('uploads/' . ($hero['image'])) ?>') no-repeat center center/cover;
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
    <div class="container">
        <h1 class="display-3 fw-bold" data-aos="zoom-in" data-aos-duration="1000">
            <?= esc($hero['title']) ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($hero['subtitle']) ?>
        </p>
        <a href="#alumni" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up"
            data-aos-delay="400" style="font-family: 'Poppins', sans-serif;">
            View Alumni
        </a>
    </div>
</section>

<!-- Testimonials Section -->
<section id="alumni" class="testimonials-section py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4" data-aos="fade-up">Our Alumni Stories</h2>
        <div class="row g-4">
            <?php foreach ($testimonials as $alum):
                $details = json_decode($alum['extra_data'], true);
            ?>
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card p-4 text-center h-100">
                        <img src="<?= base_url('uploads/' . $alum['image']) ?>" class="testimonial-img">
                        <p><?= esc($alum['content']) ?></p>
                        <h5><?= esc($alum['title']) ?></h5>
                        <p class="text-muted"><?= esc($details['year'] ?? '') ?>, <?= esc($details['role'] ?? '') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Gallery Section -->
<section class="gallery-section py-5">
    <div class="container">
        <h2 class="text-center fw-bold" data-aos="fade-up">Alumni Gallery</h2>
        <div class="row g-4">
            <?php foreach ($gallery as $img): ?>
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card">
                        <img src="<?= base_url('uploads/' . $img['image']) ?>" class="gallery-img">
                        <div class="card-body">
                            <p class="card-text"><?= esc($img['title']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>