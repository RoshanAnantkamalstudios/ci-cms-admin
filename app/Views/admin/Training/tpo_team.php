<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h1 class="mb-4">Training & Placement Cell Team</h1>

    <!-- HERO FORM -->
    <h2>Hero Section</h2>
    <form action="<?= base_url('saveTpoTeam') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="section_type" value="hero">
        <div class="mb-3">
            <label>Hero Title</label>
            <input type="text" name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="<?= esc($hero['subtitle'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label>Button Text</label>
            <input type="text" name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Background Image</label>
            <?php if (!empty($hero['image'])): ?>
                <div class="mb-2">
                    <img src="<?= base_url('uploads/' . $hero['image']) ?>" width="150">
                </div>
            <?php endif; ?>
            <input type="file" name="image" class="form-control">
        </div>
        <input type="hidden" name="id" value="<?= esc($hero['id'] ?? '') ?>">
        <button type="submit" class="btn btn-primary">Save Hero Section</button>
    </form>

    <hr class="my-5">

    <!-- MEMBER FORM -->
    <h2>Add Team Member</h2>
    <form action="<?= base_url('saveTpoTeam') ?>" method="post">
        <input type="hidden" name="section_type" value="member">
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Department</label>
            <input type="text" name="department" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Member</button>
    </form>

    <!-- Member List -->
    <?php if ($members): ?>
        <h4 class="mt-5">Team Members</h4>
        <ul class="list-group mb-4">
            <?php foreach ($members as $member): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?= esc($member['name']) ?></strong> — <?= esc($member['department']) ?> (<?= esc($member['designation']) ?>)
                    </div>
                    <a href="<?= base_url('deleteTpoTeam/' . $member['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <hr class="my-5">

    <!-- CAROUSEL FORM -->
    <h2>Add Carousel Image</h2>
    <form action="<?= base_url('saveTpoTeam') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="section_type" value="carousel">
        <div class="mb-3">
            <label>Carousel Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-warning">Upload Carousel Image</button>
    </form>

    <!-- Carousel Preview -->
    <?php if ($carousel): ?>
        <h4 class="mt-5">Uploaded Carousel Images</h4>
        <div class="d-flex flex-wrap gap-3">
            <?php foreach ($carousel as $slide): ?>
                <div class="position-relative" style="width: 200px;">
                    <img src="<?= base_url('uploads/' . $slide['image']) ?>" class="img-thumbnail" style="width: 100%;">
                    <a href="<?= base_url('deleteTpoTeam/' . $slide['id']) ?>" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">×</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>
<!-- Optional: Add JS for preview or enhancements -->
<?= $this->endsection() ?>