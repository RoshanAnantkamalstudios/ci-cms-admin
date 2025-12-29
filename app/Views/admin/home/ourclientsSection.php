<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Our Clients Section CMS</h5>
        </div>

        <div class="card-body">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form method="post"
                  action="<?= base_url('admin/ourclients/ourclientssave') ?>"
                  enctype="multipart/form-data">

                <!-- SECTION ID -->
                <input type="hidden" name="id" value="<?= $about['id'] ?? '' ?>">

                <!-- ===== SECTION HEADER ===== -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Section Icon (SVG / PNG)</label>
                        <input type="file" name="icon" class="form-control">
                        <?php if (!empty($about['icon'])): ?>
                            <img src="<?= base_url($about['icon']) ?>" height="40" class="mt-2">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Short Title</label>
                        <input type="text"
                               name="short_title"
                               class="form-control"
                               value="<?= $about['short_title'] ?? '' ?>">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Heading</label>
                    <input type="text"
                           name="heading"
                           class="form-control"
                           value="<?= $about['heading'] ?? '' ?>">
                </div>

                <hr>

                <!-- ===== CARDS ===== -->
                <h6 class="mb-3">Client Cards</h6>

                <div id="cards-wrapper">
                    <?php
                    $cards = !empty($about['cards'])
                        ? json_decode($about['cards'], true)
                        : [];

                    foreach ($cards as $i => $card):
                        // ✅ SAFE FALLBACKS
                        $cardId   = $card['id'] ?? uniqid('c_');
                        $cardIcon = $card['icon'] ?? '';
                    ?>
                        <div class="card mb-3 card-item">
                            <div class="card-body">

                                <!-- REQUIRED HIDDEN FIELDS -->
                                <input type="hidden" name="cards[<?= $i ?>][id]" value="<?= $cardId ?>">
                                <input type="hidden" name="cards[<?= $i ?>][deleted]" value="0" class="deleted-flag">
                                <input type="hidden" name="cards[<?= $i ?>][old_icon]" value="<?= $cardIcon ?>">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Icon</label>
                                        <input type="file"
                                               name="cards[<?= $i ?>][icon]"
                                               class="form-control">
                                        <?php if (!empty($cardIcon)): ?>
                                            <img src="<?= base_url($cardIcon) ?>"
                                                 height="30"
                                                 class="mt-2">
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-8">
                                        <label class="form-label">Title</label>
                                        <input type="text"
                                               name="cards[<?= $i ?>][aboutTitle]"
                                               class="form-control"
                                               value="<?= $card['aboutTitle'] ?? '' ?>">
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <label class="form-label">Description</label>
                                    <textarea name="cards[<?= $i ?>][aboutDescription]"
                                              class="form-control"
                                              rows="3"><?= $card['aboutDescription'] ?? '' ?></textarea>
                                </div>

                                <!-- DELETE CARD -->
                                <button type="button"
                                        class="btn btn-danger btn-sm mt-3 remove-card">
                                    Delete Card
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- ADD CARD -->
                <button type="button" class="btn btn-success btn-sm" id="add-card">
                    + Add Card
                </button>

                <!-- SAVE -->
                <div class="text-end mt-4">
                    <button class="btn btn-primary px-4">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<script>
let cardIndex = <?= count($cards) ?>;

// ADD CARD
document.getElementById('add-card').addEventListener('click', function () {
    const html = `
    <div class="card mb-3 card-item">
        <div class="card-body">
            <input type="hidden" name="cards[${cardIndex}][id]" value="c_${Date.now()}">
            <input type="hidden" name="cards[${cardIndex}][deleted]" value="0" class="deleted-flag">
            <input type="hidden" name="cards[${cardIndex}][old_icon]" value="">

            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Icon</label>
                    <input type="file" name="cards[${cardIndex}][icon]" class="form-control">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Title</label>
                    <input type="text" name="cards[${cardIndex}][aboutTitle]" class="form-control">
                </div>
            </div>

            <div class="mt-2">
                <label class="form-label">Description</label>
                <textarea name="cards[${cardIndex}][aboutDescription]" class="form-control" rows="3"></textarea>
            </div>

            <button type="button" class="btn btn-danger btn-sm mt-3 remove-card">
                Delete Card
            </button>
        </div>
    </div>`;

    document.getElementById('cards-wrapper')
        .insertAdjacentHTML('beforeend', html);

    cardIndex++;
});

// DELETE CARD (SOFT DELETE)
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-card')) {
        const card = e.target.closest('.card-item');
        card.querySelector('.deleted-flag').value = 1;
        card.style.display = 'none';
    }
});
</script>
<?= $this->endSection() ?>
