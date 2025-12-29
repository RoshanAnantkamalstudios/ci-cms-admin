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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
// $routes->get('/', 'admin\Login::login', ['filter' => 'noauth']);

// 
// $routes->get('/forget_password', 'admin\Login::forget');
// $routes->post('send-password-reset-link', 'admin\Login::sendpasswordresetlink', ['as' => 'send-password-reset-link']);
// $routes->match(['get', 'post'], 'otpverify', 'admin\Login::otpverify');
// $routes->match(['get', 'post'], 'resetpassword/(:segment)', 'admin\Login::resetpassword/$1', ['as' => 'resetpassword']);
// $routes->match(['get', 'post'], 'updateresetpassword', 'admin\Login::updateresetpassword', ['as' => 'updateresetpassword']);
// $routes->post('/login_action', 'admin\Login::login_action');
// $routes->match(['get', 'post'], 'logout', 'admin\Login::logout');
// $routes->match(['get', 'post'], 'verify', 'admin\Login::verify', ['as' => 'verify']);


// $routes->group('', ['filter' => 'auth'], function ($routes) {
//     $routes->get('/admin', 'admin\Admin::index', ['filter' => 'auth']);
// });


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

// $routes->get('/gallery', 'admin\Dashboard::gallery');
$routes->get('galleries', 'admin\Galleries::Index');
$routes->post('storeGallery', 'admin\Galleries::storeGallery');
$routes->post('updateGallery/(:num)', 'admin\Galleries::updateGallery/$1');
$routes->get('deleteGallery/(:num)', 'admin\Galleries::deleteGallery/$1');
$routes->post('updateGalleryHero', 'admin\Galleries::updateGalleryHero');

// $routes->get('/admision_enquiri', 'admin\Dashboard::admision_enquiri');
$routes->get('admision_enquiri', 'admin\Dashboard::admision_enquiri');
$routes->post('save_HeroSection', 'admin\Dashboard::save_HeroSection');

$routes->get('/contact_us', 'admin\Contactus::Index');
$routes->post('saveHero', 'admin\Contactus::saveHero');
$routes->post('save-communication', 'admin\Contactus::saveCommunication');

$routes->get('/carousel', 'admin\Home::index');
$routes->get('/aboutsection', 'admin\Home::aboutsection');
$routes->get('/coursessection', 'admin\Home::coursessection');
$routes->get('/facilitiessection', 'admin\Home::facilitiessection');
$routes->get('/gallerySection', 'admin\Home::gallerySection');
$routes->get('/registration', 'admin\Home::registration');
$routes->get('/expertStaff', 'admin\Home::expertStaff');
$routes->get('/placementsSection', 'admin\Home::placementsSection');


$routes->get('/boardmember', 'admin\AboutUs::boardmember');
$routes->post('saveHeroBoardMember', 'admin\AboutUs::saveHeroBoardMember');
$routes->post('saveBoardMember', 'admin\AboutUs::saveBoardMember');
$routes->get('deleteBoardMember/(:num)', 'admin\AboutUs::deleteBoardMember/$1');

$routes->post('save_board_page', 'admin\AboutUs::save_board_page');
$routes->post('save_principal_desk', 'admin\AboutUs::save_principal_desk');
$routes->post('save_herogoverning_body', 'admin\AboutUs::save_herogoverning_body');
$routes->post('save_membergoverning_body', 'admin\AboutUs::save_membergoverning_body');
$routes->get('delete_member/(:num)', 'admin\AboutUs::delete_member/$1');
$routes->post('update_membergoverning_body/(:num)', 'admin\AboutUs::update_member/$1');
$routes->post('save_vision_mssion', 'admin\AboutUs::save_vision_mssion');

$routes->get('/president_desk', 'admin\AboutUs::president_desk');
$routes->get('/principal_desk', 'admin\AboutUs::principal_desk');
$routes->get('/governing_body', 'admin\AboutUs::governing_body');
$routes->get('/vision_mission', 'admin\AboutUs::vision_mission');


$routes->get('/library_admin', 'admin\Facilities::Library');
$routes->get('/hostel_admin', 'admin\Facilities::Hostel');
$routes->get('/sports_admin', 'admin\Facilities::Sports');
$routes->get('/cafeteria_admin', 'admin\Facilities::Cafeteria');
$routes->get('/transport_admin', 'admin\Facilities::Transport');
$routes->get('/cultural_fiesta_admin', 'admin\Facilities::Cultural_fiesta');

