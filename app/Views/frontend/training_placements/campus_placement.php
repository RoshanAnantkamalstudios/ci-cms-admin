<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= base_url('uploads/' . esc($hero['image'])) ?>') no-repeat center center/cover;
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
<!-- Hero Section -->
<section class="hero-section py-5 text-center text-white bg-dark">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold" data-aos="zoom-in" data-aos-duration="1000">
            <?= esc($hero['title']) ?>
        </h1>
        <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200"
            style="font-family: 'Poppins', sans-serif;">
            <?= esc($hero['subtitle']) ?>
        </p>
        <?php if ($hero['button_text']): ?>
            <a href="#about-tpo-section" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up"
                data-aos-delay="400" style="font-family: 'Poppins', sans-serif;">
                <?= esc($hero['button_text']) ?>
            </a>
        <?php endif; ?>
    </div>
</section>


<section class="container-fluid py-5" id="about-tpo-section">

    <!-- Filter Section -->
    <div class="container mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" class="form-control" id="studentSearch"
                        placeholder="Search by name or company" aria-label="Search students">
                    <select class="form-select" id="branchFilter">
                        <option value="">All Branches</option>
                        <option value="Mechanical">Mechanical</option>
                        <option value="E & TC">E & TC</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Computer">Computer</option>
                    </select>
                    <button class="btn btn-primary" type="button" onclick="filterStudents()"
                        style="background-color: #ea1f28; border-color: #ea1f28;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Cards -->
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="studentListings" data-aos="fade-up"
            data-aos-delay="400" data-aos-duration="1000">
            <!-- Student Cards -->
            <?php foreach ($students as $student): ?>
                <div class="col student-card" data-branch="<?= esc($student['branch']) ?>" data-name="<?= esc($student['name']) ?>" data-company="<?= esc($student['company']) ?>">
                    <div class="card shadow-lg border-0 hover-card text-center" style="border-radius: 10px;">
                        <img src="<?= base_url('uploads/' . $student['image']) ?>" class="card-img-top mx-auto mt-3" style="width: 100px; height: 100px; object-fit: contain; border-radius: 50%;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: #9933CC;"><?= esc($student['name']) ?></h5>
                            <p class="card-text text-muted"><?= esc($student['branch']) ?></p>
                            <p class="card-text fw-bold text-primary"><?= esc($student['company']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Image Carousel -->
    <div class="container mt-5">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="600">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div id="placementCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Carousel -->
                            <div class="carousel-inner">
                                <?php foreach ($carousel as $index => $c): ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="<?= base_url('uploads/' . $c['image']) ?>" class="d-block w-100" alt="Slide" style="height: 300px; object-fit: contain;">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#placementCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#placementCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold" style="color: #9933CC;">Our Placement Highlights</h5>
                        <p class="text-muted">Moments from our successful placement drives and industry
                            interactions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>