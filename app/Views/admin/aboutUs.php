<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Manage About Us</h2>
    </div>

    <div id="responseMessage"></div>

    <form action="<?= base_url('admin/about-us/save') ?>" method="POST" id="aboutUsForm" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <!-- About Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fa fa-info-circle me-2 text-secondary"></i>About Section</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase fw-bold">Icon (FontAwesome Class)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fa fa-font-awesome text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" name="about_icon" value="<?= esc($record['about_icon'] ?? '') ?>" placeholder="e.g. fa fa-user">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase fw-bold">Heading</label>
                        <input type="text" class="form-control" name="about_heading" value="<?= esc($record['about_heading'] ?? '') ?>" placeholder="Enter section heading">
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-uppercase text-muted fw-bold mb-0">Content Cards</h6>
                    <button type="button" class="btn btn-outline-dark btn-sm" id="addAboutCard">
                        <i class="fa fa-plus me-1"></i> Add Card
                    </button>
                </div>
                <div class="row g-3" id="about_cards_container">
                    <!-- Dynamic Cards -->
                </div>
            </div>
        </div>

        <!-- Quality Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fa fa-star me-2 text-secondary"></i>Quality Section</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label text-muted small text-uppercase fw-bold">Background Image</label>
                        <input type="file" class="form-control" name="quality_bg_image">
                        <?php if(!empty($record['quality_bg_image'])): ?>
                            <div class="mt-2 p-1 border rounded d-inline-block">
                                <img src="<?= base_url('uploads/about_us/'.$record['quality_bg_image']) ?>" class="img-fluid" style="height: 60px;">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small text-uppercase fw-bold">Icon (FontAwesome)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fa fa-font-awesome text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" name="quality_icon" value="<?= esc($record['quality_icon'] ?? '') ?>" placeholder="e.g. fa fa-star">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small text-uppercase fw-bold">Heading</label>
                        <input type="text" class="form-control" name="quality_heading" value="<?= esc($record['quality_heading'] ?? '') ?>" placeholder="Enter section heading">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-uppercase text-muted fw-bold mb-0">Quality Cards</h6>
                    <button type="button" class="btn btn-outline-dark btn-sm" id="addQualityCard">
                        <i class="fa fa-plus me-1"></i> Add Card
                    </button>
                </div>
                <div class="row g-3" id="quality_cards_container">
                    <!-- Dynamic Cards -->
                </div>
            </div>
        </div>

        <!-- Vision & Mission Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fa fa-bullseye me-2 text-secondary"></i>Vision & Mission</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-uppercase text-muted fw-bold mb-0">Mission Cards</h6>
                    <button type="button" class="btn btn-outline-dark btn-sm" id="addVisionCard">
                        <i class="fa fa-plus me-1"></i> Add Card
                    </button>
                </div>
                <div class="row g-3" id="vision_cards_container">
                    <!-- Dynamic Cards -->
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fa fa-heart me-2 text-secondary"></i>Values Section</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase fw-bold">Main Image</label>
                        <input type="file" class="form-control" name="values_image">
                        <?php if(!empty($record['values_image'])): ?>
                            <div class="mt-2 p-1 border rounded d-inline-block">
                                <img src="<?= base_url('uploads/about_us/'.$record['values_image']) ?>" class="img-fluid" style="height: 60px;">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase fw-bold">Heading</label>
                        <input type="text" class="form-control" name="values_heading" value="<?= esc($record['values_heading'] ?? '') ?>" placeholder="Enter section heading">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-uppercase text-muted fw-bold mb-0">Value Cards</h6>
                    <button type="button" class="btn btn-outline-dark btn-sm" id="addValuesCard">
                        <i class="fa fa-plus me-1"></i> Add Card
                    </button>
                </div>
                <div class="row g-3" id="values_cards_container">
                    <!-- Dynamic Cards -->
                </div>
            </div>
        </div>

        <!-- Questions Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fa fa-question-circle me-2 text-secondary"></i>Questions Section</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-uppercase text-muted fw-bold mb-0">FAQ Cards</h6>
                    <button type="button" class="btn btn-outline-dark btn-sm" id="addQuestionCard">
                        <i class="fa fa-plus me-1"></i> Add Card
                    </button>
                </div>
                <div class="row g-3" id="questions_container">
                    <!-- Dynamic Cards -->
                </div>
            </div>
        </div>

        <div class="text-end pb-5 sticky-bottom bg-white py-3 border-top">
            <button type="submit" class="btn btn-dark px-4"><i class="fa fa-save me-2"></i>Save All Changes</button>
        </div>
    </form>