$routes->post('saveCafeteria', 'admin\Facilities::saveCafeteria');
$routes->get('deleteCafeteria/(:num)', 'admin\Facilities::deleteCafeteria/$1');

$routes->post('saveCulturalFiesta', 'admin\Facilities::saveCulturalFiesta');
$routes->get('deleteCulturalFiesta/(:num)', 'admin\Facilities::deleteCulturalFiesta/$1');

$routes->post('saveHostelFacility', 'Admin\Facilities::saveHostelFacility');
$routes->get('deleteHostelImage/(:num)', 'Admin\Facilities::deleteHostelImage/$1');

$routes->post('saveLibrary', 'Admin\Facilities::saveLibrary');
$routes->get('deleteLibrary/(:num)', 'Admin\Facilities::deleteImageLibrary/$1');


$routes->post('saveSports', 'Admin\Facilities::saveSports');
$routes->get('deleteImageSports/(:num)', 'Admin\Facilities::deleteImageSports/$1');

$routes->post('saveTransport', 'Admin\Facilities::saveTransport');
$routes->get('deleteImageTransport/(:num)', 'Admin\Facilities::deleteImageTransport/$1');



$routes->get('/student_grievance', 'admin\Committee::StudentGrievance');
$routes->get('/antiragging', 'admin\Committee::Antiragging');
$routes->get('/women_committee', 'admin\Committee::Women_committee');


$routes->post('saveAntiRagging', 'admin\Committee::saveAntiRagging');
$routes->get('deleteAntiRagging/(:num)', 'admin\Committee::deleteAntiRagging/$1');

// $routes->post('saveGrievance', 'admin\Committee::saveGrievance');
$routes->post('saveHeroGrievance', 'admin\Committee::saveHeroGrievance');
$routes->post('saveMemberGrievance', 'admin\Committee::saveMemberGrievance');
$routes->get('deleteGrievance/(:num)', 'admin\Committee::deleteGrievance/$1');


$routes->post('saveHeroWomens', 'admin\Committee::saveHeroWomens');
$routes->post('saveMemberWomens', 'admin\Committee::saveMemberWomens');
$routes->get('deleteWomens/(:num)', 'admin\Committee::deleteWomens/$1');




$routes->post('saveHeroExamination', 'admin\Examination::saveHeroExamination');
$routes->post('saveExamination', 'admin\Examination::saveExamination');
$routes->get('deleteExamination/(:num)', 'admin\Examination::deleteExamination/$1');


$routes->post('saveAcademicHero', 'admin\Examination::saveAcademicHero');
$routes->post('saveAcademicEvent', 'admin\Examination::saveAcademicEvent');
$routes->get('deleteAcademicEvent/(:num)', 'admin\Examination::deleteAcademicEvent/$1');

$routes->post('saveSyllabus', 'Admin\Examination::saveSyllabus');
$routes->get('deleteSyllabus/(:num)', 'Admin\Examination::deleteSyllabus/$1');

$routes->post('saveHeroSyllabus', 'Admin\Examination::saveHeroSyllabus');
$routes->post('saveEntrySyllabus', 'Admin\Examination::saveEntrySyllabus');
$routes->get('deleteSyllabus/(:num)', 'Admin\Examination::deleteEntrySyllabus/$1');
$routes->get('editSyllabus/(:num)', 'Admin\Examination::getEntrySyllabus/$1');

$routes->get('admin/examination-schedule', 'admin\Examination::admin');
$routes->post('saveHeroSchedule', 'admin\Examination::saveHeroExam_schedule');
$routes->post('saveSchedule', 'admin\Examination::saveScheduleExam_schedule');
$routes->get('deleteSchedule/(:num)', 'admin\Examination::deleteScheduleExam_schedule/$1');


$routes->post('saveHeroExamDownload', 'admin\Examination::saveHeroExamDownload');
$routes->post('saveEntryExamination', 'admin\Examination::saveEntryExamination');
$routes->get('deleteExamDownload/(:num)', 'admin\Examination::deleteExamDownload/$1');


// Admin Campus Placements CMS
$routes->post('saveCampus', 'Admin\Examination::saveCampus');
$routes->get('deleteCampus/(:num)', 'Admin\Examination::deleteCampus/$1');




// about us gavit 27 jun
$routes->get('/examination', 'admin\Examination::examination');
$routes->get('/academiccalendar', 'admin\Examination::academiccalendar');
$routes->get('/examinationschedule', 'admin\Examination::examinationschedule');
$routes->get('/syllabusdownload', 'admin\Examination::syllabusdownload');
$routes->get('/examdownloads', 'admin\Examination::examdownloads');
$routes->get('/campusrecruitment', 'admin\Examination::campusrecruitment');

