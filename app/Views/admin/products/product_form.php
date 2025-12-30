<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title"><?= isset($product) ? 'Edit' : 'Add' ?> Product</h2>
        <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">Back to List</a>
    </div>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= isset($product) ? base_url('admin/products/update/'.$product['id']) : base_url('admin/products/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?= isset($product) ? esc($product['title']) : old('title') ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= isset($product) && $product['category_id']==$cat['id'] ? 'selected' : '' ?>><?= esc($cat['category_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Product Image</label>
                <input type="file" name="image" class="form-control">
                <?php if(isset($product) && $product['image']): ?>
                    <img src="<?= base_url('uploads/products/'.$product['image']) ?>" width="120" class="mt-2">
                <?php endif; ?>
            </div>

            <div class="col-md-6 mb-3">
                <label>Market Demand</label>
                <textarea name="market_demand" class="form-control" rows="3"><?= isset($product) ? esc($product['market_demand']) : old('market_demand') ?></textarea>
            </div>
        </div>

        <!-- Specifications Table -->
        <div class="mb-3">
            <label>Specifications</label>
            <table class="table table-bordered" id="specification_table">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Value</th>
                        <th><button type="button" class="btn btn-success btn-sm" id="add_spec">Add</button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $specs = isset($product['specifications']) ? $product['specifications'] : ['key'=>[], 'value'=>[]];
                        $keys = $specs['key'] ?? [];
                        $values = $specs['value'] ?? [];
                        for($i=0; $i < count($keys); $i++):
                    ?>
                        <tr>
                            <td><input type="text" name="specifications[key][]" value="<?= esc($keys[$i]) ?>" class="form-control" required></td>
                            <td><input type="text" name="specifications[value][]" value="<?= esc($values[$i]) ?>" class="form-control" required></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove_row">Remove</button></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>

        <!-- Ingredients Table -->
        <div class="mb-3">
            <label>Ingredients</label>
            <table class="table table-bordered" id="ingredients_table">
                <thead>
                    <tr>
                        <th>Ingredient</th>
                        <th>Quantity</th>
                        <th><button type="button" class="btn btn-success btn-sm" id="add_ingredient">Add</button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $ingredients = isset($product['ingredients']) ? $product['ingredients'] : ['name'=>[], 'qty'=>[]];
                        $names = $ingredients['name'] ?? [];
                        $qtys = $ingredients['qty'] ?? [];
                        for($i=0; $i < count($names); $i++):
                    ?>
                        <tr>
                            <td><input type="text" name="ingredients[name][]" value="<?= esc($names[$i]) ?>" class="form-control" required></td>
                            <td><input type="text" name="ingredients[qty][]" value="<?= esc($qtys[$i]) ?>" class="form-control" required></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove_row">Remove</button></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>

        <!-- Uses & Benefits -->
        <div class="mb-3">
            <label>Uses & Benefits</label>
            <textarea name="uses_benefits" class="form-control" rows="3"><?= isset($product) ? esc($product['uses_benefits']) : old('uses_benefits') ?></textarea>
        </div>

        <!-- Heading -->
        <div class="mb-3">
            <label>Heading</label>
            <input type="text" name="heading" class="form-control" value="<?= isset($product) ? esc($product['heading']) : old('heading') ?>">
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4"><?= isset($product) ? esc($product['description']) : old('description') ?></textarea>
        </div>

        <!-- Other Section -->
        <div class="mb-3">
            <label>Other Section</label>
            <table class="table table-bordered" id="other_section_table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th><button type="button" class="btn btn-success btn-sm" id="add_other_section">Add</button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $other = isset($product['other_section']) ? $product['other_section'] : [];
                        foreach($other as $item):
                    ?>
                        <tr>
                            <td>
                                <input type="file" name="other_image[]" class="form-control"><br>
                                <?php if(!empty($item['image'])): ?>
                                    <img src="<?= base_url('uploads/products/'.$item['image']) ?>" width="80">
                                <?php endif; ?>
                            </td>
                            <td><input type="text" name="other_title[]" value="<?= esc($item['title']) ?>" class="form-control"></td>
                            <td><textarea name="other_description[]" class="form-control"><?= esc($item['description']) ?></textarea></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove_row">Remove</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($product) ? 'Update' : 'Save' ?> Product</button>
    </form>
</div>

<!-- JS for dynamic tables -->
<script>
document.addEventListener('DOMContentLoaded', function(){
    // Specifications
    document.getElementById('add_spec').addEventListener('click', function(){
        let tbody = document.querySelector('#specification_table tbody');
        tbody.insertAdjacentHTML('beforeend', `<tr>
            <td><input type="text" name="specifications[key][]" class="form-control" required></td>
            <td><input type="text" name="specifications[value][]" class="form-control" required></td>
            <td><button type="button" class="btn btn-danger btn-sm remove_row">Remove</button></td>
        </tr>`);
    });

    // Ingredients
    document.getElementById('add_ingredient').addEventListener('click', function(){
        let tbody = document.querySelector('#ingredients_table tbody');
        tbody.insertAdjacentHTML('beforeend', `<tr>
            <td><input type="text" name="ingredients[name][]" class="form-control" required></td>
            <td><input type="text" name="ingredients[qty][]" class="form-control" required></td>
            <td><button type="button" class="btn btn-danger btn-sm remove_row">Remove</button></td>
        </tr>`);
    });

    // Other Section
    document.getElementById('add_other_section').addEventListener('click', function(){
        let tbody = document.querySelector('#other_section_table tbody');
        tbody.insertAdjacentHTML('beforeend', `<tr>
            <td><input type="file" name="other_image[]" class="form-control"></td>
            <td><input type="text" name="other_title[]" class="form-control"></td>
            <td><textarea name="other_description[]" class="form-control"></textarea></td>
            <td><button type="button" class="btn btn-danger btn-sm remove_row">Remove</button></td>
        </tr>`);
    });

    // Remove row
    document.addEventListener('click', function(e){
        if(e.target && e.target.classList.contains('remove_row')){
            e.target.closest('tr').remove();
        }
    });
});
</script>

<?= $this->endSection() ?>
