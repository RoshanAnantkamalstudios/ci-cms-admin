<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="page-inner">
    <h2>Academic Calendar CMS</h2>

    <!-- Hero Section -->
    <div class="card mb-4">
        <div class="card-header"><strong>Hero Section</strong></div>
        <div class="card-body">
            <form method="post" action="<?= base_url('saveAcademicHero') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= esc($hero['id'] ?? '') ?>">
                <div class="mb-3"><label>Title</label><input name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>"></div>
                <div class="mb-3"><label>Subtitle</label><textarea name="subtitle" class="form-control"><?= esc($hero['subtitle'] ?? '') ?></textarea></div>
                <div class="mb-3"><label>Button Text</label><input name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>"></div>
                <div class="mb-3"><label>Button Link</label><input name="button_link" class="form-control" value="<?= esc($hero['button_link'] ?? '') ?>"></div>
                <div class="mb-3">
                    <label>Banner Image</label><br>
                    <?php if (!empty($hero['background_image'])): ?>
                        <img src="<?= base_url('uploads/banner/' . $hero['background_image']) ?>" width="200">
                    <?php endif ?>
                    <input type="file" name="background_image" class="form-control">
                </div>
                <button class="btn btn-primary">Save Hero</button>
            </form>
        </div>
    </div>

    <!-- Calendar Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <strong>Academic Events</strong>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#eventModal">Add Event</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Activity</th>
                        <th>2nd & 3rd Year</th>
                        <th>1st Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($calendar as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($row['activity']) ?></td>
                            <td><?= esc($row['second_third_year_period']) ?></td>
                            <td><?= esc($row['first_year_period']) ?></td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</a>
                                <a href="<?= base_url('deleteAcademicEvent/' . $row['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="post" action="<?= base_url('saveAcademicEvent') ?>" class="modal-content">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div class="modal-header">
                                        <h5>Edit Event</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="activity" value="<?= esc($row['activity']) ?>" class="form-control mb-2" required>
                                        <input type="text" name="second_third_year_period" value="<?= esc($row['second_third_year_period']) ?>" class="form-control mb-2" placeholder="2nd & 3rd Year">
                                        <input type="text" name="first_year_period" value="<?= esc($row['first_year_period']) ?>" class="form-control mb-2" placeholder="1st Year">
                                        <input type="number" name="sort_order" value="<?= esc($row['sort_order']) ?>" class="form-control mb-2" placeholder="Sort Order">
                                    </div>
                                    <div class="modal-footer"><button class="btn btn-primary">Update</button></div>
                                </form>
                            </div>
                        </div>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Event Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url('saveAcademicEvent') ?>" class="modal-content">
                <div class="modal-header">
                    <h5>Add New Event</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="activity" class="form-control mb-2" placeholder="Activity" required>
                    <input type="text" name="second_third_year_period" class="form-control mb-2" placeholder="2nd & 3rd Year">
                    <input type="text" name="first_year_period" class="form-control mb-2" placeholder="1st Year">
                    <input type="number" name="sort_order" class="form-control mb-2" placeholder="Sort Order">
                </div>
                <div class="modal-footer"><button class="btn btn-success">Save</button></div>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>