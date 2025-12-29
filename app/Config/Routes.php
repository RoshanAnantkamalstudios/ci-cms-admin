<?php

namespace Config;

use App\Controllers\admin\Login;
use App\Controllers\admin\Admin;
use App\Controllers\admin\Addbrand;
use App\Controllers\admin\Addcarproduct;
use App\Controllers\frontend\Frontend;
use App\Controllers\frontend\Dashboard;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}
/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(); 
$routes->get('login', 'admin\Auth::login');
$routes->get('signup', 'admin\Auth::signup');
$routes->post('register', 'admin\Auth::register');
// $routes->post('login_action', 'admin\Auth::login_action');
$routes->match(['get', 'post'], 'login_action', 'admin\Auth::login_action');
$routes->match(['get', 'post'], 'logout', 'admin\Auth::logout');

$routes->get('/dashboard', 'admin\Dashboard::dashboard');

$routes->get('/alumini', 'admin\Alumeni::Index');
// $routes->get('alumni-cms', 'admin\Alumeni::index');
$routes->post('storeAlumeni', 'admin\Alumeni::store');
$routes->post('updateAlumeni/(:num)', 'admin\Alumeni::update/$1');
$routes->get('deleteAlumeni/(:num)', 'admin\Alumeni::delete/$1');

$routes->get('/contact_us', 'admin\Contactus::Index');
$routes->post('saveHero', 'admin\Contactus::saveHero');
$routes->post('save-communication', 'admin\Contactus::saveCommunication');

$routes->get('/about_our_company', 'admin\AboutUs::aboutOurCompany');
 