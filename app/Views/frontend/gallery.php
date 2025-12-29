<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('uploads/' . ($hero['banner_image'] ?? 'public/frontend/img/banner/banner.jpg')) ?>') no-repeat center center/cover;
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
            <?= esc($hero['hero_title'] ?? 'Gallery') ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($hero['hero_subtitle'] ?? 'Explore vibrant moments from our academic and placement activities across various departments.') ?>
        </p>
        <a href="#gallery-section" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up" data-aos-delay="400">
            View Gallery
        </a>
    </div>
</section>

<!-- Gallery Section -->
<section class="container py-5" id="gallery-section">
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3" id="galleryGrid" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
        <?php if (!empty($gallery)): ?>
            <?php foreach ($gallery as $img): ?>
                <div class="col gallery-item" data-category="gallery">
                    <a href="<?= base_url('uploads/' . $img['image']) ?>" data-rel="lightcase:gallery" title="<?= esc($img['title']) ?>">
                        <img src="<?= base_url('uploads/' . $img['image']) ?>" class="img-fluid rounded shadow-sm"
                            alt="<?= esc($img['title']) ?>" style="width: 100%; height: 100px; object-fit: cover;">
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">No images found in gallery.</div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>
<script src="<?= base_url('public/frontend/js/lightcase.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('a[data-rel^=lightcase]').lightcase();
    });
</script>
<?= $this->endsection() ?>