<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Manage Categories</h2>
        <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#categoryModal" onclick="openModal()">
            <i class="fa fa-plus me-1"></i> Add Category
        </button>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" style="width: 40%;">Name</th>
                            <th style="width: 15%;">Image</th>
                            <th style="width: 15%;">Level</th>
                            <th style="width: 15%;">Status</th>
                            <th class="text-end pe-4" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($flat_categories)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No categories found.</td>
                            </tr>
                        <?php else: ?>
                            <?php 
                                // Helper function to display rows recursively is not needed if we use flat_categories sorted by path or just simple list with parent check.
                                // But the flat list in controller is sorted by level then name. That doesn't preserve tree structure in display.
                                // We should use the tree structure or sort the flat list properly. 
                                // For simplicity in this iteration, I'll write a recursive loop using the $categories tree.
                            ?>
                            <?php 
                                function displayRows($nodes, $level = 0) {
                                    foreach ($nodes as $node): 
                            ?>
                                <tr>
                                    <td class="ps-4">
                                        <div style="padding-left: <?= $level * 30 ?>px;">
                                            <?php if($level > 0): ?><i class="fa fa-level-up-alt fa-rotate-90 me-2 text-muted"></i><?php endif; ?>
                                            <span class="fw-bold text-dark"><?= esc($node['name']) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($node['image']): ?>
                                            <img src="<?= base_url('uploads/category/' . $node['image']) ?>" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="text-muted small">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($node['level'] == 0) echo '<span class="badge bg-primary">Root</span>';
                                            elseif ($node['level'] == 1) echo '<span class="badge bg-info">Sub</span>';
                                            else echo '<span class="badge bg-secondary">Child</span>';
                                        ?>
                                    </td>
                                    <td>
                                        <?php if($node['status']): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-outline-primary btn-sm me-1" onclick='editCategory(<?= json_encode($node) ?>)'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="<?= base_url('admin/category/delete/' . $node['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?');">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                        if (isset($node['children'])) {
                                            displayRows($node['children'], $level + 1);
                                        }
                                    endforeach; 
                                }
                                displayRows($categories);
                            ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('admin/category/save') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="cat_id">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="modalTitle">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Parent Category</label>
                        <select class="form-select" name="parent_id" id="cat_parent_id">
                            <option value="">-- No Parent (Root) --</option>
                            <?php foreach($flat_categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>">
                                    <?= str_repeat('&nbsp;&nbsp;', $cat['level'] * 2) . $cat['name'] ?> 
                                    (<?= $cat['level'] == 0 ? 'Root' : ($cat['level'] == 1 ? 'Sub' : 'Child') ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text">Leave empty to create a main category.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Name</label>
                        <input type="text" class="form-control" name="name" id="cat_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Image</label>
                        <input type="file" class="form-control" name="image">
                        <div id="current_image" class="mt-2"></div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('aboutUsForm')?.reset(); // In case name conflict
        document.getElementById('cat_id').value = '';
        document.getElementById('cat_parent_id').value = '';
        document.getElementById('cat_name').value = '';
        document.getElementById('current_image').innerHTML = '';
        document.getElementById('modalTitle').innerText = 'Add Category';
        
        // Disable nothing
        enableAllOptions();
    }

    function editCategory(data) {
        var modal = new bootstrap.Modal(document.getElementById('categoryModal'));
        document.getElementById('cat_id').value = data.id;
        document.getElementById('cat_parent_id').value = data.parent_id || '';
        document.getElementById('cat_name').value = data.name;
        document.getElementById('modalTitle').innerText = 'Edit Category';
        
        if(data.image) {
            document.getElementById('current_image').innerHTML = 
                '<img src="<?= base_url('uploads/category/') ?>' + data.image + '" height="50" class="rounded">';
        } else {
            document.getElementById('current_image').innerHTML = '';
        }

        // Prevent selecting self as parent (simple client side check)
        const options = document.querySelectorAll('#cat_parent_id option');
        options.forEach(opt => {
            if(opt.value == data.id) {
                opt.disabled = true;
            } else {
                opt.disabled = false;
            }
        });

        modal.show();
    }

    function enableAllOptions() {
        const options = document.querySelectorAll('#cat_parent_id option');
        options.forEach(opt => opt.disabled = false);
    }
</script>

<?= $this->endSection() ?>
