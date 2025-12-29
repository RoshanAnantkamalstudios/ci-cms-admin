<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Our World-Class Facilities</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#facilityModal">+ Add New</button>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Heading</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Button</th>
                <th>Link</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            helper('text');
            if (!empty($facilities)): ?>
                <?php foreach ($facilities as $i => $row): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= character_limiter($row['heading'] ?? '', 10) ?></td>
                        <td><?= character_limiter($row['title'] ?? '', 10) ?></td>
                        <td><?= character_limiter($row['subtitle'] ?? '', 20) ?></td>
                        <td><?= esc($row['button_name'] ?? '') ?></td>
                        <td>
                            <a href="<?= !empty($row['button_link']) ? esc($row['button_link']) : '#' ?>" target="_blank">
                                <?= !empty($row['button_link']) ? 'Link' : '#' ?>
                            </a>
                        </td>

                        <td><img src="<?= base_url($row['image'] ?? '') ?>" height="60"></td>
                        <td>
                            <button class="btn btn-sm btn-primary editBtn"
                                data-id="<?= $row['id'] ?>"
                                data-heading="<?= esc($row['heading'] ?? '') ?>"
                                data-title="<?= esc($row['title'] ?? '') ?>"
                                data-subtitle="<?= esc($row['subtitle'] ?? '') ?>"
                                data-button_name="<?= esc($row['button_name'] ?? '') ?>"
                                data-button_link="<?= esc($row['button_link'] ?? '') ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <a href="<?= base_url('deleteFacility/' . $row['id'] ?? '') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this facility?')">
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
</div>

<!-- Modal -->
<div class="modal fade" id="facilityModal" tabindex="-1" aria-labelledby="facilityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('saveFacility') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="facility_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add/Edit Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <div class="form-group col-md-6 mb-3">
                        <label>Heading</label>
                        <input type="text" name="heading" id="heading" class="form-control">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label>Button Text</label>
                        <input type="text" name="button_name" id="button_name" class="form-control">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label>Button Link</label>
                        <input type="url" name="button_link" id="button_link" class="form-control">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label>Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <div id="imagePreview" class="mt-2"></div>
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

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<script>
    $('.editBtn').on('click', function() {
        let btn = $(this);
        $('#facility_id').val(btn.data('id'));
        $('#heading').val(btn.data('heading'));
        $('#title').val(btn.data('title'));
        $('#subtitle').val(btn.data('subtitle'));
        $('#button_name').val(btn.data('button_name'));
        $('#button_link').val(btn.data('button_link'));
        $('#facilityModal').modal('show');
    });

    $('#image').on('change', function() {
        let preview = $('#imagePreview');
        preview.html('');
        const file = this.files[0];
        if (file) {
            const img = $('<img />', {
                src: URL.createObjectURL(file),
                height: 60,
                class: 'mt-2'
            });
            preview.append(img);
        }
    });
</script>
<?= $this->endSection() ?>