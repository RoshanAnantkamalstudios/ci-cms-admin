<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h3 class="mb-4">Campus Placements Management</h3>

    <!-- Hero Section -->
    <div class="card mb-4">
        <div class="card-header">Hero Section</div>
        <div class="card-body">
            <form action="<?= base_url('saveCampus') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= esc($hero['id'] ?? '') ?>">
                <input type="hidden" name="section" value="hero">

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Subtitle</label>
                    <textarea name="subtitle" class="form-control"><?= esc($hero['subtitle'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Hero Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($hero['image'])): ?>
                        <div class="mt-2">
                            <img src="<?= base_url('uploads/placements/' . $hero['image']) ?>" alt="Hero" height="120">
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-success">Save Hero</button>
            </form>
        </div>
    </div>

    <!-- About Section Form -->
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>About Section</strong>
        </div>
        <div class="card-body">
            <form action="<?= base_url('saveCampus') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="section" value="about">
                <input type="hidden" name="id" value="<?= $about['id'] ?? '' ?>">
                <div class="mb-2">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?= esc($about['title'] ?? '') ?>">
                </div>
                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?= esc($about['description'] ?? '') ?></textarea>
                </div>
                <div class="mb-2">
                    <label>Icon</label>
                    <select name="icon" class="form-select">
                        <option value="bi-building" <?= ($about['icon'] ?? '') == 'bi-building' ? 'selected' : '' ?>>Building</option>
                        <option value="bi-mortarboard" <?= ($about['icon'] ?? '') == 'bi-mortarboard' ? 'selected' : '' ?>>Education</option>
                        <option value="bi-info-circle" <?= ($about['icon'] ?? '') == 'bi-info-circle' ? 'selected' : '' ?>>Info</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($about['image'])): ?>
                        <div class="mt-2">
                            <img src="<?= base_url('uploads/placements/' . $about['image']) ?>" alt="about" height="120">
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>


    <!-- Recruiters Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <span>Recruiters</span>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addRecruiter">+ Add</button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Logo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recruiters as $r): ?>
                        <tr>
                            <td><?= esc($r['title']) ?></td>
                            <td><img src="<?= base_url('uploads/placements/' . $r['image']) ?>" alt="" height="60"></td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editRecruiter<?= $r['id'] ?>">Edit</button>
                                <a href="<?= base_url('deleteCampus/' . $r['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- MODALS should go below the table -->
            <?php foreach ($recruiters as $r): ?>
                <div class="modal fade" id="editRecruiter<?= $r['id'] ?>" tabindex="-1" aria-labelledby="editLabel<?= $r['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="<?= base_url('saveCampus') ?>" method="post" enctype="multipart/form-data" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editLabel<?= $r['id'] ?>">Edit Recruiter</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                <input type="hidden" name="section" value="recruiter">
                                <div class="mb-2">
                                    <label>Company Name</label>
                                    <input type="text" name="title" value="<?= esc($r['title']) ?>" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label>Logo</label>
                                    <input type="file" name="image" class="form-control">
                                    <?php if (!empty($r['image'])): ?>
                                        <div class="mt-2">
                                            <img src="<?= base_url('uploads/placements/' . $r['image']) ?>" alt="Hero" height="120">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Application Process Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <span>Application Process</span>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addProcess">+ Add</button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($process as $step): ?>
                        <tr>
                            <td><i class="bi <?= esc($step['icon']) ?>"></i> <?= esc($step['icon']) ?></td>
                            <td><?= esc($step['title']) ?></td>
                            <td><?= esc($step['description']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProcess<?= $step['id'] ?>">Edit</button>
                                <a href="<?= base_url('deleteCampus/' . $step['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Modals: Render separately outside table -->
            <?php foreach ($process as $step): ?>
                <div class="modal fade" id="editProcess<?= $step['id'] ?>" tabindex="-1" aria-labelledby="editProcessLabel<?= $step['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="<?= base_url('saveCampus') ?>" method="post" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProcessLabel<?= $step['id'] ?>">Edit Step</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $step['id'] ?>">
                                <input type="hidden" name="section" value="process">
                                <div class="mb-2">
                                    <label>Icon</label>
                                    <select name="icon" class="form-select">
                                        <option value="bi-search" <?= $step['icon'] == 'bi-search' ? 'selected' : '' ?>>Search</option>
                                        <option value="bi-file-earmark-text" <?= $step['icon'] == 'bi-file-earmark-text' ? 'selected' : '' ?>>File</option>
                                        <option value="bi-person-check" <?= $step['icon'] == 'bi-person-check' ? 'selected' : '' ?>>Check</option>
                                        <option value="bi-lightning-charge-fill" <?= $step['icon'] == 'bi-lightning-charge-fill' ? 'selected' : '' ?>>Fast</option>
                                        <option value="bi-briefcase" <?= $step['icon'] == 'bi-briefcase' ? 'selected' : '' ?>>Briefcase</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="<?= esc($step['title']) ?>">
                                </div>
                                <div class="mb-2">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3"><?= esc($step['description']) ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Add Recruiter Modal -->
<div class="modal fade" id="addRecruiter" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('saveCampus') ?>" method="post" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5>Add Recruiter</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" name="section" value="recruiter">
                <div class="mb-2">
                    <label>Company Name</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Logo</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Process Step Modal -->
<div class="modal fade" id="addProcess" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('saveCampus') ?>" method="post" class="modal-content">
            <div class="modal-header">
                <h5>Add Step</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" name="section" value="process">
                <div class="mb-2">
                    <label>Icon</label>
                    <select name="icon" class="form-select">
                        <option value="bi-search">Search</option>
                        <option value="bi-file-earmark-text">File</option>
                        <option value="bi-person-check">Check</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Add</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>