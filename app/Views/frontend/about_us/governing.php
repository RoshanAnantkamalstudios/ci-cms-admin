<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= base_url($hero['hero_image'] ?? 'public/frontend/img/banner/banner.jpg') ?>') no-repeat center center/cover;
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
        <h1 class="display-4 fw-bold" data-aos="fade-up" data-aos-duration="1000"><?= esc($hero['hero_title']) ?></h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($hero['hero_subtitle']) ?>
        </p>
    </div>
</section>
<section id="president-message" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Name of Member</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Background</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $i => $m): ?>
                            <tr class="<?= $i % 2 == 0 ? 'bg-light' : '' ?>">
                                <td><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></td>
                                <td><img src="<?= base_url($m['photo']) ?>" width="60" height="60" class="rounded"></td>
                                <td><?= esc($m['name']) ?></td>
                                <td><?= esc($m['designation']) ?></td>
                                <td><?= esc($m['background']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>