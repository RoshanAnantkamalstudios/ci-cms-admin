<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h1 class="mb-4">Student Admission Form</h1>
    <form action="<?= base_url('save_HeroSection') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= isset($hero['id']) ? $hero['id'] : '' ?>">

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="hero_title" value="<?= esc($hero['title'] ?? '') ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="hero_subtitle" value="<?= esc($hero['subtitle'] ?? '') ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Button Name</label>
            <input type="text" name="hero_button" value="<?= esc($hero['button_text'] ?? '') ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Background Image</label>
            <input type="file" name="hero_image" class="form-control">
            <?php if (!empty($hero['image'])): ?>
                <img src="<?= base_url('uploads/hero/' . $hero['image']) ?>" alt="Hero Image" class="mt-2" height="80">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Save Page</button>
    </form>
</div>


<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>