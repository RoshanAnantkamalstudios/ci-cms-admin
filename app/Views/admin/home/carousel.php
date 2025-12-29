<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Hero Section</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#heroModal">Add New</button>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Button</th>
                <th>Banner</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            helper('text');

            if (!empty($hero_sections)): ?>
                <?php foreach ($hero_sections as $key => $row): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= esc($row['title']) ?></td>
                        <td><?= character_limiter($row['sub_title'], 30) ?></td>
                        <td>
                            <a href="<?= esc($row['btn_link']) ?>" target="_blank">
                                <?= character_limiter($row['btn_text'], 20) ?>
                            </a>
                        </td>

                        <td><img src="<?= base_url($row['banner_image']) ?>" width="100"></td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="editHero(<?= $row['id'] ?>)" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <a class="btn btn-sm btn-danger"
                                href="<?= base_url('delete-hero/' . $row['id']) ?>"
                                onclick="return confirm('Are you sure you want to delete this hero section?');"
                                title="Delete">
                                <i class="bi bi-trash"></i>
                            </a>

                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No records found</td>
                </tr>
            <?php endif; ?>


        </tbody>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="heroModal" tabindex="-1" aria-labelledby="heroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="<?= base_url('courosel_section') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="hero_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="heroModalLabel">Add/Edit Hero Section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6 mb-3">
                            <label>Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Subtitle</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Button Name</label>
                            <input type="text" name="btn_text" id="btn_text" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Button Link</label>
                            <input type="text" name="btn_link" id="btn_link" class="form-control" required>
                        </div>
                        <div class="form-group col-12 mb-3">
                            <label>Caurosel Image</label>
                            <input type="file" name="banner_image" id="banner_image" class="form-control" required>
                            <!-- <small class="text-muted">Leave blank to keep existing</small> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Section</button>
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
    function editHero(id) {
        fetch('<?= base_url('get-hero/') ?>' + id)
            .then(res => res.json())
            .then(data => {
                document.getElementById('hero_id').value = data.id;
                document.getElementById('title').value = data.title;
                document.getElementById('sub_title').value = data.sub_title;
                document.getElementById('btn_text').value = data.btn_text;
                document.getElementById('btn_link').value = data.btn_link;
                document.getElementById('banner_image').required = false;
                var heroModal = new bootstrap.Modal(document.getElementById('heroModal'));
                heroModal.show();
            });
    }
</script>
<?= $this->endsection() ?>