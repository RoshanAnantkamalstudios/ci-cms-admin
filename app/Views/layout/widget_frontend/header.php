 <div class="container-fluid py-1" style="background-color: #ea1f28;">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center text-white gap-2 px-3">
      <ul class="list-inline mb-0 d-flex flex-wrap gap-2 text-white">
        <li class="list-inline-item"><a class="text-white text-decoration-none small" href="#">Download
            E-Brochures</a>
        </li>
        <li class="list-inline-item"><a class="text-white text-decoration-none small" href="#">Admission</a>
        </li>
        <li class="list-inline-item"><a class="text-white text-decoration-none small" href="#" target="_blank">Blogs</a>
        </li>
        <li class="list-inline-item"><a class="text-white text-decoration-none small" href="#"
            target="_blank">Consultancy Cell</a></li>
      </ul>
      <ul class="list-inline mb-0 d-flex align-items-center gap-2">
        <li><a class="text-white text-decoration-none small" href="#">Get Connected</a></li>
        <li class="ms-2"><a class="text-white" href="#" target="_blank" aria-label="WhatsApp"><img
              src="<?= base_url() ?>public/front_end/img/whatsapp_icon.png" alt="WhatsApp" width="20" height="20"></a></li>
        <li class="ms-2"><a class="text-white" href="#" target="_blank" aria-label="360"><img
              src="<?= base_url() ?>public/front_end/img/g360_icon_brahmavalley_social.png" alt="360" width="20" height="20"></a></li>
        <li class="ms-2"><a class="text-white" href="#" target="_blank"><img src="<?= base_url() ?>public/front_end/img/fb_icon.png" alt="Facebook"
              width="20" height="20"></a></li>
        <li class="ms-2"><a class="text-white" href="https://in.linkedin.com/" target="_blank"><img
              src="<?= base_url() ?>public/front_end/img/linkedin_icon.png" alt="LinkedIn" width="20" height="20"></a></li>
        <li class="ms-2"><a class="text-white" href="https://www.youtube.com/" target="_blank"><img
              src="<?= base_url() ?>public/front_end/img/youtube_icon.png" alt="YouTube" width="20" height="20"></a></li>
      </ul>
    </div>
  </div>

  <!-- Header Menu -->
  <header class="header_area">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/') ?>"><img src="<?= base_url() ?>public/front_end/img/logo.png" alt="Logo" height="100"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="<?= base_url('/') ?>">Home</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">About Us</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('board-member') ?>">Board Members</a></li>
                <li><a class="dropdown-item" href="<?= base_url('president') ?>">President Desk</a></li>
                <li><a class="dropdown-item" href="<?= base_url('principal') ?>">Principal Desk</a></li>
                <li><a class="dropdown-item" href="<?= base_url('governing') ?>">Governing Body</a></li>
                <li><a class="dropdown-item" href="<?= base_url('vision-mission') ?>">Our Mission/Vision</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">Trade</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Turner </a></li>
                <li><a class="dropdown-item" href="#">Fitter</a></li>
                <li><a class="dropdown-item" href="#">Wireman </a></li>
                <li><a class="dropdown-item" href="#">Electrican </a>
                </li>
                <li><a class="dropdown-item" href="#">Draughtsman Civil</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">Facilities</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('library') ?>">Library</a></li>
                <li><a class="dropdown-item" href="<?= base_url('hostel') ?>">Hostel</a></li>
                <li><a class="dropdown-item" href="<?= base_url('sports') ?>">Sports</a></li>
                <li><a class="dropdown-item" href="<?= base_url('cafeteria') ?>">Cafeteria</a></li>
                <li><a class="dropdown-item" href="<?= base_url('transport') ?>">Transport</a></li>
                <li><a class="dropdown-item" href="<?= base_url('cultural-fiesta') ?>">Cultural Fiesta</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">Grievances</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('student_grievances') ?>">Student Grievances</a></li>
                <li><a class="dropdown-item" href="<?= base_url('anti_ragging_committe') ?>">Anti-Ragging Committee</a></li>
                <li><a class="dropdown-item" href="<?= base_url('womens_committee') ?>">Womens Committee</a></li>
                <li><a class="dropdown-item" href="<?= base_url('anti_harassment_committee') ?>">Anti Harassment Committee</a></li>
                <li><a class="dropdown-item" href="<?= base_url('anti_sexual_committee') ?>">Anti - Sexual Committee</a></li>
                <li><a class="dropdown-item" href="<?= base_url('sc_st_committee') ?>">SC/ST Committee</a></li>
                <li><a class="dropdown-item" href="<?= base_url('entrepre_committee') ?>">Entrepreneurship Committee</a></li>
                <li><a class="dropdown-item" href="<?= base_url('social_life_committee') ?>">Social Life Committee</a></li>
                <li><a class="dropdown-item" href="<?= base_url('vishaka_committee') ?>">Vishakha Committee</a></li>
                <li><a class="dropdown-item" href="<?= base_url('emergency_committee') ?>">Emergency Committee</a></li>





              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">Student Guide</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('examination_notice') ?>">Examination Notice</a></li>
                <li><a class="dropdown-item" href="<?= base_url('academic_calendar') ?>">Academic Calendar </a></li>
                <li><a class="dropdown-item" href="<?= base_url('examination_schedule') ?>">Examination Schedule </a></li>
                <li><a class="dropdown-item" href="<?= base_url('syllabus_downloads') ?>">Syllabus Downloads</a></li>
                <li><a class="dropdown-item" href="<?= base_url('exam_downloads') ?>">Exam Downloads</a></li>
                <li><a class="dropdown-item" href="<?= base_url('campus_recruitment') ?>">Campus Recruitment</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">Training & Placements</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('abouttpo') ?>">About TPO</a></li>
                <li><a class="dropdown-item" href="<?= base_url('tpo') ?>">TPO Team</a></li>
                <li><a class="dropdown-item" href="#">Recruiters</a></li>
                <li><a class="dropdown-item" href="<?= base_url('campus_placement') ?>">Campus Placements</a></li>
                <li><a class="dropdown-item" href="<?= base_url('mous') ?>">MOU's</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('alumni') ?>">Alumni</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('gallery') ?>">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('admission') ?>">Admission Enquiry</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('contact') ?>">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>