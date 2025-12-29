<?php

namespace App\Controllers\Admin;

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




class Committee extends BaseController
{
    public function StudentGrievance()
    {
        $model = new GrievanceModel();

        $data = [
            'hero' => $model->where('section_type', 'hero')->first(),
            'committee' => $model->where('section_type', 'committee')->orderBy('sort_order')->findAll(),
        ];
        return view('admin/committee/student_grievance', $data);
    }

    public function saveHeroGrievance()
    {
        $model = new GrievanceModel();
        $id = $this->request->getPost('id');

        $data = [
            'section_type'  => 'hero',
            'title'         => $this->request->getPost('title'),
            'subtitle'      => $this->request->getPost('subtitle'),
            'button_text'   => $this->request->getPost('button_text'),
            'button_link'   => $this->request->getPost('button_link'),
        ];

        $img = $this->request->getFile('background_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/banner', $newName);
            $data['background_image'] = $newName;
        }

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('student_grievance'))->with('success', 'Hero section saved.');
    }

    public function saveMemberGrievance()
    {
        $model = new GrievanceModel();

        $data = [
            'section_type'    => 'committee',
            'name'            => $this->request->getPost('name'),
            'designation'     => $this->request->getPost('designation'),
            'associated_with' => $this->request->getPost('associated_with'),
            'sort_order'      => $this->request->getPost('sort_order') ?? 0,
            'status'          => 1
        ];

        $model->insert($data);
        return redirect()->to(base_url('student_grievance'))->with('success', 'Committee member added.');
    }


    public function deleteGrievance($id)
    {
        $model = new GrievanceModel();
        $model->delete($id);
        return redirect()->to(base_url('student_grievance'))->with('success', 'Deleted.');
    }




    public function Antiragging()
    {
        $model = new AntiRaggingModel();

        $data = [
            'hero'      => $model->where('section_type', 'hero')->first(),
            'committee' => $model->where('section_type', 'committee')->orderBy('sort_order')->findAll(),
            'squad'     => $model->where('section_type', 'squad')->orderBy('sort_order')->findAll(),
        ];
        return view('admin/committee/antiragging', $data);
    }

    public function saveAntiRagging()
    {
        $model = new AntiRaggingModel();
        $id = $this->request->getPost('id');

        $data = [
            'section_type'     => $this->request->getPost('section_type'),
            'title'            => $this->request->getPost('title'),
            'subtitle'         => $this->request->getPost('subtitle'),
            'button_text'      => $this->request->getPost('button_text'),
            'button_link'      => $this->request->getPost('button_link'),
            'name'             => $this->request->getPost('name'),
            'designation'      => $this->request->getPost('designation'),
            'email'            => $this->request->getPost('email'),
            'sort_order'       => $this->request->getPost('sort_order') ?? 0,
            'status'           => $this->request->getPost('status') ?? 1
        ];

        // Handle image upload
        $img = $this->request->getFile('background_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/banner', $newName);
            $data['background_image'] = $newName;
        }

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('antiragging'))->with('success', 'Data saved successfully!');
    }

    public function deleteAntiRagging($id)
    {
        $model = new AntiRaggingModel();
        $model->delete($id);
        return redirect()->to(base_url('antiragging'))->with('success', 'Data deleted successfully!');
    }

    public function Women_committee()
    {
        $model = new WomensModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('admin/committee/women_committee', $data);
    }
    public function saveHeroWomens()
    {
        $model = new WomensModel();
        $id = $this->request->getPost('id');
        $data = [
            'section_type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
        ];

        // $file = $this->request->getFile('background_image');
        // if ($file && $file->isValid() && !$file->hasMoved()) {
        //     $name = $file->getRandomName();
        //     $file->move(WRITEPATH . '../public/uploads/banner/', $name);
        //     $data['background_image'] = $name;
        // }

        $img = $this->request->getFile('background_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/banner', $newName);
            $data['background_image'] = $newName;
        }


        $id ? $model->update($id, $data) : $model->insert($data);
        return redirect()->to(base_url('women_committee'))->with('success', 'Hero saved.');
    }

    public function saveMemberWomens()
    {
        $model = new WomensModel();
        $model->insert([
            'section_type' => 'committee',
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'status' => 1
        ]);
        return redirect()->to(base_url('women_committee'))->with('success', 'Member added.');
    }

    public function deleteWomens($id)
    {
        (new WomensModel())->delete($id);
        return redirect()->to(base_url('women_committee'))->with('success', 'Deleted.');
    }



    //05-09-2025

        public function anti_hara_committee()
    {
        $model = new Anti_harr_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('admin/committee/anti_hara_committee', $data);
    }
    public function saveHeroAntihara()
    {
        $model = new Anti_harr_model();
        $id = $this->request->getPost('id');
        $data = [
            'section_type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
        ];

        // $file = $this->request->getFile('background_image');
        // if ($file && $file->isValid() && !$file->hasMoved()) {
        //     $name = $file->getRandomName();
        //     $file->move(WRITEPATH . '../public/uploads/banner/', $name);
        //     $data['background_image'] = $name;
        // }

        $img = $this->request->getFile('background_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/banner', $newName);
            $data['background_image'] = $newName;
        }


        $id ? $model->update($id, $data) : $model->insert($data);
        return redirect()->to(base_url('anti_hara_committee'))->with('success', 'Hero saved.');
    }

    public function saveMemberAntihara()
    {
        $model = new Anti_harr_model();
        $model->insert([
            'section_type' => 'committee',
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'appointed_as' => $this->request->getPost('appointed_as'),
            'contact' => $this->request->getPost('contact'),
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'status' => 1
        ]);
        return redirect()->to(base_url('anti_hara_committee'))->with('success', 'Member added.');
    }

    public function deleteAntihara($id)
    {
        (new Anti_harr_model())->delete($id);
        return redirect()->to(base_url('anti_hara_committee'))->with('success', 'Deleted.');
    }



    public function anti_sexual_committee()
    {
        $model = new Anti_sexual_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('admin/committee/anti_sexual', $data);
    }
    public function saveHeroAntisex()
    {
        $model = new Anti_sexual_model();
        $id = $this->request->getPost('id');
        $data = [
            'section_type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
        ];

        // $file = $this->request->getFile('background_image');
        // if ($file && $file->isValid() && !$file->hasMoved()) {
        //     $name = $file->getRandomName();
        //     $file->move(WRITEPATH . '../public/uploads/banner/', $name);
        //     $data['background_image'] = $name;
        // }

        $img = $this->request->getFile('background_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/banner', $newName);
            $data['background_image'] = $newName;
        }


        $id ? $model->update($id, $data) : $model->insert($data);
        return redirect()->to(base_url('anti_sexual_committee_admin'))->with('success', 'Hero saved.');
    }

    public function saveMemberAntisex()
    {
        $model = new Anti_sexual_model();
        $model->insert([
            'section_type' => 'committee',
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
             'appointed_as' => $this->request->getPost('appointed_as'),
            'contact' => $this->request->getPost('contact'),
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'status' => 1
        ]);
        return redirect()->to(base_url('anti_sexual_committee_admin'))->with('success', 'Member added.');
    }

    public function deleteAntisex($id)
    {
        (new Anti_sexual_model())->delete($id);
        return redirect()->to(base_url('anti_sexual_committee_admin'))->with('success', 'Deleted.');
    }


    //sc st committe
    
     public function sc_st_committee()
    {
        $model = new Sc_St_committee_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('admin/committee/sc_st_committee', $data);
    }
    public function saveHerosc_st()
    {
        $model = new Sc_St_committee_model();
        $id = $this->request->getPost('id');
        $data = [
            'section_type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
        ];

        // $file = $this->request->getFile('background_image');
        // if ($file && $file->isValid() && !$file->hasMoved()) {
        //     $name = $file->getRandomName();
        //     $file->move(WRITEPATH . '../public/uploads/banner/', $name);
        //     $data['background_image'] = $name;
        // }

        $img = $this->request->getFile('background_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/banner', $newName);
            $data['background_image'] = $newName;
        }


        $id ? $model->update($id, $data) : $model->insert($data);
        return redirect()->to(base_url('sc_st_committee_admin'))->with('success', 'Hero saved.');
    }

    public function saveMembersc_st()
    {
        $model = new Sc_St_committee_model();
        $model->insert([
            'section_type' => 'committee',
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'appointed_as' => $this->request->getPost('appointed_as'),
            'contact' => $this->request->getPost('contact'),
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'status' => 1
        ]);
        return redirect()->to(base_url('sc_st_committee_admin'))->with('success', 'Member added.');
    }

    public function deletesc_st($id)
    {
        (new Sc_St_committee_model())->delete($id);
        return redirect()->to(base_url('sc_st_committee_admin'))->with('success', 'Deleted.');
    }


        //enterpre committe
    
     public function entrepre_committee()
    {
        $model = new Entrepre_committee_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('admin/committee/entrepre_committee', $data);
    }
    public function saveHero_entrepre()
    {
        $model = new Entrepre_committee_model();
        $id = $this->request->getPost('id');
        $data = [
            'section_type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
        ];

        // $file = $this->request->getFile('background_image');
        // if ($file && $file->isValid() && !$file->hasMoved()) {
        //     $name = $file->getRandomName();
        //     $file->move(WRITEPATH . '../public/uploads/banner/', $name);
        //     $data['background_image'] = $name;
        // }

        $img = $this->request->getFile('background_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/banner', $newName);
            $data['background_image'] = $newName;
        }


        $id ? $model->update($id, $data) : $model->insert($data);
        return redirect()->to(base_url('entrepre_committee_admin'))->with('success', 'Hero saved.');
    }

    public function saveMember_entrepre()
    {
        $model = new Entrepre_committee_model();
        $model->insert([
            'section_type' => 'committee',
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
             'appointed_as' => $this->request->getPost('appointed_as'),
            'contact' => $this->request->getPost('contact'),
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'status' => 1
        ]);
        return redirect()->to(base_url('entrepre_committee_admin'))->with('success', 'Member added.');
    }

    public function deletesc_entrepre($id)
    {
        (new Entrepre_committee_model())->delete($id);
        return redirect()->to(base_url('entrepre_committee_admin'))->with('success', 'Deleted.');
    }


    //social life committe

         public function social_life()
    {
        $model = new Social_life_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('admin/committee/social_life', $data);
    }
    public function saveHero_social_life()
    {
        $model = new Social_life_model();
        $id = $this->request->getPost('id');
        $data = [
            'section_type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
        ];

        // $file = $this->request->getFile('background_image');
        // if ($file && $file->isValid() && !$file->hasMoved()) {
        //     $name = $file->getRandomName();
        //     $file->move(WRITEPATH . '../public/uploads/banner/', $name);
        //     $data['background_image'] = $name;
        // }

        $img = $this->request->getFile('background_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/banner', $newName);
            $data['background_image'] = $newName;
        }


        $id ? $model->update($id, $data) : $model->insert($data);
        return redirect()->to(base_url('social_life_admin'))->with('success', 'Hero saved.');
    }

    public function saveMember_social_life()
    {
        $model = new Social_life_model();
        $model->insert([
            'section_type' => 'committee',
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'appointed_as' => $this->request->getPost('appointed_as'),
            'contact' => $this->request->getPost('contact'),
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'status' => 1
        ]);
        return redirect()->to(base_url('social_life_admin'))->with('success', 'Member added.');
    }

    public function delete_social_life($id)
    {
        (new Social_life_model())->delete($id);
        return redirect()->to(base_url('social_life_admin'))->with('success', 'Deleted.');
    }

    //vishaka

    public function vishaka_committee()
    {
        $model = new Vishaka_committee_model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('admin/committee/vishaka_committee', $data);
    }
    public function saveHero_vishaka_committee()
    {
        $model = new Vishaka_committee_model();
        $id = $this->request->getPost('id');
        $data = [
            'section_type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
        ];

        // $file = $this->request->getFile('background_image');
        // if ($file && $file->isValid() && !$file->hasMoved()) {
        //     $name = $file->getRandomName();
        //     $file->move(WRITEPATH . '../public/uploads/banner/', $name);
        //     $data['background_image'] = $name;
        // }

        $img = $this->request->getFile('background_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/banner', $newName);
            $data['background_image'] = $newName;
        }


        $id ? $model->update($id, $data) : $model->insert($data);
        return redirect()->to(base_url('vishaka_committee_admin'))->with('success', 'Hero saved.');
    }

    public function saveMember_vishaka_committee()
    {
        $model = new Vishaka_committee_model();
        $model->insert([
            'section_type' => 'committee',
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'appointed_as' => $this->request->getPost('appointed_as'),
            'contact' => $this->request->getPost('contact'),
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'status' => 1
        ]);
        return redirect()->to(base_url('vishaka_committee_admin'))->with('success', 'Member added.');
    }

    public function delete_vishaka_committee($id)
    {
        (new Vishaka_committee_model())->delete($id);
        return redirect()->to(base_url('vishaka_committee_admin'))->with('success', 'Deleted.');
    }

    //emergancy_committee
    public function emergency_committee()
    {
        $model = new Emergency_committee_Model();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['committee'] = $model->where('section_type', 'committee')->orderBy('sort_order')->findAll();
        return view('admin/committee/emergancy_committee', $data);
    }

    public function saveHero_emergency_committee()
    {
        $model = new Emergency_committee_Model();
        $id = $this->request->getPost('id');
        $data = [
            'section_type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
        ];

        // $file = $this->request->getFile('background_image');
        // if ($file && $file->isValid() && !$file->hasMoved()) {
        //     $name = $file->getRandomName();
        //     $file->move(WRITEPATH . '../public/uploads/banner/', $name);
        //     $data['background_image'] = $name;
        // }

        $img = $this->request->getFile('background_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/banner', $newName);
            $data['background_image'] = $newName;
        }


        $id ? $model->update($id, $data) : $model->insert($data);
        return redirect()->to(base_url('emergency_committee_admin'))->with('success', 'Hero saved.');
    }

    public function saveMember_emergency_committee()
    {
        $model = new Emergency_committee_Model();
        $model->insert([
            'section_type' => 'committee',
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
             'appointed_as' => $this->request->getPost('appointed_as'),
            'contact' => $this->request->getPost('contact'),
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'status' => 1
        ]);
        return redirect()->to(base_url('emergency_committee_admin'))->with('success', 'Member added.');
    }

    public function delete_emergency_committee($id)
    {
        (new Emergency_committee_Model())->delete($id);
        return redirect()->to(base_url('emergency_committee_admin'))->with('success', 'Deleted.');
    }




    
}
