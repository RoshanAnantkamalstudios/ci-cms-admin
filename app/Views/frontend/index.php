<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<!-- Home Banner Area (Carousel) -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php if (!empty($carousel_slides)): ?>
      <?php foreach ($carousel_slides as $index => $slide): ?>
        <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
          <img src="<?= base_url($slide['banner_image'] ?? 'public/frontend/img/default-slide.jpg') ?>"
            class="d-block w-100" alt="Slide <?= $index + 1 ?>">
          <div class="carousel-caption d-none d-md-block">
            <h5 data-aos="fade-up"><?= esc($slide['title']) ?></h5>
            <p data-aos="fade-up" data-aos-delay="100"><?= esc($slide['sub_title']) ?></p>
            <?php if (!empty($slide['btn_text']) && !empty($slide['btn_link'])): ?>
              <a href="<?= esc($slide['btn_link']) ?>" class="btn btn-primary" data-aos="fade-up" data-aos-delay="200"><?= esc($slide['btn_text']) ?></a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="carousel-item active">
        <img src="<?= base_url('public/frontend/img/default-slide.jpg') ?>" class="d-block w-100" alt="Default Slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Welcome</h5>
          <p>Carousel is coming soon...</p>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- BVCTE Introduction Section -->
<section class="bvcte-section py-5 bg-white">
  <div class="container">
    <!-- Section Title -->
    <h2 class="text-center mb-4 fw-bold" style="font-family: 'Poppins';" data-aos="fade-up">About BVCTE</h2>
    <div class="mx-auto mb-5" style="width: 80px; height: 3px; background-color: #ea1f28;"></div>

    <!-- About Row -->
    <div class="row align-items-center mb-5">
      <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
        <img src="<?= base_url($about['image'] ?? 'public/frontend/img/default-image.jpg') ?>" alt="BVCTE Campus" class="img-fluid rounded shadow-sm">
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <?= $about['overview'] ?>
        <?php if (!empty($about['subtitle'])): ?>
          <a href="<?= esc($about['btn_link']) ?>" class="btn btn-danger mt-3 px-4 py-2"><?= esc($about['subtitle']) ?></a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Features and Location -->
    <div class="row g-4">
      <!-- Location Info -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <div class="p-4 bg-light rounded shadow-sm h-100">
          <h4 class="mb-3"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Easily Approachable Campus</h4>
          <?= $about['approachable'] ?>
        </div>
      </div>

      <!-- Features -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <div class="p-4 bg-light rounded shadow-sm h-100">
          <h4 class="mb-3"><i class="bi bi-stars text-danger me-2"></i>Our Features</h4>
          <?= $about['features'] ?>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Courses Section -->
<section class="py-5 bg-light position-relative">
  <div class="container">
    <!-- Section Title -->
    <h2 class="text-center fw-bold mb-3" style="font-family: 'Poppins';" data-aos="fade-up">Our Courses</h2>
    <div class="mx-auto mb-5" style="width: 100px; height: 4px; background: linear-gradient(to right, #007bff, #00bcd4);"></div>

    <div class="row g-4">
      <?php $delay = 100; ?>
      <?php foreach ($courses as $course): ?>
        <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
          <div class="card h-100 border-0 shadow-lg hover-shadow transition rounded-4">
            <div class="card-body text-center">
              <?php if (!empty($course['icon_image'])): ?>
                <img src="<?= base_url($course['icon_image']) ?>" alt="<?= esc($course['title']) ?>" class="mb-3" style="height: 60px;">
              <?php else: ?>
                <i class="bi bi-book display-4 text-gradient mb-3"></i>
              <?php endif; ?>
              <h5 class="card-title"><?= esc($course['title']) ?></h5>
              <p class="card-text text-muted"><?= esc($course['content']) ?></p>
              <span class="badge bg-primary mb-2"><?= esc($course['subtitle']) ?></span><br>
              <a href="<?= esc($course['btn_link']) ?>" class="btn btn-outline-primary rounded-pill mt-2"><?= esc($course['btn_text']) ?></a>
            </div>
          </div>
        </div>
        <?php $delay += 50; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>






