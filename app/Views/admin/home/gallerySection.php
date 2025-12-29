<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Campus Gallery</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#galleryModal">Add New</button>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Caption </th>
                <!-- <th>Link</th> -->
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($gallery)): ?>
                <?php foreach ($gallery as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($row['title']) ?></td>
                        <td><?= esc($row['btn_text']) ?></td>
                        <td>
                            <img src="<?= base_url($row['image']) ?>" alt="Image" height="40">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary editBtn"
                                data-id="<?= $row['id'] ?>"
                                data-title="<?= esc($row['title']) ?>"
                                data-btn_text="<?= esc($row['btn_text']) ?>"
                                data-image="<?= base_url($row['image']) ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <a href="<?= base_url('deleteGallery___/' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">
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
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="<?= base_url('saveGallery') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="gallery_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add/Edit Campus Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6 mb-3">
                            <label>Image Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Image Lightbox Caption (Optional)</label>
                            <input type="text" name="btn_text" id="btn_text" class="form-control">
                        </div>
                        <div class="form-group col-12 mb-3">
                            <label>Image Upload</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <small class="text-muted">Upload a high-quality campus image</small>
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
    // Prefill edit modal
    $('.editBtn').on('click', function() {
        const btn = $(this);
        $('#gallery_id').val(btn.data('id'));
        $('#title').val(btn.data('title'));
        $('#btn_text').val(btn.data('btn_text'));
        $('#btn_link').val(btn.data('btn_link'));
        $('#previewImage').attr('src', btn.data('image')).show();
        $('#galleryModal').modal('show');
    });

    // Preview new image on file input change
    $('#image').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => $('#previewImage').attr('src', e.target.result).show();
            reader.readAsDataURL(file);
        }
    });
</script>
<?= $this->endsection() ?>