$routes->get('/about_tpo', 'admin\Training::about_tpo');
$routes->get('/tpo_team', 'admin\Training::tpo_team');
$routes->get('/campus_placements', 'admin\Training::campus_placements');
$routes->get('/mous_', 'admin\Training::mous_');

$routes->post('saveMous', 'admin\Training::saveMous');
$routes->get('deleteMous/(:num)', 'admin\Training::deleteMous/$1');

$routes->post('saveTpoTeam', 'admin\Training::saveTpoTeam');
$routes->get('deleteTpoTeam/(:num)', 'admin\Training::deleteTpoTeam/$1');

$routes->post('savePlacedStudent', 'admin\Training::saveCampusPlacement');
$routes->get('deletePlacedStudent/(:num)', 'admin\Training::deleteCampusPlacement/$1');

$routes->post('saveAboutTpo', 'admin\Training::saveAboutTpo');
$routes->get('deleteAboutTpo/(:num)', 'admin\Training::deleteAboutTpo/$1');


$routes->get('hero-section', 'admin\Home::index');
$routes->post('courosel_section', 'admin\Home::courosel_section');
$routes->get('get-hero/(:num)', 'admin\Home::get_hero_data/$1');
$routes->get('delete-hero/(:num)', 'admin\Home::deleteHeroSection/$1');

// About Section
$routes->get('about-bvcte', 'admin\Home::about_us');
$routes->post('saveAbout_us', 'admin\Home::saveAbout_us'); // form action


// Our Courses
$routes->get('our_courses', 'admin\Home::our_courses');
$routes->post('saveour_courses', 'admin\Home::saveour_courses');
$routes->get('deleteour_courses/(:num)', 'admin\Home::deleteour_courses/$1');


// World class Facility
$routes->get('wc_facility', 'admin\Home::wc_facility');
$routes->post('saveFacility', 'admin\Home::saveFacility');
$routes->get('deleteFacility/(:num)', 'admin\Home::deleteFacility/$1');

// Campus Gallery
$routes->get('campus_gallery', 'admin\Home::campus_gallery');
$routes->post('saveGallery', 'admin\Home::saveGallery');
$routes->get('deleteGallery___/(:num)', 'admin\Home::deleteGallery___/$1');

// Admission Form
$routes->get('admission_open', 'admin\Home::admission_open');
$routes->post('saveregistration', 'admin\Home::saveregistration');

// Faculty
$routes->get('expert_faculty', 'admin\Home::expert_faculty');
$routes->post('saveFaculty', 'admin\Home::saveFaculty');
$routes->post('updateTitleFaculty', 'admin\Home::updateTitleFaculty');
$routes->get('deleteFaculty/(:num)', 'admin\Home::deleteFaculty/$1');
$routes->get('getFaculty/(:num)', 'admin\Home::getFaculty/$1');

// Top Recruiters
$routes->get('recruiters', 'admin\Home::top_recruiters');
$routes->post('saveRecruiter', 'admin\Home::saveRecruiter');
$routes->post('updateTitleRecruiter', 'admin\Home::updateTitleRecruiter');
$routes->get('deleteRecruiter/(:num)', 'admin\Home::deleteRecruiter/$1');
$routes->get('getRecruiter/(:num)', 'admin\Home::getRecruiter/$1');






// Frontend
$routes->get('/', 'frontend\Index::index');

//about us
$routes->get('/board-member', 'frontend\About_us::index');
$routes->get('/president', 'frontend\About_us::president');
$routes->get('/principal', 'frontend\About_us::principal');
$routes->get('/governing', 'frontend\About_us::governing');
$routes->get('/vision-mission', 'frontend\About_us::vision_mission');

//Facilities
$routes->get('/library', 'frontend\Facilities::index');
$routes->get('/hostel', 'frontend\Facilities::hostel');
$routes->get('/sports', 'frontend\Facilities::sports');
$routes->get('/cafeteria', 'frontend\Facilities::cafeteria');
$routes->get('/transport', 'frontend\Facilities::transport');
$routes->get('/cultural-fiesta', 'frontend\Facilities::cultural_fiesta');

//Grievances
$routes->get('/student_grievances', 'frontend\Grievances::Index');
$routes->get('/anti_ragging_committe', 'frontend\Grievances::anti_ragging_committe');
$routes->get('/womens_committee', 'frontend\Grievances::womens_committee');

