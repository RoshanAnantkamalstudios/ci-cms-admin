<?php

namespace App\Controllers\Frontend;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\AboutUs\BoardGovernanceModel;
use App\Models\AboutUs\BoardPageModel;
use App\Models\AboutUs\PresidentDeskModel;
use App\Models\AboutUs\PrincipalDeskModel;
use App\Models\AboutUs\VisionMissionModel;

class About_us extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function Index()
    {
        $model = new BoardPageModel();
        $hero = $model->where('type', 'hero')->first();
        $members = $model->where('type', 'member')->findAll();
        return view('frontend/about_us/board_member', [
            'hero' => $hero,
            'members' => $members
        ]);
    }

    public function president()
    {
        $model = new PresidentDeskModel();
        $data['data'] = $model->first();
        return view('frontend/about_us/president', $data);
    }

    public function principal()
    {
        $model = new PrincipalDeskModel();
        $data['principal'] = $model->first();
        return view('frontend/about_us/principal', $data);
    }

    public function governing()
    {
        $model = new BoardGovernanceModel();
        $hero = $model->where('type', 'hero')->first();
        $members = $model->where('type', 'member')->orderBy('display_order')->findAll();
        return view('frontend/about_us/governing', [
            'hero' => $hero,
            'members' => $members
        ]);
    }

    public function vision_mission()
    {
        $model = new VisionMissionModel();
        $data['vm'] = $model->first();
        return view('frontend/about_us/vision_mission', $data);
    }
}
