<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2 class="mb-4">Manage Board of Governance</h2>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>

    <!-- Hero Section -->
    <form method="post" action="<?= base_url('save_herogoverning_body') ?>" enctype="multipart/form-data" class="card p-4 mb-4">
        <h4>Hero Section</h4>
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="hero_title" value="<?= $hero['hero_title'] ?? '' ?>" class="form-control" placeholder="Hero Title">
        </div>
        <div class="mb-3">
            <label>Subtitle</label>
            <textarea name="hero_subtitle" class="form-control" placeholder="Hero Subtitle"><?= $hero['hero_subtitle'] ?? '' ?></textarea>
        </div>
        <div class="mb-3">
            <label>Hero Image</label>
            <input type="file" name="hero_image" class="form-control">
            <?php if (!empty($hero['hero_image'])): ?>
                <img src="<?= base_url($hero['hero_image']) ?>" width="150" class="mt-2">
            <?php endif; ?>
        </div>
        <button class="btn btn-success w-25">Save Hero</button>
    </form>

    <!-- Add Member -->
    <form method="post" action="<?= base_url('save_membergoverning_body') ?>" enctype="multipart/form-data" class="card p-4 mb-4">
        <h4>Add Board Member</h4>
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="designation" class="form-control" placeholder="Designation" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="background" class="form-control" placeholder="Background">
            </div>
            <div class="col-md-4">
                <input type="number" name="display_order" class="form-control" placeholder="Order">
            </div>
            <div class="col-md-4 mt-3">
                <input type="file" name="photo" class="form-control">
            </div>
        </div>
        <button class="btn btn-success mt-3 w-25">Add Member</button>
    </form>

    <!-- Member Table -->
    <h4>Board Members</h4>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Sr.No</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Background</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $i => $m): ?>
                    <tr class="text-center">
                        <td><?= $i + 1 ?></td>
                        <td>
                            <img
                                src="<?= base_url(!empty($m['photo']) ? $m['photo'] : 'public/frontend/img/person.webp') ?>"
                                width="50"
                                height="50"
                                class="rounded">
                        </td>
                        <td><?= esc($m['name']) ?></td>
                        <td><?= esc($m['designation']) ?></td>
                        <td><?= esc($m['background']) ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $m['id'] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?= base_url('delete_member/' . $m['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this member?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?= $m['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $m['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form method="post" action="<?= base_url('update_membergoverning_body/' . $m['id']) ?>" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Member</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row g-3">
                                        <div class="col-md-6">
                                            <label>Name</label>
                                            <input type="text" name="name" value="<?= esc($m['name']) ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Designation</label>
                                            <input type="text" name="designation" value="<?= esc($m['designation']) ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Background</label>
                                            <input type="text" name="background" value="<?= esc($m['background']) ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Display Order</label>
                                            <input type="number" name="display_order" value="<?= esc($m['display_order']) ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Change Photo</label>
                                            <input type="file" name="photo" class="form-control">
                                            <?php if ($m['photo']): ?>
                                                <img src="<?= base_url($m['photo']) ?>" width="80" class="mt-2">
                                            <?php endif; ?>
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
                    <!-- End Edit Modal -->

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<!-- FontAwesome (if not already included) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<?= $this->endSection() ?>