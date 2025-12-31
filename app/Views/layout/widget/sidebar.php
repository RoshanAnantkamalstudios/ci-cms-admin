<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header mt-3" data-background-color="dark">
            <a href="<?= base_url('dashboard') ?>" class="logo">
                <img src="<?= base_url('public/front_end/img/cmslogo.jpg') ?>" alt="navbar brand" class="navbar-brand"
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
                            <!-- <li><a href="<?= base_url('about_our_company') ?>"><span class="sub-item">About Our Company</span></a> -->
                            <li><a href="<?= base_url('admin/homehero') ?>"><span class="sub-item">Hero Section</span></a>
                            <li><a href="<?= base_url('admin/homewhychoose') ?>"><span class="sub-item">Why Choose Us Section</span></a>
                            <li><a href="<?= base_url('admin/ourclients') ?>"><span class="sub-item">Our Clients</span></a>


                            </li>
                            <li><a href="<?= base_url('product_strength') ?>"><span class="sub-item">Product Strength</span></a>
                            </li>
                            <li><a href="<?= base_url('testimonials') ?>"><span class="sub-item">Testimonials</span></a>
                            </li>
                            <li><a href="<?= base_url('youtube') ?>"><span class="sub-item">Youtube</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a href="<?= base_url('about_us') ?>"><i class="fa-regular fa-address-card"></i>
                        <p>About Us</p>
                    </a></li>
                <li class="nav-item"><a href="<?= base_url('admin/categories') ?>"><i class="fas fa-layer-group"></i>
                        <p>Categories</p>
                    </a></li>
                <li class="nav-item"><a href="<?= base_url('admin/products') ?>"><i class="fas fa-boxes"></i>
                        <p>Products</p>
                    </a></li>
                <li class="nav-item"><a href="<?= base_url('admin/services') ?>"><i class="fas fa-briefcase"></i>
                        <p>Services</p>
                    </a></li>
                <li class="nav-item"><a href="<?= base_url('admin/contact_us') ?>"><i class="fas fa-envelope"></i>
                <li class="nav-item"><a href="<?= base_url('admin/certificates') ?>"><i class="fa-regular fa-address-card"></i>
                        <p>Certificate Section</p>
                    </a></li>
                <li class="nav-item"><a href="<?= base_url('contact_us') ?>"><i class="fas fa-envelope"></i>
                        <p>Contact Us</p>
                    </a></li>
                <li class="nav-item"><a href="<?= base_url('admin/bannersection') ?>"><i class="fas fa-image"></i>
                        <p>All Banners Section</p>
                    </a></li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#product">
                        <i class="fas fa-th-list"></i>
                        <p>Products</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="nav nav-collapse">
                            <!-- <li><a href="<?= base_url('about_our_company') ?>"><span class="sub-item">About Our Company</span></a> -->
                            <li><a href="<?= base_url('admin/product-category') ?>"><span class="sub-item"> Product Category</span></a>
                            <li><a href="<?= base_url('admin/products') ?>"><span class="sub-item">Products </span></a>

                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>