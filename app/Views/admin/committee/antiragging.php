<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2 class="mb-4">Anti-Ragging CMS</h2>

    <!-- Flash -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Hero Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Hero Section</strong>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#heroModal">Edit Hero</button>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-8">
                    <p><strong>Title:</strong> <?= esc($hero['title'] ?? '') ?></p>
                    <p><strong>Subtitle:</strong> <?= esc($hero['subtitle'] ?? '') ?></p>
                    <p><strong>Button:</strong>
                        <?= esc($hero['button_text'] ?? '') ?>
                        <?php if (!empty($hero['button_link'])): ?>
                            (<a href="<?= esc($hero['button_link']) ?>" target="_blank"><?= esc($hero['button_link']) ?></a>)
                        <?php endif; ?>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <?php if (!empty($hero['background_image'])): ?>
                        <img src="<?= base_url('uploads/banner/' . $hero['background_image']) ?>" class="img-fluid rounded shadow-sm" style="max-height: 150px;" alt="Banner Image">
                    <?php else: ?>
                        <p class="text-muted">No Banner Image</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Committee Members -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <strong>Anti-Ragging Committee</strong>
            <button class="btn btn-success btn-sm" onclick="openMemberModal('committee')">Add Member</button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($committee as $i => $member): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($member['name']) ?></td>
                            <td><?= esc($member['designation']) ?></td>
                            <td><?= esc($member['email']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick='editMember(<?= json_encode($member) ?>)'>Edit</button>
                                <a href="<?= base_url('deleteAntiRagging/' . $member['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Squad Members -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <strong>Anti-Ragging Squad</strong>
            <button class="btn btn-success btn-sm" onclick="openMemberModal('squad')">Add Member</button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($squad as $i => $member): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($member['name']) ?></td>
                            <td><?= esc($member['designation']) ?></td>
                            <td><?= esc($member['email']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick='editMember(<?= json_encode($member) ?>)'>Edit</button>
                                <a href="<?= base_url('deleteAntiRagging/' . $member['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Hero Modal -->
<div class="modal fade" id="heroModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" action="<?= base_url('saveAntiRagging') ?>" enctype="multipart/form-data" class="modal-content">
            <input type="hidden" name="id" value="<?= $hero['id'] ?? '' ?>">
            <input type="hidden" name="section_type" value="hero">
            <div class="modal-header">
                <h5 class="modal-title">Edit Hero Section</h5>
            </div>
            <div class="modal-body">
                <input type="text" name="title" placeholder="Title" class="form-control mb-2" value="<?= $hero['title'] ?? '' ?>">
                <textarea name="subtitle" class="form-control mb-2" placeholder="Subtitle"><?= $hero['subtitle'] ?? '' ?></textarea>
                <input type="text" name="button_text" placeholder="Button Text" class="form-control mb-2" value="<?= $hero['button_text'] ?? '' ?>">
                <input type="text" name="button_link" placeholder="Button Link" class="form-control mb-2" value="<?= $hero['button_link'] ?? '' ?>">

                <!-- Banner Image Upload -->
                <label class="form-label mt-2">Banner Image</label>
                <?php if (!empty($hero['background_image'])): ?>
                    <div class="mb-2">
                        <img src="<?= base_url('uploads/banner/' . $hero['background_image']) ?>" class="img-fluid rounded shadow-sm" style="max-height: 150px;" alt="Current Banner">
                    </div>
                <?php endif; ?>
                <input type="file" name="background_image" class="form-control mb-2">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>


<!-- Member Modal -->
<div class="modal fade" id="memberModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" action="<?= base_url('saveAntiRagging') ?>" class="modal-content">
            <input type="hidden" name="id" id="memberId">
            <input type="hidden" name="section_type" id="memberType">
            <div class="modal-header">
                <h5 class="modal-title">Member</h5>
            </div>
            <div class="modal-body">
                <input type="text" name="name" id="memberName" class="form-control mb-2" placeholder="Name" required>
                <input type="text" name="designation" id="memberDesignation" class="form-control mb-2" placeholder="Designation">
                <input type="email" name="email" id="memberEmail" class="form-control mb-2" placeholder="Email">
                <input type="number" name="sort_order" id="memberOrder" class="form-control mb-2" placeholder="Order">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>




<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>

<script>
    function openMemberModal(type) {
        document.getElementById('memberId').value = '';
        document.getElementById('memberName').value = '';
        document.getElementById('memberDesignation').value = '';
        document.getElementById('memberEmail').value = '';
        document.getElementById('memberOrder').value = '';
        document.getElementById('memberType').value = type;
        new bootstrap.Modal(document.getElementById('memberModal')).show();
    }

    function editMember(member) {
        document.getElementById('memberId').value = member.id;
        document.getElementById('memberName').value = member.name;
        document.getElementById('memberDesignation').value = member.designation;
        document.getElementById('memberEmail').value = member.email;
        document.getElementById('memberOrder').value = member.sort_order;
        document.getElementById('memberType').value = member.section_type;
        new bootstrap.Modal(document.getElementById('memberModal')).show();
    }
</script>
<?= $this->endsection() ?>