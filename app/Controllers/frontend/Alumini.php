<?php
namespace App\Controllers\frontend;

use App\Models\AlumniPageModel;
use App\Controllers\BaseController;

class Alumini extends BaseController{

public function index()
    {
        $model = new AlumniPageModel();

        $data['hero'] = $model->where(['section_type' => 'hero', 'status' => 1])->first();
        $data['testimonials'] = $model->where(['section_type' => 'testimonial', 'status' => 1])->orderBy('order')->findAll();
        $data['gallery'] = $model->where(['section_type' => 'gallery', 'status' => 1])->orderBy('order')->findAll();

        return view('frontend/alumni', $data);
    }

}