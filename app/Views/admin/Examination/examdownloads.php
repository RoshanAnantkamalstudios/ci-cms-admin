<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2 class="mb-4">Examination Downloads</h2>

    <!-- Hero Section -->
    <div class="card mb-5">
        <div class="card-header">Hero Section</div>
        <div class="card-body">
            <form action="<?= base_url('saveHeroExamDownload') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= esc($hero['id'] ?? '') ?>">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Title</label>
                        <input type="text" name="title_text" class="form-control" value="<?= esc($hero['title_text'] ?? '') ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle_text" class="form-control" value="<?= esc($hero['subtitle_text'] ?? '') ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Button Text</label>
                        <input type="text" name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Hero Image</label>
                        <input type="file" name="banner_image" class="form-control">
                        <?php if (!empty($hero['banner_image'])): ?>
                            <div class="mb-2">
                                <small class="d-block text-muted">Current Banner Image:</small>
                                <img src="<?= base_url('uploads/banners/' . $hero['banner_image']) ?>"
                                    alt="Current Banner"
                                    class="img-thumbnail mt-1"
                                    style="max-height: 150px;">
                                <!-- <small class="d-block mt-1 text-muted"><= esc($hero['banner_image']) ?></small> -->
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save Hero</button>
            </form>
        </div>
    </div>

    <!-- Downloads Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Download Entries</span>
            <button class="btn btn-sm btn-light bg-success text-light" data-bs-toggle="modal" data-bs-target="#addModal">+ Add</button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($entries as $entry): ?>
                        <tr>
                            <td><?= esc($entry['department']) ?></td>
                            <td><?= esc($entry['category']) ?></td>
                            <td><?= esc($entry['title']) ?></td>
                            <td>
                                <a href="<?= base_url('uploads/downloads/' . $entry['file']) ?>" target="_blank">View</a>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editModal<?= $entry['id'] ?>">Edit</button>
                                <a href="<?= base_url('deleteExamDownload/' . $entry['id']) ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modals (Place outside the table!) -->
    <?php foreach ($entries as $entry): ?>
        <div class="modal fade" id="editModal<?= $entry['id'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <form action="<?= base_url('saveEntryExamination') ?>" method="post" enctype="multipart/form-data" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Entry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                        <div class="mb-2">
                            <label>Department</label>
                            <input type="text" name="department" class="form-control" value="<?= esc($entry['department']) ?>">
                        </div>
                        <div class="mb-2">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control" value="<?= esc($entry['category']) ?>">
                        </div>
                        <div class="mb-2">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?= esc($entry['title']) ?>">
                        </div>
                        <div class="mb-2">
                            <label>File</label>
                            <input type="file" name="file" class="form-control">
                            <?php if (!empty(($entry['file']))): ?>
                                <div class="mb-2">
                                    <small class="d-block text-muted">Current Banner Image:</small>
                                    <img src="<?= base_url('uploads/downloads/' . ($entry['file'])) ?>"
                                        alt="Current Banner"
                                        class="img-thumbnail mt-1"
                                        style="max-height: 150px;">
                                    <!-- <small class="d-block mt-1 text-muted"><= esc($hero['banner_image']) ?></small> -->
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('saveEntryExamination') ?>" method="post" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>Department</label>
                    <input type="text" name="department" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>File</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>