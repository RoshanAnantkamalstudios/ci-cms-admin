<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2>Examination Schedule CMS</h2>

    <!-- Hero Section Form -->
    <div class="card mb-4">
        <div class="card-header"><strong>Hero Section</strong></div>
        <div class="card-body">
            <form action="<?= base_url('saveHeroSchedule') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= esc($hero['id'] ?? '') ?>">
                <div class="mb-3"><label>Title</label><input name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>"></div>
                <div class="mb-3"><label>Subtitle</label><textarea name="subtitle" class="form-control"><?= esc($hero['subtitle'] ?? '') ?></textarea></div>
                <div class="mb-3"><label>Button Text</label><input name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>"></div>
                <div class="mb-3"><label>Button Link</label><input name="button_link" class="form-control" value="<?= esc($hero['button_link'] ?? '') ?>"></div>
                <div class="mb-3">
                    <label>Banner Image</label>
                    <?php if (!empty($hero['banner_image'])): ?>
                        <img src="<?= base_url('uploads/banner/' . $hero['banner_image']) ?>" style="max-width: 200px;">
                    <?php endif ?>
                    <input type="file" name="banner_image" class="form-control">
                </div>
                <button class="btn btn-primary">Save Hero</button>
            </form>
        </div>
    </div>

    <!-- Schedule Table + Modal -->
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <strong>Examination Schedule</strong>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#scheduleModal" onclick="resetModal()">Add Row</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>1st Year</th>
                        <th>2nd Year</th>
                        <th>3rd Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedules as $row): ?>
                        <tr>
                            <td><?= esc($row['department']) ?></td>
                            <td><?= $row['year_1st'] ?></td>
                            <td><?= $row['year_2nd'] ?></td>
                            <td><?= $row['year_3rd'] ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm me-1" onclick='editSchedule(<?= json_encode($row) ?>)'>
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <a href="<?= base_url('deleteSchedule/' . $row['id']) ?>" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url('saveSchedule') ?>" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Examination Schedule</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="text" name="department" id="department" class="form-control mb-2" placeholder="Department" required>
                    <textarea name="year_1st" id="year_1st" class="form-control mb-2 summernote" placeholder="1st Year Data"></textarea>
                    <textarea name="year_2nd" id="year_2nd" class="form-control mb-2 summernote" placeholder="2nd Year Data"></textarea>
                    <textarea name="year_3rd" id="year_3rd" class="form-control mb-2 summernote" placeholder="3rd Year Data"></textarea>
                    <input type="number" name="sort_order" id="sort_order" class="form-control mb-2" placeholder="Sort Order">
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
<script>
    function editSchedule(data) {
        document.getElementById('id').value = data.id;
        document.getElementById('department').value = data.department;
        $('#year_1st').summernote('code', data.year_1st);
        $('#year_2nd').summernote('code', data.year_2nd);
        $('#year_3rd').summernote('code', data.year_3rd);
        document.getElementById('sort_order').value = data.sort_order;

        new bootstrap.Modal(document.getElementById('scheduleModal')).show();
    }


    function resetModal() {
        document.getElementById('id').value = '';
        document.getElementById('department').value = '';
        document.getElementById('year_1st').value = '';
        document.getElementById('year_2nd').value = '';
        document.getElementById('year_3rd').value = '';
        document.getElementById('sort_order').value = '';
    }
</script>
<?= $this->endsection() ?>