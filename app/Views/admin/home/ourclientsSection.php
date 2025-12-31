<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Manage Our Clients</h2>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form method="post"
          action="<?= base_url('admin/ourclients/ourclientssave') ?>"
          enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $about['id'] ?? '' ?>">

        <!-- ===== SECTION DETAILS ===== -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fa fa-users me-2 text-secondary"></i>
                    Our Clients Section
                </h5>
            </div>

            <div class="card-body">

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label small text-uppercase fw-bold text-muted">
                            Section Icon
                        </label>
                        <input type="file" name="icon" class="form-control">
                        <?php if (!empty($about['icon'])): ?>
                            <img src="<?= base_url($about['icon']) ?>" height="40" class="mt-2">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label small text-uppercase fw-bold text-muted">
                            Short Title
                        </label>
                        <input type="text"
                               name="short_title"
                               class="form-control"
                               value="<?= esc($about['short_title'] ?? '') ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-uppercase fw-bold text-muted">
                        Heading
                    </label>
                    <input type="text"
                           name="heading"
                           class="form-control"
                           value="<?= esc($about['heading'] ?? '') ?>">
                </div>

            </div>
        </div>

        <!-- ===== CLIENT CARDS ===== -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-uppercase text-muted">Client Cards</h6>
                <button type="button" class="btn btn-outline-dark btn-sm" id="add-card">
                    <i class="fa fa-plus me-1"></i> Add Card
                </button>
            </div>

            <div class="card-body">
                <div class="row g-3" id="cards-wrapper">

                    <?php
                    $cards = !empty($about['cards'])
                        ? json_decode($about['cards'], true)
                        : [];

                    foreach ($cards as $i => $card):
                        $cardId   = $card['id'] ?? uniqid('c_');
                        $cardIcon = $card['icon'] ?? '';
                    ?>
                    <div class="col-md-6 card-item">
                        <div class="card h-100 border-0 shadow-sm bg-light">
                            <div class="card-body">

                                <!-- hidden fields -->
                                <input type="hidden" name="cards[<?= $i ?>][id]" value="<?= $cardId ?>">
                                <input type="hidden" name="cards[<?= $i ?>][deleted]" value="0" class="deleted-flag">
                                <input type="hidden" name="cards[<?= $i ?>][old_icon]" value="<?= $cardIcon ?>">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-white border text-dark">
                                        Card <?= $i + 1 ?>
                                    </span>
                                    <button type="button" class="btn btn-outline-danger btn-sm remove-card border-0">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted text-uppercase">
                                        Icon
                                    </label>
                                    <input type="file"
                                           name="cards[<?= $i ?>][icon]"
                                           class="form-control">

                                    <?php if (!empty($cardIcon)): ?>
                                        <div class="mt-2 p-1 bg-white border rounded d-inline-block">
                                            <img src="<?= base_url($cardIcon) ?>" height="40">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted text-uppercase">
                                        Title
                                    </label>
                                    <input type="text"
                                           name="cards[<?= $i ?>][aboutTitle]"
                                           class="form-control"
                                           value="<?= esc($card['aboutTitle'] ?? '') ?>">
                                </div>

                                <div>
                                    <label class="form-label small fw-bold text-muted text-uppercase">
                                        Description
                                    </label>
                                    <textarea name="cards[<?= $i ?>][aboutDescription]"
                                              class="form-control"
                                              rows="3"><?= esc($card['aboutDescription'] ?? '') ?></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

        <!-- SAVE -->
        <div class="text-end mt-4 sticky-bottom bg-white py-3 border-top">
            <button class="btn btn-dark px-4">
                <i class="fa fa-save me-2"></i> Save Changes
            </button>
        </div>

    </form>
</div>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>
<script>
let cardIndex = <?= count($cards) ?>;

// ADD CARD
document.getElementById('add-card').addEventListener('click', function () {

    const html = `
    <div class="col-md-6 card-item">
        <div class="card h-100 border-0 shadow-sm bg-light">
            <div class="card-body">

                <input type="hidden" name="cards[${cardIndex}][id]" value="c_${Date.now()}">
                <input type="hidden" name="cards[${cardIndex}][deleted]" value="0" class="deleted-flag">
                <input type="hidden" name="cards[${cardIndex}][old_icon]" value="">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-white border text-dark">New</span>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-card border-0">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Icon</label>
                    <input type="file" name="cards[${cardIndex}][icon]" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Title</label>
                    <input type="text" name="cards[${cardIndex}][aboutTitle]" class="form-control">
                </div>

                <div>
                    <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                    <textarea name="cards[${cardIndex}][aboutDescription]" class="form-control" rows="3"></textarea>
                </div>

            </div>
        </div>
    </div>`;

    document.getElementById('cards-wrapper')
        .insertAdjacentHTML('beforeend', html);

    cardIndex++;
});

// SOFT DELETE
document.addEventListener('click', function (e) {
    if (e.target.closest('.remove-card')) {
        const card = e.target.closest('.card-item');
        card.querySelector('.deleted-flag').value = 1;
        card.style.display = 'none';
    }
});
</script>
<?= $this->endSection() ?>
