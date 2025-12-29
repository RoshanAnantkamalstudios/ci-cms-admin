<?php

namespace App\Controllers\Frontend;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\AdmissionModel;

class Admission extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function Index()
    {
        $model = new AdmissionModel();
        $data['hero'] = $model->first();
        return view('frontend/admission',$data);
    }
}
