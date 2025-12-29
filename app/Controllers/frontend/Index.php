<?php

namespace App\Controllers\Frontend;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\ContactModel;
use App\Models\FeesModel;
use App\Models\Home\AboutBvcteModel;
use App\Models\Home\AdmissionSectionModel;
use App\Models\Home\FacilityModel;
use App\Models\Home\FacultyModel;
use App\Models\Home\GalleryModel;
use App\Models\Home\HeroSectionModel;
use App\Models\Home\OurCoursesModel;
use App\Models\Home\RecruiterModel;

class Index extends BaseController
{
    protected $galleryModel;
    protected $feesModel;
    protected $contactModel;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
        $this->feesModel = new FeesModel();
        $this->contactModel = new ContactModel();
    }
    public function Index()
    {
        $data = [];

        // Hero section - carousel
        $heroModel = new HeroSectionModel();
        $data['carousel_slides'] = $heroModel->findAll();

        // About section
        $aboutModel = new AboutBvcteModel();
        $data['about'] = $aboutModel->first();

        // Courses
        $coursesModel = new OurCoursesModel();
        $data['courses'] = $coursesModel->findAll();
        // Facilities
        $facilityModel = new FacilityModel();
        $data['facilities'] = $facilityModel->findAll();

        // Gallery
        $galleryModel = new GalleryModel();
        $data['gallery'] = $galleryModel->orderBy('id', 'DESC')->findAll();

        // Admission section
        $admissionModel = new AdmissionSectionModel();
        $data['admission'] = $admissionModel->first();

        // Faculty section
        $facultyModel = new FacultyModel();
        $data['faculty_section'] = $facultyModel->where('id', 1)->first();
        $data['faculties'] = $facultyModel->where('id !=', 1)->orderBy('sort_order', 'ASC')->findAll();

        // Recruiter section
        $recruiterModel = new RecruiterModel();
        $data['recruiter_section'] = $recruiterModel->where('section_title !=', null)->first();
        $data['recruiters'] = $recruiterModel->where('section_title', null)->orderBy('sort_order', 'ASC')->findAll();

        return view('frontend/index', $data);
    }
}