//student_guide
$routes->get('/examination_notice', 'frontend\Student_guide::Index');
$routes->get('/academic_calendar', 'frontend\Student_guide::academic_calendar');
$routes->get('/examination_schedule', 'frontend\Student_guide::examination_schedule');
$routes->get('/syllabus_downloads', 'frontend\Student_guide::syllabus_downloads');
$routes->get('/exam_downloads', 'frontend\Student_guide::exam_downloads');
$routes->get('/campus_recruitment', 'frontend\Student_guide::campus_recruitment');

//Training_placements
$routes->get('/abouttpo', 'frontend\Training_placements::Index');
$routes->get('/tpo', 'frontend\Training_placements::tpo');
$routes->get('/campus_placement', 'frontend\Training_placements::campus_placement');
$routes->get('/mous', 'frontend\Training_placements::mous');

//gallery
$routes->get('/gallery', 'frontend\Gallery::Index');

$routes->get('/alumni', 'frontend\Alumini::Index');



//Admission
$routes->get('/admission', 'frontend\Admission::Index');

//contact
$routes->get('/contact', 'frontend\Contact::Index');

$routes->get('/anti_hara_committee', 'admin\Committee::anti_hara_committee');
$routes->post('saveHeroAntihara', 'admin\Committee::saveHeroAntihara');
$routes->post('saveMemberAntihara', 'admin\Committee::saveMemberAntihara');
$routes->get('deleteAntihara/(:num)', 'admin\Committee::deleteAntihara/$1');

$routes->get('/anti_sexual_committee_admin', 'admin\Committee::anti_sexual_committee');

$routes->post('saveHeroAntisex', 'admin\Committee::saveHeroAntisex');
$routes->post('saveMemberAntisex', 'admin\Committee::saveMemberAntisex');
$routes->get('deleteAntisex/(:num)', 'admin\Committee::deleteAntisex/$1');

$routes->get('/sc_st_committee_admin', 'admin\Committee::sc_st_committee');

$routes->post('saveHerosc_st', 'admin\Committee::saveHerosc_st');
$routes->post('saveMembersc_st', 'admin\Committee::saveMembersc_st');
$routes->get('deletesc_st/(:num)', 'admin\Committee::deletesc_st/$1');


//entrepre_committee

$routes->get('/entrepre_committee_admin', 'admin\Committee::entrepre_committee');

$routes->post('saveHero_entrepre', 'admin\Committee::saveHero_entrepre');
$routes->post('saveMember_entrepre', 'admin\Committee::saveMember_entrepre');
$routes->get('delete_entrepre/(:num)', 'admin\Committee::delete_entrepre/$1');


//social life committee

$routes->get('/social_life_admin', 'admin\Committee::social_life');

$routes->post('saveHero_social_life', 'admin\Committee::saveHero_social_life');
$routes->post('saveMember_social_life', 'admin\Committee::saveMember_social_life');
$routes->get('delete_social_life/(:num)', 'admin\Committee::delete_social_life/$1');


//vishaka committee

$routes->get('/vishaka_committee_admin', 'admin\Committee::vishaka_committee');

$routes->post('saveHero_vishaka_committee', 'admin\Committee::saveHero_vishaka_committee');
$routes->post('saveMember_vishaka_committee', 'admin\Committee::saveMember_vishaka_committee');
$routes->get('delete_vishaka_committee/(:num)', 'admin\Committee::delete_vishaka_committee/$1');

//emergency_committee
$routes->get('/emergency_committee_admin', 'admin\Committee::emergency_committee');

$routes->post('saveHero_emergency_committee', 'admin\Committee::saveHero_emergency_committee');
$routes->post('saveMember_emergency_committee', 'admin\Committee::saveMember_emergency_committee');
$routes->get('delete_emergency_committee/(:num)', 'admin\Committee::delete_emergency_committee/$1');

$routes->get('/anti_harassment_committee', 'frontend\Grievances::anti_harassment_committee');
$routes->get('/anti_sexual_committee', 'frontend\Grievances::anti_sexual_committee');
$routes->get('/sc_st_committee', 'frontend\Grievances::sc_st_committee');
$routes->get('/entrepre_committee', 'frontend\Grievances::entrepre_committee');
$routes->get('/social_life_committee', 'frontend\Grievances::social_life_committee');
$routes->get('/vishaka_committee', 'frontend\Grievances::vishaka_committee');
$routes->get('/emergency_committee', 'frontend\Grievances::emergency_committee');


