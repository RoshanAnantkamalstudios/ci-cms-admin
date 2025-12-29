<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">

    <h2>Manage Top Recruiters</h2>

    <!-- Section Title -->
    <form method="post" action="<?= base_url('updateTitleRecruiter') ?>">
        <div class="mb-3">
            <label>Section Title</label>
            <input type="text" name="section_title" class="form-control" value="<?= $section['section_title'] ?? '' ?>">
        </div>
        <button class="btn btn-primary">Update Title</button>
    </form>

    <hr>

    <!-- Recruiters Table -->
    <button class="btn btn-success mb-3" onclick="openRecruiterModal()">+ Add Recruiter</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Alt Text</th>
                <th>Sort</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recruiters as $r): ?>
                <tr>
                    <td><img src="<?= base_url('uploads/recruiters/' . $r['image']) ?>" width="80"></td>
                    <td><?= esc($r['alt_text']) ?></td>
                    <td><?= esc($r['sort_order']) ?></td>
                    <td>
                        <button class="btn btn-sm btn-outline-warning" onclick="editRecruiter(<?= $r['id'] ?>)" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <a href="<?= base_url('deleteRecruiter/' . $r['id']) ?>" onclick="return confirm('Delete this?')" class="btn btn-sm btn-outline-danger" title="Delete">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="recruiterModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" action="<?= base_url('saveRecruiter') ?>" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recruiter Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="recruiter_id">
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Alt Text</label>
                        <input type="text" name="alt_text" id="recruiter_alt" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" id="recruiter_sort" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" id="recruiter_status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>
<script>
    function openRecruiterModal() {
        document.getElementById('recruiter_id').value = '';
        document.getElementById('recruiter_alt').value = '';
        document.getElementById('recruiter_sort').value = '';
        document.getElementById('recruiter_status').value = '1';
        new bootstrap.Modal(document.getElementById('recruiterModal')).show();
    }

    function editRecruiter(id) {
        fetch('<?= base_url('getRecruiter/') ?>' + id)
            .then(res => res.json())
            .then(data => {
                document.getElementById('recruiter_id').value = data.id;
                document.getElementById('recruiter_alt').value = data.alt_text;
                document.getElementById('recruiter_sort').value = data.sort_order;
                document.getElementById('recruiter_status').value = data.status;
                new bootstrap.Modal(document.getElementById('recruiterModal')).show();
            });
    }
</script>
<?= $this->endsection() ?>