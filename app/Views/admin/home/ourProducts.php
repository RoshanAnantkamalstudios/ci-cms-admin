<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title"><?= isset($record) ? 'Edit' : 'Create' ?> Our Product's Strength</h2> 
        <!-- <h2 class="page-title"><?= isset($record) ? 'Edit' : 'Create' ?> Why the Indian market is Best?</h2>  -->
    </div>

    <div id="responseMessage"></div>

    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="<?= base_url('admin/product_strength/save') ?>" method="POST" enctype="multipart/form-data" id="productStrengthForm">
                    <?= csrf_field() ?>
                    
                    <!-- Page Image -->
                    <div class="mb-3">
                        <label for="page_image" class="form-label">
                            Page Image <?= !isset($record) ? '<span class="text-danger">*</span>' : '' ?> 
                            <small class="text-muted">(PNG only)</small>
                        </label>
                        
                        <?php if (isset($record) && $record['page_image']): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/product_strength/' . $record['page_image']) ?>" 
                                     class="img-thumbnail" 
                                     style="max-width: 200px; max-height: 200px;">
                                <button type="button" class="btn btn-sm btn-danger ms-2 delete-page-image">
                                    <i class="fa fa-trash"></i> Delete Image
                                </button>
                            </div>
                        <?php endif; ?>
                        
                        <input type="file" 
                               class="form-control" 
                               id="page_image" 
                               name="page_image" 
                               accept=".png"  >
                        <small class="form-text text-muted">Accepted format: PNG (Max: 2MB)</small>
                        <div id="pageImagePreview" class="mt-2"></div>
                    </div>

                    <!-- Heading -->
                    <div class="mb-3">
                        <label for="heading" class="form-label">
                            Heading <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="heading" 
                               name="heading" 
                               value="<?= isset($record) ? esc($record['heading']) : '' ?>" 
                               placeholder="Enter heading" 
                               >
                    </div>

                    <!-- Cards Section -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0">Cards</label>
                            <button type="button" class="btn btn-success btn-sm" id="addCard">
                                <i class="fa fa-plus"></i> Add Card
                            </button>
                        </div>
                        
                        <div id="cardsContainer" class="row g-3">
                            <?php if (isset($record) && !empty($record['cards'])): ?>
                                <?php foreach ($record['cards'] as $index => $card): ?>
                                    <div class="col-md-6 col-lg-4 card-item" id="card-<?= $index ?>">
                                        <div class="card h-100 border">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">Card <?= $index + 1 ?></span>
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm remove-card" 
                                                        data-card="card-<?= $index ?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <!-- Card Image -->
                                                <div class="mb-3">
                                                    <label class="form-label">Image <small>(PNG/SVG)</small></label>
                                                    
                                                    <?php if (!empty($card['image'])): ?>
                                                        <div class="mb-2">
                                                            <img src="<?= base_url('uploads/product_strength/' . $card['image']) ?>" 
                                                                 class="img-thumbnail" 
                                                                 style="max-width: 100px;">
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-danger ms-1 delete-card-image" 
                                                                    data-index="<?= $index ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                        <input type="hidden" name="existing_card_image[]" value="<?= $card['image'] ?>">
                                                    <?php else: ?>
                                                        <input type="hidden" name="existing_card_image[]" value="">
                                                    <?php endif; ?>
                                                    
                                                    <input type="file" 
                                                           class="form-control card-image-input" 
                                                           name="card_image[]" 
                                                           accept=".png,.svg,.jpg">
                                                    <div class="card-image-preview mt-2"></div>
                                                </div>
                                                
                                                <!-- Card Heading -->
                                                <div class="mb-3">
                                                    <label class="form-label">Heading <span class="text-danger">*</span></label>
                                                    <input type="text" 
                                                           class="form-control" 
                                                           name="card_heading[]" 
                                                           value="<?= esc($card['heading']) ?>" 
                                                           placeholder="Card heading" 
                                                           >
                                                </div>
                                                
                                                <!-- Card Description -->
                                                <div class="mb-3">
                                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" 
                                                              name="card_description[]" 
                                                              rows="4" 
                                                              placeholder="Card description" 
                                                              ><?= esc($card['description']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> <?= isset($record) ? 'Update' : 'Submit' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>
<script>
$(document).ready(function() {
    let cardCounter = <?= isset($record) && !empty($record['cards']) ? count($record['cards']) : 0 ?>;

    // Preview page image
    $('#page_image').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#pageImagePreview').html('<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px;">');
            }
            reader.readAsDataURL(file);
        }
    });

    // Add new card
    $('#addCard').on('click', function() {
        cardCounter++;
        const cardHtml = `
            <div class="col-md-6 col-lg-4 card-item" id="card-${cardCounter}">
                <div class="card h-100 border">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Card ${cardCounter}</span>
                        <button type="button" class="btn btn-danger btn-sm remove-card" data-card="card-${cardCounter}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Image <small>(PNG/SVG)</small></label>
                            <input type="hidden" name="existing_card_image[]" value="">
                            <input type="file" class="form-control card-image-input" name="card_image[]" accept=".png,.svg,.jpg">
                            <div class="card-image-preview mt-2"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Heading <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="card_heading[]" placeholder="Card heading" >
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="card_description[]" rows="4" placeholder="Card description" ></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#cardsContainer').append(cardHtml);
    });

    // Remove card
    $(document).on('click', '.remove-card', function() {
        const cardId = $(this).data('card');
        $('#' + cardId).remove();
    });

    // Preview card images
    $(document).on('change', '.card-image-input', function() {
        const file = this.files[0];
        const preview = $(this).siblings('.card-image-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.html('<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 100px;">');
            }
            reader.readAsDataURL(file);
        }
    });

    // Delete page image
    $('.delete-page-image').on('click', function() {
        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: '<?= base_url('admin/product_strength/delete-page-image') ?>',
                type: 'POST',
                data: {
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                }
            });
        }
    });

    // Delete card image
    $(document).on('click', '.delete-card-image', function() {
        if (confirm('Are you sure you want to delete this card image?')) {
            const index = $(this).data('index');
            $.ajax({
                url: '<?= base_url('admin/product_strength/delete-card-image') ?>',
                type: 'POST',
                data: {
                    card_index: index,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                }
            });
        }
    });

    // Form submission
    $('#productStrengthForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#responseMessage').html(`
                        <div class="alert alert-success alert-dismissible fade show">
                            ${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    let errorHtml = '<div class="alert alert-danger alert-dismissible fade show"><ul class="mb-0">';
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {
                            errorHtml += '<li>' + value + '</li>';
                        });
                    } else {
                        errorHtml += '<li>' + response.message + '</li>';
                    }
                    errorHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
                    $('#responseMessage').html(errorHtml);
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                }
            },
            error: function() {
                $('#responseMessage').html(`
                    <div class="alert alert-danger alert-dismissible fade show">
                        An error occurred. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);
            }
        });
    });

    // Add first card if none exist
    <?php if (!isset($record) || empty($record['cards'])): ?>
        $('#addCard').trigger('click');
    <?php endif; ?>
});
</script>
<?= $this->endsection() ?>