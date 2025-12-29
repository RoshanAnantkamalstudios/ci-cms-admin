<?php $principal = $principal ?? []; ?>

<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= base_url($principal['hero_image'] ?? 'public/frontend/img/banner/banner.jpg') ?>') no-repeat center center/cover;
        height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }
</style>

<!--================ Start Hero Section =================-->
<section class="hero-section py-5 bg-primary text-white text-center">
    <div class="container">
        <h1 class="display-4 fw-bold" data-aos="fade-up" data-aos-duration="1000">
            <?= esc($principal['hero_title'] ?? 'Principal\'s Desk') ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($principal['hero_subtitle'] ?? 'Meet the visionaries guiding Brahma Valley Polytechnic toward excellence') ?>
        </p>
        <a href="#principal" class="btn btn-light btn-lg mt-4" data-aos="fade-up" data-aos-delay="400">
            Read Message
        </a>
    </div>
</section>
<!--================ End Hero Section =================-->

<!--================ Start Message Section =================-->
<section id="principal" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                <figure class="shadow rounded overflow-hidden mb-3 mb-lg-0">
                    <img src="<?= base_url($principal['principal_image'] ?? 'public/frontend/img/nikhade.jpg') ?>"
                        alt="<?= esc($principal['principal_name'] ?? 'Principal') ?>"
                        class="img-fluid w-100" style="object-fit: contain; height: 500px;" />
                    <figcaption class="p-3 bg-white text-center"
                        style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1rem; color: #222;">
                        <?= esc($principal['principal_name'] ?? 'Prof. V.P. Nikhade') ?><br>
                        <?= esc($principal['designation'] ?? 'Principal') ?><br>
                        <?= esc($principal['address'] ?? 'Nahsik Gramin Shikshan Prasarak Mandal') ?>
                    </figcaption>
                </figure>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                <div class="bg-white p-4 rounded shadow-sm">
                    <?= !empty($principal['message']) ? $principal['message'] : '<p class="lead">No message found.</p>' ?>
                    <?php if (!empty($principal['mobile_no'])): ?>
                        <p class="lead mt-4"><strong>Contact:</strong> <?= esc($principal['mobile_no']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Message Section =================-->

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<?= $this->endSection() ?>