<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2>Transportation</h2>

    <!-- Hero Section Form -->
    <form action="<?= base_url('saveTransport') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="section_type" value="hero">
        <input type="hidden" name="id" value="<?= $hero['id'] ?? '' ?>">

        <div class="card mb-4">
            <div class="card-header">Hero Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Subtitle</label>
                    <textarea name="subtitle" class="form-control"><?= esc($hero['subtitle'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Background Image</label>
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
    <form action="<?= base_url('saveTransport') ?>" method="post">
        <input type="hidden" name="section_type" value="content">
        <input type="hidden" name="id" value="<?= $content['id'] ?? '' ?>">

        <div class="card mb-4">
            <div class="card-header">Transportation Description</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Bullet Point Description</label>
                    <textarea name="description" rows="6" class="form-control summernote"><?= esc($content['description'] ?? '') ?></textarea>
                    <!-- <small class="text-muted">Use bullet points using HTML list if needed (e.g., &lt;ul&gt;&lt;li&gt;...)</small> -->
                </div>
                <button class="btn btn-primary">Save Description</button>
            </div>
        </div>
    </form>

    <!-- Image Upload Section -->
    <form action="<?= base_url('saveTransport') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="section_type" value="image">

        <div class="card mb-4">
            <div class="card-header">Upload Transportation Images</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Select Images</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                </div>
                <button class="btn btn-success">Upload Images</button>
            </div>
        </div>
    </form>

    <!-- Uploaded Images -->
    <div class="card mb-4">
        <div class="card-header">Uploaded Images</div>
        <div class="card-body d-flex flex-wrap gap-3">
            <?php if (!empty($images)): ?>
                <?php foreach ($images as $img): ?>
                    <div class="text-center">
                        <img src="<?= base_url('uploads/transport/' . $img['image']) ?>" height="100" class="rounded shadow-sm mb-1"><br>
                        <a href="<?= base_url('deleteImageTransport/' . $img['id']) ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No images uploaded yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>


<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>