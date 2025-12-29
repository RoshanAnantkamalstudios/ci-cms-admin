<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h1 class="mb-4">President's Desk Page</h1>

    <?php if (session('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('save_board_page') ?>" method="post" enctype="multipart/form-data">

        <!-- Hero Section -->
        <div class="card mb-4">
            <div class="card-header fw-bold">Hero Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="hero_title" class="form-control" value="<?= esc($data['hero_title'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label>Subtitle</label>
                    <input type="text" name="hero_subtitle" class="form-control" value="<?= esc($data['hero_subtitle'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Background Image</label>
                    <input type="file" name="hero_image" class="form-control">
                    <?php if (!empty($data['hero_image'])): ?>
                        <img src="<?= base_url($data['hero_image']) ?>" alt="Hero Image" class="img-thumbnail mt-2" style="height:100px">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- President Desk -->
        <div class="card mb-4">
            <div class="card-header fw-bold">President's Desk</div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="fw-bold">Overview</div>
                    <textarea name="overview" class="form-control summernote"><?= esc($data['overview'] ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label>President Desk Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($data['president_image'])): ?>
                        <img src="<?= base_url($data['president_image']) ?>" class="img-thumbnail mt-2" style="height:100px">
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label>President Name</label>
                    <input type="text" name="president_name" class="form-control" value="<?= esc($data['president_name'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control" value="<?= esc($data['designation'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="<?= esc($data['address'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Mobile No.</label>
                    <input type="text" name="mobile_no" class="form-control" value="<?= esc($data['mobile_no'] ?? '') ?>">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Page</button>
    </form>
</div>

<?= $this->endSection() ?>


<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>