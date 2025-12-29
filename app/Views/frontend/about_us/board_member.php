<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url($hero['image'] ?? 'public/frontend/img/banner/meet-our-board-member.jpg') ?>') no-repeat center center/cover;
        height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }
</style>
<!-- Hero Section -->
<section class="hero-section py-5 text-center bg-light">
    <div class="container">
        <h1 data-aos="fade-up" class="fw-bold mb-3"><?= esc($hero['title'] ?? 'Our Board Members') ?></h1>
        <p data-aos="fade-up" data-aos-delay="200" class="lead">
            <?= esc($hero['subtitle'] ?? 'Meet the visionaries guiding our institution toward excellence.') ?>
        </p>
    </div>
</section>

<!-- Board Members Section -->
<section class="board-members-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5" data-aos="fade-up">Leadership Team</h2>
        <div class="row g-4 justify-content-center">

            <?php if (!empty($members)): ?>
                <?php foreach ($members as $index => $member): ?>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="<?= $index * 100 ?>">
                        <div class="member-card">
                            <img src="<?= base_url($member['image'] ?? 'public/frontend/img/person.webp') ?>"
                                alt="<?= esc($member['name']) ?>"
                                class="member-img" />
                            <div class="member-overlay" aria-hidden="true">
                                <p><?= esc($member['message'] ?? 'Committed to institutional growth and student success.') ?></p>
                                <div class="social-links d-flex gap-3 justify-content-center">
                                    <a href="#" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
                                    <a href="#" aria-label="Twitter" target="_blank" rel="noopener"><i class="bi bi-twitter"></i></a>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= esc($member['name']) ?></h5>
                                <p class="card-text"><?= esc($member['designation']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No board members found.</p>
            <?php endif; ?>

        </div>
    </div>
</section>

<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>