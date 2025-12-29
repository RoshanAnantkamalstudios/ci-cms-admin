<?php echo $this->extend('layout/main'); ?>
<?php echo $this->section('content'); ?>

<div class="page-inner">
    <h2>Examination</h2>

    <!-- Hero Section -->
    <div class="card mb-4">
        <div class="card-header"><strong>Hero Section</strong></div>
        <div class="card-body">
            <form action="<?= base_url('saveHeroExamination') ?>" method="post" enctype="multipart/form-data">
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
                    <?php if (!empty($hero['background_image'])): ?>
                        <img src="<?= base_url('uploads/banner/' . $hero['background_image']) ?>" style="max-width: 200px;">
                    <?php endif; ?>
                    <input type="file" name="background_image" class="form-control">
                </div>
                <button class="btn btn-primary">Save Hero</button>
            </form>
        </div>
    </div>

    <!-- Exam Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <strong>Exam Table</strong>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#examModal">Add Exam</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Activity</th>
                        <th>Period (2nd & 3rd Year)</th>
                        <th>Period (1st Year)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($exams as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($row['activity'] ?? '') ?></td>
                            <td><?= esc($row['period_second_year'] ?? '') ?></td>
                            <td><?= esc($row['period_first_year'] ?? '') ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#examModal"
                                    onclick='editExam(<?= json_encode($row) ?>)'>Edit</button>
                                <a href="<?= base_url('deleteExamination/' . $row['id'] ?? '') ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit Exam -->
<div class="modal fade" id="examModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" action="<?= base_url('saveExamination') ?>" class="modal-content">
            <input type="hidden" name="id" id="exam_id">
            <div class="modal-header">
                <h5 class="modal-title">Add/Edit Exam</h5>
            </div>
            <div class="modal-body">
                <input type="text" name="activity" id="activity" class="form-control mb-2" placeholder="Activity" required>
                <input type="text" name="period_second_year" id="period_second_year" class="form-control mb-2" placeholder="Period (2nd & 3rd Year)" required>
                <input type="text" name="period_first_year" id="period_first_year" class="form-control mb-2" placeholder="Period (1st Year)" required>
                <input type="number" name="sort_order" id="sort_order" class="form-control mb-2">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('custom_script'); ?>
<script>
    function editExam(data) {
        document.getElementById('exam_id').value = data.id;
        document.getElementById('activity').value = data.activity;
        document.getElementById('period_second_year').value = data.period_second_year;
        document.getElementById('period_first_year').value = data.period_first_year;
        document.getElementById('sort_order').value = data.sort_order;
    }
</script>
<?php echo $this->endSection(); ?>