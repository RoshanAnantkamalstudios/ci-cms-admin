<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2 class="mb-4">Manage Cafeteria</h2>

    <!-- Hero Section Form -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">Hero Section</div>
        <div class="card-body">
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('saveCafeteria') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($hero['id'] ?? '') ?>">
                <input type="hidden" name="section_type" value="hero">

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <textarea name="subtitle" class="form-control"><?= esc($hero['subtitle'] ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Banner Image</label>
                    <?php if (!empty($hero['image'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/banner/' . $hero['image']) ?>" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    <?php endif ?>
                    <input type="file" name="image" class="form-control">
                </div>

                <button class="btn btn-primary">Save Hero</button>
            </form>
        </div>
    </div>

    <!-- About Section Form -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">About Section</div>
        <div class="card-body">
            <form action="<?= base_url('saveCafeteria') ?>" method="post">
                <input type="hidden" name="id" value="<?= $about['id'] ?? '' ?>">
                <input type="hidden" name="section_type" value="about">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?= esc($about['title'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?= esc($about['description'] ?? '') ?></textarea>
                </div>
                <button class="btn btn-primary">Save About</button>
            </form>
        </div>
    </div>

    <!-- Image Upload Form -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">Upload Images with Description</div>
        <div class="card-body">
            <form action="<?= base_url('saveCafeteria') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="section_type" value="image">

                <div id="image-upload-group">
                    <div class="row mb-3 image-upload-item">
                        <div class="col-md-6">
                            <label class="form-label">Image</label>
                            <input type="file" name="images[]" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description</label>
                            <input type="text" name="descriptions[]" class="form-control" placeholder="Image description">
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="addImageField()">+ Add More</button>
                <button class="btn btn-success">Upload</button>
            </form>
        </div>
    </div>

    <!-- Uploaded Images List -->
    <div class="card mb-5">
        <div class="card-header bg-dark text-white">Uploaded Images</div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($images as $img): ?>
                    <div class="col-md-4 mb-4 text-center">
                        <img src="<?= base_url('uploads/cafeteria/' . $img['image']) ?>" class="img-fluid rounded shadow-sm mb-2" style="max-height: 180px;">
                        <p><?= esc($img['description']) ?></p>
                        <a href="<?= base_url('deleteCafeteria/' . $img['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">Delete</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<script>
    function addImageField() {
        const group = document.createElement('div');
        group.className = 'row mb-3 image-upload-item';

        group.innerHTML = `
            <div class="col-md-6">
                <input type="file" name="images[]" class="form-control" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="descriptions[]" class="form-control" placeholder="Image description">
            </div>
        `;
        document.getElementById('image-upload-group').appendChild(group);
    }
</script>
<?= $this->endSection() ?>
