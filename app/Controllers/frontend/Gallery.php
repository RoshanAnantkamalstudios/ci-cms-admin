<?php

namespace App\Controllers\Frontend;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\Home\GalleryModel;

class Gallery extends BaseController
{

    protected $galleryModel;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
    }

    public function Index()
    {
        $data['gallery'] = $this->galleryModel->where('type', 'item')->findAll();
        $data['hero'] = $this->galleryModel->where('type', 'hero')->first();
        return view('frontend/gallery', $data);
    }

    public function gallery()
    {
        $data['gallery'] = $this->galleryModel->where('type', 'item')->findAll();
        $data['hero'] = $this->galleryModel->where('type', 'hero')->first();
        return view('frontend/gallery', $data);
    }
}
