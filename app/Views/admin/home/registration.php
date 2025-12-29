<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">🎓 Admission Section Settings</h2>
    </div>

    <?php if (session('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form method="post" action="<?= base_url('saveregistration') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $admission['id'] ?? '' ?>">

                <div class="row g-3">

                    <div class="col-md-12">
                        <label class="form-label fw-semibold"><i class="bi bi-megaphone-fill me-1"></i> Heading</label>
                        <input type="text" name="heading" class="form-control rounded-pill"
                            value="<?= esc($admission['heading'] ?? '') ?>" placeholder="Enter section heading...">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold"><i class="bi bi-textarea-resize me-1"></i> Description</label>
                        <textarea name="description" rows="4" class="form-control rounded-4"
                            placeholder="Write a short paragraph..."><?= esc($admission['description'] ?? '') ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="bi bi-calendar-event me-1"></i> End Date (for Countdown)</label>
                        <input type="date" name="end_date" class="form-control rounded-pill"
                            value="<?= esc($admission['end_date'] ?? '') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold"><i class="bi bi-pencil-square me-1"></i> Form Title</label>
                        <input type="text" name="form_title" class="form-control rounded-pill"
                            value="<?= esc($admission['form_title'] ?? '') ?>" placeholder="e.g., Register Now">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold"><i class="bi bi-chat-dots me-1"></i> Form Subtitle</label>
                        <input type="text" name="form_subtitle" class="form-control rounded-pill"
                            value="<?= esc($admission['form_subtitle'] ?? '') ?>" placeholder="e.g., Start your journey today.">
                    </div>

                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                        <i class="bi bi-save me-1"></i> Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<!-- Optional: JS alert fadeout -->
<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) alert.classList.add('fade');
    }, 3000);
</script>
<?= $this->endSection() ?>
