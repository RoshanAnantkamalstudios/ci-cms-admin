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

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="display-4 fw-bold"><?= esc($hero['title_text'] ?? 'Syllabus') ?></h1>
        <p class="lead mt-3"><?= esc($hero['subtitle_text'] ?? 'Access detailed syllabi for all diploma programs.') ?></p>
        <a href="#syllabus-section" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2">
            <?= esc($hero['button_text'] ?? 'View Syllabus') ?>
        </a>
    </div>
</section>

<!-- Syllabus Section -->
<section class="container py-5" id="syllabus-section">
    <div class="bg-light rounded-4 shadow p-4 p-md-5">
        <h3 class="text-danger text-center mb-4 fw-bold text-decoration-underline">
            G-Scheme & E-Scheme Syllabus
        </h3>

        <?php
        $grouped = [];
        foreach ($entries as $entry) {
            $dept = trim($entry['department']);
            $scheme = trim($entry['scheme']);
            $grouped[$dept][$scheme][] = $entry;
        }
        ?>

        <?php if (!empty($grouped)): ?>
            <div class="accordion" id="syllabusAccordion">
                <?php $deptIndex = 0; ?>
                <?php foreach ($grouped as $department => $schemes): ?>
                    <?php $deptId = 'dept' . $deptIndex; ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-<?= $deptId ?>">
                            <button class="accordion-button <?= $deptIndex === 0 ? '' : 'collapsed' ?>" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse-<?= $deptId ?>"
                                aria-expanded="<?= $deptIndex === 0 ? 'true' : 'false' ?>"
                                aria-controls="collapse-<?= $deptId ?>">
                                <?= esc($department) ?>
                            </button>
                        </h2>
                        <div id="collapse-<?= $deptId ?>" class="accordion-collapse collapse <?= $deptIndex === 0 ? 'show' : '' ?>"
                            aria-labelledby="heading-<?= $deptId ?>" data-bs-parent="#syllabusAccordion">
                            <div class="accordion-body">
                                <?php foreach ($schemes as $scheme => $items): ?>
                                    <h5 class="text-primary mt-3"><?= esc($scheme) ?> Syllabus</h5>
                                    <ul class="list-unstyled">
                                        <?php foreach ($items as $item): ?>
                                            <li class="mb-2">
                                                <?php
                                                $filePath = 'uploads/syllabus/' . $item['file'];
                                                $fileUrl = base_url($filePath);
                                                $ext = pathinfo($item['file'], PATHINFO_EXTENSION);
                                                ?>

                                                <div class="mb-4">
                                                    <h6 class="mb-2"><?= esc($item['title']) ?></h6>

                                                    <?php if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                                        <img src="<?= $fileUrl ?>" alt="<?= esc($item['title']) ?>" class="img-fluid border rounded shadow-sm" style="max-height: 400px;">
                                                    <?php elseif (strtolower($ext) === 'pdf'): ?>
                                                        <iframe src="<?= $fileUrl ?>" width="100%" height="500px" class="border rounded shadow-sm"></iframe>
                                                    <?php else: ?>
                                                        <a href="<?= $fileUrl ?>" target="_blank" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-download"></i> Download <?= esc($item['title']) ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>

                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php $deptIndex++; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">No syllabus entries available.</div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<!-- Bootstrap JS Bundle (Required for accordion toggle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->endSection() ?>