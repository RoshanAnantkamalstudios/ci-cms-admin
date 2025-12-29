<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">About Our Company</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aboutModal">Add / Edit</button>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?> 
</div>

<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200
        });
    });
</script>
<?= $this->endsection() ?>