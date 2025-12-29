<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2 class="mb-4">Manage Institute-Industry Association (MOU)</h2>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- HERO SECTION FORM -->
    <div class="card mb-5">
        <div class="card-header bg-dark text-white">Hero Section</div>
        <div class="card-body">
            <form action="<?= base_url('saveMous') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="section_type" value="hero">
                <input type="hidden" name="id" value="<?= $hero['id'] ?? '' ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" value="<?= esc($hero['title'] ?? '') ?>" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" value="<?= esc($hero['subtitle'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Button Text</label>
                        <input type="text" name="button_text" value="<?= esc($hero['button_text'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Banner Image</label>
                        <input type="file" name="image" class="form-control">
                        <?php if (!empty($hero['image'])): ?>
                            <img src="<?= base_url($hero['image']) ?>" width="150" class="mt-2">
                            <input type="hidden" name="existing_image" value="<?= esc($hero['image']) ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-success">Save Hero Section</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MOU TABLE FORM -->
    <div class="card mb-5">
        <div class="card-header bg-secondary text-white">Add MOU Entry</div>
        <div class="card-body">
            <form action="<?= base_url('saveMous') ?>" method="post">
                <input type="hidden" name="section_type" value="mou">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Organization Name</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Branches (Comma Separated)</label>
                        <input type="text" name="extra" placeholder="Mechanical, Electrical" class="form-control" required>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-success">Add MOU</button>
                </div>
            </form>

            <!-- Existing MOU Table -->
            <hr>
            <h5 class="mt-4">Existing MOUs</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Organization</th>
                        <th>Branches</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mous as $mou): ?>
                        <tr>
                            <td><?= esc($mou['title']) ?></td>
                            <td><?= esc($mou['extra']) ?></td>
                            <td>
                                <a href="<?= base_url('deleteMous/' . $mou['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this MOU?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- CAROUSEL FORM -->
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">Carousel Image</div>
        <div class="card-body">
            <form action="<?= base_url('saveMous') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="section_type" value="carousel">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Upload Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Alt Text / Description</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-success">Upload Carousel Image</button>
                </div>
            </form>

            <!-- Existing Carousel Images -->
            <hr>
            <h5 class="mt-4">Carousel Gallery</h5>
            <div class="row g-3">
                <?php foreach ($carousel as $item): ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="<?= base_url($item['image']) ?>" class="card-img-top" alt="<?= esc($item['title']) ?>">
                            <div class="card-body text-center">
                                <small><?= esc($item['title']) ?></small><br>
                                <a href="<?= base_url('deleteMous/' . $item['id']) ?>" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Delete image?')">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>