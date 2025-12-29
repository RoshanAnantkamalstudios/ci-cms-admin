<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h1 class="mb-4">Contact Us</h1>

    <!-- Hero Section Form -->
    <form action="<?= base_url('saveHero') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <h4>Hero Section</h4>
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="<?= esc($hero['subtitle'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Banner Image</label>
            <input type="file" name="banner_image" class="form-control">
            <?php if (!empty($hero['banner_image'])): ?>
                <img src="<?= base_url('uploads/' . $hero['banner_image']) ?>" width="150" class="mt-2">
            <?php endif; ?>
        </div>
        <button class="btn btn-primary">Save Hero</button>
    </form>

    <!-- Communication Info Form -->
    <form action="<?= base_url('save-communication') ?>" method="post" class="card p-4 mb-4">
        <?= csrf_field() ?>
        <h4>Communication Info</h4>

        <?php
        // Define expected types with labels
        $types = ['central_office' => 'Central Office', 'campus_address' => 'Campus Address', 'accessibility' => 'Accessibility'];

        // Map existing communication data by type
        $communicationData = [];
        if (!empty($communication)) {
            foreach ($communication as $item) {
                $communicationData[$item['type']] = $item;
            }
        }
        ?>

        <?php foreach ($types as $key => $label): ?>
            <?php
            $data = $communicationData[$key] ?? ['title' => '', 'description' => '', 'extra_data' => '{}'];
            $extra = json_decode($data['extra_data'] ?? '{}', true);
            ?>
            <div class="mb-4 border rounded p-3 bg-light">
                <h5><?= esc($label) ?></h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="<?= $key ?>_title" class="form-control" value="<?= esc($data['title']) ?>">
                    </div>
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea name="<?= $key ?>_description" class="form-control summernote" rows="2"><?= esc($data['description']) ?></textarea>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <button class="btn btn-primary">Save Communication</button>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<!-- Custom Scripts if needed -->
<?= $this->endSection() ?>