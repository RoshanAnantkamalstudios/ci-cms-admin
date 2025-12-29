<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title"><?= isset($record) ? 'Edit' : 'Create' ?> About Our Company</h2> 
    </div

    <div id="responseMessage"></div>

    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="<?= base_url('admin/about_our_company/save') ?>" method="POST" enctype="multipart/form-data" id="aboutCompanyForm">
                    <?= csrf_field() ?>
                    
                    <!-- Main Icon -->
                    <div class="form-group">
                        <label for="icon">Main Icon <small>(SVG/PNG or Font Awesome class)</small></label>
                        
                        <?php if (isset($record) && $record['icon']): ?>
                            <div class="mb-2">
                                <?php $isFA = strpos($record['icon'], 'fa-') !== false; ?>
                                <?php if ($isFA): ?>
                                    <i class="<?= esc($record['icon']) ?>" style="font-size: 48px;"></i>
                                <?php else: ?>
                                    <img src="<?= base_url('uploads/about/' . $record['icon']) ?>" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                <?php endif; ?>
                                <button type="button" class="btn btn-sm btn-danger ml-2 delete-main-icon">Delete Icon</button>
                            </div>
                        <?php endif; ?>
                        
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="icon" name="icon" accept=".svg,.png">
                            <label class="custom-file-label" for="icon">Choose file</label>
                        </div>
                        <small class="form-text text-muted">Upload an image or enter Font Awesome classes</small>
                        <div id="iconPreview" class="mt-2"></div>
                        <div class="mt-3">
                            <input type="text" class="form-control" id="icon_class" name="icon_class" placeholder="e.g., fa-sharp fa-solid fa-hammer" value="<?= isset($record) && isset($isFA) && $isFA ? esc($record['icon']) : '' ?>">
                            <div id="iconClassPreview" class="mt-2"></div>
                        </div>
                    </div>

                    <!-- Short Title -->
                    <div class="form-group">
                        <label for="short_title">Short Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="short_title" name="short_title" value="<?= isset($record) ? esc($record['short_title']) : '' ?>" placeholder="Enter short title"  maxlength="255">
                    </div>

                    <!-- Heading -->
                    <div class="form-group">
                        <label for="heading">Heading <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="heading" name="heading" value="<?= isset($record) ? esc($record['heading']) : '' ?>" placeholder="Enter full heading" >
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control summernote" id="description" name="description" ><?= isset($record) ? $record['description'] : '' ?></textarea>
                    </div>

                    <!-- About Sections -->
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="mb-0">About Sections</label>
                            <button type="button" class="btn btn-success btn-sm" id="addAboutSection">
                                <i class="fa fa-plus"></i> Add Section
                            </button>
                        </div>
                        
                        <div id="aboutSectionsContainer">
                            <?php if (isset($record) && !empty($record['about_sections'])): ?>
                                <?php foreach ($record['about_sections'] as $index => $section): ?>
                                    <div class="card mb-3 about-section" id="section-<?= $index ?>">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <span>Section <?= $index + 1 ?></span>
                                            <button type="button" class="btn btn-danger btn-sm remove-section" data-section="section-<?= $index ?>">
                                                <i class="fa fa-trash"></i> Remove
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Section Icon <small>(SVG/PNG)</small></label>
                                                
                                                <?php if (!empty($section['icon'])): ?>
                                                    <div class="mb-2">
                                                        <img src="<?= base_url('uploads/about/' . $section['icon']) ?>" class="img-thumbnail" style="max-width: 100px;">
                                                        <button type="button" class="btn btn-sm btn-danger ml-2 delete-section-icon" data-index="<?= $index ?>">Delete</button>
                                                    </div>
                                                    <input type="hidden" name="existing_section_icon[]" value="<?= $section['icon'] ?>">
                                                <?php else: ?>
                                                    <input type="hidden" name="existing_section_icon[]" value="">
                                                <?php endif; ?>
                                                
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input section-icon" name="about_icon[]" accept=".svg,.png">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                                <div class="section-icon-preview mt-2"></div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Section Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="about_title[]" value="<?= esc($section['title']) ?>" placeholder="Enter section title"  maxlength="255">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Section Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="about_description[]" rows="4" placeholder="Enter section description" ><?= esc($section['description']) ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-right">
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
    // Initialize Summernote
    $('.summernote').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });

    // Custom file input label
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        
        if (this.id === 'icon') {
            previewMainIcon(this);
        }
    });

    // Preview main icon
    function previewMainIcon(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#iconPreview').html('<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 150px;">');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Counter for unique IDs
    let sectionCounter = <?= isset($record) && !empty($record['about_sections']) ? count($record['about_sections']) : 0 ?>;

    // Add about section
    $('#addAboutSection').on('click', function() {
        sectionCounter++;
        let sectionHtml = `
            <div class="card mb-3 about-section" id="section-${sectionCounter}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span>Section ${sectionCounter}</span>
                    <button type="button" class="btn btn-danger btn-sm remove-section" data-section="section-${sectionCounter}">
                        <i class="fa fa-trash"></i> Remove
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Section Icon <small>(SVG/PNG)</small></label>
                        <input type="hidden" name="existing_section_icon[]" value="">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input section-icon" name="about_icon[]" accept=".svg,.png">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                        <div class="section-icon-preview mt-2"></div>
                    </div>
                    
                    <div class="form-group">
                        <label>Section Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="about_title[]" placeholder="Enter section title"  maxlength="255">
                    </div>
                    
                    <div class="form-group">
                        <label>Section Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="about_description[]" rows="4" placeholder="Enter section description" ></textarea>
                    </div>
                </div>
            </div>
        `;
        
        $('#aboutSectionsContainer').append(sectionHtml);
    });

    $('#icon_class').on('input', function() {
        let val = $(this).val().trim();
        if (val) {
            $('#iconClassPreview').html('<i class="' + val + '" style="font-size: 48px;"></i>');
        } else {
            $('#iconClassPreview').empty();
        }
    });

    
    // Remove section
    $(document).on('click', '.remove-section', function() {
        let sectionId = $(this).data('section');
        $('#' + sectionId).remove();
    });

    // Preview section icons
    $(document).on('change', '.section-icon', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        
        let preview = $(this).closest('.form-group').find('.section-icon-preview');
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                preview.html('<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 100px;">');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Delete main icon
    $('.delete-main-icon').on('click', function() {
        if (confirm('Are you sure you want to delete this icon?')) {
            $.ajax({
                url: '<?= base_url('admin/about_our_company/delete-main-icon') ?>',
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

    // Delete section icon
    $(document).on('click', '.delete-section-icon', function() {
        if (confirm('Are you sure you want to delete this section icon?')) {
            let index = $(this).data('index');
            $.ajax({
                url: '<?= base_url('admin/about_our_company/delete-section-icon') ?>',
                type: 'POST',
                data: {
                    section_index: index,
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
    $('#aboutCompanyForm').on('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        
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
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    `);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    let errorHtml = '<div class="alert alert-danger alert-dismissible fade show"><ul>';
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {
                            errorHtml += '<li>' + value + '</li>';
                        });
                    } else {
                        errorHtml += '<li>' + response.message + '</li>';
                    }
                    errorHtml += '</ul><button type="button" class="close" data-dismiss="alert">&times;</button></div>';
                    $('#responseMessage').html(errorHtml);
                }
            },
            error: function(xhr) {
                $('#responseMessage').html(`
                    <div class="alert alert-danger alert-dismissible fade show">
                        An error occurred. Please try again.
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                `);
            }
        });
    });

    // Add first section if none exist
    <?php if (!isset($record) || empty($record['about_sections'])): ?>
        $('#addAboutSection').trigger('click');
    <?php endif; ?>
});
</script>
<?= $this->endsection() ?>  
