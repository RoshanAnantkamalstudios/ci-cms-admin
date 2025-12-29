<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h1 class="mb-4">Board Members CMS</h1>

    <!-- HERO SECTION -->
    <form action="<?= base_url('saveHeroBoardMember') ?>" method="post" enctype="multipart/form-data" class="card mb-4">
        <div class="card-header fw-bold">Hero Section</div>
        <div class="card-body">
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label>Subtitle</label>
                <input type="text" name="subtitle" class="form-control" value="<?= esc($hero['subtitle'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label>Background Image</label>
                <input type="file" name="image" class="form-control">
                <?php if (!empty($hero['image'])): ?>
                    <img src="<?= base_url($hero['image']) ?>" height="100" class="mt-2">
                <?php endif; ?>
            </div>
            <button class="btn btn-primary">Save Hero</button>
        </div>
    </form>

    <!-- MEMBERS SECTION -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-bold">Board Members</span>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#memberModal" onclick="openMemberModal()">+ Add Member</button>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3 g-3">
                <?php foreach ($members as $member): ?>
                    <div class="col">
                        <div class="card h-100 text-center">
                            <div class="card-body d-flex flex-column">
                                <?php
                                $imagePath = !empty($member['image']) ? base_url($member['image']) : base_url('uploads/person.webp');
                                ?>
                                <?php if ($member['image']): ?>
                                    <img src="<?= $imagePath ?>" class="rounded-circle mx-auto d-block mb-3" style="width:120px;height:120px;object-fit:cover;">
                                <?php else: ?>
                                    <div class="rounded-circle bg-secondary mx-auto mb-3" style="width:120px;height:120px;"></div>
                                <?php endif; ?>

                                <h5 class="mt-auto"><?= esc($member['name']) ?></h5>
                                <p class="mb-1"><?= esc($member['designation']) ?></p>
                                <p class="text-muted"><small><?= esc($member['role']) ?></small></p>
                                <p class="small"><?= esc($member['message']) ?></p>
                            </div>
                            <div class="card-footer bg-white border-0 d-flex justify-content-around">
                                <button class="btn btn-sm btn-warning" onclick="editMember(<?= htmlspecialchars(json_encode($member)) ?>)">Edit</button>
                                <a href="<?= base_url('deleteBoardMember/' . $member['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this member?')">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="memberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('saveBoardMember') ?>" method="post" enctype="multipart/form-data" class="modal-content">
            <input type="hidden" name="id" id="member-id">
            <div class="modal-header">
                <h5 class="modal-title">Add/Edit Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" id="member-name">
                </div>
                <div class="col-md-6">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control" id="member-designation">
                </div>
                <div class="col-md-6">
                    <label>Role/Department</label>
                    <input type="text" name="role" class="form-control" id="member-role">
                </div>
                <div class="col-md-6">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-12">
                    <label>Message</label>
                    <textarea name="message" class="form-control" id="member-message"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
<script>
    function openMemberModal() {
        document.getElementById('member-id').value = '';
        document.getElementById('member-name').value = '';
        document.getElementById('member-designation').value = '';
        document.getElementById('member-role').value = '';
        document.getElementById('member-message').value = '';
    }

    function editMember(member) {
        const modal = new bootstrap.Modal(document.getElementById('memberModal'));
        document.getElementById('member-id').value = member.id;
        document.getElementById('member-name').value = member.name;
        document.getElementById('member-designation').value = member.designation;
        document.getElementById('member-role').value = member.role;
        document.getElementById('member-message').value = member.message;
        modal.show();
    }
</script>
<?= $this->endSection() ?>