<?php helper('form'); ?>
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2>Entrepreneurship Committee</h2>

    <!-- Hero Section Form -->
    <div class="card mb-4">
        <div class="card-header"><strong>Hero Section</strong></div>
        <div class="card-body">
            <form action="<?= base_url('saveHero_entrepre') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= esc($hero['id'] ?? '') ?>">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Subtitle</label>
                    <textarea name="subtitle" class="form-control"><?= esc($hero['subtitle'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Button Link</label>
                    <input type="text" name="button_link" class="form-control" value="<?= esc($hero['button_link'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Banner Image</label>
                    <br>
                    <?php if (!empty($hero['background_image'])): ?>
                        <img src="<?= base_url('uploads/banner/' . $hero['background_image']) ?>" style="max-width: 200px;" class="mb-2">
                    <?php endif ?>
                    <input type="file" name="background_image" class="form-control">
                </div>
                <button class="btn btn-primary">Save Hero</button>
            </form>
        </div>
    </div>

    <!-- Committee Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <strong>Committee Members</strong>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#memberModal">Add Member</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Designation</th>
                         <th>Appointed As</th>
                          <th>Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($committee as $i => $mem): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($mem['name']) ?></td>
                            <td><?= esc($mem['designation']) ?></td>
                             <td><?= esc($mem['appointed_as']) ?></td>
                              <td><?= esc($mem['contact']) ?></td>
                            <td>
                                <a href="<?= base_url('delete_entrepre/' . $mem['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this member?')">Delete</a>
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
            <form method="post" action="<?= base_url('saveMember_entrepre') ?>" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Committee Member</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                    <input type="text" name="designation" class="form-control mb-2" placeholder="Designation" required>
                    <input type="text" name="appointed_as" class="form-control mb-2" placeholder="appointed_as" required>
                    <input type="text" name="contact" class="form-control mb-2" placeholder="Contact" required pattern="[0-9]{10}" title="Please enter a valid 10-digit contact number"> 
                    <input type="number" name="sort_order" class="form-control mb-2" placeholder="Sort Order">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>
<?= $this->endsection() ?>