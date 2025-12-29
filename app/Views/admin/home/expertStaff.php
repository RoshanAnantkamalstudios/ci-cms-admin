<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2>Manage Faculty Section</h2>

    <form method="post" action="<?= base_url('updateTitleFaculty') ?>">
        <div class="mb-3">
            <label>Main Title</label>
            <input type="text" class="form-control" name="main_title" value="<?= $section['main_title'] ?? '' ?>">
        </div>
        <div class="mb-3">
            <label>Subtitle</label>
            <textarea class="form-control" name="sub_title"><?= $section['sub_title'] ?? '' ?></textarea>
        </div>
        <button class="btn btn-primary">Update Section</button>
    </form>

    <hr>

    <button class="btn btn-success mb-3" onclick="openModal()">+ Add Faculty</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            helper('text');
            foreach ($faculties as $faculty): ?>
                <tr>
                    <td><img src="<?= base_url('uploads/faculty/' . $faculty['image']) ?>" width="60"></td>
                    <td><?= esc($faculty['name']) ?></td>
                    <td><?= character_limiter(strip_tags($faculty['designation'], 10)) ?></td>
                    <td><?= character_limiter(strip_tags($faculty['department'], 10)) ?></td>
                    <td><?= character_limiter(strip_tags($faculty['description']), 25) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editFaculty(<?= $faculty['id'] ?>)"><i class="bi bi-pencil-square"></i></button>
                        <a href="<?= base_url('deleteFaculty/' . $faculty['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="facultyModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="post" action="<?= base_url('saveFaculty') ?>" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Faculty Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <input type="hidden" name="id" id="faculty_id">
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" id="faculty_name" required>
                        </div>
                        <div class="col-md-6">
                            <label>Designation</label>
                            <input type="text" name="designation" class="form-control" id="faculty_designation" required>
                        </div>
                        <div class="col-md-6">
                            <label>Department</label>
                            <input type="text" name="department" class="form-control" id="faculty_department" required>
                        </div>
                        <div class="col-md-6">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" id="faculty_sort">
                        </div>
                        <div class="col-12">
                            <label>Description</label>
                            <textarea name="description" class="form-control" id="faculty_description"></textarea>
                        </div>
                        <div class="col-12">
                            <label>Photo</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-12">
                            <label>Status</label>
                            <select name="status" class="form-control" id="faculty_status">
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





</div>
<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>
<script>
    function openModal() {
        document.querySelector('#faculty_id').value = '';
        document.querySelector('#faculty_name').value = '';
        document.querySelector('#faculty_designation').value = '';
        document.querySelector('#faculty_department').value = '';
        document.querySelector('#faculty_sort').value = '';
        document.querySelector('#faculty_description').value = '';
        document.querySelector('#faculty_status').value = '1';
        new bootstrap.Modal(document.getElementById('facultyModal')).show();
    }

    function editFaculty(id) {
        fetch('<?= base_url('getFaculty/') ?>' + id)
            .then(res => res.json())
            .then(data => {
                document.querySelector('#faculty_id').value = data.id;
                document.querySelector('#faculty_name').value = data.name;
                document.querySelector('#faculty_designation').value = data.designation;
                document.querySelector('#faculty_department').value = data.department;
                document.querySelector('#faculty_sort').value = data.sort_order;
                document.querySelector('#faculty_description').value = data.description;
                document.querySelector('#faculty_status').value = data.status;
                new bootstrap.Modal(document.getElementById('facultyModal')).show();
            });
    }
</script>
<?= $this->endsection() ?>