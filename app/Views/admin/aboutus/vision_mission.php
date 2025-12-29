<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2 class="mb-4">Manage Vision & Mission</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('save_vision_mssion') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-4">
            <h4>Hero Section</h4>
            <input type="text" name="hero_heading" class="form-control mb-2" placeholder="Hero Heading" value="<?= esc($vm['hero_heading'] ?? '') ?>">
            <textarea name="hero_subheading" class="form-control mb-2" placeholder="Hero Subheading"><?= esc($vm['hero_subheading'] ?? '') ?></textarea>
            <input type="text" name="hero_button_text" class="form-control mb-2" placeholder="Button Text" value="<?= esc($vm['hero_button_text'] ?? '') ?>">
            <input type="text" name="hero_button_link" class="form-control mb-2" placeholder="Button Link" value="<?= esc($vm['hero_button_link'] ?? '') ?>">

            <label class="form-label">Banner Image (JPG/PNG)</label>
            <?php if (!empty($vm['hero_banner_image'])): ?>
                <div class="mb-2">
                    <img src="<?= base_url('public/uploads/' . $vm['hero_banner_image']) ?>" alt="Banner" style="max-height: 150px;">
                </div>
            <?php endif; ?>
            <input type="file" name="hero_banner_file" class="form-control mb-3" accept="image/*">
        </div>

        <div class="mb-4">
            <h4>Section Heading</h4>
            <input type="text" name="section_heading" class="form-control mb-2" placeholder="Section Heading" value="<?= esc($vm['section_heading'] ?? '') ?>">
            <textarea name="section_subheading" class="form-control" placeholder="Section Subheading"><?= esc($vm['section_subheading'] ?? '') ?></textarea>
        </div>

        <div class="mb-4">
            <h4>Our Belief</h4>
            <input type="text" name="belief_title" class="form-control mb-2" placeholder="Belief Title" value="<?= esc($vm['belief_title'] ?? '') ?>">
            <textarea name="belief_description" class="form-control mb-2 summernote" placeholder="Belief Description"><?= esc($vm['belief_description'] ?? '') ?></textarea>
            <input type="text" name="belief_icon" class="form-control mb-2" placeholder="Belief Icon Class (e.g., bi bi-lightbulb)" value="<?= esc($vm['belief_icon'] ?? '') ?>">
        </div>

        <div class="mb-4">
            <h4>Our Vision</h4>
            <input type="text" name="vision_title" class="form-control mb-2" placeholder="Vision Title" value="<?= esc($vm['vision_title'] ?? '') ?>">
            <textarea name="vision_description" class="form-control mb-2 summernote" placeholder="Vision Description"><?= esc($vm['vision_description'] ?? '') ?></textarea>
            <input type="text" name="vision_icon" class="form-control mb-2" placeholder="Vision Icon Class (e.g., bi bi-eye)" value="<?= esc($vm['vision_icon'] ?? '') ?>">
        </div>

        <div class="mb-4">
            <h4>Our Mission</h4>
            <input type="text" name="mission_title" class="form-control mb-2" placeholder="Mission Title" value="<?= esc($vm['mission_title'] ?? '') ?>">
            <textarea name="mission_description" class="form-control mb-2 summernote" placeholder="Mission Description"><?= esc($vm['mission_description'] ?? '') ?></textarea>
            <input type="text" name="mission_icon" class="form-control mb-2" placeholder="Mission Icon Class (e.g., bi bi-flag)" value="<?= esc($vm['mission_icon'] ?? '') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

</div>

<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>