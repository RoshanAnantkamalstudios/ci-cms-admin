<?php

namespace Config;

use App\Controllers\admin\Login;
use App\Controllers\admin\Admin;
use App\Controllers\admin\Addbrand;
use App\Controllers\admin\Addcarproduct;
use App\Controllers\frontend\Frontend;
use App\Controllers\frontend\Dashboard;

$routes = Services::routes();
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// Auth Routes (Public)
$routes->get('login', 'admin\Auth::login');
$routes->get('signup', 'admin\Auth::signup');
$routes->post('register', 'admin\Auth::register');
$routes->match(['get', 'post'], 'login_action', 'admin\Auth::login_action');
$routes->match(['get', 'post'], 'logout', 'admin\Auth::logout');

// API Routes (Public)
$routes->group('api', function ($routes) {
    $routes->get('getherodata', 'Admin\HomeController::getherodata');
    $routes->get('getwhychooseusCards', 'Admin\HomeController::getwhychooseusCards');
    $routes->get('getbanner', 'Admin\Bannersection::banner_data');
    $routes->get('getcertificates', 'Admin\Certificates::getcertificatedata');

    $routes->get('productsdata', 'Admin\ProductsApi::productBySlug');                // all products
    $routes->get('productsdata/(:segment)', 'Admin\ProductsApi::productBySlug/$1');

    // Category APIs
    $routes->get('categories', 'Admin\CategoryController::getCategoriesTreeJson');
    $routes->get('categories/flat', 'Admin\CategoryController::getCategoriesFlatJson');
    $routes->get('categories/subcategories/(:num)', 'Admin\CategoryController::getSubcategoriesApi/$1');

    // Product APIs
    $routes->get('products', 'Admin\ProductController::getProductsJson');
    $routes->get('products/category/(:num)', 'Admin\ProductController::getProductsByCategoryJson/$1');
    $routes->get('products/(:num)', 'Admin\ProductController::getProductJson/$1');

    // Service APIs
    $routes->get('services', 'Admin\ServiceController::getServicesJson');
    $routes->get('services/type/(:segment)', 'Admin\ServiceController::getServicesByTypeJson/$1');
    $routes->get('services/(:num)', 'Admin\ServiceController::getServiceJson/$1');

    // Contact Us API
    $routes->get('contact_us', 'Admin\ContactUsController::getContactUsJson');

    // About Company / Home APIs
    $routes->get('about_our_company', 'admin\HomeController::aboutCompanyJson');
    $routes->get('product_strength', 'admin\HomeController::getProductStrenthJson');
    $routes->get('testimonials', 'admin\HomeController::getTestimonialJson');
    $routes->get('youtube', 'admin\HomeController::getYoutubeJson');
    $routes->get('about-us', 'admin\HomeController::getAboutUsJson');
});

