<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Products Category</h2>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <!-- FORM -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5><?= isset($editData) ? 'Edit' : 'Add' ?> Product Category</h5>
        </div>

        <div class="card-body">
            <form action="<?= isset($editData)
                ? base_url('admin/product-category/update/'.$editData['id'])
                : base_url('admin/product-category/save') ?>"
                  method="post"
                  enctype="multipart/form-data">

                <?= csrf_field() ?>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Background Image</label>
                        <input type="file" name="background_image" class="form-control">

                        <?php if (!empty($editData['background_image'])): ?>
                            <img src="<?= base_url($editData['background_image']) ?>"
                                 class="img-thumbnail mt-2" height="60">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label>Category Name</label>
                        <input type="text" name="category_name" class="form-control"
                               value="<?= esc($editData['category_name'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Heading</label>
                    <textarea name="heading" class="form-control" required><?= esc($editData['heading'] ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="summernote"><?= $editData['description'] ?? '' ?></textarea>
                </div>

                <button class="btn btn-primary">
                    <?= isset($editData) ? 'Update' : 'Save' ?>
                </button>

                <?php if (isset($editData)): ?>
                    <a href="<?= base_url('admin/product-category') ?>" class="btn btn-secondary">Cancel</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow">
        <div class="card-header">
            <h5>Product Categories List</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle" id="categoryTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Heading</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <?php if ($row['background_image']): ?>
                                    <img src="<?= base_url($row['background_image']) ?>" height="50">
                                <?php endif; ?>
                            </td>
                            <td><?= esc($row['category_name']) ?></td>
                            <td><?= esc($row['heading']) ?></td>
                            <!-- <td>
                                <a href="<= base_url('admin/product-category/edit/'.$row['id']) ?>"
                                   class="btn btn-sm btn-warning">Edit</a>

                                <a href="<= base_url('admin/product-category/delete/'.$row['id']) ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Delete this category?')">
                                    Delete
                                </a>
                            </td> -->
                            <td class="text-nowrap">
                                <a href="<?= base_url('admin/product-category/edit/'.$row['id']) ?>"
                                class="btn btn-sm btn-outline-warning"
                                title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="<?= base_url('admin/product-category/delete/'.$row['id']) ?>"
                                class="btn btn-sm btn-outline-danger"
                                title="Delete"
                                onclick="return confirm('Delete this category?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No records found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<script>
    $(document).ready(function () {

        // Summernote
        $('.summernote').summernote({
            height: 200
        });

        // DataTable
        $('#categoryTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            searching: true,
            responsive: true,
            columnDefs: [
                { orderable: false, targets: [1, 4] } // Image & Actions not sortable
            ]
        });

    });
</script>
<?= $this->endSection() ?>
