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
$routes->get('login', 'admin\Auth::login');
$routes->get('signup', 'admin\Auth::signup');
$routes->post('register', 'admin\Auth::register');
$routes->match(['get', 'post'], 'login_action', 'admin\Auth::login_action');
$routes->match(['get', 'post'], 'logout', 'admin\Auth::logout');

$routes->get('/dashboard', 'admin\Dashboard::dashboard');

$routes->get('/about_our_company', 'admin\HomeController::aboutOurCompany');
$routes->post('/admin/about_our_company/save', 'admin\HomeController::saveAboutCompany');
$routes->post('/admin/about_our_company/delete-main-icon', 'admin\HomeController::deleteMainIcon');
$routes->post('/admin/about_our_company/delete-section-icon', 'admin\HomeController::deleteSectionIcon');

$routes->get('/product_strength', 'admin\HomeController::productStrength');
$routes->post('/admin/product_strength/save', 'admin\HomeController::productStrengthSave');
$routes->post('/admin/product_strength/delete-page-image', 'admin\HomeController::productStrengthDeletePageImage');
$routes->post('/admin/product_strength/delete-card-image', 'admin\HomeController::productStrengthDeleteCardImage');

$routes->get('/testimonials', 'admin\HomeController::testimonials');
$routes->post('/admin/testimonials/save', 'admin\HomeController::saveTestimonial');
$routes->post('/admin/testimonials/delete-main-icon', 'admin\HomeController::testimonialDeleteMainIcon');
$routes->post('/admin/testimonials/delete-card-image', 'admin\HomeController::testimonialDeleteCardImage');

$routes->get('/youtube', 'admin\HomeController::youtube');
$routes->post('/admin/youtube/save', 'admin\HomeController::saveYoutube');

$routes->get('/about_us', 'admin\HomeController::aboutUs');
$routes->post('/admin/about-us/save', 'admin\HomeController::saveAboutUs');


$routes->get('/api/about_our_company', 'admin\HomeController::aboutCompanyJson');
$routes->get('/api/product_strength', 'admin\HomeController::getProductStrenthJson');
$routes->get('/api/testimonials', 'admin\HomeController::getTestimonialJson');
$routes->get('/api/youtube', 'admin\HomeController::getYoutubeJson');
$routes->get('/api/about-us', 'admin\HomeController::getAboutUsJson');

// $routes->post('login_action', 'admin\Auth::login_action');


$routes->get('/alumini', 'admin\Alumeni::Index');
$routes->post('storeAlumeni', 'admin\Alumeni::store');
$routes->post('updateAlumeni/(:num)', 'admin\Alumeni::update/$1');
$routes->get('deleteAlumeni/(:num)', 'admin\Alumeni::delete/$1');

$routes->get('/contact_us', 'admin\Contactus::Index');
$routes->post('saveHero', 'admin\Contactus::saveHero');
$routes->post('save-communication', 'admin\Contactus::saveCommunication');

$routes->get('/about_our_company', 'admin\AboutUs::aboutOurCompany');

$routes->group('admin', function ($routes) {
    $routes->get('homehero', 'Admin\HomeController::Herosection');
    $routes->post('hero/save', 'Admin\HomeController::saveherosection');
    $routes->get('homewhychoose', 'Admin\HomeController::Whychoosesection');
    $routes->post('homewhychoose/save', 'Admin\HomeController::whychoosesave');
    $routes->get('homewhychoose/delete/(:num)', 'Admin\HomeController::whychoosedelete/$1');

    //ourclients 
    $routes->get('ourclients', 'Admin\HomeController::ourclients');
    $routes->post('ourclients/ourclientssave', 'Admin\HomeController::ourclientssave');
    $routes->get('ourclients/ourclientsdelete/(:num)', 'Admin\HomeController::ourclientsdelete/$1');

    //banner section 

    $routes->get('bannersection', 'Admin\Bannersection::index');
    $routes->get('bannersection/fetch', 'Admin\Bannersection::fetch');
    $routes->post('bannersection/save', 'Admin\Bannersection::save');
    $routes->get('bannersection/edit/(:num)', 'Admin\Bannersection::edit/$1');
    $routes->get('bannersection/delete/(:num)', 'Admin\Bannersection::delete/$1');

    // Category Section
    $routes->get('categories', 'Admin\CategoryController::index');
    $routes->post('category/save', 'Admin\CategoryController::save');
    $routes->get('category/delete/(:num)', 'Admin\CategoryController::delete/$1');
    $routes->get('category/get-subcategories/(:num)', 'Admin\CategoryController::getSubcategories/$1');

    // Products Section
    $routes->get('products', 'Admin\ProductController::index');
    $routes->post('product/save', 'Admin\ProductController::save');
    $routes->get('product/delete/(:num)', 'Admin\ProductController::delete/$1');
    $routes->get('product/list/(:num)', 'Admin\ProductController::listByCategory/$1');

    // Services Section
    $routes->get('services', 'Admin\ServiceController::index');
    $routes->post('service/save', 'Admin\ServiceController::save');
    $routes->get('service/delete/(:num)', 'Admin\ServiceController::delete/$1');

    // Contact Us Section
    $routes->get('contact_us', 'Admin\ContactUsController::index');
    $routes->post('contact_us/save', 'Admin\ContactUsController::save');
});

$routes->group('api', function ($routes) {
    $routes->get('getherodata', 'Admin\HomeController::getherodata');
    $routes->get('getwhychooseusCards', 'Admin\HomeController::getwhychooseusCards');
    $routes->get('getbanner', 'Admin\Bannersection::banner_data');
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
});
