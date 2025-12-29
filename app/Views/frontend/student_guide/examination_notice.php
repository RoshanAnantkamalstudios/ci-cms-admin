<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= base_url('uploads/banner/' . ($hero['background_image'] ?? 'default.jpg')) ?>') no-repeat center center/cover;
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

<section class="hero-section">
    <div class="container text-white text-center py-5">
        <h1 class="display-4"><?= esc($hero['title']) ?></h1>
        <p class="lead"><?= esc($hero['subtitle']) ?></p>
        <?php if (!empty($hero['button_text']) && !empty($hero['button_link'])): ?>
            <a href="<?= esc($hero['button_link']) ?>" class="btn btn-light mt-3"><?= esc($hero['button_text']) ?></a>
        <?php endif; ?>
    </div>
</section>

<section class="container py-5" id="examination">
    <h3 class="text-danger text-center fw-bold mb-4 text-decoration-underline">Examination</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark text-white">
                <tr>
                    <th>Sr. No</th>
                    <th>Activities</th>
                    <th>Period (2<sup>nd</sup> & 3<sup>rd</sup> Year)</th>
                    <th>Period (1<sup>st</sup> Year)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exam_rows as $index => $exam): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($exam['activity']) ?></td>
                        <td><?= esc($exam['period_second_year']) ?></td>
                        <td><?= esc($exam['period_first_year']) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>


<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>