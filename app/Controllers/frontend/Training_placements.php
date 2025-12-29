<?php

namespace App\Controllers\Frontend;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\TP\MouModel;
use App\Models\TP\PlacedStudentsModel;
use App\Models\TP\TpoTeamModel;
use App\Models\TP\TpSectionModel;

class Training_placements extends BaseController
{
    protected $mouModel;
    protected $tpoModel;
    protected $model;
    protected $Aboutmodel;
    public function __construct()
    {
        $this->mouModel = new MouModel();
        $this->tpoModel = new TpoTeamModel();
        $this->model = new PlacedStudentsModel();
        $this->Aboutmodel = new TpSectionModel();
    }
    public function Index()
    {
        $data = [
            'hero'      => $this->Aboutmodel->where('section_type', 'hero')->first(),
            'profile'   => $this->Aboutmodel->where('section_type', 'profile')->first(),
            'about'     => $this->Aboutmodel->where('section_type', 'about')->first(),
            'procedure' => $this->Aboutmodel->where('section_type', 'procedure')->first(),
            'carousel'  => $this->Aboutmodel->where('section_type', 'carousel')->findAll(),
        ];
        return view('frontend/training_placements/abouttpo', $data);
    }

    public function tpo()
    {
        $data = [
            'hero'     => $this->tpoModel->where('section_type', 'hero')->first(),
            'members'  => $this->tpoModel->where('section_type', 'member')->findAll(),
            'carousel' => $this->tpoModel->where('section_type', 'carousel')->findAll(),
        ];
        return view('frontend/training_placements/tpo', $data);
    }

    public function campus_placement()
    {
        $data = [
            'hero' => $this->model->where('section_type', 'hero')->first(),
            'students' => $this->model->where('section_type', 'student')->findAll(),
            'carousel' => $this->model->where('section_type', 'carousel')->findAll(),
        ];
        return view('frontend/training_placements/campus_placement', $data);
    }

    public function mous()
    {
        $data = [
            'hero'     => $this->mouModel->where('section_type', 'hero')->first(),
            'mous'     => $this->mouModel->where('section_type', 'mou')->findAll(),
            'carousel' => $this->mouModel->where('section_type', 'carousel')->findAll(),
        ];
        return view('frontend/training_placements/mous',$data);
    }
}
