<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\ContactModel;

class Contact extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    protected $contactModel;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
    }
    public function Index()
    {
        $data['hero'] = $this->contactModel->where('type', 'hero')->first();
        $data['communication'] = $this->contactModel->whereIn('type', ['central_office', 'campus_address', 'accessibility'])->findAll();
        // echo "<pre>";
        // print_r($data);die;
        return view('frontend/contact', $data);
    }
}