<!-- Facilities Section -->
<section class="py-5 bg-dark text-light">
  <div class="container">
    <h2 class="text-center mb-5" data-aos="fade-up"><?= esc($facilities[0]['heading'] ?? 'Our Facilities') ?></h2>
    <div class="row g-4">
      <?php foreach ($facilities as $index => $facility): ?>
        <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="<?= $index * 100 ?>">
          <div class="card h-100 border-0 shadow rounded-4 overflow-hidden">
            <img src="<?= base_url($facility['image'] ?? 'public/frontend/img/default-facility.jpg') ?>" class="card-img-top" alt="<?= esc($facility['title']) ?>">
            <div class="card-body text-center">
              <h5 class="card-title"><?= esc($facility['title']) ?></h5>
              <p class="card-text"><?= esc($facility['subtitle']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Optional: Add a call-to-action below -->
    <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
      <?php if (!empty($facilities[0]['button_link'])): ?>
        <a href="<?= esc($facilities[0]['button_link']) ?>" class="btn btn-primary px-4 py-2 rounded-pill" target="_blank">
          <?= esc($facilities[0]['button_name'] ?? 'Learn More') ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>


<!-- Gallery Section -->
<section class="py-5 bg-light">
  <div class="container">
    <h3 class="text-center mb-4" style="font-family: 'Poppins', sans-serif;" data-aos="fade-up">Campus Gallery</h3>
    <div class="mx-auto mb-5" style="width: 80px; height: 3px; background-color: #ea1f28; border-radius: 2px;"
      data-aos="fade-up" data-aos-delay="100"></div>

    <div class="row g-3">
      <?php foreach ($gallery as $index => $img): ?>
        <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="<?= $index * 100 ?>">
          <a href="<?= base_url($img['image'] ?? 'public/frontend/img/default-gallery.jpg') ?>" data-rel="lightcase:campusgallery" title="<?= esc($img['btn_text'] ?? $img['title']) ?>">
            <img src="<?= base_url($img['image'] ?? 'public/frontend/img/default-gallery.jpg') ?>" class="img-fluid rounded shadow-sm" alt="<?= esc($img['title']) ?>">
          </a>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-4">
      <a href="gallery.html" class="btn btn-danger px-4 py-2" data-aos="fade-up" data-aos-delay="800">View All Photos</a>
    </div>
  </div>
</section>

<?php
// // Set timezone
// date_default_timezone_set('Asia/Kolkata');

// // Get current time and calculate remaining time
// $endDate = strtotime($admission['end_date'] ?? date('Y-m-d'));
// $now = time();

// $diff = $endDate - $now;

// if ($diff <= 0) {
//   $days = $hours = $minutes = $seconds = 0;
//   $isClosed = true;
// } else {
//   $days = floor($diff / (60 * 60 * 24));
//   $hours = floor(($diff % (60 * 60 * 24)) / (60 * 60));
//   $minutes = floor(($diff % (60 * 60)) / 60);
//   $seconds = $diff % 60;
//   $isClosed = false;
// }
?>


<section class="py-5 position-relative text-white" style="background: linear-gradient(135deg, #003366, #005f99); overflow: hidden;">
  <div class="container">
    <div class="row align-items-center gy-5">

      <!-- Countdown and Heading -->
      <div class="col-lg-7">
        <h2 class="fw-bold mb-3"><?= esc($admission['heading'] ?? 'Admissions Open') ?></h2>
        <p class="lead mb-4"><?= esc($admission['description'] ?? 'Register now before the deadline.') ?></p>

        <!-- <php if ($isClosed): ?>
          <div class="alert alert-danger fw-bold">Registration Closed</div>
        <php else: ?>
          <div class="d-flex flex-wrap gap-3" id="clockdiv">
            <div class="text-center px-3 py-2 bg-white bg-opacity-10 rounded-3 shadow-sm">
              <h3 class="display-6 mb-0 text-white"><= $days ?></h3>
              <small class="text-uppercase text-white-50">Days</small>
            </div>
            <div class="text-center px-3 py-2 bg-white bg-opacity-10 rounded-3 shadow-sm">
              <h3 class="display-6 mb-0 text-white"><= $hours ?></h3>
              <small class="text-uppercase text-white-50">Hours</small>
            </div>
            <div class="text-center px-3 py-2 bg-white bg-opacity-10 rounded-3 shadow-sm">
              <h3 class="display-6 mb-0 text-white"><= $minutes ?></h3>
              <small class="text-uppercase text-white-50">Minutes</small>
            </div>
            <div class="text-center px-3 py-2 bg-white bg-opacity-10 rounded-3 shadow-sm">
              <h3 class="display-6 mb-0 text-white"><= $seconds ?></h3>
              <small class="text-uppercase text-white-50">Seconds</small>
            </div>
          </div>
        <php endif; ?> -->
      </div>

      <!-- Registration Form -->
      <div class="col-lg-5">
        <div class="p-4 bg-white text-dark rounded-4 shadow-lg" style="backdrop-filter: blur(10px);">
          <h4 class="fw-semibold mb-2"><?= esc($admission['form_title'] ?? 'Apply Now') ?></h4>
          <p class="mb-4 text-muted"><?= esc($admission['form_subtitle'] ?? 'Fill in your details to get started.') ?></p>

          <form action="#" method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input name="name" id="name" type="text" required class="form-control" placeholder="">
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input name="phone" id="phone" type="tel" required class="form-control" placeholder="">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input name="email" id="email" type="email" required class="form-control" placeholder="">
            </div>
            <div class="text-center mt-4">
              <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">Submit Application</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>





<!-- Expert Staff Section -->
<section class="trainer_area py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-7 text-center">
        <h2><?= esc($faculty_section['main_title'] ?? 'Our Faculty') ?></h2>
        <p class="text-muted"><?= esc($faculty_section['sub_title'] ?? '') ?></p>
      </div>
    </div>
    <div class="row g-4">
      <?php foreach ($faculties as $f): ?>
        <div class="col-lg-3 col-md-6">
          <div class="card h-100 border-0 shadow-sm rounded-4 text-center">
            <img src="<?= base_url('Uploads/faculty/' . ($f['image'] ?? 'default-faculty.jpg')) ?>" class="card-img-top rounded-top-4" alt="<?= esc($f['name']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= esc($f['name']) ?></h5>
              <p class="text-muted mb-1"><?= esc($f['designation']) ?>, <?= esc($f['department']) ?></p>
              <p class="card-text small"><?= esc($f['description']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>




<!-- Placements Section -->
<section class="py-5 bg-white">
  <div class="container text-center">
    <h3 class="font-weight-bold mb-3" style="font-family: 'Poppins'" data-aos="fade-up">
      <?= esc($recruiter_section['section_title'] ?? 'Our Recruiters') ?>
    </h3>
    <div class="mb-4" style="width: 150px; height: 2px; background-color: #ea1f28; margin: 0 auto;"></div>
    <div class="row justify-content-center g-4">
      <?php foreach ($recruiters as $r): ?>
        <div class="col-6 col-sm-4 col-md-2 mb-4" data-aos="zoom-in">
          <img src="<?= base_url('Uploads/recruiters/' . ($r['image'] ?? 'default-recruiter.jpg')) ?>" class="img-fluid shadow-sm p-2 bg-white" alt="<?= esc($r['alt_text']) ?>">
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?= $this->endsection() ?>

<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>