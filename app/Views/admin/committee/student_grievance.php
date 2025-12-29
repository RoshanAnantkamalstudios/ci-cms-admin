<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <!-- Hero Section Form -->
    <div class="card mb-4">
        <div class="card-header"><strong>Hero Section</strong></div>
        <div class="card-body">
            <form method="post" action="<?= base_url('saveHeroGrievance') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $hero['id'] ?? '' ?>">
                <input type="hidden" name="section_type" value="hero">

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <textarea name="subtitle" class="form-control"><?= esc($hero['subtitle'] ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Button Link</label>
                    <input type="text" name="button_link" class="form-control" value="<?= esc($hero['button_link'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Banner Image</label><br>
                    <?php if (!empty($hero['background_image'])): ?>
                        <img src="<?= base_url('uploads/banner/' . $hero['background_image']) ?>" class="img-fluid mb-2" style="max-height: 150px;">
                    <?php endif; ?>
                    <input type="file" name="background_image" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Save Hero Section</button>
            </form>
        </div>
    </div>

    <!-- Committee Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Committee Members</strong>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#memberModal">Add Member</button>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Associated With</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($committee as $i => $member): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($member['name']) ?></td>
                            <td><?= esc($member['designation']) ?></td>
                            <td><?= esc($member['associated_with']) ?></td>
                            <td>
                                <a href="<?= base_url('admin/grievance/delete/' . $member['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Committee Modal -->
    <div class="modal fade" id="memberModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url('saveMemberGrievance') ?>" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Committee Member</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="section_type" value="committee">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>
                    <input type="text" name="designation" class="form-control mb-2" placeholder="Designation" required>
                    <input type="text" name="associated_with" class="form-control mb-2" placeholder="Associated With" required>
                    <input type="number" name="sort_order" class="form-control mb-2" placeholder="Sort Order (optional)">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Member</button>
                </div>
            </form>
        </div>
    </div>


    <?= $this->endsection() ?>

    <?= $this->section('custom_script') ?>

    <?= $this->endsection() ?>