<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
    .cms-card {
        border-radius: 8px;
    }
    .cms-section-title {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 12px;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 6px;
    }
    .img-preview img {
        height: 110px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #dee2e6;
    }
    .upload-box {
        border: 1px dashed #ced4da;
        border-radius: 6px;
        padding: 15px;
        background: #fafafa;
    }
</style>

<div class="page-inner">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="container-fluid mt-4">
        <div class="card cms-card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Hero Section</h5>
                <small class="text-muted">Manage homepage hero content</small>
            </div>

            <div class="card-body">
                <form method="post"
                      action="<?= base_url('admin/hero/save') ?>"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $hero['id'] ?? '' ?>">
                    <input type="hidden" name="existing_images"
                           value='<?= isset($hero["images"]) ? json_encode($hero["images"]) : "[]" ?>'>

                    <!-- BASIC INFO -->
                    <div class="mb-4">
                        <div class="cms-section-title">Basic Information</div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Small Title</label>
                                <input type="text"
                                       name="small_title"
                                       class="form-control"
                                       value="<?= $hero['small_title'] ?? '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Main Title</label>
                                <input type="text"
                                       name="main_title"
                                       class="form-control"
                                       value="<?= $hero['main_title'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label">Description</label>
                            <textarea name="description"
                                      rows="4"
                                      class="form-control"><?= $hero['description'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="mb-4">
                        <div class="cms-section-title">Call To Action</div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Button Text</label>
                                <input type="text"
                                       name="button_text"
                                       class="form-control"
                                       value="<?= $hero['button_text'] ?? '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Button Link</label>
                                <input type="text"
                                       name="button_link"
                                       class="form-control"
                                       value="<?= $hero['button_link'] ?? '' ?>">
                            </div>
                        </div>
                    </div>

                    <!-- HERO IMAGES -->
                    <div class="mb-4">
                        <div class="cms-section-title">Hero Images</div>

                        <div class="upload-box mb-3">
                            <label class="form-label fw-semibold">Upload Images</label>
                            <input type="file"
                                   name="hero_images[]"
                                   class="form-control"
                                   multiple
                                   accept="image/*">
                            <small class="text-muted">
                                You can upload multiple images (JPG, PNG).
                            </small>
                        </div>

                        <?php if (!empty($hero['images'])): ?>
                            <div class="row g-3">
                                <?php foreach ($hero['images'] as $index => $img): ?>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                        <div class="img-preview">
                                            <img src="<?= base_url($img) ?>"
                                                 class="img-fluid"
                                                 alt="Hero Image <?= $index + 1 ?>">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- SAVE -->
                    <div class="text-end pt-3 border-top">
                        <button type="submit"
                                class="btn btn-primary px-4">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<script>
    $(document).ready(function () {
        $('.summernote').summernote({
            height: 220
        });
    });
</script>
<?= $this->endSection() ?>
