<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title"><?= isset($record) ? 'Edit' : 'Create' ?> Youtube Section</h2>
    </div>

    <div id="responseMessage"></div>

    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="<?= base_url('admin/youtube/save') ?>" method="POST" id="youtubeForm">
                    <?= csrf_field() ?>
                    
                    <!-- Heading -->
                    <div class="mb-4">
                        <label for="heading" class="form-label">Section Heading</label>
                        <input type="text" class="form-control" id="heading" name="heading" 
                               value="<?= isset($record) ? esc($record['heading']) : '' ?>" 
                               placeholder="Enter section heading">
                    </div>

                    <!-- Links Section -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0"><h4>Youtube Videos</h4></label>
                            <button type="button" class="btn btn-success btn-sm" id="addLink">
                                <i class="fa fa-plus"></i> Add Video
                            </button>
                        </div>
                        
                        <div id="linksContainer" class="row g-3">
                            <?php if (isset($record) && !empty($record['links'])): ?>
                                <?php foreach ($record['links'] as $index => $link): ?>
                                    <div class="col-md-6 col-lg-4 link-item" id="link-<?= $index ?>">
                                        <div class="card h-100 border">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">Video <?= $index + 1 ?></span>
                                                <button type="button" class="btn btn-danger btn-sm remove-link" data-link="link-<?= $index ?>">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Youtube URL</label>
                                                    <input type="url" class="form-control youtube-url" name="links[]" 
                                                           value="<?= esc($link) ?>" placeholder="https://www.youtube.com/watch?v=..." required>
                                                </div>
                                                <div class="ratio ratio-16x9 preview-container">
                                                    <!-- Preview will be injected here -->
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
    // Helper to get Youtube ID
    function getYoutubeId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    }

    // Update Preview
    function updatePreview(input) {
        const url = $(input).val();
        const id = getYoutubeId(url);
        const container = $(input).closest('.card-body').find('.preview-container');
        
        if (id) {
            container.html(`
                <iframe src="https://www.youtube.com/embed/${id}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            `);
        } else {
            container.html('<div class="d-flex align-items-center justify-content-center bg-light h-100 text-muted">Invalid URL</div>');
        }
    }

    // Init existing previews
    $('.youtube-url').each(function() {
        updatePreview(this);
    });

    // On change
    $(document).on('input', '.youtube-url', function() {
        updatePreview(this);
    });

    // Add Link
    let linkCounter = <?= isset($record) && !empty($record['links']) ? count($record['links']) : 0 ?>;
    
    $('#addLink').on('click', function() {
        linkCounter++;
        const html = `
            <div class="col-md-6 col-lg-4 link-item" id="link-${linkCounter}">
                <div class="card h-100 border">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Video ${linkCounter}</span>
                        <button type="button" class="btn btn-danger btn-sm remove-link" data-link="link-${linkCounter}">
                            <i class="fa fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Youtube URL</label>
                            <input type="url" class="form-control youtube-url" name="links[]" placeholder="https://www.youtube.com/watch?v=..." required>
                        </div>
                        <div class="ratio ratio-16x9 preview-container">
                            <div class="d-flex align-items-center justify-content-center bg-light h-100 text-muted">Enter URL for preview</div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#linksContainer').append(html);
    });

    // Remove Link
    $(document).on('click', '.remove-link', function() {
        const id = $(this).data('link');
        $('#' + id).remove();
    });

    // Form Submit
    $('#youtubeForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
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

    // Auto-add first
    <?php if (!isset($record) || empty($record['links'])): ?>
        $('#addLink').trigger('click');
    <?php endif; ?>
});
</script>
<?= $this->endsection() ?>
