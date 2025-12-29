<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2>Hostel Facility CMS</h2>

    <!-- HERO SECTION -->
    <form action="<?= base_url('saveHostelFacility') ?>" method="post" enctype="multipart/form-data">
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
                    <input type="text" name="subtitle" class="form-control" value="<?= $hero['subtitle'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label>Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="<?= $hero['button_text'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label>Image</label>
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

    <!-- CONTENT SECTION -->
    <form action="<?= base_url('saveHostelFacility') ?>" method="post">
        <input type="hidden" name="section_type" value="content">
        <input type="hidden" name="id" value="<?= $content['id'] ?? '' ?>">

        <div class="card mb-4">
            <div class="card-header">Content Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="5"><?= $content['description'] ?? '' ?></textarea>
                </div>
                <button class="btn btn-primary">Save Content Section</button>
            </div>
        </div>
    </form>

    <!-- IMAGE UPLOAD SECTION -->
    <form action="<?= base_url('saveHostelFacility') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="section_type" value="image">

        <div class="card mb-4">
            <div class="card-header">Upload Hostel Images</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Girls Hostel Images</label>
                        <input type="file" name="images[]" multiple class="form-control">
                        <input type="hidden" name="group_type[]" value="girls">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Boys Hostel Images</label>
                        <input type="file" name="images[]" multiple class="form-control">
                        <input type="hidden" name="group_type[]" value="boys">
                    </div>
                </div>
                <button class="btn btn-primary">Upload Images</button>
            </div>
        </div>
    </form>

    <!-- GIRLS HOSTEL IMAGES -->
    <div class="card mb-4">
        <div class="card-header">Girls Hostel Images</div>
        <div class="card-body d-flex flex-wrap gap-3">
            <?php foreach ($images_girls as $img): ?>
                <div class="border p-2 text-center">
                    <img src="<?= base_url('uploads/hostel/' . $img['image']) ?>" height="100"><br>
                    <a href="<?= base_url('deleteHostelImage/' . $img['id']) ?>" class="btn btn-sm btn-danger mt-1" onclick="return confirm('Delete this image?')">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- BOYS HOSTEL IMAGES -->
    <div class="card mb-4">
        <div class="card-header">Boys Hostel Images</div>
        <div class="card-body d-flex flex-wrap gap-3">
            <?php foreach ($images_boys as $img): ?>
                <div class="border p-2 text-center">
                    <img src="<?= base_url('uploads/hostel/' . $img['image']) ?>" height="100"><br>
                    <a href="<?= base_url('deleteHostelImage/' . $img['id']) ?>" class="btn btn-sm btn-danger mt-1" onclick="return confirm('Delete this image?')">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>