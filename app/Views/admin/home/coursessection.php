<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Our Courses</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#courseModal">Add New</button>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Button</th>
                <th>Link</th>
                <th>Content</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            helper('text');
            if (!empty($courses)): ?>
                <?php foreach ($courses as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($row['title']) ?></td>
                        <td><?= esc($row['subtitle']) ?></td>
                        <td><?= esc($row['btn_text']) ?></td>
                        <td><a href="<?= esc($row['btn_link']) ?>" target="_blank">Link</a></td>
                        <td><?= character_limiter(strip_tags($row['content']), 40) ?></td>
                        <td><img src="<?= base_url($row['icon_image']) ?>" height="40"></td>
                        <td>
                            <button class="btn btn-sm btn-primary editBtn"
                                data-id="<?= $row['id'] ?>"
                                data-title="<?= esc($row['title']) ?>"
                                data-subtitle="<?= esc($row['subtitle']) ?>"
                                data-content="<?= esc($row['content']) ?>"
                                data-btn_text="<?= esc($row['btn_text']) ?>"
                                data-btn_link="<?= esc($row['btn_link']) ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <a href="<?= base_url('deleteour_courses/' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">No records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="<?= base_url('saveour_courses') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="course_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="courseModalLabel">Add/Edit Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6 mb-3">
                            <label>Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Subtitle</label>
                            <input type="text" name="subtitle" id="subtitle" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Content</label>
                            <input type="text" name="content" id="content" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Button Text</label>
                            <input type="text" name="btn_text" id="btn_text" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Button Link</label>
                            <input type="text" name="btn_link" id="btn_link" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Icon Image</label>
                            <input type="file" name="icon_image" class="form-control">
                            <!-- <small class="text-muted">Leave blank to keep existing</small> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>
<script>
    $('.editBtn').on('click', function() {
        const btn = $(this);
        $('#course_id').val(btn.data('id'));
        $('#title').val(btn.data('title'));
        $('#subtitle').val(btn.data('subtitle'));
        $('#content').val(btn.data('content'));
        $('#btn_text').val(btn.data('btn_text'));
        $('#btn_link').val(btn.data('btn_link'));
        $('#courseModal').modal('show');
    });
</script>
<?= $this->endsection() ?>