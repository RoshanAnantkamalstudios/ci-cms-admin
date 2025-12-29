<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2>Sports Facility</h2>

    <!-- Hero Section Form -->
    <form action="<?= base_url('saveSports') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="section_type" value="hero">
        <input type="hidden" name="id" value="<?= $hero['id'] ?? '' ?>">

        <div class="card mb-4">
            <div class="card-header">Hero Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?= $hero['title'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label>Subtitle</label>
                    <textarea name="subtitle" class="form-control"><?= $hero['subtitle'] ?? '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="<?= $hero['button_text'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label>Hero Background Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($hero['image'])): ?>
                        <div class="mt-2">
                            <img src="<?= base_url('uploads/banner/' . $hero['image']) ?>" height="100">
                        </div>
                    <?php endif; ?>
                </div>
                <button class="btn btn-primary">Save Hero Section</button>
            </div>
        </div>
    </form>

    <!-- Content Section Form -->
    <form action="<?= base_url('saveSports') ?>" method="post">
        <input type="hidden" name="section_type" value="content">
        <input type="hidden" name="id" value="<?= $content['id'] ?? '' ?>">

        <div class="card mb-4">
            <div class="card-header">Content Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" rows="6" class="form-control"><?= $content['description'] ?? '' ?></textarea>
                </div>
                <button class="btn btn-primary">Save Description</button>
            </div>
        </div>
    </form>

    <!-- Image Upload Section -->
    <form action="<?= base_url('saveSports') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="section_type" value="image">

        <div class="card mb-4">
            <div class="card-header">Upload Sports Images</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Select Images</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                </div>
                <button class="btn btn-success">Upload Images</button>
            </div>
        </div>
    </form>

    <!-- Gallery -->
    <div class="card mb-4">
        <div class="card-header">Uploaded Sports Images</div>
        <div class="card-body d-flex flex-wrap gap-3">
            <?php foreach ($images as $img): ?>
                <div class="text-center">
                    <img src="<?= base_url('uploads/sports/' . $img['image']) ?>" height="100" class="rounded shadow-sm mb-1"><br>
                    <a href="<?= base_url('deleteImageSports/' . $img['id']) ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>