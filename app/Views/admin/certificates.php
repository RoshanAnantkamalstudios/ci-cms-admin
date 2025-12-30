<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid page-inner">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Manage Certificates</h2>
    </div>

    <div id="responseMessage"></div>

    <form action="<?= base_url('admin/certificates/save') ?>" method="POST"
          id="certForm" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $record['id'] ?? '' ?>">
        <?= csrf_field() ?>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">
                    <i class="fa fa-certificate me-2 text-secondary"></i> Certificates Section
                </h5>
            </div>

            <div class="card-body">

                <!-- ICON -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-uppercase">Icon (SVG / PNG)</label>
                        <input type="file" class="form-control" name="icon">
                        <input type="hidden" name="existing_icon" value="<?= $record['icon'] ?? '' ?>">

                        <?php if (!empty($record['icon'])): ?>
                            <img src="<?= base_url('uploads/certificates/'.$record['icon']) ?>"
                                 class="mt-2" height="50">
                        <?php endif; ?>
                    </div>

                    <!-- <div class="col-md-4">
                        <label class="form-label fw-bold small text-uppercase">Short Title</label>
                        <input type="text" class="form-control"
                               name="short_title"
                               value="< esc($record['short_title'] ?? '') ?>">
                    </div> -->

                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-uppercase">Heading</label>
                        <input type="text" class="form-control"
                               name="heading"
                               value="<?= esc($record['heading'] ?? '') ?>">
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="mb-4">
                    <label class="form-label fw-bold small text-uppercase">Description</label>
                    <textarea class="form-control summernote"
                              name="description"><?= $record['description'] ?? '' ?></textarea>
                </div>

                <!-- ITEMS -->
                <div class="d-flex justify-content-between mb-3">
                    <h6 class="fw-bold text-uppercase text-muted">Certificates Files</h6>
                    <button type="button" class="btn btn-outline-dark btn-sm" id="addItem">
                        <i class="fa fa-plus"></i> Add Item
                    </button>
                </div>

                <div class="row g-3" id="items_container"></div>

            </div>
        </div>

        <div class="text-end sticky-bottom bg-white py-3 border-top">
            <button type="submit" class="btn btn-dark px-4">
                <i class="fa fa-save me-2"></i> Save
            </button>
        </div>

    </form>
</div>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<script>
$(function () {

    let counter = 0;
    const items = <?= json_encode(!empty($record['items']) ? json_decode($record['items'], true) : []) ?>;

    function itemHtml(index, data = {}) {
        let preview = '';
        if (data.file) {
            const ext = data.file.split('.').pop().toLowerCase();
            preview = ext === 'pdf'
                ? `<a href="<?= base_url('uploads/certificates/') ?>/${data.file}" target="_blank">View PDF</a>`
                : `<img src="<?= base_url('uploads/certificates/') ?>/${data.file}" height="60">`;
        }

        return `
        <div class="col-md-6" id="item_${index}">
            <div class="card bg-light shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-white text-dark">Item ${index + 1}</span>
                        <button type="button" class="btn btn-sm btn-outline-danger remove" data-id="${index}">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>

                    <input type="text" class="form-control mb-2"
                           name="items[${index}][title]"
                           placeholder="Certificate Name"
                           value="${data.title || ''}">

                    <input type="file" class="form-control mb-2"
                           name="items[${index}][file]">

                    <input type="hidden"
                           name="items[${index}][existing_file]"
                           value="${data.file || ''}">

                    ${preview}
                </div>
            </div>
        </div>`;
    }

    // Load existing
    items.forEach(item => {
        $('#items_container').append(itemHtml(counter, item));
        counter++;
    });

    $('#addItem').click(function () {
        $('#items_container').append(itemHtml(counter));
        counter++;
    });

    $(document).on('click', '.remove', function () {
        $('#item_' + $(this).data('id')).remove();
    });

    $('.summernote').summernote({
        height: 200,
        toolbar: [
            ['style', ['bold','underline']],
            ['para', ['ul','ol']],
            ['view', ['fullscreen','codeview']]
        ]
    });

    $('#certForm').submit(function (e) {
        e.preventDefault();

        const fd = new FormData(this);

        $.ajax({
            url: this.action,
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            success(res) {
                $('#responseMessage').html(
                    `<div class="alert alert-success">${res.message}</div>`
                );
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    });

});
</script>
<?= $this->endSection() ?>