// Admin Routes (Protected)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'admin\Dashboard::dashboard');

    // Home Section
    $routes->group('home', function ($routes) {
        $routes->get('hero', 'Admin\HomeController::Herosection');
        $routes->post('hero/save', 'Admin\HomeController::saveherosection');

        $routes->get('why-choose', 'Admin\HomeController::Whychoosesection');
        $routes->post('why-choose/save', 'Admin\HomeController::whychoosesave');
        $routes->get('why-choose/delete/(:num)', 'Admin\HomeController::whychoosedelete/$1');

        $routes->get('our-clients', 'Admin\HomeController::ourclients');
        $routes->post('our-clients/save', 'Admin\HomeController::ourclientssave');
        $routes->get('our-clients/delete/(:num)', 'Admin\HomeController::ourclientsdelete/$1');
    });

    // About Our Company
    $routes->get('about_our_company', 'admin\HomeController::aboutOurCompany');
    $routes->post('about_our_company/save', 'admin\HomeController::saveAboutCompany');
    $routes->post('about_our_company/delete-main-icon', 'admin\HomeController::deleteMainIcon');
    $routes->post('about_our_company/delete-section-icon', 'admin\HomeController::deleteSectionIcon');

    // Product Strength (keeping underscore to match view)
    $routes->get('product_strength', 'admin\HomeController::productStrength');
    $routes->post('product_strength/save', 'admin\HomeController::productStrengthSave');
    $routes->post('product_strength/delete-page-image', 'admin\HomeController::productStrengthDeletePageImage');
    $routes->post('product_strength/delete-card-image', 'admin\HomeController::productStrengthDeleteCardImage');

    // Testimonials
    $routes->get('testimonials', 'admin\HomeController::testimonials');
    $routes->post('testimonials/save', 'admin\HomeController::saveTestimonial');
    $routes->post('testimonials/delete-main-icon', 'admin\HomeController::testimonialDeleteMainIcon');
    $routes->post('testimonials/delete-card-image', 'admin\HomeController::testimonialDeleteCardImage');

    // Youtube
    $routes->get('youtube', 'admin\HomeController::youtube');
    $routes->post('youtube/save', 'admin\HomeController::saveYoutube');

    // About Us (Using about_us to match sidebar, but view might use about-us)
    $routes->get('about_us', 'admin\HomeController::aboutUs');
    $routes->post('about-us/save', 'admin\HomeController::saveAboutUs');

    // Banner Section
    $routes->get('bannersection', 'Admin\Bannersection::index');
    $routes->get('bannersection/fetch', 'Admin\Bannersection::fetch');
    $routes->post('bannersection/save', 'Admin\Bannersection::save');
    $routes->get('bannersection/edit/(:num)', 'Admin\Bannersection::edit/$1');
    $routes->get('bannersection/delete/(:num)', 'Admin\Bannersection::delete/$1');

    // Certificates
    $routes->get('certificates', 'Admin\Certificates::index');
    $routes->post('certificates/save', 'Admin\Certificates::saveCertificates');

    // Product Categories
    $routes->get('product-category', 'Admin\ProductCategory::index');
    $routes->post('product-category/save', 'Admin\ProductCategory::save');
    $routes->get('product-category/edit/(:num)', 'Admin\ProductCategory::edit/$1');
    $routes->post('product-category/update/(:num)', 'Admin\ProductCategory::update/$1');
    $routes->get('product-category/delete/(:num)', 'Admin\ProductCategory::delete/$1');

    // Products (New Module)
    $routes->get('products', 'Admin\ProductController::index');
    $routes->post('product/save', 'Admin\ProductController::save');
    $routes->get('product/delete/(:num)', 'Admin\ProductController::delete/$1');
    $routes->get('product/list/(:num)', 'Admin\ProductController::listByCategory/$1');

    // Legacy Products Routes (Keeping if needed, but might conflict if paths overlap. 
    // The previous file had both 'products' pointing to Admin\Products and Admin\ProductController. 
    // I will prioritize ProductController as it seems newer/grouped properly in previous file)
    // Wait, the previous file had:
    // $routes->get('products', 'Admin\Products::index'); 
    // AND
    // $routes->get('products', 'Admin\ProductController::index');
    // This is a conflict! The last one wins. So ProductController wins.

    // Services
    $routes->get('services', 'Admin\ServiceController::index');
    $routes->post('service/save', 'Admin\ServiceController::save');
    $routes->get('service/delete/(:num)', 'Admin\ServiceController::delete/$1');

    // Categories (New Module)
    $routes->get('categories', 'Admin\CategoryController::index');
    $routes->post('category/save', 'Admin\CategoryController::save');
    $routes->get('category/delete/(:num)', 'Admin\CategoryController::delete/$1');
    $routes->get('category/get-subcategories/(:num)', 'Admin\CategoryController::getSubcategories/$1');

    // Contact Us (New Module)
    $routes->get('contact_us', 'Admin\ContactUsController::index');
    $routes->post('contact_us/save', 'Admin\ContactUsController::save');
});

// Legacy / Unused Routes (Commented out to prevent confusion)
// $routes->get('/alumini', 'admin\Alumeni::Index');
// $routes->post('storeAlumeni', 'admin\Alumeni::store');
// $routes->post('updateAlumeni/(:num)', 'admin\Alumeni::update/$1');
// $routes->get('deleteAlumeni/(:num)', 'admin\Alumeni::delete/$1');
// $routes->get('/contact_us', 'admin\Contactus::Index'); // Old Contact Us
// $routes->post('saveHero', 'admin\Contactus::saveHero');
// $routes->post('save-communication', 'admin\Contactus::saveCommunication');
