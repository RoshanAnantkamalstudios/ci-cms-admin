<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="page-inner">
    <h1 class="mb-4">Principal's Desk CMS</h1>

    <?php if (session('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('save_principal_desk') ?>" method="post" enctype="multipart/form-data">
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
                        <img src="<?= base_url($data['hero_image']) ?>" height="100">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header fw-bold">Principal Info</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Message</label>
                    <textarea name="message" class="form-control summernote"><?= esc($data['message'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Principal Image</label>
                    <input type="file" name="principal_image" class="form-control">
                    <?php if (!empty($data['principal_image'])): ?>
                        <img src="<?= base_url($data['principal_image']) ?>" height="100">
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label>Principal Name</label>
                    <input type="text" name="principal_name" class="form-control" value="<?= esc($data['principal_name'] ?? '') ?>" required>
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

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>