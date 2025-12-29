<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h1 class="mb-4">Manage List of Students Placed</h1>

    <!-- Hero Section Form -->
    <h3>Hero Section</h3>
    <form action="<?= base_url('savePlacedStudent') ?>" method="post" enctype="multipart/form-data" class="mb-5">
        <input type="hidden" name="section_type" value="hero">

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="<?= esc($hero['subtitle'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label>Button Text</label>
            <input type="text" name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label>Background Image</label>
            <input type="file" name="image" class="form-control">
            <?php if (!empty($hero['image'])): ?>
                <img src="<?= base_url('uploads/' . $hero['image']) ?>" width="150" class="mt-2">
                <input type="hidden" name="existing_image" value="<?= esc($hero['image']) ?>">
            <?php endif; ?>
        </div>

        <input type="hidden" name="id" value="<?= esc($hero['id'] ?? '') ?>">
        <button type="submit" class="btn btn-primary">Save Hero Section</button>
    </form>

    <hr>

    <!-- Add Student Form -->
    <h3>Add Placed Student</h3>
    <form action="<?= base_url('savePlacedStudent') ?>" method="post" enctype="multipart/form-data" class="mb-5">
        <input type="hidden" name="section_type" value="student">

        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Branch</label>
            <input type="text" name="branch" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Company</label>
            <input type="text" name="company" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Student Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Add Student</button>
    </form>

    <hr>

    <!-- Carousel Form -->
    <h3>Add Carousel Image</h3>
    <form action="<?= base_url('savePlacedStudent') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="section_type" value="carousel">

        <div class="mb-3">
            <label>Carousel Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-warning">Upload Carousel Image</button>
    </form>

    <hr>

    <!-- Carousel List -->
    <h3>Uploaded Carousel Images</h3>
    <div class="row">
        <?php foreach ($carousel as $item): ?>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="<?= base_url('uploads/' . $item['image']) ?>" class="card-img-top">
                    <div class="card-body text-center">
                        <a href="<?= base_url('deletePlacedStudent/' . $item['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <hr>

    <!-- Placed Students Table -->
    <h3>Placed Students</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Branch</th>
                <th>Company</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= esc($student['name']) ?></td>
                    <td><?= esc($student['branch']) ?></td>
                    <td><?= esc($student['company']) ?></td>
                    <td><img src="<?= base_url('uploads/' . $student['image']) ?>" width="100"></td>
                    <td><a href="<?= base_url('deletePlacedStudent/' . $student['id']) ?>" class="btn btn-sm btn-danger">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<?= $this->endSection() ?>
