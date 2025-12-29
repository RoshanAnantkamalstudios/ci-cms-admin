<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Alumni Page Sections</h2>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">+ Add Section</button>
    </div>
    <?php if (session('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Type</th>
                <th>Title</th>
                <th>Order</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sections)): ?>
                <?php $i = 1;
                foreach ($sections as $section): $extra = json_decode($section['extra_data'], true);
                ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= esc($section['section_type']) ?></td>
                        <td><?= esc($section['title']) ?></td>
                        <td><?= esc($section['order']) ?></td>
                        <td><?= $section['status'] ? 'Active' : 'Inactive' ?></td>
                        <td><?php if ($section['image']): ?><img src="<?= base_url('uploads/' . $section['image']) ?>" width="150"><?php endif; ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $section['id'] ?>">Edit</button>
                            <a href="<?= base_url('deleteAlumeni/' . $section['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this section?')">Delete</a>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal<?= $section['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <form method="post" enctype="multipart/form-data" action="<?= base_url('updateAlumeni/' . $section['id']) ?>">
                                <?= csrf_field() ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Section</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body row g-3">
                                        <div class="col-md-6">
                                            <label>Section Type</label>
                                            <select name="section_type" class="form-select" required>
                                                <option value="hero" <?= ($section['section_type'] ?? '') === 'hero' ? 'selected' : '' ?>>Hero</option>
                                                <option value="testimonial" <?= ($section['section_type'] ?? '') === 'testimonial' ? 'selected' : '' ?>>Testimonial</option>
                                                <option value="gallery" <?= ($section['section_type'] ?? '') === 'gallery' ? 'selected' : '' ?>>Gallery</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" value="<?= esc($section['title']) ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label>Subtitle</label>
                                            <input type="text" name="subtitle" class="form-control" value="<?= esc($section['subtitle']) ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label>Description</label>
                                            <textarea name="content" class="form-control"><?= esc($section['content']) ?></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control">
                                            <?php if ($section['image']): ?><img src="<?= base_url('uploads/' . $section['image']) ?>" width="150" class="mt-2"><?php endif; ?>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Passing Year (Testimonial only)</label>
                                            <input type="text" name="year" class="form-control" value="<?= esc($extra['year'] ?? '') ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Role (Testimonial only)</label>
                                            <input type="text" name="role" class="form-control" value="<?= esc($extra['role'] ?? '') ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Order</label>
                                            <input type="number" name="order" class="form-control" value="<?= esc($section['order']) ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Status</label>
                                            <select name="status" class="form-select">
                                                <option value="1" <?= $section['status'] == 1 ? 'selected' : '' ?>>Active</option>
                                                <option value="0" <?= $section['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No data available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="post" enctype="multipart/form-data" action="<?= base_url('storeAlumeni') ?>">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Section Type</label>
                        <select name="section_type" class="form-select" required>
                            <option value="hero">Hero</option>
                            <option value="testimonial">Testimonial</option>
                            <option value="gallery">Gallery</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea name="content" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Passing Year (Testimonial only)</label>
                        <input type="text" name="year" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Role (Testimonial only)</label>
                        <input type="text" name="role" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Order</label>
                        <input type="number" name="order" class="form-control" value="0">
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>
<?= $this->endsection() ?>