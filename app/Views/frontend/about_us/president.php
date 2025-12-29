<?php
$president = $data ?? [];
?>
<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= base_url($president['hero_image'] ?? 'public/frontend/img/banner/banner.jpg') ?>') no-repeat center center/cover;
        height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }
</style>
<section class="hero-section py-5 bg-primary text-white text-center">
    <div class="container">
        <h1 class="display-4 fw-bold" data-aos="fade-up" data-aos-duration="1000">
            <?= esc($president['hero_title'] ?? 'President\'s Desk') ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($president['hero_subtitle'] ?? 'Meet the visionaries guiding Brahma Valley Polytechnic toward excellence') ?>
        </p>
        <a href="#president-message" class="btn btn-light btn-lg mt-4" data-aos="fade-up" data-aos-delay="400">
            Read Message
        </a>
    </div>
</section>

<!-- Message Section -->
<section id="president-message" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                <figure class="shadow rounded overflow-hidden mb-3 mb-lg-0">
                    <img src="<?= base_url($president['president_image'] ?? 'public/frontend/img/image.jpeg') ?>"
                        alt="<?= esc($president['president_name'] ?? 'President') ?>"
                        class="img-fluid w-100" style="object-fit: contain; height: 500px;" />
                    <figcaption class="p-3 bg-white text-center"
                        style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1rem; color: #222;">
                        <?= esc($president['president_name'] ?? 'President Name') ?><br>
                        <?= esc($president['designation'] ?? 'Designation') ?><br>
                        <?= esc($president['address'] ?? '') ?>
                    </figcaption>
                </figure>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                <div class="bg-white p-4 rounded shadow-sm">
                    <!-- <h4 class="mb-4 text-primary fw-bold" style="font-family: 'Poppins', sans-serif;">
                        Dear Students,
                    </h4> -->
                    <div class="lead" style="font-family: 'Poppins', sans-serif; color: #444; line-height: 1.6;">
                        <?= $president['overview'] ?? 'President’s message content goes here...' ?>
                    </div>
                    <!-- <p class="lead mt-3" style="font-family: 'Poppins', sans-serif; color: #444; line-height: 1.6;">
                        <strong>Mobile:</strong> <= esc($president['mobile_no'] ?? '') ?>
                    </p> -->
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>