</div>

<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>
<script>
$(document).ready(function() {
    
    // --- Helper to create card HTML ---
    function createCardHtml(section, index, data = {}) {
        let content = '';
        const prefix = section;

        if (section === 'about_cards' || section === 'quality_cards') {
            const imgPath = data.image ? `<?= base_url('uploads/about_us/') ?>/${data.image}` : '';
            content = `
                <div class="col-md-6 card-item" id="${prefix}_${index}">
                    <div class="card h-100 border-0 shadow-sm bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-white text-dark border">Card ${index+1}</span>
                                <button type="button" class="btn btn-outline-danger btn-sm border-0 remove-card" data-target="${prefix}_${index}"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Image</label>
                                <input type="file" class="form-control" name="${prefix}[${index}][image]">
                                <input type="hidden" name="${prefix}[${index}][existing_image]" value="${data.image || ''}">
                                ${imgPath ? `<div class="mt-2 p-1 border rounded bg-white d-inline-block"><img src="${imgPath}" class="img-fluid" style="height:60px;"></div>` : ''}
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                                <textarea class="form-control summernote" rows="3" name="${prefix}[${index}][description]">${data.description || ''}</textarea>
                            </div>
                        </div>
                    </div>
                </div>`;
        } else if (section === 'vision_cards') {
            content = `
                <div class="col-md-6 card-item" id="${prefix}_${index}">
                    <div class="card h-100 border-0 shadow-sm bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-white text-dark border">Card ${index+1}</span>
                                <button type="button" class="btn btn-outline-danger btn-sm border-0 remove-card" data-target="${prefix}_${index}"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Icon (FA Class)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fa fa-font-awesome text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" name="${prefix}[${index}][icon]" value="${data.icon || ''}" placeholder="fa fa-eye">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Card Name</label>
                                <input type="text" class="form-control" name="${prefix}[${index}][card_name]" value="${data.card_name || ''}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                                <textarea class="form-control" rows="3" name="${prefix}[${index}][description]">${data.description || ''}</textarea>
                            </div>
                        </div>
                    </div>
                </div>`;
        } else if (section === 'values_cards') {
            const imgPath = data.value_image ? `<?= base_url('uploads/about_us/') ?>/${data.value_image}` : '';
            content = `
                <div class="col-md-6 card-item" id="${prefix}_${index}">
                    <div class="card h-100 border-0 shadow-sm bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-white text-dark border">Card ${index+1}</span>
                                <button type="button" class="btn btn-outline-danger btn-sm border-0 remove-card" data-target="${prefix}_${index}"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Image</label>
                                <input type="file" class="form-control" name="${prefix}[${index}][value_image]">
                                <input type="hidden" name="${prefix}[${index}][existing_value_image]" value="${data.value_image || ''}">
                                ${imgPath ? `<div class="mt-2 p-1 border rounded bg-white d-inline-block"><img src="${imgPath}" class="img-fluid" style="height:60px;"></div>` : ''}
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Heading</label>
                                <input type="text" class="form-control" name="${prefix}[${index}][value_heading]" value="${data.value_heading || ''}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                                <textarea class="form-control" rows="3" name="${prefix}[${index}][value_description]">${data.value_description || ''}</textarea>
                            </div>
                        </div>
                    </div>
                </div>`;
        } else if (section === 'questions') {
            const imgPath = data.question_image ? `<?= base_url('uploads/about_us/') ?>/${data.question_image}` : '';
            content = `
                <div class="col-md-12 card-item" id="${prefix}_${index}">
                    <div class="card h-100 border-0 shadow-sm bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-white text-dark border">Card ${index+1}</span>
                                <button type="button" class="btn btn-outline-danger btn-sm border-0 remove-card" data-target="${prefix}_${index}"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Image</label>
                                        <input type="file" class="form-control" name="${prefix}[${index}][question_image]">
                                        <input type="hidden" name="${prefix}[${index}][existing_question_image]" value="${data.question_image || ''}">
                                        ${imgPath ? `<div class="mt-2 p-1 border rounded bg-white d-inline-block"><img src="${imgPath}" class="img-fluid" style="height:60px;"></div>` : ''}
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Heading</label>
                                        <input type="text" class="form-control" name="${prefix}[${index}][question_heading]" value="${data.question_heading || ''}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                                    <textarea class="form-control summernote-${index}" name="${prefix}[${index}][question_description]">${data.question_description || ''}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
        }
        return content;
    } 

    // --- Counters ---
    let counters = {
        about_cards: 0,
        quality_cards: 0,
        vision_cards: 0,
        values_cards: 0,
        questions: 0
    };

    // --- Load Existing Data ---
    const record = <?= json_encode($record ?? []) ?>;
    
    function initSection(sectionName) {
        if (record && record[sectionName]) {
            record[sectionName].forEach((card, i) => {
                $('#' + sectionName + '_container').append(createCardHtml(sectionName, counters[sectionName], card));
                
                // Initialize summernote for questions and about_cards
                if (sectionName === 'questions' || sectionName === 'about_cards' || sectionName === "quality_cards") {
                    const selector = sectionName === 'questions' ? '.summernote-' + counters[sectionName] : '#' + sectionName + '_' + counters[sectionName] + ' .summernote';
                    
                    $(selector).summernote({ 
                        height: 150,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    });
                }
                
                counters[sectionName]++;
            });
        }
    }

    initSection('about_cards');
    initSection('quality_cards');
    initSection('vision_cards');
    initSection('values_cards');
    initSection('questions');

    // --- Add Buttons ---
    $('#addAboutCard').click(function() {
        const s = 'about_cards';
        const newIndex = counters[s]++;
        const newCard = createCardHtml(s, newIndex);
        $('#' + s + '_container').append(newCard);
        
        // Initialize Summernote for new card
        $('#' + s + '_' + newIndex + ' .summernote').summernote({
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
    
    $('#addQualityCard').click(function() {
        const s = 'quality_cards';
        const newIndex = counters[s]++;
        $('#' + s + '_container').append(createCardHtml(s, newIndex));
    });
    
    $('#addVisionCard').click(function() {
        const s = 'vision_cards';
        const newIndex = counters[s]++;
        $('#' + s + '_container').append(createCardHtml(s, newIndex));
    });
    
    $('#addValuesCard').click(function() {
        const s = 'values_cards';
        const newIndex = counters[s]++;
        $('#' + s + '_container').append(createCardHtml(s, newIndex));
    });
    
    $('#addQuestionCard').click(function() {
        const s = 'questions';
        const newIndex = counters[s]++;
        const html = createCardHtml(s, newIndex);
        $('#' + s + '_container').append(html);
        
        // Initialize summernote for the newly added card
        $('.summernote-' + newIndex).summernote({ 
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
  
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

    // --- Remove Button ---
    $(document).on('click', '.remove-card', function() {
        const target = $(this).data('target');
        $('#' + target).remove();
    });

    // --- Form Submit ---
    $('#aboutUsForm').on('submit', function(e) {
        e.preventDefault();
        
        // Sync all summernote instances before submit
        $('.summernote').each(function() {
            if ($(this).summernote) {
                $(this).summernote('code', $(this).summernote('code'));
            }
        });
        
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
                    $('#responseMessage').html('<div class="alert alert-success alert-dismissible fade show"><i class="fa fa-check-circle me-2"></i>'+res.message+'<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                     
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    $('#responseMessage').html('<div class="alert alert-danger alert-dismissible fade show"><i class="fa fa-exclamation-circle me-2"></i>'+res.message+'<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                }
            },
            error: function(err) {
                $('#responseMessage').html('<div class="alert alert-danger alert-dismissible fade show"><i class="fa fa-exclamation-circle me-2"></i>An error occurred while saving.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
                $('html, body').animate({ scrollTop: 0 }, 'fast');
            }
        });
    });
});
</script>
<?= $this->endsection() ?>