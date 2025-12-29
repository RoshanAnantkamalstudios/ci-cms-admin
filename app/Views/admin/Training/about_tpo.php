<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h1 class="mb-4">Manage Training & Placement Cell</h1>

    <!-- Hero Section Form -->
    <h3>Hero Section</h3>
    <form action="<?= base_url('saveAboutTpo') ?>" method="post" enctype="multipart/form-data" class="mb-5">
        <input type="hidden" name="section_type" value="hero">
        <input type="hidden" name="id" value="<?= esc($hero['id'] ?? '') ?>">

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="<?= esc($hero['subtitle'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label>Button Text</label>
            <input type="text" name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label>Background Image</label>
            <input type="file" name="image" class="form-control">
            <?php if (!empty($hero['image'])): ?>
                <img src="<?= base_url('uploads/' . $hero['image']) ?>" width="150" class="mt-2">
                <input type="hidden" name="existing_image" value="<?= esc($hero['image']) ?>">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Save Hero Section</button>
    </form>

    <hr>

    <!-- TPO Profile Form -->
    <h3>TPO Profile</h3>
    <form action="<?= base_url('saveAboutTpo') ?>" method="post" enctype="multipart/form-data" class="mb-5">
        <input type="hidden" name="section_type" value="profile">
        <input type="hidden" name="id" value="<?= esc($profile['id'] ?? '') ?>">

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="title" class="form-control" value="<?= esc($profile['title'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label>Qualification</label>
            <input type="text" name="subtitle" class="form-control" value="<?= esc($profile['subtitle'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            <?php if (!empty($profile['image'])): ?>
                <img src="<?= base_url('uploads/' . $profile['image']) ?>" width="150" class="mt-2">
                <input type="hidden" name="existing_image" value="<?= esc($profile['image']) ?>">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Save Profile</button>
    </form>

    <hr>

    <!-- About Section Form -->
    <h3>About TPO Section</h3>
    <form action="<?= base_url('saveAboutTpo') ?>" method="post">
        <input type="hidden" name="section_type" value="about">
        <input type="hidden" name="id" value="<?= esc($about['id'] ?? '') ?>">

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" rows="6" class="form-control summernote"><?= esc($about['description'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save About Section</button>
    </form>

    <hr>

    <!-- Placement Procedure Form -->
    <h3>Placement Procedure (Steps as List)</h3>
    <form action="<?= base_url('saveAboutTpo') ?>" method="post">
        <input type="hidden" name="section_type" value="procedure">
        <input type="hidden" name="id" value="<?= esc($procedure['id'] ?? '') ?>">

        <div class="mb-3">
            <label>Steps (one per line)</label>
            <textarea name="extra" rows="8" class="form-control summernote"><?= esc($procedure['extra'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Procedure</button>
    </form>

    <hr>

    <!-- Carousel Upload -->
    <h3>Upload Carousel Image</h3>
    <form action="<?= base_url('saveAboutTpo') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="section_type" value="carousel">

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Upload</button>
    </form>

    <div class="row mt-4">
        <?php foreach ($carousel as $item): ?>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="<?= base_url('uploads/' . $item['image']) ?>" class="card-img-top">
                    <div class="card-body text-center">
                        <a href="<?= base_url('deleteAboutTpo/' . $item['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<?= $this->endSection() ?>