<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Products</h2>
        <a href="<?= base_url('admin/products/create') ?>" class="btn btn-primary">
            Add New Product
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table id="productsTable" class="table table-bordered table-striped align-middle">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Market Demand</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php $i = 1; foreach ($products as $product): ?>
                                <tr>
                                    <td><?= $i++ ?></td>

                                    <td>
                                        <?php if (!empty($product['image'])): ?>
                                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>"
                                                 width="60" height="60"
                                                 style="object-fit:cover;border-radius:4px;">
                                        <?php else: ?>
                                            <span class="text-muted">No Image</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?= esc($product['title']) ?></td>

                                    <td>
                                        <?php
                                            $cat = array_filter(
                                                $categories,
                                                fn($c) => $c['id'] == $product['category_id']
                                            );
                                            echo $cat ? esc(array_values($cat)[0]['category_name']) : '-';
                                        ?>
                                    </td>

                                    <td>
                                        <?= strlen($product['market_demand']) > 80
                                            ? esc(substr($product['market_demand'], 0, 80)) . '...'
                                            : esc($product['market_demand']) ?>
                                    </td>

                                    <td>
                                        <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <a href="<?= base_url('admin/products/delete/' . $product['id']) ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Are you sure?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<!-- <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script> -->

<script>
$(document).ready(function () {
    $('#productsTable').DataTable({
        pageLength: 10,
        lengthChange: true,
        ordering: true,
        searching: true,
        responsive: true
    });
});
</script>
<?= $this->endSection() ?>
