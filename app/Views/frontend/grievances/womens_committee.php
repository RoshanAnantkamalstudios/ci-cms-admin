<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('uploads/banner/' . ($hero['background_image'] ?? 'default.jpg')) ?>') no-repeat center center/cover;
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
        <h1 class="display-4 fw-bold" data-aos="zoom-in" data-aos-duration="1000">
            <?= esc($hero['title'] ?? 'Women\'s Grievance Redressal Committee') ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200" style="font-family: 'Poppins', sans-serif;">
            <?= esc($hero['subtitle'] ?? 'Dedicated to addressing student concerns with transparency and fairness.') ?>
        </p>
        <?php if (!empty($hero['button_text']) && !empty($hero['button_link'])): ?>
            <a href="<?= esc($hero['button_link']) ?>" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up" data-aos-delay="400" style="font-family: 'Poppins', sans-serif;">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<!-- Committee Section -->
<section class="container py-5" id="committee">
    <div class="bg-white rounded-4 shadow p-4 p-md-5" data-aos="fade-up" data-aos-duration="1000"
        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <h3 class="text-primary mb-4 border-bottom pb-2 fw-semibold">
            Women's Grievance Redressal Committee
        </h3>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" class="text-center" style="width: 70px;">Sr. No</th>
                        <th scope="col">Name of the Committee Member</th>
                        <th scope="col">Profession / Designation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($committee as $i => $row): ?>
                        <tr>
                            <td class="text-center"><?= $i + 1 ?></td>
                            <td><?= esc($row['name']) ?></td>
                            <td><?= esc($row['designation']) ?></td>
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