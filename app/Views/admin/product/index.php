<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Manage Products</h2>
        <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#productModal" onclick="openProductModal()">
            <i class="fa fa-plus me-1"></i> Add Product
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

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label text-muted small text-uppercase fw-bold">Select Category</label>
                    <form action="<?= base_url('admin/products') ?>" method="GET" id="categoryFilterForm">
                        <select class="form-select" name="category_id" id="filter_category">
                            <option value="">-- All Categories --</option>
                            <?php foreach ($flat_categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= $selected_category == $cat['id'] ? 'selected' : '' ?>>
                                    <?= str_repeat('— ', $cat['level']) . $cat['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="productsGrid">
        <?php if (empty($products)): ?>
            <div class="col-12">
                <div class="text-center text-muted py-4">No products found.</div>
            </div>
        <?php else: ?>
            <?php foreach ($products as $p): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-4 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <?php
                                $firstImg = !empty($p['image_urls']) ? $p['image_urls'][0] : null;
                                ?>
                                <?php if ($firstImg): ?>
                                    <img src="<?= $firstImg ?>" class="rounded me-3" style="width:60px;height:60px;object-fit:cover;">
                                <?php else: ?>
                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                        <i class="fa fa-image text-muted"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <div class="fw-bold"><?= esc($p['name'] ?: 'Untitled') ?></div>
                                    <div class="text-muted small">Category ID: <?= esc($p['category_id'] ?: '-') ?></div>
                                </div>
                            </div>
                            <div class="text-muted small mb-2">
                                <?= esc(strip_tags($p['description'])) ?>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-end">
                            <button class="btn btn-outline-primary btn-sm me-2" onclick='editProduct(<?= json_encode($p) ?>)'><i class="fa fa-edit"></i></button>
                            <a class="btn btn-outline-danger btn-sm" href="<?= base_url('admin/product/delete/' . $p['id']) ?>" onclick="return confirm('Delete this product?')"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('admin/product/save') ?>" method="POST" enctype="multipart/form-data" id="productForm">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="prod_id">
            <input type="hidden" name="existing_images" id="prod_existing_images">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="modalTitle">Add Product</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small text-uppercase fw-bold">Category</label>
                            <select class="form-select" name="category_id" id="prod_category_id" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($flat_categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>">
                                        <?= str_repeat('— ', $cat['level']) . $cat['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small text-uppercase fw-bold">Name</label>
                            <input type="text" class="form-control" name="name" id="prod_name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Description</label>
                        <textarea class="form-control summernote" name="description" id="prod_description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Images</label>
                        <div id="imageInputs" class="mb-2"></div>
                        <button type="button" class="btn btn-outline-dark btn-sm" onclick="addImageInput()">
                            <i class="fa fa-plus me-1"></i>Add Image
                        </button>
                        <div id="prod_images_preview" class="mt-2 d-flex flex-wrap gap-2"></div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="submit" class="btn btn-dark">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    let productModal;

    document.addEventListener('DOMContentLoaded', function() {
        productModal = new bootstrap.Modal(
            document.getElementById('productModal'), {
                backdrop: true,
                keyboard: true
            }
        );
    });

    document.getElementById('filter_category').addEventListener('change', function() {
        document.getElementById('categoryFilterForm').submit();
    });

    function openProductModal() {
        var modal = new bootstrap.Modal(document.getElementById('productModal'));

        document.getElementById('prod_id').value = '';
        document.getElementById('prod_category_id').value = '<?= $selected_category ?: '' ?>';
        document.getElementById('prod_name').value = '';
        document.getElementById('prod_existing_images').value = '[]';
        document.getElementById('prod_images_preview').innerHTML = '';
        document.getElementById('imageInputs').innerHTML = '';
        addImageInput();

        // 🔥 Reset summernote correctly
        if ($('.summernote').next('.note-editor').length) {
            $('.summernote').summernote('destroy');
        }

        $('.summernote').summernote({
            height: 180
        });

        $('.summernote').summernote('code', '');

        resetProductForm();
        document.getElementById('modalTitle').innerText = 'Add Product';
        modal.show();

    }


    function editProduct(data) {
        var modal = new bootstrap.Modal(document.getElementById('productModal'));

        document.getElementById('prod_id').value = data.id;
        document.getElementById('prod_category_id').value = data.category_id || '';
        document.getElementById('prod_name').value = data.name || '';

        // 🔥 DESTROY summernote if already initialized
        if ($('.summernote').next('.note-editor').length) {
            $('.summernote').summernote('destroy');
        }

        // Clear textarea first
        document.getElementById('prod_description').value = '';

        // Re-init Summernote
        $('.summernote').summernote({
            height: 180
        });

        // ✅ SET OLD VALUE PROPERLY
        $('.summernote').summernote('code', data.description || '');

        document.getElementById('prod_existing_images').value =
            JSON.stringify(data.images ? JSON.parse(data.images) : []);

        var preview = document.getElementById('prod_images_preview');
        preview.innerHTML = '';
        document.getElementById('imageInputs').innerHTML = '';
        addImageInput();

        if (data.image_urls && data.image_urls.length) {
            data.image_urls.forEach(function(url) {
                var img = document.createElement('img');
                img.src = url;
                img.style.width = '60px';
                img.style.height = '60px';
                img.style.objectFit = 'cover';
                img.className = 'rounded';
                preview.appendChild(img);
            });
        }

        document.getElementById('modalTitle').innerText = 'Edit Product';
        modal.show();
    }


    function addImageInput() {
        var container = document.getElementById('imageInputs');
        var row = document.createElement('div');
        row.className = 'd-flex align-items-center mb-2 gap-2';
        var input = document.createElement('input');
        input.type = 'file';
        input.name = 'images[]';
        input.accept = 'image/*';
        input.className = 'form-control';
        input.onchange = function() {
            previewSelectedFile(this);
        };
        var img = document.createElement('img');
        img.style.width = '60px';
        img.style.height = '60px';
        img.style.objectFit = 'cover';
        img.className = 'rounded d-none';
        var remove = document.createElement('button');
        remove.type = 'button';
        remove.className = 'btn btn-outline-danger btn-sm';
        remove.innerHTML = '<i class="fa fa-times"></i>';
        remove.onclick = function() {
            row.remove();
        };
        row.appendChild(input);
        row.appendChild(img);
        row.appendChild(remove);
        container.appendChild(row);
    }

    function previewSelectedFile(input) {
        var file = input.files && input.files[0];
        if (!file) return;
        var img = input.parentElement.querySelector('img');
        var reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            img.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
</script>

<?= $this->endSection() ?>