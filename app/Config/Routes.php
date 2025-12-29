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

$routes->get('/about_us', 'admin\AboutUsController::aboutUs');
$routes->post('/admin/about-us/save', 'admin\AboutUsController::saveAboutUs');


$routes->get('/api/about_our_company', 'admin\HomeController::aboutCompanyJson');
$routes->get('/api/product_strength', 'admin\HomeController::getProductStrenthJson');
$routes->get('/api/testimonials', 'admin\HomeController::getTestimonialJson');
$routes->get('/api/youtube', 'admin\HomeController::getYoutubeJson');
$routes->get('/api/about-us', 'admin\AboutUsController::getAboutUsJson');

// $routes->post('login_action', 'admin\Auth::login_action');


$routes->get('/alumini', 'admin\Alumeni::Index');
// $routes->get('alumni-cms', 'admin\Alumeni::index');
$routes->post('storeAlumeni', 'admin\Alumeni::store');
$routes->post('updateAlumeni/(:num)', 'admin\Alumeni::update/$1');
$routes->get('deleteAlumeni/(:num)', 'admin\Alumeni::delete/$1');

$routes->get('/contact_us', 'admin\Contactus::Index');
$routes->post('saveHero', 'admin\Contactus::saveHero');
$routes->post('save-communication', 'admin\Contactus::saveCommunication');
