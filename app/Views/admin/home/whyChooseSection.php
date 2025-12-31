<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Manage Why Choose Us</h2>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/homewhychoose/save') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fa fa-check-circle me-2 text-secondary"></i>
                        Why Choose Us Section
                    </h5>
                </div>
            </div>

            <div class="card-body">

                <!-- Heading -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase fw-bold">
                            Section Heading
                        </label>
                        <input type="text"
                               class="form-control"
                               name="heading"
                               value="<?= esc($data['heading']) ?>"
                               placeholder="Enter section heading"
                               required>
                    </div>
                </div>

                <!-- Cards Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-uppercase text-muted fw-bold mb-0">Cards</h6>
                    <button type="button" class="btn btn-outline-dark btn-sm" id="addWhyChooseCard">
                        <i class="fa fa-plus me-1"></i> Add Card
                    </button>
                </div>

                <!-- Cards Container -->
                <div class="row g-3" id="whychoose_cards_container">
                    <!-- JS injects cards -->
                </div>

            </div>
        </div>

        <!-- Save -->
        <div class="text-end sticky-bottom bg-white py-3 border-top">
            <button type="submit" class="btn btn-dark px-4">
                <i class="fa fa-save me-2"></i> Save Changes
            </button>
        </div>

    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<script>
$(document).ready(function () {

    let counter = 0;
    const cards = <?= json_encode($data['cards'] ?? []) ?>;

    function cardHtml(index, data = {}) {
        const img = data.icon ? `<?= base_url() ?>/${data.icon}` : '';

        return `
        <div class="col-md-6 card-item" id="card_${index}">
            <div class="card h-100 border-0 shadow-sm bg-light">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-white text-dark border">Card ${index + 1}</span>
                        <a href="<?= base_url('admin/homewhychoose/delete') ?>/${index}"
                           onclick="return confirm('Delete this card?')"
                           class="btn btn-outline-danger btn-sm border-0">
                           <i class="fa fa-times"></i>
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Icon</label>
                        <input type="file" class="form-control" name="cards[${index}][icon]">
                        <input type="hidden" name="cards[${index}][existing_icon]" value="${data.icon || ''}">
                        ${img ? `
                        <div class="mt-2 p-1 border rounded bg-white d-inline-block">
                            <img src="${img}" style="height:60px;">
                        </div>` : ''}
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Title</label>
                        <input type="text"
                               class="form-control"
                               name="cards[${index}][title]"
                               value="${data.title || ''}"
                               required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                        <textarea class="form-control"
                                  rows="3"
                                  name="cards[${index}][description]"
                                  required>${data.description || ''}</textarea>
                    </div>
                </div>
            </div>
        </div>`;
    }

    // Load existing cards
    if (cards.length) {
        cards.forEach(card => {
            $('#whychoose_cards_container').append(cardHtml(counter, card));
            counter++;
        });
    }

    // Add new card
    $('#addWhyChooseCard').on('click', function () {
        $('#whychoose_cards_container').append(cardHtml(counter));
        counter++;
    });

});
</script>
<?= $this->endSection() ?>
