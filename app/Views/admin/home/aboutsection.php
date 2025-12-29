<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">About BVCTE</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aboutModal">Add / Edit</button>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Button</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php helper('text');
            if ($data): ?>
                <tr>
                    <td>1</td>
                    <td>
                        <a href="<?= esc($data['btn_link']) ?>" target="_blank">
                            <?= character_limiter($data['subtitle'], 20) ?>
                        </a>
                    </td>
                    <td><img src="<?= base_url($data['image']) ?>" height="60"></td>
                    <td><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#aboutModal"><i class="bi bi-pencil-square"></i></button></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No data found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Modal Form -->
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="<?= base_url('saveAbout_us') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($data['id'] ?? '') ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="aboutModalLabel">Add / Edit About BVCTE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row">
                        <div class="mb-3 col-12">
                            <label><strong>Overview</strong></label>
                            <textarea name="overview" class="form-control summernote"><?= esc($data['overview'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3 col-12">
                            <label><strong>Easily Approachable Campus</strong></label>
                            <textarea name="approachable" class="form-control summernote"><?= esc($data['approachable'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3 col-12">
                            <label><strong>Our Features</strong></label>
                            <textarea name="features" class="form-control summernote"><?= esc($data['features'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label>Button Name (Subtitle)</label>
                            <input type="text" name="subtitle" class="form-control" value="<?= esc($data['subtitle'] ?? '') ?>" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label>Button Link</label>
                            <input type="text" name="btn_link" class="form-control" value="<?= esc($data['btn_link'] ?? '') ?>" required>
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label>About Image</label>
                            <input type="file" name="image" class="form-control" <?= empty($data['image']) ? 'required' : '' ?>>
                            <?php if (!empty($data['image'])): ?>
                                <img src="<?= base_url($data['image']) ?>" height="60" class="mt-2">
                            <?php endif; ?>
                            <!-- <small class="text-muted">Leave blank to keep existing image.</small> -->
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
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200
        });
    });
</script>
<?= $this->endsection() ?>