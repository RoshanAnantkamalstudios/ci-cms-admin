<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="<?= base_url('dashboard') ?>" class="logo">
                <img src="<?= base_url('public/front_end/img/logo.png') ?>" alt="navbar brand" class="navbar-brand" height="75" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
            <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- About Us -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#home">
                        <i class="fas fa-th-list"></i>
                        <p>Home</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="home">
                        <ul class="nav nav-collapse">
                            <li><a href="<?= base_url('carousel') ?>"><span class="sub-item">Carousel Section</span></a></li>
                            <li><a href="<?= base_url('aboutsection') ?>"><span class="sub-item">About BVCTE</span></a></li>
                            <li><a href="<?= base_url('coursessection') ?>"><span class="sub-item">Courses Section</span></a></li>
                            <li><a href="<?= base_url('facilitiessection') ?>"><span class="sub-item">Facilities Section</span></a></li>
                            <li><a href="<?= base_url('gallerySection') ?>"><span class="sub-item">Gallery Section</span></a></li>
                            <li><a href="<?= base_url('registration') ?>"><span class="sub-item">Registration Area</span></a></li>
                            <li><a href="<?= base_url('expertStaff') ?>"><span class="sub-item">Expert Staff</span></a></li>
                            <li><a href="<?= base_url('placementsSection') ?>"><span class="sub-item">Placements Section</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- About Us -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#aboutUs">
                        <i class="fas fa-th-list"></i>
                        <p>About Us</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="aboutUs">
                        <ul class="nav nav-collapse">
                            <li><a href="<?= base_url('boardmember') ?>"><span class="sub-item">Board Members</span></a></li>
                            <li><a href="<?= base_url('president_desk') ?>"><span class="sub-item">President Desk</span></a></li>
                            <li><a href="<?= base_url('principal_desk') ?>"><span class="sub-item">Principal Desk</span></a></li>
                            <li><a href="<?= base_url('governing_body') ?>"><span class="sub-item">Governing Body</span></a></li>
                            <li><a href="<?= base_url('vision_mission') ?>"><span class="sub-item">Our Mission/Vision</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- Trade -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#trade">
                        <i class="fas fa-pen-square"></i>
                        <p>Trade</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="trade">
                        <ul class="nav nav-collapse">
                            <li><a href="<?= base_url('admin/trade/turner') ?>"><span class="sub-item">Turner</span></a></li>
                            <li><a href="<?= base_url('admin/trade/fitter') ?>"><span class="sub-item">Fitter</span></a></li>
                            <li><a href="<?= base_url('admin/trade/wireman') ?>"><span class="sub-item">Wireman</span></a></li>
                            <li><a href="<?= base_url('admin/trade/electrician') ?>"><span class="sub-item">Electrician</span></a></li>
                            <li><a href="<?= base_url('admin/trade/draughtsman-civil') ?>"><span class="sub-item">Draughtsman Civil</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- Facilities -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#facilities">
                        <i class="fas fa-table"></i>
                        <p>Facilities</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="facilities">
                        <ul class="nav nav-collapse">
                            <li><a href="<?= base_url('library_admin') ?>"><span class="sub-item">Library</span></a></li>
                            <li><a href="<?= base_url('hostel_admin') ?>"><span class="sub-item">Hostel</span></a></li>
                            <li><a href="<?= base_url('sports_admin') ?>"><span class="sub-item">Sports</span></a></li>
                            <li><a href="<?= base_url('cafeteria_admin') ?>"><span class="sub-item">Cafeteria</span></a></li>
                            <li><a href="<?= base_url('transport_admin') ?>"><span class="sub-item">Transport</span></a></li>
                            <li><a href="<?= base_url('cultural_fiesta_admin') ?>"><span class="sub-item">Cultural Fiesta</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- Grievances -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#grievances">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Grievances</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="grievances">
                        <ul class="nav nav-collapse">
                            <li><a href="<?= base_url('student_grievance') ?>"><span class="sub-item">Student Grievances</span></a></li>
                            <li><a href="<?= base_url('antiragging') ?>"><span class="sub-item">Anti-Ragging Committee</span></a></li>
                            <li><a href="<?= base_url('women_committee') ?>"><span class="sub-item">Womens Committee</span></a></li>
                             <li><a href="<?= base_url('anti_hara_committee') ?>"><span class="sub-item">Anti Harassment Committee</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- Student Guide -->
                <!-- shankar -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#studentGuide">
                        <i class="far fa-chart-bar"></i>
                        <p>Student Guide</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="studentGuide">
                        <ul class="nav nav-collapse">
                            <!-- gavit 27 jun -->
                            <li><a href="<?= base_url('examination') ?>"><span class="sub-item">Examination Notice</span></a></li>
                            <li><a href="<?= base_url('academiccalendar') ?>"><span class="sub-item">Academic Calendar</span></a></li>
                            <li><a href="<?= base_url('examinationschedule') ?>"><span class="sub-item">Examination Schedule</span></a></li>
                            <li><a href="<?= base_url('syllabusdownload') ?>"><span class="sub-item">Syllabus Downloads</span></a></li>
                            <li><a href="<?= base_url('examdownloads') ?>"><span class="sub-item">Exam Downloads</span></a></li>
                            <li><a href="<?= base_url('campusrecruitment') ?>"><span class="sub-item">Campus Recruitment</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- TPO -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#training">
                        <i class="fas fa-briefcase"></i>
                        <p>Training & Placements</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="training">
                        <ul class="nav nav-collapse">
                            <li><a href="<?= base_url('about_tpo') ?>"><span class="sub-item">About TPO</span></a></li>
                            <li><a href="<?= base_url('tpo_team') ?>"><span class="sub-item">TPO Team</span></a></li>
                            <li><a href="<?= base_url('campusrecruitment') ?>"><span class="sub-item">Recruiters</span></a></li>
                            <li><a href="<?= base_url('campus_placements') ?>"><span class="sub-item">Campus Placements</span></a></li>
                            <li><a href="<?= base_url('mous_') ?>"><span class="sub-item">MOU's</span></a></li>
                        </ul>
                    </div>
                </li>
                <!-- shankar -->

                <li class="nav-item"><a href="<?= base_url('alumini') ?>"><i class="fas fa-user-graduate"></i>
                        <p>Alumni</p>
                    </a></li>
                <li class="nav-item"><a href="<?= base_url('galleries') ?>"><i class="far fa-image"></i>
                        <p>Gallery</p>
                    </a></li>
                <li class="nav-item"><a href="<?= base_url('admision_enquiri') ?>"><i class="fas fa-user-plus"></i>
                        <p>Admission Enquiry</p>
                    </a></li>
                <li class="nav-item"><a href="<?= base_url('contact_us') ?>"><i class="fas fa-envelope"></i>
                        <p>Contact Us</p>
                    </a></li>
            </ul>
        </div>
    </div>
</div>