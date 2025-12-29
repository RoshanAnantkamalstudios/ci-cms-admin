<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= base_url('uploads/fiesta/' . $hero['image']) ?>') no-repeat center center/cover;
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
        <h1 class="display-4 fw-bold" data-aos="zoom-in"><?= esc($hero['title'] ?? 'Cultural Fiesta') ?></h1>
        <p class="lead mt-3" data-aos="fade-up"><?= esc($hero['subtitle']) ?></p>
        <?php if (!empty($hero['button_text'])): ?>
            <a href="#fiesta" class="btn btn-light btn-lg mt-4 shadow-sm"><?= esc($hero['button_text']) ?></a>
        <?php endif; ?>
    </div>
</section>

<!-- Description -->
<section class="container py-5" id="fiesta">
    <div class="bg-white p-5 shadow rounded">
        <h3 class="text-danger mb-4 text-decoration-underline">Cultural Fiesta :</h3>
        <p style="text-align: justify"><?= nl2br(esc($about['description'] ?? '')) ?></p>

        <div class="row mt-4">
            <?php foreach ($images as $img): ?>
                <div class="col-md-4 mb-4 text-center">
                    <img src="<?= base_url('uploads/fiesta/' . $img['image']) ?>" class="img-fluid rounded shadow-sm mb-2" alt="Fiesta">
                    <p><?= esc($img['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= $this->endsection() ?>