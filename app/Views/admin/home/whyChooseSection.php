<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<style>
    .card-item {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        position: relative;
    }
    .card-number {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #0d6efd;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }
    .remove-card {
        position: absolute;
        top: 10px;
        right: 60px;
        background: #dc3545;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 5px;
        cursor: pointer;
    }
    .add-card-btn {
        margin-top: 10px;
    }
    .icon-preview {
        margin-top: 10px;
        padding: 10px;
        background: white;
        border-radius: 5px;
        display: inline-block;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Cards Management</h5>
                </div>

                <div class="card-body">
                    <form method="post" action="<?= base_url('admin/homewhychoose/save') ?>" enctype="multipart/form-data">
                        
                        <!-- Heading Section -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Section Heading</label>
                            <input type="text" name="heading" class="form-control" placeholder="Enter main heading..." value="<?= $data['heading'] ?? '' ?>" required>
                        </div>

                        <hr>

                        <!-- Cards Section -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Cards Content</label>
                        </div>

                        <div id="cards-container">
                            <?php if (!empty($data['cards'])): ?>
                                <?php foreach ($data['cards'] as $index => $card): ?>
                                    <div class="card-item" data-card-index="<?= $index ?>">
                                
                                        <a href="<?= base_url('admin/homewhychoose/delete/' . $index) ?>" class="remove-card" onclick="return confirm('Are you sure you want to delete this card?')">Delete</a>
                                        
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Icon (Upload Image)</label>
                                                <input type="file" name="cards[<?= $index ?>][icon]" class="form-control" accept="image/*">
                                                <?php if (!empty($card['icon'])): ?>
                                                    <div class="icon-preview">
                                                        <small class="text-muted d-block mb-2">Current Icon:</small>
                                                        <img src="<?= base_url($card['icon']) ?>" height="50" alt="icon" class="border rounded p-1">
                                                    </div>
                                                    <input type="hidden" name="cards[<?= $index ?>][existing_icon]" value="<?= $card['icon'] ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="cards[<?= $index ?>][title]" class="form-control" placeholder="Enter card title..." value="<?= $card['title'] ?? '' ?>" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea name="cards[<?= $index ?>][description]" class="form-control" rows="3" placeholder="Enter card description..." required><?= $card['description'] ?? '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="card-item">
                                 
                                    <button type="button" class="remove-card" onclick="removeCard(this)">Remove</button>
                                    
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Icon (Upload Image)</label>
                                            <input type="file" name="cards[0][icon]" class="form-control" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="cards[0][title]" class="form-control" placeholder="Enter card title..." required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="cards[0][description]" class="form-control" rows="3" placeholder="Enter card description..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="button" class="btn btn-success add-card-btn" onclick="addCard()">
                            + Add New Card
                        </button>

                        <hr class="my-4">

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">Save All Cards</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>
<script>
let cardIndex = <?= !empty($data['cards']) ? count($data['cards']) : 1 ?>;

function addCard() {
    const container = document.getElementById('cards-container');
    const cardHTML = `
        <div class="card-item">
            <button type="button" class="remove-card" onclick="removeCard(this)">Remove</button>
            
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Icon (Upload Image)</label>
                    <input type="file" name="cards[${cardIndex}][icon]" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="cards[${cardIndex}][title]" class="form-control" placeholder="Enter card title..." required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="cards[${cardIndex}][description]" class="form-control" rows="3" placeholder="Enter card description..." required></textarea>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', cardHTML);
    cardIndex++;
    updateCardNumbers();
}

function removeCard(button) {
    const cards = document.querySelectorAll('.card-item');
    if (cards.length > 1) {
        button.closest('.card-item').remove();
        updateCardNumbers();
    } else {
        alert('At least one card is required!');
    }
}

function updateCardNumbers() {
    const cards = document.querySelectorAll('.card-item');
    cards.forEach((card, index) => {
        card.querySelector('.card-number').textContent = `Card ${index + 1}`;
    });
}
</script>
<?= $this->endsection() ?>
