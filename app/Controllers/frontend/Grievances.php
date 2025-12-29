<?php

namespace App\Controllers\Frontend;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\Grievances\AntiRaggingModel;
use App\Models\Grievances\GrievanceModel;
use App\Models\Grievances\WomensModel;
use App\Models\Grievances\Anti_harr_model;
use App\Models\Grievances\Anti_sexual_model;
use App\Models\Grievances\Sc_St_committee_model;
use App\Models\Grievances\Entrepre_committee_model;
use App\Models\Grievances\Social_life_model;
use App\Models\Grievances\Vishaka_committee_model;
use App\Models\Grievances\Emergency_committee_Model;



class Grievances extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function Index()
    {
        $model = new GrievanceModel();

        $data = [
            'hero' => $model->where('section_type', 'hero')->first(),
            'committee' => $model->where('section_type', 'committee')->orderBy('sort_order')->findAll(),
        ];
        return view('frontend/grievances/student_grievances', $data);
    }

    public function anti_ragging_committe()
    {
        $model = new AntiRaggingModel();

        $data = [
            'hero'      => $model->where('section_type', 'hero')->first(),
            'committee' => $model->where('section_type', 'committee')->orderBy('sort_order')->findAll(),
            'squad'     => $model->where('section_type', 'squad')->orderBy('sort_order')->findAll(),
        ];
        return view('frontend/grievances/anti_ragging_committe', $data);
    }

    public function womens_committee()
    {
        $model = new WomensModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('frontend/grievances/womens_committee', $data);
    }

    public function anti_harassment_committee()
    {
        $model = new Anti_harr_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('frontend/grievances/anti_harassment_committee', $data);
    }

        public function anti_sexual_committee()
    {
        $model = new Anti_sexual_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('frontend/grievances/anti_sexual_committee', $data);
    }

    public function sc_st_committee()
    {
        $model = new Sc_St_committee_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('frontend/grievances/sc_st_committee', $data);
    }

        public function entrepre_committee()
    {
        $model = new Entrepre_committee_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('frontend/grievances/entrepre_committee', $data);
    }

    public function social_life_committee()
    {
        $model = new Social_life_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('frontend/grievances/social_life_committee', $data);
    }

        public function vishaka_committee()
    {
        $model = new Vishaka_committee_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('frontend/grievances/vishakha_committee', $data);
    }

     public function emergency_committee()
    {
        $model = new Emergency_committee_Model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('frontend/grievances/emergency_committee', $data);
    }

    

    
}

