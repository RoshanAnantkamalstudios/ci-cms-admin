<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <h2>Syllabus CMS</h2>

    <!-- Hero Section Form -->
    <div class="card mb-4">
        <div class="card-header"><strong>Hero Section</strong></div>
        <div class="card-body">
            <form action="<?= base_url('saveHeroSyllabus') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= esc($hero['id'] ?? '') ?>">
                <div class="mb-3"><label>Title</label><input name="title" class="form-control" value="<?= esc($hero['title'] ?? '') ?>"></div>
                <div class="mb-3"><label>Subtitle</label><input name="subtitle" class="form-control" value="<?= esc($hero['subtitle'] ?? '') ?>"></div>
                <div class="mb-3"><label>Button Text</label><input name="button_text" class="form-control" value="<?= esc($hero['button_text'] ?? '') ?>"></div>
                <div class="mb-3"><label>Button Link</label><input name="button_link" class="form-control" value="<?= esc($hero['button_link'] ?? '') ?>"></div>
                <div class="mb-3">
                    <label>Banner Image</label><br>
                    <?php if (!empty($hero['banner_image'])): ?>
                        <img src="<?= base_url('uploads/banners/' . $hero['banner_image']) ?>" style="max-width: 200px;">
                    <?php endif ?>
                    <input type="file" name="banner_image" class="form-control mt-2">
                </div>
                <button class="btn btn-primary">Save Hero</button>
            </form>
        </div>
    </div>

    <!-- Syllabus Table & Modal -->
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <strong>Syllabus Entries</strong>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#syllabusModal">Add Entry</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Department</th>
                        <th>Scheme</th>
                        <th>Semester</th>
                        <th>File</th>
                        <th>Sort</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($entries as $row): ?>
                        <tr>
                            <td><?= esc($row['department']) ?></td>
                            <td><?= esc($row['scheme']) ?></td>
                            <td><?= esc($row['semester']) ?></td>
                            <td><a href="<?= base_url('uploads/syllabus/' . $row['file']) ?>" target="_blank">View</a></td>
                            <td><?= esc($row['sort_order']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="editEntry(<?= $row['id'] ?>)">Edit</button>
                                <a href="<?= base_url('deleteSyllabus/' . $row['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="syllabusModal" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="<?= base_url('saveEntrySyllabus') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Syllabus Entry</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="entry_id">
                    <input type="text" name="department" id="department" placeholder="Department" class="form-control mb-2" required>
                    <input type="text" name="scheme" id="scheme" placeholder="Scheme (e.g., G, E)" class="form-control mb-2" required>
                    <input type="text" name="semester" id="semester" placeholder="Semester" class="form-control mb-2" required>
                    <input type="file" name="file" class="form-control mb-2">
                    <input type="number" name="sort_order" id="sort_order" class="form-control mb-2" placeholder="Sort Order">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>
<script>
    function editEntry(id) {
        fetch("<?= base_url('editSyllabus/') ?>" + id)
            .then(res => res.json())
            .then(data => {
                document.getElementById('entry_id').value = data.id;
                document.getElementById('department').value = data.department;
                document.getElementById('scheme').value = data.scheme;
                document.getElementById('semester').value = data.semester;
                document.getElementById('sort_order').value = data.sort_order;
                var modal = new bootstrap.Modal(document.getElementById('syllabusModal'));
                modal.show();
            });
    }
</script>
<?= $this->endsection() ?>