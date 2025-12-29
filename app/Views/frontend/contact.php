<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>
<style>
  .hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
      url('<?= base_url('uploads/' . ($hero['banner_image'])) ?>') no-repeat center center/cover;
    height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
  }
</style>
<!-- Hero Section -->
<section class="hero-section py-5 text-center text-white bg-dark">
  <div class="container">
    <h1 class="display-4 fw-bold" data-aos="zoom-in" data-aos-duration="1000">
      <?= esc($hero['title'] ?? 'Contact Us') ?>
    </h1>
    <p class="lead mt-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
      <?= esc($hero['subtitle'] ?? '') ?>
    </p>
    <a href="#about-tpo-section" class="btn btn-light btn-lg mt-4 shadow-sm px-5 py-2" data-aos="fade-up" data-aos-delay="400">
      Contact Us
    </a>
  </div>
</section>

<!-- Contact Info Section -->
<section class="container-fluid py-5 bg-light" id="about-tpo-section">
  <!-- Embedded Google Map -->
  <div class="container mb-5" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
    <div class="d-flex justify-content-center">
      <div class="mapBox rounded shadow" style="width: 100%; max-width: 900px; height: 400px; overflow: hidden;">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3750.391736119273!2d73.57335127595073!3d19.950021323952065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bddf3443b96f067%3A0x34188a49959a588d!2sBrahma%20Valley%20College%20of%20Engineering%20and%20Research%20Institute!5e0!3m2!1sen!2sin!4v1748151488575!5m2!1sen!2sin"
          width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>

  <!-- Contact Info + Form -->
  <div class="container">
    <div class="row g-5">
      <!-- Communication Info -->
      <div class="col-lg-4">
        <div class="bg-white rounded shadow p-4 h-100">
          <h4 class="mb-4 text-danger">Contact Details</h4>

          <?php foreach ($communication as $section): ?>
            <div class="mb-4">
              <h6 class="fw-bold"><?= esc($section['title']) ?></h6>
              <p class="mb-0 small text-muted" style="white-space: pre-line;">
                <?= $section['description'] ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="col-lg-8">
        <div class="bg-white rounded shadow p-4">
          <h4 class="mb-4 text-danger">Send Us a Message</h4>
          <form class="row g-3" action="" method="post" id="contactForm" novalidate>
            <div class="col-md-6">
              <input type="text" class="form-control" name="name" placeholder="Your Name" required>
            </div>
            <div class="col-md-6">
              <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            </div>
            <div class="col-md-12">
              <input type="text" class="form-control" name="subject" placeholder="Subject" required>
            </div>
            <div class="col-md-12">
              <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
            </div>
            <div class="col-md-12 text-end">
              <button type="submit" class="btn btn-primary px-4">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endsection() ?>
<?= $this->section('custom_script') ?>

<?= $this->endsection() ?>