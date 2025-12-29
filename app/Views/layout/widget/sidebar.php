<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="<?= base_url('dashboard') ?>" class="logo">
                <img src="<?= base_url('public/front_end/img/logo.png') ?>" alt="navbar brand" class="navbar-brand"
                    height="75" />
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
                            <li><a href="<?= base_url('carousel') ?>"><span class="sub-item">Carousel Section</span></a>
                            </li>
                            <li><a href="<?= base_url('aboutsection') ?>"><span class="sub-item">About BVCTE</span></a>
                            </li>
                            <li><a href="<?= base_url('coursessection') ?>"><span class="sub-item">Courses
                                        Section</span></a></li>
                            <li><a href="<?= base_url('facilitiessection') ?>"><span class="sub-item">Facilities
                                        Section</span></a></li>
                            <li><a href="<?= base_url('gallerySection') ?>"><span class="sub-item">Gallery
                                        Section</span></a></li>
                            <li><a href="<?= base_url('registration') ?>"><span class="sub-item">Registration
                                        Area</span></a></li>
                            <li><a href="<?= base_url('expertStaff') ?>"><span class="sub-item">Expert Staff</span></a>
                            </li>
                            <li><a href="<?= base_url('placementsSection') ?>"><span class="sub-item">Placements
                                        Section</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a href="<?= base_url('contact_us') ?>"><i class="fas fa-envelope"></i>
                        <p>Contact Us</p>
                    </a></li>
            </ul>
        </div>
    </div>
</div>