<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('uploads/banners/' . ($hero['banner_image'] ?? 'banner.jpg')) ?>') no-repeat center center/cover;
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }
</style>

<section class="hero-section">
    <div class="container">
        <h1 class="display-4 fw-bold"><?= esc($hero['title_text'] ?? 'Examination Downloads') ?></h1>
        <p class="lead mt-3"><?= esc($hero['subtitle_text'] ?? 'Access sample papers, QBs, and board papers.') ?></p>
        <a href="#downloads-section" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2">
            <?= esc($hero['button_text'] ?? 'View Downloads') ?>
        </a>
    </div>
</section>

<section class="container py-5" id="downloads-section">
    <div class="bg-light rounded-4 shadow p-4 p-md-5">
        <h3 class="text-center mb-4 fw-bold text-decoration-underline text-primary">Examination Downloads</h3>

        <?php if (!empty($downloads)): ?>
            <div class="accordion" id="downloadsAccordion">
                <?php $i = 0; ?>
                <?php foreach ($downloads as $department => $categories): ?>
                    <?php $deptId = 'dept' . $i++; ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?= $deptId ?>">
                            <button class="accordion-button <?= $i === 1 ? '' : 'collapsed' ?>" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse<?= $deptId ?>"
                                aria-expanded="<?= $i === 1 ? 'true' : 'false' ?>" aria-controls="collapse<?= $deptId ?>">
                                <?= esc($department) ?>
                            </button>
                        </h2>
                        <div id="collapse<?= $deptId ?>" class="accordion-collapse collapse <?= $i === 1 ? 'show' : '' ?>"
                            aria-labelledby="heading<?= $deptId ?>" data-bs-parent="#downloadsAccordion">
                            <div class="accordion-body">
                                <?php foreach ($categories as $category => $items): ?>
                                    <h5 class="text-secondary mt-3"><?= esc($category) ?></h5>
                                    <ul class="list-unstyled">
                                        <?php foreach ($items as $item): ?>
                                            <li class="mb-2">
                                                <a href="<?= base_url('uploads/downloads/' . $item['file']) ?>"
                                                    target="_blank" class="d-flex align-items-center text-decoration-none">
                                                    <i class="bi bi-file-earmark-arrow-down-fill text-danger me-2"></i>
                                                    <?= esc($item['title']) ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">No downloads available at the moment.</div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>