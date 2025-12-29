<?php

namespace App\Controllers\Admin;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\Home\HeroModel;
use App\Models\Home\HeroSectionModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new HeroSectionModel();
        $data['hero_sections'] = $model->findAll();
        // print_r($data);die; 
        return view('admin/home/carousel', $data);
    }


}
