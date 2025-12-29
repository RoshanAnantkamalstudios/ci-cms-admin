<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('public/uploads/' . $vm['hero_banner_image']) ?>') no-repeat center center/cover;
        height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }
</style>

<section class="hero-section py-5 text-white text-center">
    <div class="container">
        <h1 class="display-4 fw-bold" data-aos="fade-up" data-aos-duration="1000"><?= esc($vm['hero_heading']) ?></h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($vm['hero_subheading']) ?>
        </p>
        <?php if (!empty($vm['hero_button_text']) && !empty($vm['hero_button_link'])): ?>
            <a href="<?= esc($vm['hero_button_link']) ?>" class="btn btn-light btn-lg mt-4" data-aos="fade-up" data-aos-delay="400">
                <?= esc($vm['hero_button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<section id="vision-mission" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold"><?= esc($vm['section_heading']) ?></h2>
            <p class="text-muted"><?= esc($vm['section_subheading']) ?></p>
        </div>

        <!-- <div class="row g-4"> -->
        <!-- Our Belief -->
        <div class="col-12 mt-5" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 shadow-sm border-0 rounded-4 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="<?= esc($vm['belief_icon'] ?: 'bi bi-lightbulb') ?> display-4 text-primary"></i>
                    </div>
                    <h5 class="card-title fw-bold"><?= esc($vm['belief_title']) ?></h5>
                    <p class="card-text fst-italic"><?= $vm['belief_description'] ?></p>
                </div>
            </div>
        </div>

        <!-- Our Vision -->
        <div class="col-12 mt-5" data-aos="fade-up" data-aos-delay="200">
            <div class="card h-100 shadow-sm border-0 rounded-4 text-center bg-white">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="<?= esc($vm['vision_icon'] ?: 'bi bi-eye') ?> display-4 text-success"></i>
                    </div>
                    <h5 class="card-title fw-bold"><?= esc($vm['vision_title']) ?></h5>
                    <p class="card-text"><?= $vm['vision_description'] ?></p>
                </div>
            </div>
        </div>

        <!-- Our Mission -->
        <div class="col-12 mt-5" data-aos="fade-up" data-aos-delay="300">
            <div class="card h-100 shadow-sm border-0 rounded-4 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="<?= esc($vm['mission_icon'] ?: 'bi bi-flag') ?> display-4 text-danger"></i>
                    </div>
                    <h5 class="card-title fw-bold"><?= esc($vm['mission_title']) ?></h5>
                    <p class="card-text fst-italic"><?= $vm['mission_description'] ?></p>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<!-- AOS JS if needed -->
<?= $this->endSection() ?>