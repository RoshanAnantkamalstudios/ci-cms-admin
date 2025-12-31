<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="pt-2 pb-4">
        <h3 class="fw-bold mb-3">Dashboard</h3>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm bg-white border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-layer-group fa-2x text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted">Total Categories</div>
                        <div class="h4 mb-0"><?= esc($category_count ?? 0) ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm bg-white border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-boxes fa-2x text-success"></i>
                    </div>
                    <div>
                        <div class="text-muted">Total Products</div>
                        <div class="h4 mb-0"><?= esc($product_count ?? 0) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm bg-white border-0">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent Categories</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Level</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($recent_categories)): ?>
                                    <?php foreach ($recent_categories as $c): ?>
                                        <tr>
                                            <td><?= esc($c['name']) ?></td>
                                            <td><?= (int)($c['level'] ?? 0) ?></td>
                                            <td><?= esc($c['created_at']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-muted">No categories found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm bg-white border-0">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent Products</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($recent_products)): ?>
                                    <?php foreach ($recent_products as $p): ?>
                                        <tr>
                                            <td style="width: 60px;">
                                                <?php if (!empty($p['thumb'])): ?>
                                                    <img src="<?= esc($p['thumb']) ?>" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                                <?php else: ?>
                                                    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= esc($p['name']) ?></td>
                                            <td><?= esc($p['category_name'] ?? '-') ?></td>
                                            <td><?= esc($p['created_at']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-muted">No products found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>