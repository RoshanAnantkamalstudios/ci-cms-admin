<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title"><?= isset($record) ? 'Edit' : 'Create' ?> Testimonials</h2>
    </div>

    <div id="responseMessage"></div>

    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="<?= base_url('admin/testimonials/save') ?>" method="POST" enctype="multipart/form-data" id="testimonialForm">
                    <?= csrf_field() ?>
                    
                    <!-- Main Icon Section -->
                    <div class="mb-4 border-bottom pb-4">
                        <h4>Main Section Details</h4>
                        
                        <!-- Icon Type Selection -->
                        <div class="mb-3">
                            <label class="form-label d-block">Icon Type</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon_type" id="iconTypeClass" value="class" 
                                    <?= (!isset($record) || (isset($record['icon']) && str_starts_with($record['icon'], 'fa-'))) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="iconTypeClass">Font Awesome Class</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon_type" id="iconTypeImage" value="image"
                                    <?= (isset($record['icon']) && !str_starts_with($record['icon'], 'fa-')) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="iconTypeImage">Image Upload</label>
                            </div>
                        </div>

                        <!-- Icon Class Input -->
                        <div class="mb-3" id="iconClassInput" style="display: none;">
                            <label for="icon_class" class="form-label">Font Awesome Class</label>
                            <input type="text" class="form-control" id="icon_class" name="icon_class" 
                                   value="<?= (isset($record['icon']) && str_starts_with($record['icon'], 'fa-')) ? esc($record['icon']) : '' ?>" 
                                   placeholder="e.g. fa-solid fa-users">
                        </div>

                        <!-- Icon Image Input -->
                        <div class="mb-3" id="iconImageInput" style="display: none;">
                            <label for="icon_image" class="form-label">Icon Image</label>
                            <?php if (isset($record['icon']) && !str_starts_with($record['icon'], 'fa-') && !empty($record['icon'])): ?>
                                <div class="mb-2">
                                    <img src="<?= base_url('uploads/testimonials/' . $record['icon']) ?>" class="img-thumbnail" style="max-width: 100px;">
                                    <button type="button" class="btn btn-sm btn-danger ms-2 delete-main-icon">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="icon_image" name="icon_image" accept=".png,.jpg,.jpeg,.svg">
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="<?= isset($record) ? esc($record['title']) : '' ?>" 
                                   placeholder="Enter section title">
                        </div>
                    </div>

                    <!-- Cards Section -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0"><h4>Testimonial Cards</h4></label>
                            <button type="button" class="btn btn-success btn-sm" id="addCard">
                                <i class="fa fa-plus"></i> Add Card
                            </button>
                        </div>
                        
                        <div id="cardsContainer" class="row g-3">
                            <?php if (isset($record) && !empty($record['cards'])): ?>
                                <?php foreach ($record['cards'] as $index => $card): ?>
                                    <div class="col-md-6 col-lg-6 card-item" id="card-<?= $index ?>">
                                        <div class="card h-100 border">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">Card <?= $index + 1 ?></span>
                                                <button type="button" class="btn btn-danger btn-sm remove-card" data-card="card-<?= $index ?>">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <!-- <div class="row">
                                                    <div class="col-md-6"> 
                                                        <div class="mb-3">
                                                            <label class="form-label">Authorized Image</label>
                                                            <?php if (!empty($card['image'])): ?>
                                                                <div class="mb-2">
                                                                    <img src="<?= base_url('uploads/testimonials/' . $card['image']) ?>" class="img-thumbnail" style="max-width: 100px;">
                                                                    <button type="button" class="btn btn-sm btn-danger ms-1 delete-card-file" data-index="<?= $index ?>" data-type="image">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                                <input type="hidden" name="existing_card_image[]" value="<?= $card['image'] ?>">
                                                            <?php else: ?>
                                                                <input type="hidden" name="existing_card_image[]" value="">
                                                            <?php endif; ?>
                                                            <input type="file" class="form-control" name="card_image[]" accept="image/*">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"> 
                                                        <div class="mb-3">
                                                            <label class="form-label">Proof Image</label>
                                                            <?php if (!empty($card['proofImage'])): ?>
                                                                <div class="mb-2">
                                                                    <img src="<?= base_url('uploads/testimonials/' . $card['proofImage']) ?>" class="img-thumbnail" style="max-width: 100px;">
                                                                    <button type="button" class="btn btn-sm btn-danger ms-1 delete-card-file" data-index="<?= $index ?>" data-type="proofImage">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                                <input type="hidden" name="existing_card_proof_image[]" value="<?= $card['proofImage'] ?>">
                                                            <?php else: ?>
                                                                <input type="hidden" name="existing_card_proof_image[]" value="">
                                                            <?php endif; ?>
                                                            <input type="file" class="form-control" name="card_proof_image[]" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <!-- Heading -->
                                                <!-- <div class="mb-3">
                                                    <label class="form-label">Heading</label>
                                                    <input type="text" class="form-control" name="card_heading[]" value="<?= esc($card['heading']) ?>" placeholder="Name or Title">
                                                </div> -->
                                                
                                                <!-- Description (Summernote) -->
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control summernote" name="card_description[]"><?= esc($card['description']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save Changes
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
    // Initialize Summernote
    function initSummernote() {
        $('.summernote').summernote({
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['codeview']]
            ]
        });
    }
    initSummernote();

    // Icon Type Toggle
    function toggleIconInput() {
        const type = $('input[name="icon_type"]:checked').val();
        if (type === 'class') {
            $('#iconClassInput').show();
            $('#iconImageInput').hide();
        } else {
            $('#iconClassInput').hide();
            $('#iconImageInput').show();
        }
    }
    toggleIconInput();
    $('input[name="icon_type"]').change(toggleIconInput);

    // Add Card
    let cardCounter = <?= isset($record) && !empty($record['cards']) ? count($record['cards']) : 0 ?>;
    
    $('#addCard').on('click', function() {
        cardCounter++;
        const cardHtml = `
            <div class="col-md-6 col-lg-4 card-item" id="card-${cardCounter}">
                <div class="card h-100 border">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Card ${cardCounter}</span>
                        <button type="button" class="btn btn-danger btn-sm remove-card" data-card="card-${cardCounter}">
                            <i class="fa fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Authorized Image</label>
                                    <input type="hidden" name="existing_card_image[]" value="">
                                    <input type="file" class="form-control" name="card_image[]" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Proof Image</label>
                                    <input type="hidden" name="existing_card_proof_image[]" value="">
                                    <input type="file" class="form-control" name="card_proof_image[]" accept="image/*">
                                </div>
                            </div>
                        </div> -->

                        <!-- Heading -->
                        <!-- <div class="mb-3"> -->
                        <!--     <label class="form-label">Heading</label> -->
                        <!--     <input type="text" class="form-control" name="card_heading[]" placeholder="Name or Title"> -->
                        <!-- </div> -->
                        
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control summernote" name="card_description[]"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#cardsContainer').append(cardHtml);
        initSummernote(); // Re-init for new element
    });

    // Remove Card
    $(document).on('click', '.remove-card', function() {
        const cardId = $(this).data('card');
        $('#' + cardId).remove();
    });

    // Delete Main Icon
    $('.delete-main-icon').on('click', function() {
        if (confirm('Delete main icon?')) {
            $.ajax({
                url: '<?= base_url('admin/testimonials/delete-main-icon') ?>',
                type: 'POST',
                data: {<?= csrf_token() ?>: '<?= csrf_hash() ?>'},
                success: function(res) {
                    if (res.status === 'success') location.reload();
                    else alert(res.message);
                }
            });
        }
    });

    // Delete Card File (Image or Proof)
    $(document).on('click', '.delete-card-file', function() {
        const index = $(this).data('index');
        const type = $(this).data('type');
        if (confirm('Delete this image?')) {
            $.ajax({
                url: '<?= base_url('admin/testimonials/delete-card-image') ?>',
                type: 'POST',
                data: {
                    card_index: index,
                    type: type,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success: function(res) {
                    if (res.status === 'success') location.reload();
                    else alert(res.message);
                }
            });
        }
    });

    // Form Submit
    $('#testimonialForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#responseMessage').html('<div class="alert alert-success">'+res.message+'</div>');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    $('#responseMessage').html('<div class="alert alert-danger">'+res.message+'</div>');
                }
            },
            error: function(err) {
                $('#responseMessage').html('<div class="alert alert-danger">An error occurred.</div>');
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
