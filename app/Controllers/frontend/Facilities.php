<?php

namespace App\Controllers\Frontend;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\Facility\CafeteriaModel;
use App\Models\Facility\CulturalFiestaModel;
use App\Models\Facility\HostelFacilityModel;
use App\Models\Facility\LibraryFacilityModel;
use App\Models\Facility\SportsFacilityModel;
use App\Models\Facility\TransportationModel;

class Facilities extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function Index()
    {
        $model = new LibraryFacilityModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['content'] = $model->where('section_type', 'content')->first();
        $data['images'] = $model->where('section_type', 'image')->findAll();

        return view('frontend/facilities/library', $data);
    }

    public function hostel()
    {
        $model = new HostelFacilityModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['content'] = $model->where('section_type', 'content')->first();
        $data['images_girls'] = $model->where(['section_type' => 'image', 'group_type' => 'girls'])->findAll();
        $data['images_boys'] = $model->where(['section_type' => 'image', 'group_type' => 'boys'])->findAll();
        return view('frontend/facilities/hostel', $data);
    }

    public function sports()
    {
        $model = new SportsFacilityModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['content'] = $model->where('section_type', 'content')->first();
        $data['images'] = $model->where('section_type', 'image')->findAll();
        return view('frontend/facilities/sports', $data);
    }

    public function cafeteria()
    {
        $model = new CafeteriaModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['about'] = $model->where('section_type', 'about')->first();
        $data['images'] = $model->where('section_type', 'image')->findAll();
        return view('frontend/facilities/cafeteria', $data);
    }

    public function transport()
    {
        $model = new TransportationModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['content'] = $model->where('section_type', 'content')->first();
        $data['images'] = $model->where('section_type', 'image')->findAll();
        return view('frontend/facilities/transport', $data);
    }

    public function cultural_fiesta()
    {
        $model = new CulturalFiestaModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['about'] = $model->where('section_type', 'about')->first();
        $data['images'] = $model->where('section_type', 'image')->findAll();
        return view('frontend/facilities/cultural_fiesta', $data);
    }
}
