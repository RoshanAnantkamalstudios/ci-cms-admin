<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('uploads/banner/' . esc($hero['background_image'] ?? 'banner.jpg')) ?>') no-repeat center center/cover;
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
<section class="hero-section text-center text-white bg-dark">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold" data-aos="zoom-in" data-aos-duration="1000">
            <?= esc($hero['title'] ?? 'Academic Calendar') ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($hero['subtitle'] ?? 'Stay informed with our academic events.') ?>
        </p>
        <?php if (!empty($hero['button_text'])): ?>
            <a href="<?= esc($hero['button_link'] ?? '#academic-calendar') ?>" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up" data-aos-delay="400">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif ?>
    </div>
</section>

<!-- Calendar Table -->
<section class="container py-5" id="academic-calendar">
    <div class="bg-light rounded-4 shadow p-4 p-md-5" data-aos="fade-up" data-aos-duration="1000">
        <h3 class="text-danger text-center mb-4 fw-bold text-decoration-underline">
            <?= esc($hero['title'] ?? 'Academic Calendar') ?>
        </h3>

        <div class="table-responsive" style="font-family: 'Poppins', sans-serif;">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-white text-center">
                    <tr>
                        <th>Sr. No</th>
                        <th>Activities</th>
                        <th>Period<br>(2<sup>nd</sup> & 3<sup>rd</sup> Year)</th>
                        <th>Period<br>(1<sup>st</sup> Year)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($calendar as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($row['activity']) ?></td>
                            <td><?= esc($row['second_third_year_period']) ?></td>
                            <td><?= esc($row['first_year_period']) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>