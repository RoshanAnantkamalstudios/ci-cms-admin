<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= base_url('uploads/banner/' . ($hero['banner_image'] ?? 'banner.jpg')) ?>') no-repeat center center/cover;
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
<section class="hero-section py-5 text-center text-white bg-dark">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold" data-aos="zoom-in" data-aos-duration="1000"><?= esc($hero['title'] ?? 'Examination Schedule') ?></h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200"><?= esc($hero['subtitle'] ?? '') ?></p>
        <?php if (!empty($hero['button_text']) && !empty($hero['button_link'])): ?>
            <a href="<?= esc($hero['button_link']) ?>" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up" data-aos-delay="400">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- Schedule Table -->
<section class="container py-5" id="academic-calendar">
    <div class="bg-light rounded-4 shadow p-4 p-md-5" data-aos="fade-up" data-aos-duration="1000">
        <h3 class="text-danger text-center mb-4 fw-bold text-decoration-underline">Important Dates</h3>
        <div class="table-responsive border rounded p-3 bg-white">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Department</th>
                        <th>External Practical / Oral (1<sup>st</sup> Year)</th>
                        <th>External Practical / Oral (2<sup>nd</sup> Year)</th>
                        <th>External Practical / Oral (3<sup>rd</sup> Year)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedules as $row): ?>
                        <tr>
                            <td class="text-start"><?= esc($row['department']) ?></td>
                            <td class="text-start text-danger"><?= $row['year_1st'] ?></td>
                            <td class="text-start text-danger"><?= $row['year_2nd'] ?></td>
                            <td class="text-start text-danger"><?= $row['year_3rd'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<?= $this->endSection() ?>