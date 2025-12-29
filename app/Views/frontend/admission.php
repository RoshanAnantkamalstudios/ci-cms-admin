<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('uploads/hero/' . ($hero['image'] ?? 'default.jpg')) ?>') no-repeat center center/cover;
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        position: relative;
        text-align: center;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }
</style>

<section class="hero-section py-5 text-center text-white bg-dark">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold" data-aos="zoom-in" data-aos-duration="1000">
            <?= esc($hero['title'] ?? 'Student Admission Form') ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
            <?= esc($hero['subtitle'] ?? 'Forging strong partnerships with industry leaders to enhance student opportunities and innovation.') ?>
        </p>
        <?php if (!empty($hero['button_text'])): ?>
            <a href="#about-tpo-section" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up" data-aos-delay="400">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>



<section class="container-fluid py-5" id="about-tpo-section">
    <div class="container py-5">
        <h3 class="text-center mb-4">Student Admission Form</h3>
        <form id="admission_student_info" method="post" action="" onsubmit="return validateRform();"
            enctype="multipart/form-data" novalidate>
            <div class="row g-4">

                <!-- Section: Admission Details -->
                <div class="col-12">
                    <h5 class="border-bottom pb-2">Admission Details</h5>
                </div>

                <div class="col-md-6">
                    <label for="sat" class="form-label">Admission Type <span class="text-danger">*</span></label>
                    <select class="form-select" name="sat" id="sat" required>
                        <option value="">Select</option>
                        <option value="DFY">Direct 1st Year</option>
                        <option value="DSY">Direct 2nd Year</option>
                        <option value="DTY">Direct 3rd Year</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="sabm" class="form-label">Admission Base Mode <span
                            class="text-danger">*</span></label>
                    <select class="form-select" name="sabm" id="sabm" required>
                        <option value="">Select</option>
                        <option>After 10th</option>
                        <option>12th</option>
                        <option>MCVC</option>
                        <option>ITI</option>
                        <option>COE</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="sccs" class="form-label">Course Code <span class="text-danger">*</span></label>
                    <select class="form-select" name="sccs" id="sccs" required>
                        <option value="">Select</option>
                        <option value="CM">Computer Technology</option>
                        <option value="IF">Information Technology</option>
                        <option value="EE">Electrical Engineering</option>
                        <option value="EJ">Electronics & Telecommunication</option>
                        <option value="ME">Mechanical Engineering</option>
                        <option value="CE">Civil Engineering</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="sgnd" class="form-label">Gender <span class="text-danger">*</span></label>
                    <select class="form-select" name="sgnd" id="sgnd" required>
                        <option value="">Select</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>

                <!-- Section: Student Details -->
                <div class="col-12">
                    <h5 class="border-bottom pb-2 mt-4">Student Details</h5>
                </div>

                <div class="col-md-6">
                    <label for="sname" class="form-label">Student Full Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sname" id="sname" placeholder="As on mark sheet"
                        required>
                </div>

                <div class="col-md-6">
                    <label for="scno" class="form-label">Student Contact No <span
                            class="text-danger">*</span></label>
                    <input type="tel" class="form-control" name="scno" id="scno" pattern="[0-9]{10}" maxlength="10"
                        required>
                </div>

                <div class="col-md-6">
                    <label for="sdob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="sdob" id="sdob" required>
                </div>

                <div class="col-md-6">
                    <label for="spob" class="form-label">Place of Birth</label>
                    <input type="text" class="form-control" name="spob" id="spob">
                </div>

                <div class="col-md-6">
                    <label for="slsc" class="form-label">Latest School Completed</label>
                    <input type="text" class="form-control" name="slsc" id="slsc">
                </div>

                <div class="col-md-6">
                    <label for="sn" class="form-label">Nationality</label>
                    <input type="text" class="form-control" name="sn" id="sn" value="Indian" readonly>
                </div>

                <div class="col-md-6">
                    <label for="sr" class="form-label">Religion</label>
                    <select class="form-select" name="sr" id="sr">
                        <option value="">Select</option>
                        <option>Hindu</option>
                        <option>Muslim</option>
                        <option>Buddhist</option>
                        <option>Christian</option>
                        <option>Sikh</option>
                        <option>Jain</option>
                        <option>Parsi</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="sc" class="form-label">Category</label>
                    <select class="form-select" name="sc" id="sc">
                        <option value="">Select</option>
                        <option>OPEN</option>
                        <option>SC</option>
                        <option>ST</option>
                        <option>VJ</option>
                        <option>DT</option>
                        <option>NT-A</option>
                        <option>NT-B</option>
                        <option>NT-C</option>
                        <option>NT-D</option>
                        <option>OBC</option>
                        <option>SBC</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="ssc" class="form-label">Sub-Caste</label>
                    <input type="text" class="form-control" name="ssc" id="ssc">
                </div>

                <div class="col-md-6">
                    <label for="sfname" class="form-label">Father's Name</label>
                    <input type="text" class="form-control" name="sfname" id="sfname">
                </div>

                <div class="col-md-6">
                    <label for="sfcno" class="form-label">Father/Guardian Contact No</label>
                    <input type="tel" class="form-control" name="sfcno" id="sfcno" pattern="[0-9]{10}"
                        maxlength="10">
                </div>

                <!-- Section: Address -->
                <div class="col-12">
                    <h5 class="border-bottom pb-2 mt-4">Address</h5>
                </div>

                <div class="col-md-12">
                    <label for="stasa" class="form-label">Street Address</label>
                    <textarea class="form-control" name="stasa" id="stasa" rows="2"></textarea>
                </div>

                <div class="col-md-4">
                    <label for="stad" class="form-label">District</label>
                    <input type="text" class="form-control" name="stad" id="stad" value="Nashik">
                </div>

                <div class="col-md-4">
                    <label for="stas" class="form-label">State</label>
                    <input type="text" class="form-control" name="stas" id="stas" value="Maharashtra">
                </div>

                <div class="col-md-4">
                    <label for="stac" class="form-label">Country</label>
                    <input type="text" class="form-control" name="stac" id="stac" value="India">
                </div>

                <!-- Submit -->
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm">Send Enquiry</button>
                </div>
            </div>
        </form>
    </div>
</section>
<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>`