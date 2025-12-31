<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Manage Services</h2>
        <button class="btn btn-dark btn-sm" onclick="openServiceModal()">
            <i class="fa fa-plus me-1"></i> Add Service
        </button>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="<?= base_url('admin/services') ?>" method="GET" id="typeFilterForm">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase fw-bold">Service Type</label>
                        <select class="form-select" name="type" id="filter_type">
                            <option value="">-- All --</option>
                            <option value="Architectural" <?= $selected_type === 'Architectural' ? 'selected' : '' ?>>Architectural</option>
                            <option value="SkillLabour" <?= $selected_type === 'SkillLabour' ? 'selected' : '' ?>>SkillLabour</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <?php if (empty($services)): ?>
            <div class="col-12">
                <div class="text-center text-muted py-4">No services found.</div>
            </div>
        <?php else: ?>
            <?php foreach ($services as $s): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-4 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                    <i class="fa fa-briefcase text-muted"></i>
                                </div>
                                <div>
                                    <div class="fw-bold"><?= esc($s['name'] ?: 'Untitled') ?></div>
                                    <div class="text-muted small"><?= esc($s['service_type'] ?: '-') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-end">
                            <button class="btn btn-outline-primary btn-sm me-2" onclick='editService(<?= json_encode($s) ?>)'><i class="fa fa-edit"></i></button>
                            <a class="btn btn-outline-danger btn-sm" href="<?= base_url('admin/service/delete/' . $s['id']) ?>" onclick="return confirm('Delete this service?')"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('admin/service/save') ?>" method="POST" enctype="multipart/form-data" id="serviceForm">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="svc_id">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="modalTitle">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label text-muted small text-uppercase fw-bold">Service Type</label>
                            <select class="form-select" name="service_type" id="svc_type" required>
                                <option value="">-- Select --</option>
                                <option value="Architectural">Architectural</option>
                                <option value="SkillLabour">SkillLabour</option>
                            </select>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label text-muted small text-uppercase fw-bold">Name</label>
                            <input type="text" class="form-control" name="name" id="svc_name" required>
                        </div>
                    </div>

                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="text-uppercase text-muted fw-bold mb-0">Service Sections</h6>
                            <button type="button" class="btn btn-outline-dark btn-sm" onclick="addSection()"><i class="fa fa-plus me-1"></i>Add Section</button>
                        </div>
                        <div id="sectionsContainer" class="row g-3"></div>
                    </div>

                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="text-uppercase text-muted fw-bold mb-0">Process Steps</h6>
                            <button type="button" class="btn btn-outline-dark btn-sm" onclick="addProcess()"><i class="fa fa-plus me-1"></i>Add Step</button>
                        </div>
                        <div id="processContainer" class="row g-3"></div>
                    </div>

                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="text-uppercase text-muted fw-bold mb-0">Why Choose Us</h6>
                            <button type="button" class="btn btn-outline-dark btn-sm" onclick="addWhy()"><i class="fa fa-plus me-1"></i>Add Point</button>
                        </div>
                        <div id="whyContainer" class="row g-3"></div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var serviceModal;

    document.addEventListener('DOMContentLoaded', function() {
        var serviceModalEl = document.getElementById('serviceModal');
        serviceModal = bootstrap.Modal.getOrCreateInstance(serviceModalEl);
        serviceModalEl.addEventListener('hidden.bs.modal', function() {
            document.querySelectorAll('.modal-backdrop').forEach(function(el) {
                el.remove();
            });
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
        });

        document.getElementById('filter_type').addEventListener('change', function() {
            document.getElementById('typeFilterForm').submit();
        });
    });

    function openServiceModal() {
        document.getElementById('svc_id').value = '';
        document.getElementById('svc_type').value = '';
        document.getElementById('svc_name').value = '';
        document.getElementById('sectionsContainer').innerHTML = '';
        document.getElementById('processContainer').innerHTML = '';
        document.getElementById('whyContainer').innerHTML = '';
        addSection();
        document.getElementById('modalTitle').innerText = 'Add Service';
        serviceModal.show();
    }

    function editService(data) {
        document.getElementById('svc_id').value = data.id;
        document.getElementById('svc_type').value = data.service_type || '';
        document.getElementById('svc_name').value = data.name || '';
        document.getElementById('sectionsContainer').innerHTML = '';
        document.getElementById('processContainer').innerHTML = '';
        document.getElementById('whyContainer').innerHTML = '';

        try {
            var sections = JSON.parse(data.service_section || '[]');
            sections.forEach(function(sec, idx) {
                addSection(sec, idx);
            });
        } catch (e) {
            addSection();
        }

        try {
            var processes = JSON.parse(data.process || '[]');
            processes.forEach(function(p, idx) {
                addProcess(p, idx);
            });
        } catch (e) {}

        try {
            var why = JSON.parse(data.why_choose_us || '[]');
            why.forEach(function(v) {
                addWhy(v);
            });
        } catch (e) {}

        document.getElementById('modalTitle').innerText = 'Edit Service';
        serviceModal.show();
    }

    function addSection(prefill, index) {
        var i = typeof index === 'number' ? index : document.querySelectorAll('.section-item').length;
        var wrap = document.createElement('div');
        wrap.className = 'col-12 section-item';
        wrap.innerHTML = `
            <div class="border rounded p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong class="text-muted">Section</strong>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.section-item').remove()">Remove</button>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Title</label>
                        <input type="text" class="form-control" name="service_section[${i}][title]" value="${prefill && prefill.title ? prefill.title.replace(/\"/g,'&quot;') : ''}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Icon</label>
                        <input type="file" class="form-control" name="section_icon_${i}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Description</label>
                        <textarea class="form-control summernote-sec" name="service_section[${i}][description]">${prefill && prefill.description ? prefill.description : ''}</textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Images</label>
                        <div id="sectionImages_${i}" class="mb-2"></div>
                        <button type="button" class="btn btn-outline-dark btn-sm" onclick="addSectionImage(${i})"><i class="fa fa-plus me-1"></i>Add Image</button>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('sectionsContainer').appendChild(wrap);
        setTimeout(function() {
            if (typeof $ !== 'undefined' && $('.summernote-sec').summernote) {
                $(wrap).find('.summernote-sec').summernote({
                    height: 160
                });
            }
        }, 10);
    }

    function addSectionImage(i) {
        var container = document.getElementById('sectionImages_' + i);
        var row = document.createElement('div');
        row.className = 'd-flex align-items-center mb-2 gap-2';
        var input = document.createElement('input');
        input.type = 'file';
        input.name = 'section_images_' + i + '[]';
        input.accept = 'image/*';
        input.className = 'form-control';
        input.onchange = function() {
            previewSelectedFile(this);
        };
        var img = document.createElement('img');
        img.style.width = '60px';
        img.style.height = '60px';
        img.style.objectFit = 'cover';
        img.className = 'rounded d-none';
        var remove = document.createElement('button');
        remove.type = 'button';
        remove.className = 'btn btn-outline-danger btn-sm';
        remove.innerHTML = '<i class="fa fa-times"></i>';
        remove.onclick = function() {
            row.remove();
        };
        row.appendChild(input);
        row.appendChild(img);
        row.appendChild(remove);
        container.appendChild(row);
    }

    function addProcess(prefill, index) {
        var i = typeof index === 'number' ? index : document.querySelectorAll('.process-item').length;
        var wrap = document.createElement('div');
        wrap.className = 'col-12 process-item';
        wrap.innerHTML = `
            <div class="border rounded p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong class="text-muted">Step</strong>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.process-item').remove()">Remove</button>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Step No</label>
                        <input type="number" class="form-control" name="process[${i}][stepNo]" value="${prefill && prefill.stepNo ? prefill.stepNo : ''}">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Title</label>
                        <input type="text" class="form-control" name="process[${i}][title]" value="${prefill && prefill.title ? prefill.title.replace(/\"/g,'&quot;') : ''}">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Image</label>
                        <input type="file" class="form-control" name="process_image_${i}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Description</label>
                        <textarea class="form-control" name="process[${i}][description]">${prefill && prefill.description ? prefill.description : ''}</textarea>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('processContainer').appendChild(wrap);
    }

    function addWhy(value) {
        var wrap = document.createElement('div');
        wrap.className = 'col-12 why-item';
        wrap.innerHTML = `
            <div class="d-flex align-items-center gap-2">
                <input type="text" class="form-control" name="why_choose_us[]" value="${value ? value.replace(/\"/g,'&quot;') : ''}">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.why-item').remove()"><i class="fa fa-times"></i></button>
            </div>
        `;
        document.getElementById('whyContainer').appendChild(wrap);
    }

    function previewSelectedFile(input) {
        var file = input.files && input.files[0];
        if (!file) return;
        var img = input.parentElement.querySelector('img');
        var reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            img.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
</script>

<?= $this->endSection() ?>