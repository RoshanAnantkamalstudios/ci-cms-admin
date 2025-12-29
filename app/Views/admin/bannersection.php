<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Page Banner CMS</h5>
            <button class="btn btn-success btn-sm" id="addPage">
                + Add Page
            </button>
        </div>

        <div class="card-body">
            <table id="cmsTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Page</th>
                    <th>Title</th>
                    <th>Banner</th>
                    <th width="150">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="cmsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="cmsForm" enctype="multipart/form-data">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">CMS Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="id">
                    <input type="hidden" name="old_image">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Page</label>
                            <select name="page_key" class="form-control" required>
                                <option value="">-- Select Page --</option>
                                <option value="about_us">About Us</option>
                                <option value="products">Products</option>
                                <option value="exports">Exports</option>
                                <option value="e_catalog">E-Catalog</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" name="subtitle" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="banner_image" class="form-control">
                        <img id="previewImg" src="" class="mt-2" height="50" style="display:none">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary px-4">
                        Save
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('custom_script') ?>

<script>
let table;

$(function () {

    table = $('#cmsTable').DataTable({
        ajax: "<?= base_url('admin/bannersection/fetch') ?>",
        responsive: true
    });

    // ADD
    $('#addPage').on('click', function () {
        $('#cmsForm')[0].reset();
        $('[name=id]').val('');
        $('#previewImg').hide();
        $('#cmsModal').modal('show');
    });

    // EDIT
    $('#cmsTable').on('click', '.edit', function () {
        let id = $(this).data('id');

        $.get("<?= base_url('admin/bannersection/edit') ?>/" + id, function (res) {
            $('[name=id]').val(res.id);
            $('[name=page_key]').val(res.page_key);
            $('[name=title]').val(res.title);
            $('[name=subtitle]').val(res.subtitle);
            $('[name=old_image]').val(res.banner_image);

            if (res.banner_image) {
                $('#previewImg')
                    .attr('src', "<?= base_url('uploads/bannersection/') ?>" + res.banner_image)
                    .show();
            }

            $('#cmsModal').modal('show');
        });
    });

    // SAVE
    $('#cmsForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: "<?= base_url('admin/bannersection/save') ?>",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function () {
                $('#cmsModal').modal('hide');
                table.ajax.reload();
            }
        });
    });

    // DELETE
    $('#cmsTable').on('click', '.delete', function () {
        if (!confirm('Delete this page?')) return;

        let id = $(this).data('id');
        $.get("<?= base_url('admin/bannersection/delete') ?>/" + id, function () {
            table.ajax.reload();
        });
    });

});
</script>

<?= $this->endSection() ?>
