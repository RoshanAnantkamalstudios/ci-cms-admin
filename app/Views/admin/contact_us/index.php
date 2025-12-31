<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="page-header">
        <h4 class="page-title">Contact Us Management</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Contact Information</div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/contact_us/save') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $contact['id'] ?? '' ?>">

                        <div class="row">
                            <!-- Address Section -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Address Title</label>
                                <input type="text" class="form-control" name="address_title" value="<?= $contact['address_title'] ?? '' ?>">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <textarea class="form-control" name="address" rows="3"><?= $contact['address'] ?? '' ?></textarea>
                            </div>

                            <hr class="my-4">

                            <!-- Phone Section -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Phone Title</label>
                                <input type="text" class="form-control" name="phone_title" value="<?= $contact['phone_title'] ?? '' ?>">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Phone Numbers</label>
                                <div id="phoneNumbersContainer">
                                    <?php
                                    $phones = json_decode($contact['phone_numbers'] ?? '[]', true);
                                    if (empty($phones)) $phones = [''];
                                    foreach ($phones as $phone):
                                    ?>
                                        <div class="input-group mb-2 phone-item">
                                            <input type="text" class="form-control" name="phone_numbers[]" value="<?= $phone ?>" placeholder="+91 1234567890">
                                            <button class="btn btn-outline-danger" type="button" onclick="removeParent(this, '.phone-item')"><i class="fa fa-trash"></i></button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-dark mt-1" onclick="addPhone()"><i class="fa fa-plus me-1"></i> Add Number</button>
                            </div>

                            <hr class="my-4">

                            <!-- Email Section -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Email Title</label>
                                <input type="text" class="form-control" name="emails_title" value="<?= $contact['emails_title'] ?? '' ?>">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Emails</label>
                                <div id="emailsContainer">
                                    <?php
                                    $emails = json_decode($contact['emails'] ?? '[]', true);
                                    if (empty($emails)) $emails = [''];
                                    foreach ($emails as $email):
                                    ?>
                                        <div class="input-group mb-2 email-item">
                                            <input type="email" class="form-control" name="emails[]" value="<?= $email ?>" placeholder="sample@gmail.com">
                                            <button class="btn btn-outline-danger" type="button" onclick="removeParent(this, '.email-item')"><i class="fa fa-trash"></i></button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-dark mt-1" onclick="addEmail()"><i class="fa fa-plus me-1"></i> Add Email</button>
                            </div>

                            <hr class="my-4">

                            <!-- General Contact Info -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Contact Heading</label>
                                <input type="text" class="form-control" name="contact_heading" value="<?= $contact['contact_heading'] ?? '' ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Contact Button Name</label>
                                <input type="text" class="form-control" name="contact_btn_name" value="<?= $contact['contact_btn_name'] ?? '' ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Contact Button URL</label>
                                <input type="text" class="form-control" name="contact_btn_url" value="<?= $contact['contact_btn_url'] ?? '' ?>">
                            </div>

                            <hr class="my-4">

                            <!-- Branch Info -->
                            <div class="col-md-12 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Branch Heading</label>
                                        <input type="text" class="form-control" name="branch_heading" value="<?= $contact['branch_heading'] ?? '' ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Branch Image</label>
                                        <input type="file" class="form-control" name="branch_image">
                                        <?php if (!empty($contact['branch_image'])): ?>
                                            <div class="mt-2">
                                                <img src="<?= base_url($contact['branch_image']) ?>" class="img-thumbnail" width="150">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Branches</label>
                                <div id="branchesContainer">
                                    <?php
                                    $branches = json_decode($contact['branches'] ?? '[]', true);
                                    if (empty($branches)) $branches = []; // Start empty or maybe with one? Empty is fine.
                                    foreach ($branches as $branch):
                                    ?>
                                        <div class="card mb-3 branch-item bg-light border">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <strong>Branch Details</strong>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeParent(this, '.branch-item')">Remove</button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-2">
                                                        <input type="text" class="form-control" name="branch_name[]" placeholder="Branch Name" value="<?= $branch['branch_name'] ?? '' ?>">
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <input type="text" class="form-control" name="branch_location[]" placeholder="Branch Location" value="<?= $branch['branch_location'] ?? '' ?>">
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <input type="text" class="form-control" name="branch_address[]" placeholder="Branch Address" value="<?= $branch['branch_address'] ?? '' ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-dark" onclick="addBranch()"><i class="fa fa-plus me-1"></i> Add Branch</button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function removeParent(btn, selector) {
        if (confirm('Are you sure?')) {
            btn.closest(selector).remove();
        }
    }

    function addPhone() {
        const div = document.createElement('div');
        div.className = 'input-group mb-2 phone-item';
        div.innerHTML = `
            <input type="text" class="form-control" name="phone_numbers[]" placeholder="+91 1234567890">
            <button class="btn btn-outline-danger" type="button" onclick="removeParent(this, '.phone-item')"><i class="fa fa-trash"></i></button>
        `;
        document.getElementById('phoneNumbersContainer').appendChild(div);
    }

    function addEmail() {
        const div = document.createElement('div');
        div.className = 'input-group mb-2 email-item';
        div.innerHTML = `
            <input type="email" class="form-control" name="emails[]" placeholder="sample@gmail.com">
            <button class="btn btn-outline-danger" type="button" onclick="removeParent(this, '.email-item')"><i class="fa fa-trash"></i></button>
        `;
        document.getElementById('emailsContainer').appendChild(div);
    }

    function addBranch() {
        const div = document.createElement('div');
        div.className = 'card mb-3 branch-item bg-light border';
        div.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <strong>Branch Details</strong>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeParent(this, '.branch-item')">Remove</button>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" name="branch_name[]" placeholder="Branch Name">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" name="branch_location[]" placeholder="Branch Location">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" name="branch_address[]" placeholder="Branch Address">
                    </div>
                </div>
            </div>
        `;
        document.getElementById('branchesContainer').appendChild(div);
    }
</script>
<?= $this->endSection() ?>