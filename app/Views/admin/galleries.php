<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2>Gallery Page CMS</h2>

    <?php if (session('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>

    <!-- Hero Section Form -->
    <form method="post" enctype="multipart/form-data" action="<?= base_url('updateGalleryHero') ?>" class="card p-4 mb-4">
        <?= csrf_field() ?>
        <h4 class="mb-3">Hero Section</h4>
        <div class="row g-3">
            <div class="col-md-6">
                <label>Hero Title</label>
                <input type="text" name="hero_title" class="form-control" value="<?= esc($hero['hero_title'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label>Hero Subtitle</label>
                <input type="text" name="hero_subtitle" class="form-control" value="<?= esc($hero['hero_subtitle'] ?? '') ?>">
            </div>
            <div class="col-md-12">
                <label>Banner Image</label>
                <input type="file" name="banner_image" class="form-control">
                <?php if (!empty($hero['banner_image'])): ?>
                    <img src="<?= base_url('uploads/' . $hero['banner_image']) ?>" width="150" class="mt-2">
                <?php endif; ?>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-success">Save Hero Section</button>
        </div>
    </form>

    <!-- Add New Image Modal Trigger -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">+ Add Gallery Images</button>

    <!-- Gallery List -->
    <div class="row g-4">
        <?php if (!empty($gallery)): ?>
            <?php foreach ($gallery as $item): ?>
                <div class="col-md-3">
                    <div class="card h-100">
                        <?php if (!empty($item['image'])): ?>
                            <img src="<?= base_url('uploads/' . $item['image']) ?>" class="card-img-top" alt="Gallery Image">
                        <?php endif; ?>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3"><?= esc($item['title'] ?? 'Untitled') ?></h5>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <a href="<?= base_url('deleteGallery/' . $item['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this item?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <form method="post" enctype="multipart/form-data" action="<?= base_url('updateGallery/' . $item['id']) ?>">
                            <?= csrf_field() ?>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Gallery Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body row g-3">
                                    <div class="col-md-12">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="<?= esc($item['title']) ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <?php if (!empty($item['image'])): ?>
                                            <img src="<?= base_url('uploads/' . $item['image']) ?>" width="100" class="mt-2">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="alert alert-warning">No gallery images available.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="post" enctype="multipart/form-data" action="<?= base_url('storeGallery') ?>">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Gallery Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-12">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Upload Gallery Images</label>
                        <input type="file" name="image[]" class="form-control" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<!-- You can place additional JS if needed here -->
<?= $this->endSection() ?>